<div>
    
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Prospects') }}</h3>
                                <div class="row">                                        
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                            <input wire:model="search" wire:keydown="limpiar_page" type="text" class="form-control w-100" placeholder="Buscar">
                                            
                                        </div>
                                    </div>
                                </div>
                                
                            </div>   
                            @can('crear clientes', App\User::class)
                                    <div class="col-4 text-right">
                                        <a href="{{ route('prospects.create') }}" class="btn btn-sm btn-primary">{{ __('Add Prospect') }}</a>
                                    </div>
                                @endcan                         
                        </div>
                    </div>

                    <div class="col-12 mt-2">
                        @include('alerts.success')
                        @include('alerts.errors')
                    </div>
                    @if ($prospects->count())
                        <div class="card-body">
                            <div class="table-responsive py-4">
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">{{ __('Name') }}</th>
                                            <th scope="col">{{ __('Email') }}</th>
                                            <th scope="col">{{ __('Status') }}</th>
                                            <th scope="col">{{ __('Creation Date') }}</th>
                                            @can('editar clientes', App\User::class)
                                                <th scope="col"></th>
                                            @endcan
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($prospects as $prospect)
                                            <tr>                                                
                                                <td>{{ $prospect->name }}</td>
                                                <td>
                                                    <a href="mailto:{{ $prospect->email }}">{{ $prospect->email }}</a>
                                                </td>
                                                <td>
                                                    @if($prospect->status == 1)
                                                        PROSPECTO
                                                    @else
                                                        PENDIENTE
                                                    @endif
                                                </td>
                                                <td>{{ $prospect->created_at->format('d/m/Y H:i') }}</td>
                                                @can('editar clientes')
                                                    <td class="text-right">
                                                        @if (auth()->user()->can('editar usuarios') || auth()->user()->can('suspender usuarios'))
                                                            <div class="dropdown">
                                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="nc-icon nc-bullet-list-67"></i>
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                                    @if (Auth::user()->hasPermissionTo('editar prospectos'))
                                                                        @can('editar clientes')                                                                                
                                                                            <a class="dropdown-item" href="{{ route('prospects.edit', $prospect) }}">{{ __('Edit') }}</a>
                                                                        @endcan
                                                                        @can('crear clientes')
                                                                            @if($prospect->status == 1)
                                                                                <a class="dropdown-item" href="{{ route('client.new', $prospect->id) }}">{{ __('Convert to Client') }}</a>
                                                                            @endif
                                                                        @endcan
                                                                        @can('aprobar clientes')
                                                                            @if($prospect->status == 2)                                                                                
                                                                                <button class="dropdown-item" data-toggle="modal" data-target="#approveModal">
                                                                                    {{ __('Approve Client') }}
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
                                                                                            <p>¿Desea aprobar la solicitud de creación de cliente?</p>
                                                                                            </div>
                                                                                            <div class="modal-footer">
                                                                                            <div class="left-side">
                                                                                                <a class="btn btn-link" href="{{ route('client.approve', $prospect->id) }}">{{ __('Approve') }}</a>
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
                                                                        @can('suspender usuarios')
                                                                            <form action="{{ route('prospects.destroy', $prospect) }}" method="POST">
                                                                                @csrf
                                                                                @method('delete')
                                                                                <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this user?") }}') ? this.parentElement.submit() : ''">
                                                                                    {{ __('Suspend') }}
                                                                                </button>
                                                                            </form>
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
                            {{ $prospects->links() }}
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
