<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {

        return $this->collection->map(function ($post) {
            return new PostResource($post);
        })->toArray();

    }

    /**
     * Additional metadata for the collection.
     *
     * @param Request $request
     * @return array<string, mixed>
     */
    public function with($request)
    {
        $status = $this->collection->isEmpty() ? 'error' : 'success';

        return [
            'status' => $status,
            'message' => $status === 'success' ? 'Data retrieved successfully.' : 'No data found.',
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
