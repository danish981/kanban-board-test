<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;

use App\Models\Phase;
use App\Models\Task;
use App\Models\User;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function kanban()
    {
        return view('tasks.index', [
            'card_count' => Task::count()
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Phase::with('tasks.user')->get();
    }

    /**
     * Display a listing of the Users resource.
     */
    public function users()
    {
        return User::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreTaskRequest $request
     */
    public function store(StoreTaskRequest $request)
    {
        $task = new Task();

        $task->name = $request['name'];
        $task->phase_id = $request['phase_id'];
        $task->user_id = $request['user_id'];

        if (Phase::find($request['phase_id'])->is_completion_phase || Phase::find($request['phase_id'])->name == 'Completed') {
            $task->completed_at = now()->format('Y-m-d H:i:s');
        }

        $task->save();
        // Task::create($request->validated());
    }

    public function stats()
    {
        $tasksUsers = [];
        foreach (User::get() as $user) {
            $tasksUsers[] = [
                'name' => $user->name,
                'tasks_count' => $user->tasks->count()
            ];
        }

        $tasks = Task::whereNotNull('completed_at')->get();

        $completedThisMonth = $tasks
            ->whereYear('completed_at', now()->year)
            ->whereMonth('completed_at', now()->month)
            ->count();

        $completedThisWeek = $tasks
            ->whereBetween('completed_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->count();

        return view('tasks.task-stats', [
            'taskUsers' => $tasksUsers,
            'tasks' => [
                'this_week' => $completedThisWeek,
                'this_month' => $completedThisMonth
            ]
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param $taskId
     */
    public function update(Request $request, $taskId): void
    {
        $task = Task::find($request['id']);

        $task->name = $request['name'];
        $task->phase_id = $request['phase_id'];
        $task->user_id = $request['user_id'];

        if ($task->phase->is_completion_phase) {
            $task->completed_at = now()->format('Y-m-d H:i:s');
        }

        $task->save();
    }

    /**
     * Remove the specified resource from storage.
     * @param Task $task
     */
    public function destroy(Task $task): void
    {
        Task::destroy($task->id);
    }
}
