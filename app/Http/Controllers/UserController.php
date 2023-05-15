<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function list() {
        $users = User::all();

        return view('user.list', compact('users'));
    }

    public function details($id) {
        $user = User::find($id);

        return view('user.view', compact('user'));
    }

    public function delete($id) {
        User::find($id)->delete();

        return redirect()->route('users.list');
    }
}
