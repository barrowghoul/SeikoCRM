<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    
    const PROSPECT = 1;
    const PENDING = 2;
    const CLIENT = 3;
    const SUSPENDED = 4;

    protected $fillable = ['name', 'contact', 'email'];

    public function brach_offices(){
        return $this->hasMany(BranchOffice::class);
    }
}
