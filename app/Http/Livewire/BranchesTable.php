<?php

namespace App\Http\Livewire;

use App\Models\BranchOffice;
use Livewire\Component;
use Livewire\WithPagination;

class BranchesTable extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    public $search;
    public $customer_id;

    public function render()
    {
        $branches = BranchOffice::where('customer_id', '=', $this->customer_id )->paginate(10);
        return view('livewire.branches-table', compact('branches'));
    }
}
