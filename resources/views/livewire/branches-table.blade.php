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
                        <a href="{{ route('branches.show', $branch) }}" rel="tooltip" class="btn btn-info btn-icon btn-sm">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="{{ route('branches.edit', $branch) }}" rel="tooltip" class="btn btn-success btn-icon btn-sm ">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="#" rel="tooltip" class="btn btn-danger btn-icon btn-sm ">
                            <i class="fa fa-times"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
