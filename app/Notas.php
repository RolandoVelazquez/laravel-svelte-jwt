<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notas extends Model
{
    protected $fillable=['nota','users_id'];
    function getUser(){
        return $this->belongsTo(User::class);
    }
}
