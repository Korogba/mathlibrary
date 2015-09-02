<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Spatie\SearchIndex\Searchable;

/**
 * Class Book: Model for book entity in the library
 * @package App
 */
class Book extends Model implements Searchable
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'books';

    /**
     * Make year attribute an instance of carbon
     *
     * @var array
     */
    protected $dates = ['year'];

    /**
     * Setter for year to  discard day and month.
     * @param $year
     */
    public function setYearAttribute($year)
    {
        $this->attributes['year'] = Carbon::createFromFormat('Y-m-d', $year);
    }

    /**
     * Getter for year to return carbon instance
     * @param $year
     * @return string
     */
    public function getYearAttribute($year)
    {
        return Carbon::parse($year)->format('Y-m-d');
    }

    /**
     * Get fully qualified name of Author
     * @return string
     */
    public function getAuthor(){
        return $this->author->last_name.' '.$this->author->first_name;
    }

    /**
     * Get quantity of book remaining
     * @return string
     */
    public function getStock(){
        $loaned = Book::whereHas('transact', function($query){
                        $query->where('type', 'loan')
                              ->where('book_id', $this->attributes['id']);
                        })->count();
        return $this->attributes['quantity'] - $loaned;
    }

    /**
     * Get users that have reserved
     * @return Collection of Object User
     */
    public function getReservations()
    {
        return User::whereHas('transact', function($query){
            $query->where('type', 'reservation')
                  ->where('book_id', $this->attributes['id']);
        })->get();
    }

    /**
     * Get users that have overdue copies of this books
     * @return User collection
     */
    public function getOverdue()
    {
        return User::whereHas('transact', function($query){
            $query->where('type', 'loan')
                  ->where('book_id', $this->attributes['id'])
                  ->where('expires', '<=', Carbon::now());
        })->get();
    }

    /**
     * Get users that have loaned this book
     * @return User collection
     */
    public function getLoan()
    {
        return User::whereHas('transact', function($query){
            $query->where('type', 'loan')
                ->where('book_id', $this->attributes['id'])
                ->where('expires', '>', Carbon::now());
        })->get();
    }

    /**
     * Get library wide overdue books
     * @return Book collection
     */
    public static function overdue()
    {
        return Book::whereHas('transact', function($query){
            $query->where('type', 'loan')
                  ->where('expires', '<=', Carbon::now());
        })->get();
    }

    /**
     * Get library wide reserved books
     * @return Book collection
     */
    public static function reserved()
    {
        return Book::whereHas('transact', function($query){
            $query->where('type', 'reservation');
        })->get();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'author_id', 'publisher_id', 'isbn', 'image', 'summary', 'year', 'edition', 'quantity'];

    /**A book can have a single author
     * Return this books author
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo('App\Author');
    }

    /**
     * A book can have one publisher
     * Return this book's publisher
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function publisher()
    {
        return $this->belongsTo('App\Publisher');
    }

    /**
     * A book can be reserved by more than one user
     * Return this book's reservations
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo

    public function reserved()
    {
        return $this->belongsToMany('App\User', 'reservations')
                    ->withTimestamps()
                    ->withPivot('expires');
    }
     *
     */

    /**
     * A book can have different transactions with different users
     * Return this book's loanee
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transact()
    {
        return $this->belongsToMany('App\User', 'transactions')
                    ->withTimestamps()
                    ->withPivot('status', 'expires');
    }

    /**
     * A book can have several reviews/comment.
     * Get this book's reviews
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comment()
    {
        return $this->hasMany('App\Comment');
    }

    /**
     * Returns an array with properties which must be indexed.
     *
     * @return array
     */
    public function getSearchableBody()
    {
        return [
            'title' => $this->attributes['title'],
            'isbn' => $this->attributes['isbn'],
            'summary' => $this->attributes['summary'],
            'author' => $this->getAuthor(),
            'publisher' => $this->publisher->name,
        ];
    }

    /**
     * Return the type of the searchable subject.
     *
     * @return string
     */
    public function getSearchableType()
    {
        return 'book';
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
