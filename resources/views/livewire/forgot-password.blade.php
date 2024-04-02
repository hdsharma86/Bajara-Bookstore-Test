<div class="min-h-screen flex items-center justify-center w-full p-9 lg:p-0 md:p-0">
    <div class="card w-96 bg-base-100 shadow-xl">
        <div class="card-body">
            @if (session()->has('error'))
                <div class="text-red-600">{{ session('error') }}</div>
            @endif
            <form wire:submit.prevent="forgotPassword">
                <h2 class="card-title">Forgot Password</h2>
                <div class="py-3">
                    <input name="email" wire:model="email" type="text" placeholder="Account" class="input input-bordered w-full max-w-xs" autocomplete="off" />
                    @error('email') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
                </div>
                <button type="submit" class="btn">Forgot</button>
                
            </form>
        </div>
        <div class="card-actions ml-9 mb-3 text-sm">
            <a class="underline" wire-navigate href="/login">Login</a> OR Don't have account? <a class="underline" wire:navigate href="/register">Create account</a>
        </div>
    </div>
</div>