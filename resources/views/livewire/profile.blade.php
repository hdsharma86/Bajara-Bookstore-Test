<div>
    <div class="min-h-screen flex items-center justify-center w-full dark:bg-gray-300">
    <div class="card w-96 bg-base-100 shadow-xl">
        <div class="card-body">
            <h2 class="card-title">Update Profile</h2>
            @if (session()->has('message'))
                <div class="text-red-700">{{ session('message') }}</div>
            @endif
            <form wire:submit.prevent="profile">
                <div class="py-3">
                    <input wire:model="name" name="name" type="text" placeholder="Name" class="input input-bordered w-full max-w-xs" autocomplete="off" />
                    @error('name') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="py-3">
                    <input disabled="true" wire:model="email" type="text" placeholder="Email address" class="input input-bordered w-full max-w-xs" autocomplete="off" />
                    @error('email') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="py-3">
                    <input wire:model="password" type="password" placeholder="Password" class="input input-bordered w-full max-w-xs" autocomplete="off" />
                    @error('password') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="btn">Update</button>
            </form>
        </div>
    </div>
</div>
</div>