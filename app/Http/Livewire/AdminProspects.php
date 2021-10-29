<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use Livewire\Component;
use Livewire\WithPagination;

class AdminProspects extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    public $search;
    
    public function render()
    {
        $prospects = Customer::where('name', 'LIKE', '%' .  $this->search . '%' )->where(function ($query){
            $query->where('status', '<=', 2);
        })
        ->orWhere('email', 'LIKE', '%' . $this->search . '%'  && 'status', '<', 3)->where(function ($query){
            $query->where('status', '<=', 2);
        })
        ->paginate(10);
        
        return view('livewire.admin-prospects', compact('prospects'));
    }

    public function limpiar_page(){
        $this->reset('page');        
    }
}
