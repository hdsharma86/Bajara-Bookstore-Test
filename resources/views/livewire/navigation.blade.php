<div class="navbar sticky top-0 z-40 bg-white bg-opacity-70 shadow-xl">
    <div class="flex-1">
        @auth
            <a wire:navigate href="/user-dashboard" class="btn btn-ghost text-xl">Bajara Bookstore Test</a>
        @else
            <a wire:navigate href="/" class="btn btn-ghost text-xl">Bajara Bookstore Test</a>
        @endauth
    </div>
    <div class="flex-none">
        <ul class="menu menu-horizontal px-1">
            @auth
                <li><a wire:navigate href="/my-favourites">My favorites</a></li>
                <li><a wire:navigate href="/user-profile">My Profile</a></li>
                <li><a wire:navigate href="/user-logout">Logout</a></li>
            @else
                <li><a wire:navigate href="/login">Login</a></li>
                <li><a wire:navigate href="/register">Register</a></li>
            @endauth
        </ul>
    </div>
</div>
