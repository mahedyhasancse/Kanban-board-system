<?php

namespace App\Http\Controllers;

use App\Board;
use App\Status;
use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //
    public function index()
    {
        return view('kanban.task');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'board_id' => 'required',
            'description' => 'required'
        ]);
        $a =   Task::create([
            'title' => $request->name,
            'description' =>  $request->description,
            'board_id' => $request->board_id,
            'user_id'=>auth()->user()->id,
            'status_id' =>  Status::query()->where('order', '=', 0)->first()->id,
        ]);
        toastr()->success('add successfully');
        return back();
    }

    public function update(Request $request,Task $task)
    {
        $this->validate($request, [
            'name' => 'required',
            'board_id' => 'required',
            'description' => 'required'
        ]);
        $task->update([
            'title' => $request->name,
            'description' =>  $request->description,
            'board_id' => $request->board_id,
            'user_id'=>auth()->user()->id,
        ]);

        toastr()->success('Updated successfully');
        return back();
    }
    public function delete(Task $task){
     $task->delete();
     toastr()->success('Deleted successfully');
     return back();
    }

    public function sync(Request $request){
        $this->validate(request(), [
            'columns' => ['required', 'array']
        ]);

        foreach ($request->columns as $status) {
            foreach ($status['tasks'] as $i => $task) {
                $order = $i + 1;
                if ($task['status_id'] !== $status['id'] || $task['order'] !== $order) {
                    Task::find($task['id'])->update([
                        'status_id' => $status['id'],
                        'order' => $order
                    ]);
                }
            }
        }

        return Status::query()->with('tasks')->get();
    }
}
