<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Diagnostic;
use App\Models\DiagnosticComment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DiagnosticController extends Controller
{
    public function index(){        
        return view('diagnostics.index');
    }

    public function create($id){
        
        $prospect = Customer::find($id);
        return view('diagnostics.create', compact('prospect'));
    }

    public function store(Request $request){
        //dd($request);
        $request->validate([
            'customer_id' => 'required',            
            'legal_name' => 'required',
            'branches' => 'required',
            'brands' => 'required',
            'competitors' => 'required',
            'competitor_products' => 'required',
            'products' => 'required',
        ]);

        $diagnostic = Diagnostic::create([
            'customer_id' => $request->customer_id,
            'created_by' => Auth::user()->id,
            'status' => Diagnostic::PENDING,
            'approval_status' => Diagnostic::ONTIME,
            'legal_name' => $request->legal_name,
            'other_names' => $request->other_names,
            'employee_number' => $request->employee_number,
            'annual_budget' => $request->annual_budget,
            'sales_volume' => $request->sales_volume,
            'purchase_criteria' => $request->purchase_criteria,
            'branches' => $request->branches,
            'brands' => $request->brands,
            'competitors' => $request->competitors,
            'monthly_production' => $request->monthly_production,
            'certifications' => $request->certifications,
            'competitor_products' => $request->competitor_products,
            'products' => $request->products,
            'owners' => $request->owners,
            'auditors' => $request->auditors,
            'production' => $request->production,
            'purchases' => $request->purchases,
            'maintenance' => $request->maintenance,
            'engineering' => $request->engineering,
            'quality' => $request->quality,
            'started_at' => Carbon::now()->toDateTimeString()
        ]);

        return redirect('diagnostics');
    }    

    public function edit(Diagnostic $diagnostic){
        $comments = DiagnosticComment::where('diagnostic_id', '=', $diagnostic->id)->orderBy('created_at')->get();

        return view('diagnostics.edit', compact('diagnostic', 'comments'));
    }

    public function show(Diagnostic $diagnostic){
        return view('diagnostics.show', compact('diagnostic'));
    }

    public function update(Request $request, Diagnostic $diagnostic){
        $request->validate([
            'legal_name' => 'required',
            'branches' => 'required',
            'brands' => 'required',
            'competitors' => 'required',
            'competitor_products' => 'required',
            'products' => 'required',
        ]);

        $diagnostic->status = Diagnostic::PENDING;
        $diagnostic->started_at = Carbon::now()->toDateTimeString();
        $diagnostic->update($request->all());

        return redirect('diagnostics/' . $diagnostic->id);
    }

    public function reject(Request $request){
        $request->validate(['comments' => 'required']);

        $diagnostic = Diagnostic::find($request->id);
        DB::transaction(function () use($request, $diagnostic) {
            DiagnosticComment::create([
                'diagnostic_id' => $diagnostic->id,
                'user_id' => Auth::user()->id,
                'comments' => $request->comments
            ]);
            $diagnostic->status = Diagnostic::REJECTED;
            $diagnostic->update();
        });

        return view('diagnostics.index');
    }

    public function approve($id){
        $diagnostic = Diagnostic::findOrFail($id);
        $diagnostic->approved_at = Carbon::now()->toDateTimeString();
        $diagnostic->status = Diagnostic::APPROVED;        
        $diagnostic->save();

        return view('diagnostics.index');
    }
}
