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

    const ONTIME = 1;
    const ALERTED = 2;
    const EXPIRED = 3;

    protected $fillable = ['name', 'address', 'contact', 'mobile', 'phone', 'email', 'status', 'approved_at', 'approval_status', 'created_by'];

    public function brach_offices(){
        return $this->hasMany(BranchOffice::class);
    }
}
