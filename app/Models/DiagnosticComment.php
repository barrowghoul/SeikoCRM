<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagnosticComment extends Model
{
    use HasFactory;

    protected $fillable = ['diagnostic_id', 'user_id', 'comments'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
