<?php

namespace App\Http\Controllers;

use App\Models\Diagnostic;
use Illuminate\Http\Request;

class DiagnosticController extends Controller
{
    public function index(){        
        return view('diagnostics.index');
    }

    public function create(){
        return view('diagnostics.create');
    }

    public function store(Request $request){
        $data = $request->validate([
            'customer_id' => 'required',
            'created_by' => 'required',
            'legal_name' => 'required',
            'branches' => 'required',
            'brands' => 'required',
            'competitors' => 'required',
            'competitor_products' => 'required',
            'products' => 'required',
        ]);

        $diagnostic = Diagnostic::create($data);

        return redirect('diagnostics/' . $diagnostic->id);
    }    

    public function show(Diagnostic $diagnostic){
        return view('diagnostics.show', compact('diagnostic'));
    }

    public function update(Request $request, Diagnostic $diagnostic){
        $data = $request->validate([
            'customer_id' => 'required',
            'created_by' => 'required',
            'legal_name' => 'required',
            'branches' => 'required',
            'brands' => 'required',
            'competitors' => 'required',
            'competitor_products' => 'required',
            'products' => 'required',
        ]);

        $diagnostic->update($data);

        return redirect('diagnostics/' . $diagnostic->id);
    }
}
