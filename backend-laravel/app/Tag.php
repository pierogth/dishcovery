<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * The attributes appended to the model
     *
     * @var array
     */
    protected $appends = ['count'];

    /**
     * Get all the articles that belong to the tag.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function articles()
    {
        return $this->belongsToMany(Article::class)->latest();
    }

    public function getCountAttribute()
    {

        return $this->articles()->count();

    }
}
