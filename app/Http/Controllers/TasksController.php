<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Note;
use App\User;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tasks = Task::all();

        return view('tasks.index', [
            'tasks' => $tasks
        ]);
    }

    public function get($taskId)
    {
        // Get task from Tasks table
        $task = Task::where('id', $taskId)->first();
        return $task;
    }

    public function processTask($task)
    {
        // Get creator name from Users table
        $taskCreatorId = $task->user_id;
        $taskCreatorName = User::where('id', $taskCreatorId)->first()->name;

        // Add $taskCreatorName to $task
        $task->createdBy = $taskCreatorName;

        // Get related Notes from Notes table
        $notes = Note::where('task_id', $task->id)->get();

        // Process each note
        $notes->map(function($note, $key){
            // Get creator name from Users table
            $noteCreatorId = $note->user_id;
            $noteCreatorName = User::where('id', $noteCreatorId)->first()->name;

            // Add $creatorName to $note
            $note->createdBy = $noteCreatorName;
            return $note;
        });

        // Add processed $notes to $task
        $task->notes = $notes->all();

        return $task;
    }

    public function loadTask($taskId)
    {
        // Get Task
        $rawTask = $this->get($taskId);

        // Process Task
        $task = $this->processTask($rawTask);

        return view('tasks.task', [
            'task' => $task,
            'mode' => 'read'
        ]);
    }

    public function edit($taskId)
    {
        // Check $taskId value and set $mode accordingly
        if ($taskId === 'new') {
            $mode = 'new';
            $task = new Task();
        } else {
            $mode = 'edit';

            // Get Task
            $rawTask = $this->get($taskId);

            // Process Task
            $task = $this->processTask($rawTask);
        }
        return view('tasks.task', [
            'task' => $task,
            'mode' => $mode
        ]);
    }

    public function updateTask($taskId)
    {
        // Get task
        $task = Task::find($taskId);

        // Add new task values
        $task->name = request('name');
        $task->details = request('details');

        $task->save();

        return redirect('/task/'.$taskId);
    }

    public function store()
    {
        $userId = Auth::id();

        // Build Task
        $task = new Task();
        $task->name = request('name');
        $task->details = request('details');
        $task->user_id = $userId;

        // Save Task and Note
        $task->save();

        return redirect('/tasks');
    }

    public function destroy($taskId)
    {
        // Delete associated notes
        Note::where('task_id', $taskId)->delete();

        // Delete task
        Task::where('id', $taskId)->delete();

        return redirect('/tasks');
    }
}
