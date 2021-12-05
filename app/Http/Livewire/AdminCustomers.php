<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use Livewire\Component;
use Livewire\WithPagination;

class AdminCustomers extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";
    public $search;
    public $sort = 'id';
    public $direction = 'desc';
    
    public function render()
    {        
        $customers = Customer::where('name', 'LIKE', '%' .  $this->search . '%' )->where(function ($query){
            $query->where('status', '>=', 4);
        })
        ->orWhere('email', 'LIKE', '%' . $this->search . '%'  && 'status', '<', 3)->where(function ($query){
            $query->where('status', '>=', 4);
        })
        ->orderBy($this->sort, $this->direction)
        ->paginate(10);

        return view('livewire.admin-customers', compact('customers'));
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
