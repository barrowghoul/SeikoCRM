<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    
    const PROSPECT = 1;
    const REJECTED = 2;
    const APPROVED= 3;
    const PENDING = 4;
    const CLIENT = 5;
    const SUSPENDED = 6;

    const ONTIME = 1;
    const ALERTED = 2;
    const EXPIRED = 3;

    protected $fillable = ['name', 'address', 'contact', 'mobile', 'phone', 'email', 'status', 'approved_at', 'approval_status', 'created_by', 'comments', 'started_at'];

    public function brach_offices(){
        return $this->hasMany(BranchOffice::class);
    }
}
