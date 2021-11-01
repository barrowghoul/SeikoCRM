<?php

namespace App\Http\Controllers;

use App\Models\BranchOffice;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProspectController extends Controller
{
    public function index(){
        //dd(Carbon::now()->subMinutes(10)->toDateTimeString());

        
        return view('prospects.index');
    }

    public function create(){
        return view('prospects.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:customers',
            'address' => 'required',
            'contact' => 'required',
            'phone' => 'required|min:10',
            'mobile' => 'required|min:10',
            'email' => 'email:rfc'
        ]);
    
        Customer::create([
            'name' => strtoupper($request->name),
            'contact' => strtoupper($request->contact),
            'address' => strtoupper($request->address),
            'phone' => $request->phone,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'status' => Customer::PROSPECT,
            'approval_status'  => Customer::ONTIME,
            'created_by' => Auth::user()->id,
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
