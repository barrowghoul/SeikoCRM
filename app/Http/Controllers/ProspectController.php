<?php

namespace App\Http\Controllers;

use App\Models\BranchOffice;
use App\Models\Customer;
use Illuminate\Http\Request;

class ProspectController extends Controller
{
    public function index(){
        return view('prospects.index');
    }

    public function create(){
        return view('prospects.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'contact' => 'required',
            'email' => 'email:rfc'
        ]);

        Customer::create([
            'name' => strtoupper($request->name),
            'contact' => strtoupper($request->contact),
            'email' => $request->email,
            'status' => Customer::PROSPECT,
        ]);

        return redirect()->route('prospects.index');
    }

    public function edit(Customer $prospect){
        if($prospect->status == 1){
            return view('prospects.edit', compact('prospect'));
        }else{
            $customer = BranchOffice::where('customer_id','=', $prospect->id)->firstOrFail();
            return view('prospects.edit', compact('prospect','customer'));
        }
        
    }

    public function update(Request $request, Customer $prospect){
        $request->validate([
            'name' => 'required',
            'contact' => 'required',
            'email' => 'email:rfc,dns'
        ]);

        $prospect->update($request->all());

        return redirect()->route('prospects.index');
    }
}
