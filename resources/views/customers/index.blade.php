@extends('layouts.main', [
    'title' => __('User Management'),
    'class' => '',
    'folderActive' => 'cutomers',
    'elementActive' => 'customerElement'
])

@section('content')
    <div class="content">
        @livewire('admin-customers')
    </div>>
@endsection
