<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

use App\Services\TaskService;
class HomeController extends Controller
{
    private $taskService;
    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function dashboard()
    {
        return Inertia::render('Dashboard', [
            'lastsTasks' => $this->taskService->searchPaginate([
                'page_limit' => 4,
            ]),
            'counters' => $this->getCountersByStatus(),
        ]);
    }

    private function getCountersByStatus()
    {
        $list = [];

        $listStatus = $this->taskService->getStatusList();

        foreach($listStatus as $status) {
            $list[] = [
                'code' => $status->code,
                'name' => $status->name,
                'total' => $this->taskService->searchPaginate([
                    'page_limit' => 1,
                    'status' => $status->id
                ])->total(),
            ];
        }

        return $list;
    }
}
