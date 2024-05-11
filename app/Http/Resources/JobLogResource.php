<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobLogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'createdTs' => $this->created_at->timestamp,
            'sheduledForTs' => $this->scheduled_at->timestamp,
            'state' => $this->status,
        ];
    }
}
