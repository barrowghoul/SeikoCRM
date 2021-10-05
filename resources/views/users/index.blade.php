@extends('layouts.main', [
    'title' => __('User Management'),
    'class' => '',
    'folderActive' => 'laravel-examples',
    'elementActive' => 'user'
])

@section('content')
    <div class="content">
        @livewire('admin-users')
    </div>>
@endsection
