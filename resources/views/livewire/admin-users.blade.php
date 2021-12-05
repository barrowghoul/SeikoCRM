<div>
    
        <div class="container-fluid mt--6">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">{{ __('Users') }}</h3>
                                    <div class="row">                                        
                                        <div class="col-sm-10">
                                            <div class="form-group">
                                                <input wire:model="search" wire:keydown="limpiar_page" type="text" class="form-control w-100" placeholder="Buscar">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                @can('crear usuarios', App\User::class)
                                    <div class="col-4 text-right">
                                        <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">{{ __('Add User') }}</a>
                                    </div>
                                @endcan
                            </div>
                        </div>

                        <div class="col-12 mt-2">
                            @include('alerts.success')
                            @include('alerts.errors')
                        </div>
                        @if ($users->count())
                            <div class="card-body">
                                <div class="table-responsive py-4">
                                    <table class="table align-items-center table-flush">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">{{ __('Photo')}}</th>
                                                <th scope="col" wire:click="order('name')">{{ __('Name') }}
                                                    @if($sort == 'name')
                                                        @if($direction == 'asc')
                                                            <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                                        @else
                                                            <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                                        @endif
                                                    @endif
                                                </th>
                                                <th scope="col" wire:click="order('email')">{{ __('Email') }}
                                                    @if($sort == 'email')
                                                        @if($direction == 'asc')
                                                            <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                                        @else
                                                            <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                                        @endif
                                                    @endif
                                                </th>
                                                <th scope="col">{{ __('Role') }}</th>
                                                <th scope="col" wire:click="order('created_at')">{{ __('Creation Date') }}</th>
                                                @can('editar usuarios', App\User::class)
                                                    <th scope="col"></th>
                                                @endcan
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td>
                                                        <span class="avatar avatar-sm rounded-circle">
                                                            <img class="avatar border-gray" src="{{ $user->profilePicture() }}" alt="...">
                                                        </span>
                                                    </td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>
                                                        <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                                    </td>
                                                    <td>{{ $user->getRoleNames() }}</td>
                                                    <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                                                    @can('editar usuarios')
                                                        <td class="text-right">
                                                            @if (auth()->user()->can('editar usuarios') || auth()->user()->can('suspender usuarios'))
                                                                <div class="dropdown">
                                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <i class="nc-icon nc-bullet-list-67"></i>
                                                                    </a>
                                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                                        @if ($user->id != auth()->id())
                                                                            @can('editar usuarios')
                                                                                <a class="dropdown-item" href="{{ route('users.edit', $user) }}">{{ __('Edit') }}</a>
                                                                            @endcan
                                                                            @can('suspender usuarios')
                                                                                <form action="{{ route('users.destroy', $user) }}" method="POST">
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
                                {{ $users->links() }}
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
