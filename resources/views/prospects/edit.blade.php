@extends('layouts.main', [
    'title' => __('Cusotmer Management'),
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
                        @if($prospect->status == 1)
                            <div class="card-body">
                                <form method="post" action="{{ route('prospects.update', $prospect) }}" autocomplete="off"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('put')

                                    <h6 class="heading-small text-muted mb-4">{{ __('prospect information') }}</h6>
                                    <div class="pl-lg-4">
                                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                            <input type="text" name="name" id="input-name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name', $prospect->name) }}" required autofocus>

                                            @include('alerts.feedback', ['field' => 'name'])
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-name">{{ __('Address') }}</label>
                                            <input type="text" name="address" id="input-address" class="form-control" value="{{ old('address', $prospect->address) }}"  required="true">
    
                                            @include('alerts.feedback', ['field' => 'address'])
                                        </div>
                                        <div class="form-group{{ $errors->has('contact') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-name">{{ __('Contact') }}</label>
                                            <input type="text" name="contact" id="input-contact" class="form-control{{ $errors->has('contact') ? ' is-invalid' : '' }}" placeholder="{{ __('Contact') }}" value="{{ old('contact', $prospect->contact) }}" required autofocus>

                                            @include('alerts.feedback', ['field' => 'contact'])
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-6">
                                                <label class="form-control-label" for="input-">{{ __('Phone') }}</label>
                                                <input type="text" name="phone" id="input-phone" class="form-control" value="{{ old('phone', $prospect->phone) }}" required="true">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-control-label" for="input-">{{ __('Mobile') }}</label>
                                                <input type="text" name="mobile" id="input-mobile" class="form-control" value="{{ old('mobile', $prospect->mobile) }}" required="true">
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                            <input type="email" name="email" id="input-email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email', $prospect->email) }}" required>

                                            @include('alerts.feedback', ['field' => 'email'])
                                        </div>                                                                                                            
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @else
                            <div class="card-body">
                                <div class="nav-tabs-navigation">
                                    <div class="nav-tabs-wrapper">
                                        <ul id="tabs" class="nav nav-tabs" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab" href="#general" role="tab" aria-expanded="true">{{ __('General Information') }}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#info" role="tab" aria-expanded="false">{{ __('Customer Information' )}}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div id="my-tab-content" class="tab-content tex-center">
                                    <div class="tab-pane active" id="general" role="tabpanel" aria-expanded="true">
                                        <form method="post" action="{{ route('prospects.update', $prospect) }}" autocomplete="off"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('put')

                                            <h6 class="heading-small text-muted mb-4">{{ __('prospect information') }}</h6>
                                            <div class="pl-lg-4">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                                    <input type="text" name="name" id="input-name" class="form-control" value="{{ old('name', $prospect->name) }}" required="true" >
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-name">{{ __('Contact') }}</label>
                                                    <input type="text" name="contact" id="input-contact" class="form-control" value="{{ old('contact', $prospect->contact) }}" required="true">
                                                </div>
                                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                                    <input type="email" name="email" id="input-email" class="form-control" value="{{ old('email', $prospect->email) }}" required>
                                                </div>                                                                                                            
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="info" role="tabpanel" aria-expanded="false">
                                        <form method="post" id="TypeValidation" action="{{ route('branches.update', $customer) }}" autocomplete="off"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('put')
                                            <input id="invisible_id" name="customer_id" type="hidden" value="{{$prospect->id}}">
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
                                                    <input type="text" name="name" id="input-name" class="form-control"  value="{{ old('name', $customer->name) }}" required="true">                                        
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-address">{{ __('Dirección Fiscal') }}</label>
                                                    <input type="text" name="address" id="input-address" class="form-control"  value="{{ old('address', $customer->address) }}" required="true">                                        
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 form-group">
                                                        <label class="form-control-label" for="input-name">{{ __('R.F.C.') }}</label>
                                                        <input type="text" name="rfc" id="input-rfc" class="form-control"  value="{{ old('rfc', $customer->rfc) }}" required="true">
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label class="form-control-label" for="input-name">{{ __('Phone') }}</label>
                                                        <input type="text" name="phone" id="input-phone" class="form-control" value="{{ old('rfc', $customer->phone) }}" required="true">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-comercial_name">{{ __('Comercial Name') }}</label>
                                                    <input type="text" name="comercial_name" id="input-comercial_name" class="form-control" value="{{ old('comercial_name', $customer->comercial_name) }}" required="true">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-comercial_name">{{ __('Comercial Address') }}</label>
                                                    <input type="text" name="comercial_address" id="input-comercial_address" class="form-control" value="{{ old('comercial_address', $customer->comercial_address) }}" required="true">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-web">{{ __('Web Page') }}</label>
                                                    <input type="text" name="web" id="input-web" class="form-control" value="{{ old('web', $customer->web) }}">
                                                </div>   
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-web">{{ __('Legal Representative') }}</label>
                                                    <input type="text" name="legal_representative" id="input-legal_representative" class="form-control" value="{{ old('legal_representative', $customer->legal_representative) }}" required="true">
                                                </div>  
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="form-control-label" for="input-name">{{ __('Phone') }}</label>
                                                        <input type="text" name="lr_phone" id="input-lr_phone" class="form-control" value="{{ old('lr_phone', $customer->lr_phone) }}" >
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-control-label" for="input-name">{{ __('Email') }}</label>
                                                        <input type="text" name="lr_mail" id="input-lr_mail" class="form-control" value="{{ old('lr_mail', $customer->lr_mail) }}">
                                                    </div>
                                                </div>   
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-buyer">{{ __('Buyer') }}</label>
                                                    <input type="text" name="buyer" id="input-buyer" class="form-control" value="{{ old('buyer', $customer->buyer) }}" required="true">
                                                </div>  
                                                <div class="row">
                                                    <div class="col-md-6 form-group">
                                                        <label class="form-control-label" for="input-name">{{ __('Phone') }}</label>
                                                        <input type="text" name="buyer_phone" id="input-buyer_phone" class="form-control" value="{{ old('buyer_phone', $customer->buyer_phone) }}" required="true">
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label class="form-control-label" for="input-name">{{ __('Email') }}</label>
                                                        <input type="text" name="buyer_mail" id="input-buyer_mail" class="form-control" value="{{ old('buyer_mail', $customer->buyer_mail) }}" required="true">
                                                    </div>
                                                </div>        
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-invoicing_name">{{ __('Invoicing Contact') }}</label>
                                                    <input type="text" name="invoicing_name" id="input-invoicing_name" class="form-control" value="{{ old('invoicing_name', $customer->invoicing_name) }}" required="true">
                                                </div>  
                                                <div class="row">
                                                    <div class="col-md-6 form-group">
                                                        <label class="form-control-label" for="input-invoicing_phone">{{ __('Phone') }}</label>
                                                        <input type="text" name="invoicing_phone" id="input-invoicing_phone" class="form-control" value="{{ old('invoicing_phone', $customer->invoicing_phone) }}" required="true">
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label class="form-control-label" for="input-invoicing_mail">{{ __('Email') }}</label>
                                                        <input type="text" name="invoicing_mail" id="input-invoicing_mail" class="form-control" value="{{ old('invoicing_mail', $customer->invoicing_mail) }}" required="true">
                                                    </div>
                                                </div>      
                                                <div class="form-group{{ $errors->has('payer_name') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-payer_name">{{ __('Payer Contact') }}</label>
                                                    <input type="text" name="payer_name" id="input-payer_name" class="form-control" value="{{ old('payer_name', $customer->payer_name) }}" required="true">
                                                </div>  
                                                <div class="row">
                                                    <div class="col-md-6 form-group">
                                                        <label class="form-control-label" for="input-payer_phone">{{ __('Phone') }}</label>
                                                        <input type="text" name="payer_phone" id="input-payer_phone" class="form-control" value="{{ old('payer_phone', $customer->payer_phone) }}" required="true">
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label class="form-control-label" for="input-payer_mail">{{ __('Email') }}</label>
                                                        <input type="text" name="payer_mail" id="input-payer_mail" class="form-control" value="{{ old('payer_mail', $customer->payer_mail) }}" required="true">
                                                    </div>
                                                </div>   
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-pay_day">{{ __('Pay Day') }}</label>
                                                    <input type="text" number="true" name="pay_day" class="form-control" id="input-pay_Day"  value="{{ old('pay_day', $customer->pay_days) }}" required="true">
                                                </div>                                                                                         
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection