@extends('layouts.main', [
    'title' => __('User Management'),
    'class' => '',
    'folderActive' => 'customers',
    'elementActive' => 'prospectElement'
])

@section('content')
    <div class="content">
        @livewire('admin-prospects')
    </div>>
@endsection