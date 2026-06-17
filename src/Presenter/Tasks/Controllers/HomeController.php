<?php

namespace Src\Presenter\Tasks\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Inertia\Inertia;

use Src\Application\Tasks\UseCases\{SearchTasksUseCase,
                                    GetTaskStatusListUseCase};

class HomeController extends Controller
{
    public function __construct(
        private SearchTasksUseCase $searchTasksUseCase,
        private GetTaskStatusListUseCase $getTaskStatusListUseCase
    ) {
    }

    public function dashboard()
    {
        return Inertia::render('Dashboard', [
            'lastsTasks' => $this->searchTasksUseCase->execute([
                'page_limit' => 4,
            ]),
            'counters' => $this->getCountersByStatus(),
        ]);
    }

    private function getCountersByStatus()
    {
        $list = [];

        $listStatus = $this->getTaskStatusListUseCase->execute(false);

        foreach($listStatus as $status) {
            $list[] = [
                'code' => $status->code,
                'name' => $status->name,
                'total' => $this->searchTasksUseCase->execute([
                    'page_limit' => 1,
                    'status' => $status->id
                ])->total(),
            ];
        }

        return $list;
    }
}
