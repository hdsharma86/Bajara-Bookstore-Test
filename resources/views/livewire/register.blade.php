<div class="min-h-screen flex items-center justify-center w-full dark:bg-gray-300">
    <div class="card w-96 bg-base-100 shadow-xl">
        <div class="card-body">
            <h2 class="card-title">Register!</h2>
            <div class="py-3">
                <input type="text" placeholder="Name" class="input input-bordered w-full max-w-xs" />
            </div>
            <div class="py-3">
                <input type="text" placeholder="Email address" class="input input-bordered w-full max-w-xs" />
            </div>
            <div class="py-3">
                <input type="password" placeholder="Password" class="input input-bordered w-full max-w-xs" />
            </div>
            <div class="py-3">
                <input type="password" placeholder="Confirm Password" class="input input-bordered w-full max-w-xs" />
            </div>
            <button class="btn">Register</button>
        </div>
        <div class="card-actions justify-end mr-9 mb-3">
            <a class="underline" wire:navigate href="/login">Login</a>
        </div>
    </div>
</div>