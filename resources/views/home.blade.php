@extends('layouts.main',[
    'class' => '',
    'folderActive' => '',
    'elementActive' => 'dashboard'
])

@section('content')
    <div class="content">
        
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Javascript method's body can be found in assets/js/demos.js
            demo.initDashboardPageCharts();
            demo.initVectorMap();
        });
    </script>
@endpush