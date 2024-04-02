<div>
    <div class="text-sm breadcrumbs flex justify-end mb-3">
        <ul>
            <li><a wire:navigate href="/livewire-admin/dashboard">Admin</a></li> 
            <li><a wire:navigate href="/livewire-admin/books">Books</a></li>
            <li>Add Book</li>
        </ul>
    </div>

    <div class="grid grid-cols-2 gap-4 mb-3">
        <div class="text-left">
            <h1 class="text-2xl font-bold">Add Book</h1>
        </div>
    </div>

    <div class="max-w-md mx-auto">
    <form wire:submit.prevent="saveBook()" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                Name
            </label>
            <input wire:model="name" name="name" id="name" class="@error('name') border-red-500 @else border-gray-700 @enderror border rounded w-full py-2 px-3 text-gray-700" id="username" type="text" placeholder="Name">
            @error('name') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                Description
            </label>
            <textarea wire:model="description" name="description" placeholder="Description" class="@error('description') border-red-500 @else border-gray-700 @enderror border rounded w-full py-2 px-3 text-gray-700" ></textarea>
            @error('description') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="price">
                Price
            </label>
            <input wire:model='price' class="@error('price') border-red-500 @else border-gray-700 @enderror border rounded w-full py-2 px-3 text-gray-700 mb-3" id="price" type="number" placeholder="0.00">
            @error('price') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                Image
            </label>
            <input wire:model='image' class="@error('image') border-red-500 @else border-gray-700 @enderror border rounded w-full py-2 px-3 text-gray-700 mb-3" id="image" type="file">
            @error('image') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center justify-end">
            <button wire:click='cancelAddBook()' class="btn btn-outline btn-sm font-bold py-2 px-4 rounded">Cancel</button>
            <button type="submit" class="btn btn-outline btn-sm font-bold py-2 px-4 rounded ml-3">Save</button>
        </div>
        @if ($image)
            Photo Preview:
            <img src="{{ $image->temporaryUrl() }}">
        @endif
    </form>
</div>
</div>
