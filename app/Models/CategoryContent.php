<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryContent extends Model
{
    // ...

    /**
     * Get the category that owns the category content.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the post that owns the category content.
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
