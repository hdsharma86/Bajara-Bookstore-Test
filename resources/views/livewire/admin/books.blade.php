<div>
    <div class="text-sm breadcrumbs flex justify-end mb-3">
        <ul>
            <li><a wire:navigate href="/livewire-admin/dashboard">Admin</a></li> 
            <li>Books</li>
        </ul>
    </div>

    <div class="grid grid-cols-2 gap-4 mb-3">
        <div class="text-left">
            <h1 class="text-2xl font-bold">Books</h1>
        </div>
        <div class="text-right">
            <router-link to="/admin/add-book">
                <button wire:click="addBook()" class="btn btn-outline btn-sm">+ Add New</button>
            </router-link>
        </div>
    </div>
    @if (session()->has('message'))
        <div class="bg-green-500 text-gray-700 py-2 px-4 rounded-md mb-3">
            {{ session('message') }}
        </div>
    @endif
    <div class="overflow-x-auto border-2 border-gray-600">
        <table class="table table-zebra table-pin-rows">
            <!-- head -->
            <thead>
                <tr class="bg-gray-600 text-white">
                    <th>Sr. No</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $key => $book)
                    <tr>
                        <td class="py-2">{{ $key + 1 }}</td>
                        <td class="py-2">{{ $book->name }}</td>
                        <td class="py-2">{{ $book->description }}</td>
                        <td class="py-2">
                            <button wire:click="updateBook({{$book->id}})" class="border-gray-900 hover:border-gray-900 btn btn-xs">Edit</button>
                            <button wire:click="deleteBook({{$book->id}})" class="border-gray-900 hover:border-gray-900 btn btn-xs">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="flex justify-end mt-3">
        <div class="join bg-slate-600 border-2 border-gray-900">
            <button class="join-item btn btn-sm" wire:click="previousPage" {{ $page <= 1 ? 'disabled' : '' }}>Previous</button>
            <button class="join-item btn btn-sm" wire:click="nextPage" {{ $books->hasMorePages() ? '' : 'disabled' }}>Next</button>
        </div>
    </div>
</div>
