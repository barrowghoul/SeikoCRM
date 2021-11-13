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
                            @can('crear diagnosticos', App\User::class)
                                    <div class="col-4 text-right">
                                        <a href="{{ route('diagnostics.create') }}" class="btn btn-sm btn-primary">{{ __('Add Diagnostic') }}</a>
                                    </div>
                                @endcan                         
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
                                                <td>{{ $diagnostic->customer->name }}</td>                                                
                                                <td>{{ $diagnostic->created_by}}</td>
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
                                                        @if (auth()->user()->can('editar diagnosticos') || auth()->user()->can('rechazar diagnosticos'))
                                                            <div class="dropdown">
                                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="nc-icon nc-bullet-list-67"></i>
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                                    @if (Auth::user()->hasPermissionTo('editar diagnosticos'))
                                                                        @can('editar diagnosticos')                                                                                
                                                                            <a class="dropdown-item" href="{{ route('diagnostics.edit', $diagnostic) }}">{{ __('Edit') }}</a>
                                                                        @endcan
                                                                        @can('crear clientes')
                                                                            @if($diagnostic->status == 1)
                                                                                <a class="dropdown-item" href="{{ route('client.new', $diagnostic->id) }}">{{ __('Convert to Client') }}</a>
                                                                            @endif
                                                                        @endcan
                                                                        @can('aprobar diagnosticos')
                                                                            @if($diagnostic->status == 2)                                                                                
                                                                                <button class="dropdown-item" data-toggle="modal" data-target="#approveModal">
                                                                                    {{ __('Approve diagnostic') }}
                                                                                  </button>
                                                                                  <!-- small modal -->
                                                                                    <div class="modal fade modal-primary" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                                        <div class="modal-dialog modal-sm">
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-header justify-content-center">
                                                                                            <div class="modal-profile mx-auto">
                                                                                                <i class="nc-icon nc-bulb-63"></i>
                                                                                            </div>
                                                                                            </div>
                                                                                            <div class="modal-body">
                                                                                            <p>¿Desea aprobar la solicitud de creación del diagnostico?</p>
                                                                                            </div>
                                                                                            <div class="modal-footer">
                                                                                            <div class="left-side">
                                                                                                <a class="btn btn-link" href="{{ route('client.approve', $diagnostic->id) }}">{{ __('Approve') }}</a>
                                                                                            </div>
                                                                                            <div class="divider"></div>
                                                                                            <div class="right-side">
                                                                                                <button type="button" class="btn btn-link btn-danger" data-dismiss="modal">{{ __('Close') }}</button>
                                                                                            </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <!--    end small modal -->
                                                                            @endif
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
