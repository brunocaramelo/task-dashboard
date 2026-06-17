<?php

namespace Src\Presenter\Tasks\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Src\Application\Tasks\UseCases\{GetTaskByIdUseCase,
                                    SearchTasksUseCase,
                                    CreateTaskUseCase,
                                    UpdateTaskUseCase,
                                    GetTaskStatusListUseCase};

use Src\Application\Users\UseCases\UserSearchGetUseCase;

use Src\Domain\Shared\Traits\StringFormaTrait;

class TaskBoardController extends Controller
{
    use StringFormaTrait;

    private $taskService;

    public function __construct(
        private UserSearchGetUseCase $userSearchUseCase,
        private SearchTasksUseCase $searchTasksUseCase,
        private CreateTaskUseCase $createTaskUseCase,
        private UpdateTaskUseCase $updateTaskUseCase,
        private GetTaskByIdUseCase $getTaskByIdUseCase,
        private GetTaskStatusListUseCase $getTaskStatusListUseCase,
    ) {
    }

    public function search(Request $filter)
    {

        return Inertia::render('Tasks/Dashboard/Index', [
            'results' => $this->searchTasksUseCase->execute($filter->all()),
            'statusList' => $this->getTaskStatusListUseCase->execute(true),
            'filters' => $filter,
            'params' => $this->formatUrlParams($filter->except('page', 'date_range')),
        ]);
    }

    public function createForm()
    {
        return Inertia::render('Tasks/New', [
            'users' => $this->userSearchUseCase->execute([])->toArray(),
            'statusList' => $this->getTaskStatusListUseCase->execute(false)->toArray(),
            'csrfToken' => csrf_token(),
        ]);
    }

    public function create(TaskCreateRequest $request)
    {
        $response = $this->taskService->create($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Created with success',
            'data' => $response,
            ], 201);
    }
    public function updateForm($id)
    {
        return Inertia::render('Tasks/Edit', [
            'users' => $this->userSearchUseCase->execute([]),
            'statusList' => $this->getTaskStatusListUseCase->execute(false),
            'task' => $this->getTaskByIdUseCase->execute($id)->toArray(),
            'csrfToken' => csrf_token(),
        ]);
    }

    public function update($id, TaskUpdateRequest $request)
    {
        $response = $this->updateTaskUseCase->execute($request->validated(), $id);

        return response()->json([
            'status' => 'success',
            'message' => 'Updated with success',
            'data' => $response,
            ], 200);
    }





}
