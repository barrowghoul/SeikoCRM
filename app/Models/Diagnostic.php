<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostic extends Model
{
    use HasFactory;
    protected $guarded = [];

    const PENDING = 1;
    const REJECTED = 2;
    const APPROVED = 3;

    const ONTIME = 1;
    const ALERTED = 2;
    const EXPIRED = 3;

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function comments(){
        return $this->hasMany(DiagnosticComment::class);
    }
}
