<?php

// app/Traits/BelongsToUser.php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

trait BelongsToUser
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

// app/Models/Post.php
class Post extends Model
{
    use HasFactory, BelongsToUser;

    protected $fillable = ['title', 'content', 'user_id'];
}