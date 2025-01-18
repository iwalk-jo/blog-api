<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public static $wrap = 'posts';

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'posts',
            'id' => $this->post_id,
            'attributes' => [
                'title' => $this->title,
                'content' => $this->content,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'relationships' => [
                'user' => [
                    'data' => [
                        'type' => 'users',
                        'id' => $this->whenNotNull($this->user, fn() => $this->user->id),
                    ],
                ],
            ],
            'links' => [
                'self' => route('posts.show', $this->post_id),
            ],
        ];
    }

    public function with($request)
    {
        return [
            'status' => 'success',
        ];
    }
}