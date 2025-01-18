<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'user_id',
        // Add other fields as needed (e.g., 'published_at', 'slug')
    ];

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
