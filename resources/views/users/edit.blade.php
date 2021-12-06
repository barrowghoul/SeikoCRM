@extends('layouts.main', [
    'title' => __('User Management'),
    'class' => '',
    'folderActive' => 'laravel-examples',
    'elementActive' => 'user'
])

@section('content')
    
    <div class="content">
        @if($flash = Session::get('suspended'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ $flash }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div> 
        @elseif($flash = Session::get('activated'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ $flash }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div> 
        @endif
        <div class="container-fluid mt--6">
            <div class="row">
                <div class="col-xl-12 order-xl-1">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">{{ __('User Management') }}</h3>
                                </div>
                                <div class="col-4 text-right">
                                    <a href="{{ route('users.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                                    @can('suspender usuarios')
                                        @if($user->status == 1)
                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#suspendModal">{{ __('Suspend') }}</button>
                                        @else
                                            <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#activateModal">{{ __('Activar') }}</button>
                                        @endif
                                    @endcan
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('users.update', $user) }}" autocomplete="off"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')

                                <h6 class="heading-small text-muted mb-4">{{ __('User information') }}</h6>
                                <div class="pl-lg-4">
                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                        <input type="text" name="name" id="input-name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name', $user->name) }}" required autofocus>

                                        @include('alerts.feedback', ['field' => 'name'])
                                    </div>
                                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                        <input type="email" name="email" id="input-email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email', $user->email) }}" required>

                                        @include('alerts.feedback', ['field' => 'email'])
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('role_id') ? ' has-danger' : '' }}">
                                                <label class="form-control-label" for="input-role">{{ __('Role') }}</label>
                                                <select name="role_id" id="input-role" class="form-control{{ $errors->has('role_id') ? ' is-invalid' : '' }}" placeholder="{{ __('Role') }}" required>
                                                    <option value="">-</option>
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->name }}" {{ $role->name == old('role_id') ? 'selected' : '' }}>{{ $role->name }}</option>
                                                    @endforeach
                                                </select>

                                                @include('alerts.feedback', ['field' => 'role_id'])
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('role_id') ? ' has-danger' : '' }}">
                                                <label class="form-control-label" for="input-status">{{ __('Status') }}</label>
                                                <select name="status" id="input-status" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" placeholder="{{ __('Status') }}" required>
                                                    <option value="">-</option>
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->name }}" {{ $role->name == old('role_id') ? 'selected' : '' }}>{{ $role->name }}</option>
                                                    @endforeach
                                                </select>

                                                @include('alerts.feedback', ['field' => 'role_id'])
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('photo') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">{{ __('Profile photo') }}</label>
                                        <div class="custom-file">
                                            <input type="file" name="photo" class="custom-file-input{{ $errors->has('photo') ? ' is-invalid' : '' }}" id="input-picture" accept="image/*">
                                            <label class="custom-file-label" for="input-picture">{{ __('Select profile photo') }}</label>
                                        </div>

                                        @include('alerts.feedback', ['field' => 'photo'])
                                    </div>
                                    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-password">{{ __('Password') }}</label>
                                        <input type="password" name="password" id="input-password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" value="" required>

                                        @include('alerts.feedback', ['field' => 'password'])
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-password-confirmation">{{ __('Confirm Password') }}</label>
                                        <input type="password" name="password_confirmation" id="input-password-confirmation" class="form-control" placeholder="{{ __('Confirm Password') }}" value="" required>
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
    <div class="modal" tabindex="-1" id="suspendModal" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">                      
                <div class="modal-header">
                <h5 class="modal-title">{{ __('Suspend')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">                
                    ¿Desea desactivar a este usuario?    
                    <br>
                    Al desactivar la cuenta el usuario ya no tendrá acceso al sistema pero su información no será eliminada.      
                </div>
                <div class="modal-footer">
                <a href="{{ route('user.suspend', $user->id) }}" class="btn btn-primary">{{ __('Suspend')}}</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close')}}</button>
                </div>
          </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" id="activateModal" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">                      
                <div class="modal-header">
                <h5 class="modal-title">{{ __('Activate')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">                
                    ¿Desea activar a este usuario?          
                </div>
                <div class="modal-footer">
                <a href="{{ route('user.activate', $user->id) }}" class="btn btn-primary">{{ __('Activate')}}</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close')}}</button>
                </div>
          </div>
        </div>
    </div>
@endsection