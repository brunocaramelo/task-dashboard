<?php

declare(strict_types=1);

namespace Src\Infrastructure\Tasks\Repositories;

use Src\Application\Tasks\Dto\TaskDto;

use App\Models\Task;
use App\Interfaces\TaskInterface;

use App\Models\StatusTask;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class EloquentTaskRepository implements TaskInterface
{
    private $model = Task::class;

    public function searchPaginate(array $filters) : TaskDto
    {
        return cache()->tags(['tasksList'])
            ->remember('tasksList:'.json_encode($filters), config('cache.default_duration'), function () use ($filters){
                return TaskDto::collect($this->searchPaginateQuery($filters)
                            ->paginate($filters['page_limit'] ?? 10));
        });
    }

    private function searchPaginateQuery($filters) : Builder
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


    public function update(array $data, $id) : TaskDto
    {
        $this->model::find($id)->update($data);

        return TaskDto::from($this->model::find($id));
    }

    public function create(array $data) : TaskDto
    {
        $data['author_id'] = \Auth::user()->id;
        $creater = $this->model::create($data);
        $creater->code = 'PBI-'.$creater->id;
        $creater->save();

        return TaskDto::from($creater);
    }

    public function getItem($idItem) : TaskDto
    {
        return cache()->tags(['taskItem'])
                ->remember('taskItem:'.$idItem, config('cache.default_duration'), function () use ($idItem){
                    return TaskDto::from($this->getEagerLoadQuery()
                                ->where('tasks.id', $idItem)
                                ->first());
        });
    }

    public function getEagerLoadQuery() : Builder
    {
        return $this->model::with([
            'comments:id,message',
            'comments.responsible:id,name,email',
            'rapporteur:id,name,email',
            'responsable:id,name,email',
            'status:id,name,slug',
        ]);
    }

    public function getStatusList() : Collection
    {
        return cache()->tags(['statusTask'])
                ->remember('statusTask' ,config('cache.default_duration'), function (){
                    return StatusTask::get();
        });
    }
}
