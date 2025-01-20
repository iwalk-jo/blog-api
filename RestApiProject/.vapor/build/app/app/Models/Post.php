<?php

namespace App\Models;

use App\Traits\HasAuthor;
use App\Traits\ModelHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, HasAuthor, ModelHelpers;

    const TABLE = 'posts';

    protected $table = self::TABLE;

    protected $fillable = [
        'title',
        'content',
        'user_id',
    ];

    public function id(): string
    {
        return (string) $this->id;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function content(): string
    {
        return $this->content;
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
