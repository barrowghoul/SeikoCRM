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
                            @can('crear prospectos', App\User::class)
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
                                            <th scope="col" wire:click="order('id')" >{{ __('Folio') }} 
                                                @if($sort == 'id')
                                                    @if($direction == 'asc')
                                                        <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                                    @else
                                                        <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                                    @endif
                                                @endif
                                            </th>
                                            <th scope="col" wire:click="order('name')">{{ __('Name') }}
                                                @if($sort = 'name')
                                                    @if($direction == 'asc')
                                                        <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                                    @else
                                                        <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                                    @endif
                                                @endif
                                            </th>
                                            <th scope="col" wire:click="order('email')">{{ __('Email') }}
                                                @if($sort = 'email')
                                                    @if($direction == 'asc')
                                                        <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                                    @else
                                                        <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                                    @endif
                                                @endif
                                            </th>
                                            <th scope="col" wire:click="order('status')">{{ __('Status') }}
                                                @if($sort = 'status')
                                                    @if($direction == 'asc')
                                                        <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                                    @else
                                                        <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                                    @endif
                                                @endif
                                            </th>
                                            <th scope="col" wire:click="order('created_by')">{{ __('Created By')}}
                                                @if($sort = 'created_by')
                                                    @if($direction == 'asc')
                                                        <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                                    @else
                                                        <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                                    @endif
                                                @endif
                                            </th>
                                            <th scope="col" wire:click="order('created_at')">{{ __('Creation Date') }}
                                                @if($sort = 'created_at')
                                                    @if($direction == 'asc')
                                                        <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                                    @else
                                                        <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                                    @endif
                                                @endif
                                            </th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($prospects as $prospect)
                                            @if($prospect->approval_status == 2 && $prospect->status == 1)
                                                <tr class="table-warning">                                                
                                            @elseif($prospect->approval_status == 3 && $prospect->status == 1)
                                                <tr class="table-danger">
                                            @else
                                                </tr>
                                            @endif
                                                <td>{{ $prospect->id }}</td>
                                                <td><a href="{{ route('prospects.edit', $prospect) }}">{{ $prospect->name }}</a></td>
                                                <td>
                                                    <a href="mailto:{{ $prospect->email }}">{{ $prospect->email }}</a>
                                                </td>
                                                <td>
                                                    @if($prospect->status == 1)
                                                        EN REVISION
                                                    @elseif($prospect->status == 2)
                                                        RECHAZADO
                                                    @else
                                                        APROBADO
                                                    @endif
                                                </td>
                                                <td>{{ $prospect->requester->name}}</td>
                                                <td>{{ $prospect->started_at }}</td>                                                
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

