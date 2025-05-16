<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

use App\Services\TaskService;

use App\Traits\StringFormaTrait;

class TaskBoardController extends Controller
{
    use StringFormaTrait;
    private $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function search(Request $filter)
    {
        $results = $this->taskService->searchPaginate($filter->all());

        return Inertia::render('Tasks/Dashboard/Index', [
            'results' => $results,
            'statusList' => $this->taskService->getStatusWithAllItemList(),
            'params' => $this->formatUrlParams($filter->except('page', 'date_range')),
        ]);
    }




}