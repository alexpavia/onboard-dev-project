<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;
use App\Task;
use App\User;
use Illuminate\Support\Facades\Auth;

class NotesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function get($noteId)
    {
        // Get note from Notes table
        $note = Note::where('id', $noteId)->first();
        return $note;
    }

    public function processNote($note)
    {
        // Get creator name from Users table
        $noteCreatorId = $note->user_id;
        $noteCreatorName = User::where('id', $noteCreatorId)->first()->name;

        // Add $noteCreatorName to $note
        $note->createdBy = $noteCreatorName;

        // Get the note's Task from the Tasks table
        $task = Task::where('id', $note->task_id)->first();

        // Add $task to $note
        $note->task = $task;

        return $note;
    }

    public function loadNote($noteId)
    {
        // Get Note
        $rawNote = $this->get($noteId);

        // Process Note
        $note = $this->processNote($rawNote);

        return view('notes.note', [
            'note' => $note,
            'mode' => 'edit'
        ]);
    }

    public function create($taskId)
    {
        // Get Task
        $task = Task::find($taskId);

        // Create new note
        $note = new Note();

        // Add task to note
        $note->task = $task;

        return view('notes.note', [
            'note' => $note,
            'mode' => 'new'
        ]);
    }

    public function store()
    {
        $userId = Auth::id();

        // Build Note
        $note = new Note();
        $note->details = request('details');
        $note->user_id = $userId;
        $note->task_id = request('taskId');

        $note->save();

        return redirect('/task/'.$note->task_id);
    }

    public function updateNote($noteId)
    {
        // Get note
        $note = Note::find($noteId);

        // Add new note details
        $note->details = request('details');

        $note->save();

        return redirect('/task/'.$note->task_id);
    }

    public function destroy($noteId)
    {
        $taskId = request('taskId');
        Note::find($noteId)->delete();

        return redirect('/task/'.$taskId);
    }
}
