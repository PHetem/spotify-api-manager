<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function list() {
        $users = User::all();

        LogController::store('View users');
        return view('user.list', compact('users'));
    }

    public function details($id) {
        $user = User::find($id);

        LogController::store('User Viewed: ' . $id);
        return view('user.view', compact('user'));
    }

    public function delete($id) {
        User::find($id)->delete();

        LogController::store('User Deleted: ' . $id);
        return redirect()->route('users.list');
    }
}
