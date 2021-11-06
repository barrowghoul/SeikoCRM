@extends('layouts.main', [
    'title' => __('Cusotmer Management'),
    'class' => '',
    'folderActive' => 'laravel-examples',
    'elementActive' => 'customer'
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
                            <form method="post" id="TypeValidation" action="{{ route('prospects.store') }}" autocomplete="off"
                                enctype="multipart/form-data">
                                @csrf

                                <h6 class="heading-small text-muted mb-4">{{ __('Customer information') }}</h6>
                                <div class="pl-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                        <input type="text" name="name" id="input-name" class="form-control" value="{{ old('name') }}" required="true">

                                        @include('alerts.feedback', ['field' => 'name'])
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-name">{{ __('Address') }}</label>
                                        <input type="text" name="address" id="input-address" class="form-control" value="{{ old('address') }}" required="true">

                                        @include('alerts.feedback', ['field' => 'name'])
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-name">{{ __('Contact') }}</label>
                                        <input type="text" name="contact" id="input-contact" class="form-control"  required="true">

                                        @include('alerts.feedback', ['field' => 'contact'])
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-md-6">
                                            <label class="form-control-label" for="input-">{{ __('Phone') }}</label>
                                            <input type="text" name="phone" id="input-phone" class="form-control"  required="true">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-control-label" for="input-">{{ __('Mobile') }}</label>
                                            <input type="text" name="mobile" id="input-mobile" class="form-control"  required="true">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                        <input type="email" name="email" id="input-email" class="form-control" value="{{ old('email') }}" required="true">

                                        @include('alerts.feedback', ['field' => 'email'])
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
