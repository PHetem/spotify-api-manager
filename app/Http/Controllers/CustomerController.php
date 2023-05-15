<?php

namespace App\Http\Controllers;

use App\Models\Customer;

class CustomerController extends Controller
{
    public function dashboard() {
        $customers = Customer::all();

        return view('dashboard', compact('customers'));
    }

    public function details($id) {
        $customer = Customer::find($id);

        LogController::store('Customer Viewed: ' . $id);
        return view('customer.view', compact('customer'));    }

    public function delete($id) {
        Customer::find($id)->delete();

        LogController::store('Customer Deleted: ' . $id);
        return redirect()->route('dashboard');
    }
}
