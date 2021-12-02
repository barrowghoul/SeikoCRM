<?php

namespace App\Http\Livewire;

use App\Models\Diagnostic;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class AdminDiagnostics extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";
    public $search;

    public function render()
    {
        if(Auth::user()->hasRole('Ventas')){
            $diagnostics = DB::table('diagnostics')
            ->join('customers', 'diagnostics.customer_id', '=', 'customers.id')
            ->join('users', 'diagnostics.created_by', '=', 'users.id')
            ->select('diagnostics.*', 'customers.name as customer_name', 'users.name as user_name')
            ->where('customers.name', 'LIKE', '%' . $this->search . '%')->where(function ($query){
                $query->where('diagnostics.created_by', '=', Auth::user()->id);
            })
            ->orWhere('users.name', 'LIKE', '%' . $this->search . '%')->where(function ($query){
                $query->where('diagnostics.created_by', '=', Auth::user()->id);
            })
            ->paginate(10);
            /*$diagnostics = Diagnostic::where('created_by', '=', Auth::user()->id)
            ->where()
            ->paginate(10);;*/
        }else{
            //$diagnostics = Diagnostic::paginate(10);;
            $diagnostics = DB::table('diagnostics')
            ->join('customers', 'diagnostics.customer_id', '=', 'customers.id')
            ->join('users', 'diagnostics.created_by', '=', 'users.id')
            ->select('diagnostics.*', 'customers.name as customer_name', 'users.name as user_name')
            ->where('customers.name', 'LIKE', '%' . $this->search . '%')
            ->orWhere('users.name', 'LIKE', '%' . $this->search . '%')
            ->paginate(10);
            //dd($diagnostics);
        }

        return view('livewire.admin-diagnostics', compact('diagnostics'));
    }

    public function limpiar_page(){
        $this->reset('page');        
    }
}
