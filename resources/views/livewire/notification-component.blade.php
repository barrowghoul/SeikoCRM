<div>
    <li wire:click="markAsRead()" class="nav-item btn-rotate dropdown">
        <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="nc-icon nc-bell-55"></i>
            @if($count)
                <span class="badge badge-danger">{{ $count }}</span>
                <span class="sr-only">unread messages</span>
            @endif  
            
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
            @foreach($notifications as $notification)
                <a class="dropdown-item" href="{{ $notification->data['url'] }}">{{ $notification->data['message'] }}
                    <span class="dropdown-item text-xs font-bold">{{ $notification->created_at->diffForHumans()}}</span>
                </a>     
            @endforeach
        </div>
    </li>
</div>
