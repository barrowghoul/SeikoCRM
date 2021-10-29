@extends('layouts.main', [
    'title' => __('Customer Management'),
    'class' => '',
    'folderActive' => 'laravel-examples',
    'elementActive' => 'prospect'
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
                                    <h3 class="mb-0">{{ __('Prospect Management') }}</h3>
                                </div>
                                <div class="col-4 text-right">
                                    <a href="{{ route('prospects.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="post" id="TypeValidation" action="{{ route('branches.store') }}" autocomplete="off"
                                enctype="multipart/form-data">
                                @csrf
                                <input id="invisible_id" name="customer_id" type="hidden" value="{{$customer_id}}">
                                <h6 class="heading-small text-muted mb-4">{{ __('Customer information') }}</h6>
                                <div class="pl-lg-4">
                                    <div class="form-group">
                                        <div class="form-check-radio form-check-inline">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="type" id="moral" value="1">
                                                Persona Moral
                                                <span class="form-check-sign"></span>
                                            </label>                                            
                                        </div>
                                        <div class="form-check-radio">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="type" id="fisica" value="2" checked>
                                                Persona Física
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-name">{{ __('Razon Social') }}</label>
                                        <input type="text" name="name" id="input-name" class="form-control"  value="{{ old('name') }}" required="true">                                        
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-address">{{ __('Dirección Fiscal') }}</label>
                                        <input type="text" name="address" id="input-address" class="form-control"  value="{{ old('address') }}" required="true">                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label class="form-control-label" for="input-name">{{ __('R.F.C.') }}</label>
                                            <input type="text" name="rfc" id="input-rfc" class="form-control"  value="{{ old('rfc') }}" required="true">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label class="form-control-label" for="input-name">{{ __('Phone') }}</label>
                                            <input type="text" name="phone" id="input-phone" class="form-control" required="true">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-comercial_name">{{ __('Comercial Name') }}</label>
                                        <input type="text" name="comercial_name" id="input-comercial_name" class="form-control" value="{{ old('comercial_name') }}" required="true">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-comercial_name">{{ __('Comercial Address') }}</label>
                                        <input type="text" name="comercial_address" id="input-comercial_address" class="form-control" value="{{ old('comercial_address') }}" required="true">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-web">{{ __('Web Page') }}</label>
                                        <input type="text" name="web" id="input-web" class="form-control" value="{{ old('web') }}">
                                    </div>   
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-web">{{ __('Legal Representative') }}</label>
                                        <input type="text" name="legal_representative" id="input-legal_representative" class="form-control" value="{{ old('legal_representative') }}" required="true">
                                    </div>  
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-control-label" for="input-name">{{ __('Phone') }}</label>
                                            <input type="text" name="lr_phone" id="input-lr_phone" class="form-control" value="{{ old('lr_phone') }}" >
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-control-label" for="input-name">{{ __('Email') }}</label>
                                            <input type="text" name="lr_mail" id="input-lr_mail" class="form-control" value="{{ old('lr_mail') }}">
                                        </div>
                                    </div>   
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-buyer">{{ __('Buyer') }}</label>
                                        <input type="text" name="buyer" id="input-buyer" class="form-control" value="{{ old('buyer') }}" required="true">
                                    </div>  
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label class="form-control-label" for="input-name">{{ __('Phone') }}</label>
                                            <input type="text" name="buyer_phone" id="input-buyer_phone" class="form-control" value="{{ old('buyer_phone') }}" required="true">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label class="form-control-label" for="input-name">{{ __('Email') }}</label>
                                            <input type="text" name="buyer_mail" id="input-buyer_mail" class="form-control" value="{{ old('buyer_mail') }}" required="true">
                                        </div>
                                    </div>        
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-invoicing_name">{{ __('Invoicing Contact') }}</label>
                                        <input type="text" name="invoicing_name" id="input-invoicing_name" class="form-control" value="{{ old('invoicing_name') }}" required="true">
                                    </div>  
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label class="form-control-label" for="input-invoicing_phone">{{ __('Phone') }}</label>
                                            <input type="text" name="invoicing_phone" id="input-invoicing_phone" class="form-control" value="{{ old('invoicing_phone') }}" required="true">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label class="form-control-label" for="input-invoicing_mail">{{ __('Email') }}</label>
                                            <input type="text" name="invoicing_mail" id="input-invoicing_mail" class="form-control" value="{{ old('invoicing_mail') }}" required="true">
                                        </div>
                                    </div>      
                                    <div class="form-group{{ $errors->has('payer_name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-payer_name">{{ __('Payer Contact') }}</label>
                                        <input type="text" name="payer_name" id="input-payer_name" class="form-control" value="{{ old('payer_name') }}" required="true">
                                    </div>  
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label class="form-control-label" for="input-payer_phone">{{ __('Phone') }}</label>
                                            <input type="text" name="payer_phone" id="input-payer_phone" class="form-control" value="{{ old('payer_phone') }}" required="true">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label class="form-control-label" for="input-payer_mail">{{ __('Email') }}</label>
                                            <input type="text" name="payer_mail" id="input-payer_mail" class="form-control" value="{{ old('payer_mail') }}" required="true">
                                        </div>
                                    </div>   
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-pay_day">{{ __('Pay Day') }}</label>
                                        <input type="text" number="true" name="pay_day" class="form-control" id="input-pay_Day"  value="{{ old('pay_day') }}" required="true">
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