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

use App\Services\{TaskService,
                 UsersService};

use App\Traits\StringFormaTrait;

class TaskBoardController extends Controller
{
    use StringFormaTrait;
    private $taskService;
    private $usersService;

    public function __construct(TaskService $taskService, UsersService $usersService)
    {
        $this->taskService = $taskService;
        $this->usersService = $usersService;
    }

    public function search(Request $filter)
    {
        return Inertia::render('Tasks/Dashboard/Index', [
            'results' => $this->taskService->searchPaginate($filter->all()),
            'statusList' => $this->taskService->getStatusWithAllItemList(),
            'params' => $this->formatUrlParams($filter->except('page', 'date_range')),
        ]);
    }

    public function createForm()
    {
        return Inertia::render('Tasks/New', [
            'users' => $this->usersService->searchGet([]),
            'statusList' => $this->taskService->getStatusList(),
        ]);
    }

    public function create()
    {

    }





}