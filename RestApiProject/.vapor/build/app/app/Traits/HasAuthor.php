<?php

// app/Traits/HasAuthor.php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasAuthor
{
    public function author(): User
    {
        return $this->authorRelation;
    }

    public function authorRelation(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function isAuthoredBy(User $user): bool
    {
        return $this->author()->matches($user);
    }

    public function authoredBy(User $user)
    {
        return $this->authorRelation()->associate($user);
    }
}

