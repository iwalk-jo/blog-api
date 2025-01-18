<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'authors', // Use 'authors' since the class name is AuthorResource
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
                'email' => $this->email,
                // Add other relevant attributes like 'created_at', 'updated_at'
            ],
            'links' => [
                'self' => route('authors', $this->id), // Use 'authors' as the route name
            ],
        ];
    }
}
