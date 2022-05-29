<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'slug',
    ];

    public function posts()
    {
        // hasOne, hasMany, belongsTo, belongsToMany
        // category has many posts
        return $this->hasMany(Post::class);
    }
}
