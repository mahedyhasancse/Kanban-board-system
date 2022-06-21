<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title','description', 'order', 'board_id', 'user_id', 'status_id'
    ];
    protected $appends = [
        'color'
    ];
    public function board()
    {
        return   $this->belongsTo(Board::class, 'board_id');
    }
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
    public function user(){
        return   $this->belongsTo(User::class, 'user_id');

    }

    public function getColorAttribute(){
        return "background-color: ".$this->board()->first()->color.';';
    }
}
