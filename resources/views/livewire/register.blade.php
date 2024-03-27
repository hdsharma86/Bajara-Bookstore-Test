<div class="min-h-screen flex items-center justify-center w-full dark:bg-gray-300">
    <div class="card w-96 bg-base-100 shadow-xl">
        <div class="card-body">
            <h2 class="card-title">Register!</h2>
            <form wire:submit.prevent="register">
                <div class="py-3">
                    <input wire:model="name" type="text" placeholder="Name" class="input input-bordered w-full max-w-xs" autocomplete="off" />
                    @error('name') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="py-3">
                    <input wire:model="email" type="text" placeholder="Email address" class="input input-bordered w-full max-w-xs" autocomplete="off" />
                    @error('email') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="py-3">
                    <input wire:model="password" type="password" placeholder="Password" class="input input-bordered w-full max-w-xs" autocomplete="off" />
                    @error('password') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="btn">Register</button>
            </form>
        </div>
        <div class="card-actions justify-end mr-9 mb-3">
            <a class="underline" wire:navigate href="/login">Login</a>
        </div>
    </div>
</div>