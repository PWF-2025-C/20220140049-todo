<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $search = request('search');

        // Eager loading hanya relasi todos
        $query = User::with('todos')
                    ->where('id', '!=', 1)
                    ->orderBy('name');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        $users = $query->paginate(20)->withQueryString();

        return view('user.index', compact('users'));
    }

    public function makeadmin(User $user)
    {
        $user->timestamps = false;
        $user->is_admin = true;
        $user->save();

        return back()->with('success', 'Make admin successfully!');
    }

    public function removeadmin(User $user)
    {
        if ($user->id != 1) {
            $user->timestamps = false;
            $user->is_admin = false;
            $user->save();

            return back()->with('success', 'Remove admin successfully!');
        } else {
            return redirect()->route('user.index');
        }
    }

    public function destroy(User $user)
    {
        if ($user->id != 1) {
            $user->delete();
            return back()->with('success', 'Delete user successfully!');
        } else {
            return redirect()->route('user.index')->with('danger', 'Delete user failed');
        }
    }
}
