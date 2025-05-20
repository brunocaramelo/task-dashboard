<?php

namespace App\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Resources\TaskResource;

class TaskResourcePaginate extends ResourceCollection
{

    public function toArray($request)
    {
        return [
            'data' => TaskResource::collection($this->collection),
                'total' => $this->total(),
                'count' => $this->count(),
                'per_page' => $this->perPage(),
                'current_page' => $this->currentPage(),
                'total_pages' => $this->lastPage(),
                'links' => $this->linkCollection(),

        ];
    }
}
