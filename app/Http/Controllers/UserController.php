<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function index(){
        $user = User::all();
    // $todos = Todo::where('user_id', Auth::id())->get();
    dd($user);
        return view('user.index');
    }
}
