<?php

namespace App\Http\Resources\V1;

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
            'id' => $this->id,
            'attributes' => [
                'title' => $this->title,
                'content' => $this->content,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'relationships' => [
                'author' => [
                    'data' => $this->whenLoaded('author', function () {
                        return [
                            'type' => 'users',
                            'id' => $this->author->id,
                        ];
                    }),
                ],
            ],
            'links' => [
                'self' => route('posts.show', $this->id), // Replaced $this->post_id with $this->id
            ],
        ];
    }

    /**
     * Add additional meta information to the response.
     */
    public function with($request)
    {
        return [
            'status' => 'success',
        ];
    }

    /**
     * Customize the response headers.
     *
     * @param Request $request
     * @param \Illuminate\Http\Response $response
     */
    public function withResponse($request, $response)
    {
        $response->header('Accept', 'application/json');
    }

}