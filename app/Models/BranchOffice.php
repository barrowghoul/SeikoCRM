<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchOffice extends Model
{
    use HasFactory;
    const ACTIVE = 1;
    const SUSPENDED = 2;
    const MORAL = 1;
    const FISICA = 2;

    protected $fillable = ['customer_id', 'name', 'address', 'rfc', 'phone', 'comercial_name', 'comercial_address', 'web', 'legal_representative', 'lr_phone', 'lr_mail', 'buyer', 'buyer_phone', 'buyer_mail', 'invoicing_name', 'invoicing_phone', 'invoicing_mail', 'payer_name', 'payer_phone', 'payer_mail', 'pay_days', 'requester_id', 'approver_id', 'type', 'status'];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
