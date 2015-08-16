<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Spatie\SearchIndex\Searchable;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract, Searchable
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'role', 'remember_token'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * A user can have various transactions with different book
     * Return this user's loaned books
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transact()
    {
        return $this->belongsToMany('App\Book', 'transactions')
                    ->withTimestamps()
                    ->withPivot('status', 'expires');
    }

    /**
     * Return all reservations for this user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getReservations()
    {
        return Book::whereHas('transact', function($query){
          $query->where('type', 'reservation')
                ->where('user_id', $this->attributes['id']);
        })->get();
    }

    /**
     * Return all loaned books of this user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getLoan()
    {
        return Book::whereHas('transact', function($query){
            $query->where('type', 'loan')
                  ->where('user_id', $this->attributes['id']);
        })->get();
    }

    /**
     * Return all overdue books of this user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getOverdue()
    {
        return Book::whereHas('transact', function($query){
            $query->where('type', 'loan')
                  ->where('expires', '<=', Carbon::now())
                  ->where('user_id', $this->attributes['id']);
        })->get();
    }

    /**
     * Check if relationship exists with book and return type
     * 0 means none exists, 1 means reserved, 2 means loaned.
     * @param $book_id
     * @return string
     */
    public function getStatus($book_id)
    {
        $transaction = $this->transact()
                      ->where('book_id', $book_id)
                      ->where('status', '<>', 0)
                      ->get();
        if($transaction->isEmpty()){
            return 0;
        }
        else{
             return $transaction->first()->pivot->status;
        }

        /* This returns a collection of users whose
         * book_id = $book_id and transaction status is not zero
         *
         * $type = User::whereHas('transact', function($query) use ($book_id){
                    $query->where('status', '<>', 0)
                          ->where('book_id', $book_id)
                          ->where('user_id', $this->id);
                    })->get();
        */
    }

    /**
     * Get human readable expires date of a book for this user
     * @param $book_id
     * @return string
     */
    public function getExpires($book_id){
        $expires = auth()->user()->transact->find($book_id)->pivot->expires;
        $carbon = Carbon::parse($expires);
        return $carbon->diffForHumans();
    }

    /**
     * Returns an array with properties which must be indexed.
     *
     * @return array
     */
    public function getSearchableBody()
    {
        return [
            'name' => $this->attributes['name'],
            'email' => $this->attributes['email'],
        ];
    }

    /**
     * Return the type of the searchable subject.
     *
     * @return string
     */
    public function getSearchableType()
    {
        return 'user';
    }

    /**
     * Return the id of the searchable subject.
     *
     * @return string
     */
    public function getSearchableId()
    {
        return $this->attributes['id'];
    }
}
