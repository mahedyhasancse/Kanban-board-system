<?php

namespace App\Http\Controllers;

use App\Board;
use App\Status;
use App\Task;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'access_id' => 'required|unique:boards',
            'color' => 'required'
        ]);
        Board::create([
            'name' => $request->name,
            'access_id' => $request->access_id,
            'color' => $request->color,
            'user_id' => auth()->user()->id
        ]);
        toastr()->success('add successfully');
        return back();
    }

    public function update(Request $request, Board $board)
    {
        $this->validate($request, [
            'name' => 'required',
            'access_id' => 'required|unique:boards,access_id,'.$board->id,
            'color' => 'required'
        ]);
        $board->update([
            'name' => $request->name,
            'access_id' => $request->access_id,
            'color' => $request->color,
            'user_id' => auth()->user()->id
        ]);
        toastr()->success('Update successfully');
        return back();
    }
    public function delete(Board $board)
    {
        $board->delete();
        toastr()->success('Deleted successfully');
        return back();
    }

    public function show()
    {  
        $statuses = Status::query()->with('tasks')->orderBy('order')->get();
        return view('boards.index', compact('statuses'));
    }
    public function singleBoardShow($board_identifier)
    {
        $board = Board::query()->where('access_id', $board_identifier)->first();
        if(empty($board)) abort('404');
        $statuses = Status::query()->orderBy('order')->get();
        foreach ($statuses as &$status) {
            $status->tasks = $status->getBoardTasks($board->id);
        }
        return view('boards.index', compact('statuses'));
    }
}
