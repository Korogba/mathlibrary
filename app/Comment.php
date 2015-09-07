<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Comment: Model for student comments on books in the library
 * @package App
 */
class Comment extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'comments';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['comment', 'book_id', 'user_id', 'rating'];

    /* Return this comment's author
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /* Return the book commented on
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function book()
    {
        return $this->belongsTo('App\Book');
    }
}
