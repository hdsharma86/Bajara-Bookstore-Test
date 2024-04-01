<div>
    <div class="text-sm breadcrumbs flex justify-end mb-3">
        <ul>
            <li><a wire:navigate href="/livewire-admin/dashboard">Admin</a></li> 
            <li><a wire:navigate href="/livewire-admin/users">Users</a></li>
            <li>Add User</li>
        </ul>
    </div>

    <div class="grid grid-cols-2 gap-4 mb-3">
        <div class="text-left">
            <h1 class="text-2xl font-bold">Add User</h1>
        </div>
    </div>

    <div class="max-w-md mx-auto">
    <form wire:submit.prevent="saveUser()" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                Name
            </label>
            <input wire:model="name" name="name" id="name" class="@error('name') border-red-500 @else border-gray-700 @enderror border rounded w-full py-2 px-3 text-gray-700" id="username" type="text" placeholder="Name">
            @error('name') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                Email
            </label>
            <input wire:model='email' class="@error('email') border-red-500 @else border-gray-700 @enderror border rounded w-full py-2 px-3 text-gray-700" id="username" type="text" placeholder="Email">
            @error('email') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                Password
            </label>
            <input wire:model='password' class="@error('password') border-red-500 @else border-gray-700 @enderror border rounded w-full py-2 px-3 text-gray-700 mb-3" id="password" type="password" placeholder="**********">
            @error('password') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
        </div>
        <div class="flex items-center justify-end">
            <button wire:click='cancelAddUser()' class="btn btn-outline btn-sm font-bold py-2 px-4 rounded">Cancel</button>
            <button type="submit" class="btn btn-outline btn-sm font-bold py-2 px-4 rounded ml-3">Save</button>
        </div>
    </form>
</div>
</div>
