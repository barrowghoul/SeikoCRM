@extends('layouts.main', [
    'title' => __('Cusotmer Management'),
    'class' => '',
    'folderActive' => 'laravel-examples',
    'elementActive' => 'diagnostic'
])

@section('content')
    <div class="content">
        <div class="container-fluid mt--6">
            <div class="row">
                <div class="col-xl-12 order-xl-1">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">{{ __('Diagnostic Management') }}</h3>
                                </div>
                                <div class="col-4 text-right">
                                    <a href="{{ route('diagnostics.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="post" id="TypeValidation" action="{{ route('diagnostics.store') }}" autocomplete="off"
                                enctype="multipart/form-data">
                                @csrf

                                <h6 class="heading-small text-muted mb-4">{{ __('Customer information') }}</h6>
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="form-control-label" for="input-name">{{ __('Folio') }}</label>
                                            <input type="text" name="customer" id="input-customer_id" class="form-control" value="{{ $prospect->id }}" disabled>
                                            <input type="hidden" name="customer_id" value="{{ $prospect->id }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                            <input type="text" name="name" id="input-name" class="form-control" value="{{ $prospect->name }}" required="true" disabled>
    
                                            @include('alerts.feedback', ['field' => 'name'])
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="form-control-label" for="input-name">{{ __('Legal Name') }}</label>
                                            <input type="text" name="legal_name" id="input-legal_name" class="form-control" value="{{ old('legal_name') }}">
    
                                            @include('alerts.feedback', ['field' => 'legal_name'])
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-control-label" for="input-epmployee_number">{{ __('Employee Number') }}</label>
                                            <input type="text" name="employee_number" id="input-employee_number" class="form-control" value="{{ old('employee_number') }}">
    
                                            @include('alerts.feedback', ['field' => 'legal_name'])
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-name">{{ __('Other Names') }}</label>
                                        <textarea type="text" name="other_names" id="input-other_names" class="form-control" value="{{ old('other_names') }}"></textarea>

                                        @include('alerts.feedback', ['field' => 'other_names'])
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label class="form-control-label" for="input-annual_budget">{{ __('Annual Budget') }}</label>
                                            <input type="text" name="annual_budget" id="input-annual_budget" class="form-control">
    
                                            @include('alerts.feedback', ['field' => 'annual_budget'])
                                        </div> 
                                        <div class="form-group col-md-4">
                                            <label class="form-control-label" for="input-sales_volume">{{ __('Sales Volume') }}</label>
                                            <input type="text" name="sales_volume" id="input-sales_volume" class="form-control">
    
                                            @include('alerts.feedback', ['field' => 'sales_volume'])
                                        </div>    
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-purchase_criteria">{{ __('Purchase Criteria') }}</label>
                                        <textarea name="purchase_criteria" id="input-purchase_criteria" class="form-control"></textarea>

                                        @include('alerts.feedback', ['field' => 'purchase_criteria'])
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-branches">{{ __('Branches') }}</label>
                                        <textarea name="branches" id="input-branches" class="form-control" required="true"></textarea>

                                        @include('alerts.feedback', ['field' => 'branches'])
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-brands">{{ __('Brands and Products') }}</label>
                                        <textarea name="brands" id="input-brands" class="form-control" required="true"></textarea>

                                        @include('alerts.feedback', ['field' => 'brands'])
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-competitors">{{ __('Competitors') }}</label>
                                        <textarea name="competitors" id="input-competitors" class="form-control" required="true"></textarea>

                                        @include('alerts.feedback', ['field' => 'competitors'])
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-monthly_production">{{ __('Monthly Production') }}</label>
                                        <textarea name="monthly_production" id="input-monthly_production" class="form-control"></textarea>

                                        @include('alerts.feedback', ['field' => 'monthly_production'])
                                    </div>  
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-certifications">{{ __('Certifications') }}</label>
                                        <textarea name="certifications" id="input-certifications" class="form-control"></textarea>

                                        @include('alerts.feedback', ['field' => 'certifications'])
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-productos">{{ __('Productos que Metalboss podría proveer') }}</label>
                                        <textarea name="products" id="input-products" class="form-control" required="true"></textarea>

                                        @include('alerts.feedback', ['field' => 'products'])
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-competitor_products">{{ __('Nuestra competencia en esos productos') }}</label>
                                        <textarea name="competitor_products" id="input-competitor_products" class="form-control" required="true"></textarea>

                                        @include('alerts.feedback', ['field' => 'competitor_products'])
                                    </div>                                                                        
                                </div>
                                <h6 class="heading-small text-muted mb-4">{{ __('Key People') }}</h6>
                                <div class="pl-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-owners">{{ __('Owners') }}</label>
                                        <textarea name="owners" id="input-owners" class="form-control"></textarea>

                                        @include('alerts.feedback', ['field' => 'owners'])
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-auditors">{{ __('Auditors') }}</label>
                                        <textarea name="auditors" id="input-auditors" class="form-control"></textarea>

                                        @include('alerts.feedback', ['field' => 'auditors'])
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-production">{{ __('Production') }}</label>
                                        <textarea name="production" id="input-production" class="form-control"></textarea>

                                        @include('alerts.feedback', ['field' => 'production'])
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-purchases">{{ __('Purchases') }}</label>
                                        <textarea name="purchases" id="input-purchases" class="form-control"></textarea>

                                        @include('alerts.feedback', ['field' => 'purchases'])
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-maintenance">{{ __('Maintenance') }}</label>
                                        <textarea name="maintenance" id="input-maintenance" class="form-control"></textarea>

                                        @include('alerts.feedback', ['field' => 'maintenance'])
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-engineering">{{ __('Engineering') }}</label>
                                        <textarea name="engineering" id="input-engineering" class="form-control"></textarea>

                                        @include('alerts.feedback', ['field' => 'engineering'])
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-quality">{{ __('Quality') }}</label>
                                        <textarea name="quality" id="input-quality" class="form-control"></textarea>

                                        @include('alerts.feedback', ['field' => 'quality'])
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function setFormValidation(id) {
            $(id).validate({
                highlight: function(element) {
                    $(element).closest('.form-group').removeClass('has-success').addClass('has-danger');
                    $(element).closest('.form-check').removeClass('has-success').addClass('has-danger');
                },
                success: function(element) {
                    $(element).closest('.form-group').removeClass('has-danger').addClass('has-success');
                    $(element).closest('.form-check').removeClass('has-danger').addClass('has-success');
                },
                errorPlacement: function(error, element) {
                    $(element).closest('.form-group').append(error);
                },
            });
        }
    
        $(document).ready(function() {
            setFormValidation('#RegisterValidation');
            setFormValidation('#TypeValidation');
            setFormValidation('#LoginValidation');
            setFormValidation('#RangeValidation');
        });
    </script>
@endpush
