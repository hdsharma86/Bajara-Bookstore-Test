<div class="min-h-screen flex items-center justify-center w-full p-9 lg:p-0 md:p-0">
    <div class="card w-96 bg-base-100 shadow-xl">
        <div class="card-body">
            @if (session()->has('error'))
                <div class="text-red-600">{{ session('error') }}</div>
            @endif
            <form wire:submit.prevent="login">
                <h2 class="card-title">Admin Login (Livewire)!</h2>
                <div class="py-3">
                    <input name="email" wire:model="email" type="text" placeholder="Account" class="input input-bordered w-full max-w-xs" autocomplete="off" />
                    @error('email') <span class="error text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="py-3">
                    <input name="password" wire:model="password" type="password" placeholder="Password" class="input input-bordered w-full max-w-xs" autocomplete="off" />
                    @error('password') <span class="error text-red-600">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="btn">Login</button>
            </form>
        </div>
    </div>
</div>