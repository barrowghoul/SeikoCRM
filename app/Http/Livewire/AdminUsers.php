<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class AdminUsers extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";
    public $search;
    public $sort = 'name';
    public $direction = 'desc';

    public function render()
    {
        $users = User::where('name', 'LIKE', '%' . $this->search . '%')
        ->orWhere('email', 'LIKE', '%' . $this->search . '%')
        ->orderBy($this->sort, $this->direction)
        ->paginate(10);
        return view('livewire.admin-users', compact('users'));
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
