<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Todo;


class TodoController extends Controller
{
    //


    public function index()
{   
    $todos = Todo::all();
    // $todos = Todo::where('user_id', Auth::id())->get();
    dd($todos);
    return view('todo.index', compact('todos'));
}


    public function create()
    {
        return view('todo.create');
    }

    public function edit()
    {
        return view('todo.edit');
    }
}
