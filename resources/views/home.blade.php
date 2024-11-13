<x-vinylshop-layout>
    <x-slot name="description">New description</x-slot>
        <x-slot name="title">The Vinyl Shop</x-slot>

    <p>Welcome to the website of The Vinyl Shop, a large online store with lots of (classic) vinyl records.</p>
    @livewire('testjes.quote')
    <hr class="my-4">
    <h2>heading 2</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium blanditiis commodi dolorem eaque error esse
        eum impedit iusto necessitatibus optio, perferendis possimus quaerat, quod rem sapiente suscipit voluptates!
        Repudiandae, tempore?</p>
    <h3>heading 3</h3>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A at dolor dolorum fugit ipsam iusto laborum
        perferendis reprehenderit sapiente tenetur. Ab architecto autem dolorem illo maiores minima natus repellat
        vitae.</p>
    <button
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
        data-tippy-content="I'm a Tippy tooltip!">
        Hover Me
    </button>

    @push('script')
        <script>
            console.log('The Vinyl Shop JavaScript works! 🙂')
        </script>
    @endpush
</x-vinylshop-layout>
