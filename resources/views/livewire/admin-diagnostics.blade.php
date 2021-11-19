<div>
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Diagnostics') }}</h3>
                                <div class="row">                                        
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                            <input wire:model="search" wire:keydown="limpiar_page" type="text" class="form-control w-100" placeholder="Buscar">
                                            
                                        </div>
                                    </div>
                                </div>                                
                            </div>                                                    
                        </div>
                    </div>

                    <div class="col-12 mt-2">
                        @include('alerts.success')
                        @include('alerts.errors')
                    </div>
                    @if ($diagnostics->count())
                        <div class="card-body">
                            <div class="table-responsive py-4">
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">{{ __('Folio') }}</th>
                                            <th scope="col">{{ __('Customer') }}</th>
                                            <th scope="col">{{ __('Created By') }}</th>
                                            <th scope="col">{{ __('Status') }}</th>
                                            <th scope="col">{{ __('Creation Date') }}</th>
                                            @can('editar diagnosticos', App\User::class)
                                                <th scope="col"></th>
                                            @endcan
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($diagnostics as $diagnostic)
                                            @if($diagnostic->approval_status == 2 && $diagnostic->status == 1)
                                                <tr class="table-warning">                                                
                                            @elseif($diagnostic->approval_status == 3 && $diagnostic->status == 1)
                                                <tr class="table-danger">
                                            @else
                                                </tr>
                                            @endif
                                                <td>{{ $diagnostic->id }}</td>
                                                <td>{{ $diagnostic->customer_name }}</td>                                                
                                                <td>{{ $diagnostic->user_name}}</td>
                                                <td>
                                                    @if($diagnostic->status == 1)
                                                        PENDIENTE
                                                    @elseif($diagnostic->status == 2)
                                                        RECHAZADO
                                                    @else
                                                        APROBADO
                                                    @endif
                                                </td>
                                                <td>{{ $diagnostic->created_at }}</td>
                                                @can('editar diagnosticos')
                                                    <td class="text-right">
                                                        @if (auth()->user()->can('editar diagnosticos') || auth()->user()->can('aprobar diagnosticos'))
                                                            <div class="dropdown">
                                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="nc-icon nc-bullet-list-67"></i>
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                                    @if (Auth::user()->hasPermissionTo('editar diagnosticos'))
                                                                        @can('editar diagnosticos')                                                                                
                                                                            <a class="dropdown-item" href="{{ route('diagnostics.edit', $diagnostic->id) }}">{{ __('Edit') }}</a>
                                                                        @endcan                                                                                                                                                                                                                   
                                                                    @else
                                                                        <a class="dropdown-item" href="#">{{ __('Edit') }}</a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </td>
                                                @endcan
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    
                        <div class="card-footer">
                            {{ $diagnostics->links() }}
                        </div>
                    @else
                        <div class="card-body">
                            <strong>No se encontraron resultados</strong>
                        </div>
                    @endif                        
                </div>
                
            </div>
        </div>
    </div>
</div>
</div>
