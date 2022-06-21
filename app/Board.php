<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
  
    protected $fillable = [
        'name', 'access_id', 'color','user_id',
    ];

    public function user(){
      return   $this->belongsTo(User::class,'user_id');
    }

    public function tasks(){
      return $this->hasMany(Task::class,'board_id');
    }
   
}
