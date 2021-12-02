<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\Diagnostic;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DiagnosticManagementTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_diagnostic_can_be_created()
    {
        $this->withoutExceptionHandling();
        
        $user = User::factory()->create([
            'name' => 'Daniel Hernandez',
            'email' => 'carlos.hernandez@seikosoluciones.com',
            'password' => 'seiko123'
        ]);         

        $customer = Customer::factory()->create([
            'name' => 'Seiko Soluciones',
            'address' => 'Garcia Lorca 2008 Santa Cecilia',
            'contact' => 'Daniel Hernández',
            'mobile' => '8115885951',
            'phone' => '818043126',
            'email' => 'carlos.hernandez@seikosoluciones.com'
        ]);
        //dd($user);
        $response = $this->actingAs($user)->post('/diagnostics',[
            'customer_id' => $customer->id,
            'created_by' => $user->id,
            'legal_name' => 'Diagnostico de prueba',
            'branches' => 'Sucursal Apodaca',
            'brands' => 'Seiko CRM, Seiko HD',
            'competitors' => 'Solinek',            
            'competitor_products' => 'SAP, AXIOS, CRM, CLOUD',
            'products' => 'Producto 1, Producto 2, Producto 3, Producto 4',
        ]);

        //$response->assertOk();
        $this->assertCount(1, Diagnostic::all());
        $diagnostic = Diagnostic::first();
        $this->assertEquals($diagnostic->customer_id, 1);
        $response->assertRedirect('diagnostics/' . $diagnostic->id);
    }

    public function test_a_list_of_diagnostics_can_be_retrieved(){

        $this->withoutExceptionHandling();

        $user = User::factory()->create([
            'name' => 'Daniel Hernandez',
            'email' => 'carlos.hernandez@seikosoluciones.com',
            'password' => 'seiko123'
        ]);  

        Diagnostic::factory()->count(3)->create();

        $response = $this->actingAs($user)->get('/diagnostics');
        $response->assertOk();

        $diagnostics = Diagnostic::all();

        $response->assertViewIs('diagnostics.index');
        $response->assertViewHas('diagnostics', $diagnostics);
    }

    public function test_a_diagnostic_can_be_retrieved(){
        $this->withoutExceptionHandling();

        $user = User::factory()->create([
            'name' => 'Daniel Hernandez',
            'email' => 'carlos.hernandez@seikosoluciones.com',
            'password' => 'seiko123'
        ]);  

        $diagnostic = Diagnostic::factory()->create();

        $response = $this->actingAs($user)->get('/diagnostics/' . $diagnostic->id);
        $response->assertOk();

        $diagnostic = Diagnostic::first();

        $response->assertViewIs('diagnostics.show');
        $response->assertViewHas('diagnostic', $diagnostic);        
    }

    public function test_a_diagnostic_can_be_updated(){
        $this->withoutExceptionHandling();
        
        $user = User::factory()->create([
            'name' => 'Daniel Hernandez',
            'email' => 'carlos.hernandez@seikosoluciones.com',
            'password' => 'seiko123'
        ]);         

        $customer = Customer::factory()->create([
            'name' => 'Seiko Soluciones',
            'address' => 'Garcia Lorca 2008 Santa Cecilia',
            'contact' => 'Daniel Hernández',
            'mobile' => '8115885951',
            'phone' => '818043126',
            'email' => 'carlos.hernandez@seikosoluciones.com'
        ]);

        $diagnostic = Diagnostic::factory()->create();
        
        $response = $this->actingAs($user)->put('/diagnostics/' . $diagnostic->id, [
            'customer_id' => $customer->id,
            'created_by' => $user->id,
            'legal_name' => 'Diagnostico de prueba',
            'branches' => 'Sucursal Apodaca',
            'brands' => 'Seiko CRM, Seiko HD',
            'competitors' => 'Danfoss',            
            'competitor_products' => 'SAP, AXIOS, CRM, CLOUD',
            'products' => 'Producto 1, Producto 2, Producto 3, Producto 4',
        ]);

        //$response->assertOk();
        $this->assertCount(1, Diagnostic::all());
        $diagnostic = $diagnostic->fresh();
        $this->assertEquals($diagnostic->competitors, 'Danfoss');
        $response->assertRedirect('diagnostics/' . $diagnostic->id);
    }
}
