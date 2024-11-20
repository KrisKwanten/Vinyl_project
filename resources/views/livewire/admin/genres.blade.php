<div>
    <x-tmk.section
        x-data="{ open: false }"
        class="!p-0 mb-4 flex flex-col gap-2">
        <div class="p-4 flex justify-between items-start gap-4">
            <div class="relative w-64">
                <x-input id="newGenre" type="text" placeholder="New genre"
                         @keydown.enter="$el.setAttribute('disabled', true); $el.value = '';"
                         @keydown.tab="$el.setAttribute('disabled', true); $el.value = '';"
                         @keydown.esc="$el.setAttribute('disabled', true); $el.value = '';"
                         wire:model="newGenre"
                         wire:keydown.enter="create()"
                         wire:keydown.tab="create()"
                         wire:keydown.escape="resetValues()"
                         class="w-full shadow-md placeholder-gray-300"/>
                <x-phosphor-arrows-clockwise
                    wire:loading
                    wire:target="create"
                    class="hidden size-5 text-gray-500 absolute top-3 right-2 animate-spin"/>
            </div>
            <x-heroicon-o-information-circle
                @click="open = !open"
                class="w-5 text-gray-400 cursor-help outline-0"/>
        </div>
        <x-input-error for="newGenre" class="m-4 -mt-4 w-full"/>
        <div
            x-show="open"
            x-transition
            style="display: none"
            class="text-sky-900 bg-sky-50 border-t p-4">
            <x-tmk.list type="ul" class="list-outside mx-4 text-sm">
                <li>
                    <b>A new genre</b> can be added by typing in the input field and pressing <b>enter</b> or
                    <b>tab</b>. Press <b>escape</b> to undo.
                </li>
                <li>
                    <b>Edit a genre</b> by clicking the
                    <x-phosphor-pencil-line-duotone class="w-5 inline-block"/>
                    icon or by clicking on the genre name. Press <b>enter</b> to save, <b>escape</b> to undo.
                </li>
                <li>
                    Clicking the
                    <x-heroicon-o-information-circle class="w-5 inline-block"/>
                    icon will toggle this message on and off.
                </li>
            </x-tmk.list>
        </div>
    </x-tmk.section>

    <x-tmk.section>
        <table class="text-center w-full border border-gray-300">
            <colgroup>
                <col class="w-24">
                <col class="w-24">
                <col class="w-16">
                <col class="w-max">
            </colgroup>
            <thead>
            <tr class="bg-gray-100 text-gray-700 [&>th]:p-2">
                <x-tmk.table.sortable-header wire:click="resort('id')"
                                             position="center" :sortColumn="$sortColumn" :sortOrder="$sortOrder">
                    id
                </x-tmk.table.sortable-header>
                <x-tmk.table.sortable-header wire:click="resort('records_count')"
                                             position="center" :sortColumn="$sortColumn" :sortOrder="$sortOrder">
                    <x-tmk.logo class="size-6 fill-gray-200"/>
                </x-tmk.table.sortable-header>
                <th></th>
                <x-tmk.table.sortable-header wire:click="resort('name')"
                                             :sortColumn="$sortColumn" :sortOrder="$sortOrder">
                    Genre
                </x-tmk.table.sortable-header>
            </tr>
            </thead>
            <tbody>
            @foreach($genres as $genre)
                <tr
                    wire:key="{{ $genre->id }}"
                    class="border-t border-gray-300 [&>td]:p-2">
                    <td>{{ $genre->id }}</td>
                    <td>{{ $genre->records_count }}</td>
                <td>
                    @if($editGenre['id'] !== $genre->id)
                    <div class="flex gap-1 justify-center [&>*]:cursor-pointer [&>*]:outline-0 [&>*]:transition">
                        <x-phosphor-pencil-line-duotone
                            wire:click="edit({{ $genre->id }})"
                            class="w-5 text-gray-300 hover:text-green-600"/>
                        <x-phosphor-trash-duotone
                            wire:click="delete({{ $genre->id }})"

{{--                            wire:confirm="Are you sure you want to delete this genre?"--}}
                            class="w-5 text-gray-300 hover:text-red-600"/>
                    </div>
                    @endif
                </td>
                    @if($editGenre['id'] !== $genre->id)

                    <td
                    class="text-left cursor-pointer">{{ $genre->name }}
                </td>
                    @else
                        <td>
                            <div class="flex flex-col text-left">
                                <x-input id="edit_{{ $genre->id }}" type="text"
                                         x-init="$el.focus()"
                                         @keydown.enter="$el.setAttribute('disabled', true);"
                                         @keydown.tab="$el.setAttribute('disabled', true);"
                                         @keydown.esc="$el.setAttribute('disabled', true);"
                                         wire:model="editGenre.name"
                                         wire:keydown.enter="update({{ $genre->id }})"
                                         wire:keydown.tab="update({{ $genre->id }})"
                                         wire:keydown.escape="resetValues()"
                                         class="w-48"/>
                                <x-input-error for="editGenre.name" class="mt-2"/>
                            </div>
                        </td>
                    @endif
            </tr>
            @endforeach

            </tbody>
        </table>
    </x-tmk.section>
</div>
