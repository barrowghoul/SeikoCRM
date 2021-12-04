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
    public $sort = 'id';
    public $direction = 'desc';
    
    public function render()
    {
        if(Auth::user()->hasRole('Administrador') || Auth::user()->hasRole('Auxiliar Administrativo')){
            $prospects = Customer::where('name', 'LIKE', '%' .  $this->search . '%' )->where(function ($query){
                $query->where('status', '<=', 3);
            })
            ->orWhere('email', 'LIKE', '%' . $this->search . '%')->where(function ($query){
                $query->where('status', '<=', 3);
            })
            ->orderBy($this->sort, $this->direction)
            ->paginate(10);
        }else{
            $prospects = Customer::where('name', 'LIKE', '%' .  $this->search . '%' )->where('created_by', '=', Auth::user()->id)
            ->where(function ($query){
                $query->where('status', '<=', 3);
            })
            ->orWhere('email', 'LIKE', '%' . $this->search . '%'  && 'status', '<', 3)->where('created_by', '=', Auth::user()->id)->where(function ($query){
                $query->where('status', '<=', 3);
            })
            ->orderBy($this->sort, $this->direction)
            ->paginate(10);
        }
                
        return view('livewire.admin-prospects', compact('prospects'));
    }

    public function order($sort){
        if($this->sort == $sort){
            if($this->direction == 'desc'){
                $this->direction = 'asc';
            }else{
                $this->direction = 'desc';
            }
        }else{
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }

    public function limpiar_page(){
        $this->reset('page');        
    }
}
