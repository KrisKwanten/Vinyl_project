<x-vinylshop-layout>
    <x-slot name="title">Playground</x-slot>

    <h2>Dynamic data</h2>
    <section class="flex flex-col">
        @php
            $color = 'danger';      // $color is a dynamic value !!!
        @endphp

        <x-tmk.alert type="$color">
            Is this a red, danger alert?<br>
            No, <code class="px-2 text-blue-600 font-black">type="$color"</code> don't work with dynamic values.
        </x-tmk.alert>

        <x-tmk.alert :type="$color">
            Is this a red, danger alert?<br>
            Yes, use <code class="px-2 text-blue-600 font-black">:type="$color"</code> for dynamic values.
        </x-tmk.alert>
    </section>
</x-vinylshop-layout>
