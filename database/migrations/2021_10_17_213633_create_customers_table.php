<?php

use App\Console\Commands\CustomerTask;
use App\Models\Customer;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->string('contact');
            $table->string('mobile');
            $table->string('phone');
            $table->string('email');
            $table->enum('status',[Customer::PROSPECT, Customer::REJECTED, Customer::PENDING, Customer::CLIENT, Customer::SUSPENDED]);
            $table->enum("approval_status", [Customer::ONTIME, Customer::ALERTED, Customer::EXPIRED]);
            $table->dateTime('started_at');
            $table->dateTime('approved_at')->nullable();
            $table->unsignedBigInteger(('created_by'));
            $table->foreign('created_by')->references(('id'))->on('users');            
            $table->unsignedBigInteger(('approved_by'))->nullable();
            $table->foreign('approved_by')->references(('id'))->on('users');
            $table->text('comments')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
