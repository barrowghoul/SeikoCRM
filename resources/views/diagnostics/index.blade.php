@extends('layouts.main', [
    'title' => __('User Management'),
    'class' => '',
    'folderActive' => 'customers',
    'elementActive' => 'diagnosticElement'
])

@section('content')
    <div class="content">
        @livewire('admin-diagnostics')
    </div>>
@endsection
