<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Author: Model for author entity in the library
 * @package App
 */
class Author extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'authors';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'middle_name'];

    /**
     * An author can write several books.
     * Get this authors books
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function books()
    {
        return $this->hasMany('App\Book');
    }
}
