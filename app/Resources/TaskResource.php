<?php

namespace App\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'code' => $this->code,
            'rapporteur_id' => $this->rapporteur_id,
            'responsible_id' => $this->responsible_id,
            'author_id' => $this->author_id,
            'status_id' => $this->status_id,
            'description' => $this->description,
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
            'deleted_at' => $this->deleted_at?->format('Y-m-d H:i:s'),

            'status' => [
                'id' => $this->status->id,
                'name' => $this->status->name,
                'slug' => $this->status->slug,
            ],

            'author' => [
                'id' => $this->author->id,
                'name' => $this->author->name,
                'email' => $this->author->email,
            ],

            'rapporteur' => $this->rapporteur ? [
                'id' => $this->rapporteur->id,
                'name' => $this->rapporteur->name,
                'email' => $this->rapporteur->email,
            ] : null,

            'responsible' => $this->responsable ? [
                'id' => $this->responsable->id,
                'name' => $this->responsable->name,
                'email' => $this->responsable->email,
            ] : null,

            'is_pending' => $this->status->code === 'pending',
            'is_cancelled' => $this->status->code === 'cancelled',
        ];
    }
}