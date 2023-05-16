<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LogController;
use App\Models\Customer\Customer;

class CustomerController extends Controller
{
    public function list($pagination = 30) {
        $customers = Customer::paginate($pagination);

        return view('dashboard', compact('customers'));
    }

    public function details($id) {
        $customer = Customer::with('playlists', 'albums', 'podcasts', 'tracks', 'tracks.album')
                            ->find($id);

        LogController::store('Customer Viewed: ' . $id);
        return view('customer.view', compact('customer'));
    }

    public function delete($id) {
        Customer::find($id)->delete();

        LogController::store('Customer Deleted: ' . $id);
        return redirect()->route('dashboard');
    }
}
