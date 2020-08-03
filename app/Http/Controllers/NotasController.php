<?php

namespace App\Http\Controllers;

use App\Notas;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotasController extends Controller
{
    function getNotas(){
        $user = \auth()->user();
        return response()->json($user->notas);
    }
    function guardarNotas(Request $request){
        $nota  = new Notas([
            'nota'=>$request->nota,
            'users_id'=>\auth()->user()->id
        ]);
        $nota->save();
    }
}
