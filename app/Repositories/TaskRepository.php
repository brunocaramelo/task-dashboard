<?php

namespace App\Repositories;

use App\Models\Task;
use App\Interfaces\TaskInterface;

use App\Models\StatusTask;
class TaskRepository implements TaskInterface
{
    private $model = Task::class;

    public function searchPaginate(array $filters)
    {
        return cache()->tags(['tasksList'])
            ->remember('tasksList:'.json_encode($filters), config('cache.default_duration'), function () use ($filters){
                return $this->searchPaginateQuery($filters)
                            ->paginate($filters['page_limit'] ?? 10);
        });
    }

    private function searchPaginateQuery($filters)
    {
        return $this->model::with([
            'status:id,name,slug',
        ])->when(!empty($filters['title']), function ($query) use ($filters) {
            $query->where('tasks.title', 'LIKE' ,'%'.$filters['title'].'%');
        })
        ->when(!empty($filters['code']), function ($query) use ($filters) {
            $query->where('tasks.code', 'LIKE' ,'%'.$filters['code'].'%');
        })
        ->when(!empty($filters['status']), function ($query) use ($filters) {
            $query->where('tasks.status_id', '=' ,$filters['status']);
        })
        ->when(!empty($filters['is_cancelled']), function ($query) use ($filters) {
            $query->isCancelled();
        })->when((!empty($filters['order_field']) && !empty($filters['order_sense'])), function ($query) use ($filters) {
            $query->orderBy($filters['order_field'] , $filters['order_sense']);
        })->when((empty($filters['order_field']) || empty($filters['order_sense'])), function ($query) use ($filters) {
            $query->orderBy('tasks.created_at' , 'DESC');
        });
    }


    public function update(array $data, $id)
    {
        $this->model::find($id)->update($data);

        return $this->model::find($id);
    }

    public function create(array $data)
    {
        $data['author_id'] = \Auth::user()->id;
        $creater = $this->model::create($data);
        $creater->code = 'PBI-'.$creater->id;
        $creater->save();

        return $creater;
    }
    public function getItem($idItem)
    {
        return cache()->tags(['taskItem'])
                ->remember('taskItem:'.$idItem, config('cache.default_duration'), function () use ($idItem){
                    return $this->getEagerLoadQuery()
                                ->where('tasks.id', $idItem)
                                ->first();
        });
    }

    public function getEagerLoadQuery()
    {
        return $this->model::with([
            'comments:id,message',
            'comments.responsible:id,name,email',
            'rapporteur:id,name,email',
            'responsable:id,name,email',
            'status:id,name,slug',
        ]);
    }

    public function getStatusList()
    {
        return cache()->tags(['statusTask'])
                ->remember('statusTask' ,config('cache.default_duration'), function (){
                    return StatusTask::get();
        });
    }
}
