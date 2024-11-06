<div>
    <div wire:loading.remove>
        <x-tmk.section class="my-2 cursor-pointer" wire:click="$refresh()">
            <p class="font-bold">{{ $author }}</p>
            <p>{{ $quote }}</p>
        </x-tmk.section>
    </div>
    <div wire:loading.block>
        <x-tmk.preloader class="border border-sky-700 bg-sky-200">
            Loading quote...
        </x-tmk.preloader>
    </div>
</div>
