<?php

namespace App\Http\Controllers;

use App\Models\BranchOffice;
use App\Models\Customer;
use Illuminate\Http\Request;

class BranchOfficeController extends Controller
{
    public function new($customer_id){
        
        return view('branches.new', compact('customer_id'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'rfc'=> 'required|min:12',
            'comercial_name' => 'required',
            'comercial_address' => 'required',
        ]);

        BranchOffice::create([
            'customer_id' => $request->customer_id,
            'name' => strtoupper($request->name),
            'address' => strtoupper($request->address),
            'rfc' => strtoupper($request->rfc),
            'phone' => $request->phone,
            'comercial_name' => strtoupper($request->comercial_name),
            'comercial_address' => strtoupper($request->comercial_address),
            'web' => $request->web,
            'legal_representative' => strtoupper($request->legal_representative),
            'lr_phone' => $request->lr_phone,
            'lr_mail' => $request->lr_mail,
            'buyer' => strtoupper($request->buyer),
            'buyer_phone' => $request->buyer_phone,
            'buyer_mail' => $request->buyer_mail,
            'invoicing_name' => strtoupper($request->invoicing_name),
            'invoicing_phone' => $request->invoicing_phone,
            'invoicing_mail' => $request->invoicing_mail,
            'payer_name' => strtoupper($request->payer_name),
            'payer_phone' => $request->payer_phone,
            'payer_mail' => $request->payer_mail,
            'pay_days' => $request->pay_day,
            'requester_id' => Auth()->user()->id,
            'approver_id' => Auth()->user()->id,
        ]);

        $customer= Customer::find($request->customer_id);
        if($customer->status == 1){
            $customer->status = 2;
            $customer->update();
        }            

        return redirect()->back();
    }

    public function update(Request $request, BranchOffice $branch){        

        $branch->update($request->all());

        return redirect()->route('prospects.index');
    }
}
