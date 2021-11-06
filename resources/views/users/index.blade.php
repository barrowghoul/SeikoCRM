@extends('layouts.main', [
    'title' => __('User Management'),
    'class' => '',
    'folderActive' => 'settings',
    'elementActive' => 'userElement'
])

@section('content')
    <div class="content">
        @livewire('admin-users')
    </div>>
@endsection
