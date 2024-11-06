<div>
    <h2>Records</h2>
    <div class="my-4">{{ $records->links() }}</div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-8 ">
        @foreach ($records as $record)
            <div class="flex space-x-4 shadow-md rounded-lg p-4 {{ $record->stock <= 0 ? 'bg-red-200': 'bg-white' }}">
                <div class="inline flex-none w-48">
                    <img src="{{ $record->cover }}" alt="">
                </div>
                <div class="flex-1 relative">
                    <p class="text-lg font-medium">{{ $record->artist }}</p>
                    <p class="italic text-right pb-2 mb-2 border-b border-gray-300">{{ $record->title }}</p>
                    <p>{{ $record->genre_name }}</p>
                    <p>Price: {{ $record->price_euro }}</p>

                    @if($record->stock > 0)
                        <p>Stock: {{ $record->stock }}</p>
                    @else

                        <p class="absolute bottom-4 right-0 -rotate-12 font-bold text-red-500">SOLD OUT</p>
                    @endif
                        <?php
                        $mb_id = $record->mb_id;
                        $url = "https://listenbrainz.org/player/release/" . $mb_id;
                        ?>


                    <a href="<?= $url ?> " class="inline-flex p-0">
                        <x-si-musicbrainz class="w-6 h-6 text-red-600 mt-5"/>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
    <div class="my-4">{{ $records->links() }}</div>

    <h2>Genres with records</h2>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        @foreach ($genres as $genre)
            <div class="flex space-x-4 bg-white shadow-md rounded-lg p-4">
                <div class="flex-none w-36 border-r border-gray-200">
                    <h3 class="font-bold text-xl">{{ $genre->name }}</h3>
                    <p>Has {{ $genre->records()->count() }} {{ Str::plural('record', $genre->records()->count()) }}</p>
                </div>
                <div>
                    @foreach($genre->records as $record)
                        <x-tmk.list class="list-outside ml-4">
                            <li>
                                <span class="font-bold">{{ $record->artist }}</span><br>
                                {{ $record->title }}
                            </li>
                        </x-tmk.list>

                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    <x-tmk.livewirelog :genres="$genres" :records="$records" />
</div>
