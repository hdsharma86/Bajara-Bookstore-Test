<div>
    <div class="min-h-screen w-full dark:bg-gray-300">
        <div class="w-full p-9">
            @if (count($books) > 0)
                <div class="grid grid-cols-4 gap-2">
                    @foreach ($books as $book)
                        <div class="card bg-base-100 shadow-xl">
                            @if (count($book->images) > 0)
                                @foreach($book->images as $image)
                                <figure>
                                    <img src="/img/{{$image->name}}" alt="Book" />
                                </figure>
                                @endforeach
                            @else
                                <figure>
                                    <img src="/img/book.jpg" alt="Book" />
                                </figure>
                            @endif
                            <div class="card-body">
                                <h2 class="card-title">{{ $book->name }}</h2>
                                <p>{{ Str::limit($book->description, $limit = 30, $end = '...') }}</p>
                                <div class="card-actions justify-end">
                                    @auth
                                        <button wire:click="removeFav({{ $book->id }})" class="text-green-700 btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                            </svg>
                                        </button>
                                        <button wire:click="redirectTo('{{ $book->id }}')"
                                            class="btn btn-primary">Read More</button>
                                    @else
                                        <button wire:click="redirectTo" class="btn btn-primary">Read More</button>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="grid h-16 place-items-center">
                    <div class="p-4 border">
                        No Books Matched! try again.
                    </div>
                </div>
            @endif

        </div>
    </div>

</div>
</div>
