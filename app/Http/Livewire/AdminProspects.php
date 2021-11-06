<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class AdminProspects extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    public $search;
    
    public function render()
    {
        if(Auth::user()->hasRole('Administrador') || Auth::user()->hasRole('Auxiliar Administrativo')){
            $prospects = Customer::where('name', 'LIKE', '%' .  $this->search . '%' )->where(function ($query){
                $query->where('status', '<=', 3);
            })
            ->orWhere('email', 'LIKE', '%' . $this->search . '%')->where(function ($query){
                $query->where('status', '<=', 3);
            })
            ->paginate(10);
        }else{
            $prospects = Customer::where('name', 'LIKE', '%' .  $this->search . '%' )->where('created_by', '=', Auth::user()->id)
            ->where(function ($query){
                $query->where('status', '<=', 3);
            })
            ->orWhere('email', 'LIKE', '%' . $this->search . '%'  && 'status', '<', 3)->where('created_by', '=', Auth::user()->id)->where(function ($query){
                $query->where('status', '<=', 3);
            })
            ->paginate(10);
        }
                
        return view('livewire.admin-prospects', compact('prospects'));
    }

    public function limpiar_page(){
        $this->reset('page');        
    }
}
