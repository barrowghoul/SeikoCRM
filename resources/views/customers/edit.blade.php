@extends('layouts.main', [
    'title' => __('Customer Management'),
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
                                    <h3 class="mb-0">{{ __('Customer Management') }}</h3>
                                </div>
                                <div class="col-4 text-right">
                                    <a href="{{ route('customers.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="post" id="TypeValidation" action="{{ route('customers.update', $customer) }}" autocomplete="off"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')

                                <h6 class="heading-small text-muted mb-4">{{ __('Customer information') }}</h6>
                                <div class="pl-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                        <input type="text" name="name" id="input-name" class="form-control" value="{{ old('name', $customer->name) }}" required="true">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-name">{{ __('Contact') }}</label>
                                        <input type="text" name="contact" id="input-contact" class="form-control" value="{{ old('contact', $customer->contact) }}" required="true">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                        <input type="email" name="email" id="input-email" class="form-control" value="{{ old('email', $customer->email) }}" required="true">
                                    </div>
                                    
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                    </div>
                                    <div class="row align-items-right">
                                        <div class="col-12 text-right">
                                            <a href="{{ route('client.new', $customer->id) }}" class="btn btn-sm btn-primary">{{ __('Add Branch') }}</a>
                                        </div>
                                    </div>
                                    @livewire('branches-table', ['customer_id' => $customer->id])
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