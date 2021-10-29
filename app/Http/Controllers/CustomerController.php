<?php

namespace App\Http\Controllers;

use App\Models\BranchOffice;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(){
        #$customers = Customer::where('status','>','2')->paginate(10);
        return view('customers.index');
    }

    public function edit(Customer $customer){
        
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer){
        $request->validate([
            'name' => 'required',
            'contact' => 'required',
            'email' => 'email:rfc,dns'
        ]);

        $customer->update($request->all());

        return redirect()->back();
    }

    public function approve($id){
        $customer = Customer::find($id);
        $customer->status = 3;
        $customer->save();

        return view('customer.index');
    }
}
