<?php

namespace App\Http\Livewire;

use App\Models\Diagnostic;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class AdminDiagnostics extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";
    public $search;

    public function render()
    {
        if(Auth::user()->hasRole('Ventas')){
            $diagnostics = Diagnostic::where('craeted_by', '=', Auth::user()->id)->paginate(10);;
        }else{
            $diagnostics = Diagnostic::paginate(10);;
        }

        return view('livewire.admin-diagnostics', compact('diagnostics'));
    }

    public function limpiar_page(){
        $this->reset('page');        
    }
}
