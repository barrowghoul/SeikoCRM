<?php

use App\Models\Diagnostic;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiagnosticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnostics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->enum('status',[Diagnostic::PENDING, Diagnostic::REJECTED, Diagnostic::APPROVED])->default(Diagnostic::PENDING);
            $table->enum('approval_status',[Diagnostic::ONTIME, Diagnostic::ALERTED, Diagnostic::EXPIRED])->default(Diagnostic::PENDING);
            $table->string('legal_name');
            $table->integer('employee_number')->nullable();
            $table->decimal('annual_budget', 8,2)->default(0);
            $table->decimal('sales_volume', 8 , 2)->default(0); 
            $table->string('purchase_criteria')->nullable();
            $table->text('branches');
            $table->text('brands');
            $table->text('competitors');
            $table->text('monthly_production')->nullable();
            $table->text('certifications')->nullable();
            $table->text('competitor_products');
            $table->text('products');
            $table->text('owners')->nullable();
            $table->text('auditors')->nullable();
            $table->text('production')->nullable();
            $table->text('purchases')->nullable();
            $table->text('maintenance')->nullable();
            $table->text('engineering')->nullable();
            $table->text('quality')->nullable();
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
        Schema::dropIfExists('diagnostics');
    }
}
