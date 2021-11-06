<?php

use App\Models\BranchOffice;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_offices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->string('name');
            $table->string('address');
            $table->string('rfc');
            $table->string('phone');
            $table->string('comercial_name');
            $table->string('comercial_address');
            $table->string('web')->nullable();
            $table->string('legal_representative');
            $table->string('lr_phone')->nullable();
            $table->string('lr_mail')->nullable();
            $table->string('buyer');
            $table->string('buyer_phone');
            $table->string('buyer_mail');
            $table->string('invoicing_name');
            $table->string('invoicing_phone');
            $table->string('invoicing_mail');
            $table->string('payer_name');
            $table->string('payer_phone');
            $table->string('payer_mail');
            $table->integer('pay_days');
            $table->unsignedBigInteger('requester_id');
            $table->foreign('requester_id')->references('id')->on('users');
            $table->unsignedBigInteger('approver_id');
            $table->foreign('approver_id')->references('id')->on('users');
            $table->enum('type', [BranchOffice::MORAL, BranchOffice::FISICA]);
            $table->enum('status', [BranchOffice::ACTIVE, BranchOffice::SUSPENDED]);
            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('branch_offices');
    }
}
