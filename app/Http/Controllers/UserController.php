<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function list($pagination = 30) {
        $users = User::paginate($pagination);

        LogController::store('View users');
        return view('user.list', compact('users'));
    }

    public function details($id) {
        $user = User::find($id);

        LogController::store('User Viewed: ' . $id);
        return view('user.view', compact('user'));
    }

    public function edit($id) {
        $user = User::find($id);

        return view('user.edit', compact('user'));
    }

    public function editPass($id) {
        $user = User::find($id);

        return view('user.updatepass', compact('user'));
    }

    public function update(Request $request, $id) {

        $data = $this->treatData($request);

        User::find($id)->update($data);

        LogController::store('User Updadted: ' . $id);
        return redirect()->route('users.list');
    }

    public function delete($id) {
        User::find($id)->delete();

        LogController::store('User Deleted: ' . $id);
        return redirect()->route('users.list');
    }

    private function treatData($request) {
        $data = [];
        $requestData = $request->all();

        if (isset($requestData['name'])) {
            $data['name'] = $requestData['name'];
        }

        if (isset($requestData['password'])) {
            $request->validate([
                'password' => 'required|confirmed'
            ]);

            $data['password'] = bcrypt($requestData['password']);
        }

        return $data;
    }
}
