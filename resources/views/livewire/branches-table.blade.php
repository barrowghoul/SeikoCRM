<div class="table-responsive">   
    <table class="table">
        <thead class="text-primary">
            <th class="text-center">{{ __('Name') }}</th>
            <th class="text-center">{{ __('Comercial Name') }}</th>
            <th class="text-center">{{ __('Phone') }}</th>
            <th class="text-right">{{ __('Actions') }}</th>
        </thead>
        <tbody>
            @foreach ($branches as $branch)
                <tr>
                    <td class="text-center">{{ $branch->name }}</td>
                    <td class="text-center">{{ $branch->comercial_name }}</td>
                    <td class="text-center">{{ $branch->phone }}</td>
                    <td class="text-right">                        
                        <button type="button" rel="tooltip" class="btn btn-success btn-icon btn-sm ">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button type="button" rel="tooltip" class="btn btn-danger btn-icon btn-sm ">
                            <i class="fa fa-times"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
