<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Note;
use App\User;

class TasksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tasks = Task::all();

        return view('tasks.index', ['tasks' => $tasks]);
    }
    public function get($taskId)
    {
        // Set mode ('new' or 'edit')
        if ($taskId === 'new') {
            $mode = 'new';
            $task = new Task();
        } else {
            $mode = 'edit';

            // Get task from Tasks table
            $task = Task::where('id', $taskId)->first();

            // Use note IDs to get each note from Notes table.
            // Push each note into new array, "notesDetails"
            // Add notesDetails to $task
            $noteIds = $task->notes;
            $notesArray = array();
            for ($i = 0; $i < count($noteIds); $i++) {
                $note = Note::where('id', $noteIds[$i])->first();

                // Get creator name from Users table
                $creatorId = $note->created_by;
                $creatorName = User::where('id', $creatorId)->first()->name;
                // Add $creatorName to $note
                $note->createdBy = $creatorName;

                array_push($notesArray, $note);
            }
            $task->notesDetails = $notesArray;
        }

        return view('tasks.task', ['task' => $task, 'mode' => $mode]);
    }
    public function store()
    {
        $task = new Task();
        $task->name = request('name');
        $task->description = request('description');

        $note = new Note();
        $note->name = request('noteName');
        $note->description = request('noteDescription');

        /*TODO Find out how to elegantly do this save.*/
        /* 1. Save task to get taskId */
        /* 2. Add taskId to Note, then save Note */
        /* 3. On Note save callback, get noteId */
        /* 4. Update task to have noteId and save */

        // $task->save();
        // return redirect('/tasks');
    }
}
