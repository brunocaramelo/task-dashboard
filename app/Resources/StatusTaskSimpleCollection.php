<?php

namespace App\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Resources\StatusTaskResource;

class StatusTaskSimpleCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into a simple array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public $collects = StatusTaskResource::class;

    public function toArray($request)
    {
        return $this->collection;

    }
}
