<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable=[
        'title', 'slug', 'order',
    ];
    public function tasks(){
        return $this->hasMany(Task::class,'status_id')->orderBy('order');
    }
    public function board(){
        return $this->hasMany(Board::class,'board_id');
    }

    public function getBoardTasks($board_id){
        return $this->tasks()->where('board_id', $board_id)->orderBy('order')->get();
    }
}
