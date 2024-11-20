<?php

namespace App\Livewire\Admin;

use App\Models\Genre;
use App\Traits\SweetAlertTrait;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Genres extends Component
{
    use SweetAlertTrait;

    public $sortColumn = 'name';
    public $sortOrder = 'asc';

    #[Validate([
        'editGenre.name' => 'required|min:3|max:30|unique:genres,name',
    ], as: [
        'editGenre.name' => 'name for this genre',
    ])]
    public $editGenre = ['id' => null, 'name' => null];
    public $newGenre;
    #[Layout('layouts.vinylshop', ['title' => 'Genres', 'description' => 'Manage the genres of your vinyl records',])]
    public function resetValues()
    {
        $this->reset('newGenre', 'editGenre');
        $this->resetErrorBag();
    }
    public function edit(Genre $genre)
    {
        $this->editGenre = [
            'id' => $genre->id,
            'name' => $genre->name,
        ];
    }
    public function update(Genre $genre)
    {
        $this->editGenre['name'] = trim($this->editGenre['name']);
        // if the name is not changed, do nothing
        if(strtolower($this->editGenre['name']) === strtolower($genre->name)) {
            $this->resetValues();
            return;
        }
        $this->validateOnly('editGenre.name');
        $oldName = $genre->name;
        $genre->update([
            'name' => trim($this->editGenre['name']),
        ]);
        $this->resetValues();
        $this->swalToast("The genre <b><i>{$oldName}</i></b> has been updated to <b><i>{$genre->name}</i></b>");
    }
    // delete a genre
    public function delete(Genre $genre)
    {
        $this->swalConfirm(
            '',
            "Are you sure you want to delete the genre <b><i>{$genre->name}</i></b>?",
            'white',
            'delete-genre',
            $genre->id
        );
    }
    // delete genre is confirmed
    #[On('delete-genre')]
    public function deleteConfirmed($id)
    {
        $genre = Genre::findOrFail($id);
        $genre->delete();
        $this->swalToast("The genre <b><i>{$genre->name}</i></b> has been deleted");
    }
    public function create()
    {
        // validate the new genre name
        $this->validateOnly('newGenre');
        // create the genre
        $genre = Genre::create([
            'name' => trim($this->newGenre),
        ]);
        $this->resetValues();
        $this->swalToast("The genre <b><i>$genre->name</i></b> has been added");
    }
    public function resort($column)
    {
        if ($this->sortColumn === $column) {
            $this->sortOrder = $this->sortOrder === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortColumn = $column;
            $this->sortOrder = 'asc';
        }
    }
    public function render()
    {
        $genres = Genre::withCount('records')
            ->orderBy($this->sortColumn, $this->sortOrder)
            ->get();
        return view('livewire.admin.genres', compact('genres'));
    }



}
