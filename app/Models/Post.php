<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    // use WithPagination;

    // adding this line is good for security
    // prevents users from adding more in a query
    // such as changing their account status to admin 
    // or changing the id
    // MASS ASSIGNMENT VULNERBILITY

    // this will accept anything other than id
    // protected $guarded = ['id'];
    protected $guarded = [];

    // use this instead of load(['category', 'author'])
    // this will drop many queries from being ran on page load
    protected $with = ['category', 'author'];
    
    /**
     * Filter query search results
     *
     * @return void
     */
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, fn($query, $search) => 
            $query->where(fn($query) =>
                $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('body', 'like', '%' . $search . '%')
            )
        );
            
        $query->when($filters['category'] ?? false, fn($query, $category) => 
            $query->whereHas('category', fn($query) =>
                $query->where('slug', $category)
            )
        );

        $query->when($filters['author'] ?? false, fn($query, $author) => 
            $query->whereHas('author', fn($query) =>
                $query->where('username', $author)
            )
        );


    }

    // this will not allow anything except title, excerpt, body
    // protected $fillable = ['slug', 'title', 'excerpt', 'body'];

    // instead of using Route::get('posts/{post}:slug', function(Post $post) {
    // you can use the following method to grab the slug and not the id when routing
    // both do the same thing
    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }

    public function category()
    {
        // hasOne, hasMany, belongsTo, belongsToMany
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        // hasOne, hasMany, belongsTo, belongsToMany
        return $this->belongsTo(User::class, 'user_id');
    }
}
