<?php

namespace App\Livewire;

use App\Models\Genre;
use App\Models\Record;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Laravel\Jetstream\InteractsWithBanner;

class Shop extends Component
{
    use WithPagination;
    use InteractsWithBanner;

    public $perPage = 6;

    public $filter;
    public $genre = '%';
    public $price;
    public $priceMin, $priceMax;
    public $loading = 'Please wait...';

    public $selectedRecord;
    public $showModal = false;

    public function updated($property, $value)
    {
        // $property: The name of the current property being updated
        // $value: The value about to be set to the property
        if (in_array($property, ['perPage', 'filter', 'genre', 'price']))
            $this->resetPage();
    }
    public function showTracks(Record $record)
    {
        $this->selectedRecord = $record;
        $url = "https://musicbrainz.org/ws/2/release/{$record->mb_id}?inc=recordings&fmt=json";
        $response = Http::get($url)->json();
        $this->selectedRecord['tracks'] = $response['media'][0]['tracks'];
        $this->showModal = true;
    }
    public function mount()
    {
        $this->priceMin = ceil(Record::min('price'));
        $this->priceMax = ceil(Record::max('price'));
        $this->price = $this->priceMax;
    }
    #[Layout('layouts.vinylshop', ['title' => 'Shop', 'description' => 'Welcome to our shop'])]
    public function render()
    {
        $allGenres = Genre::has('records')
            ->withCount('records')
            ->orderBy('name')
            ->get();
        $records = Record::orderBy('artist')
            ->orderBy('title')
            ->searchTitleOrArtist($this->filter)
            ->where('genre_id', 'like', $this->genre)
            ->where('price', '<=', $this->price)
            ->paginate($this->perPage);
        $genre = Genre::find($this->genre);
        $genreName = $genre ? $genre->name : 'Unknown';
        return view('livewire.shop', compact('records', 'allGenres','genreName'));
    }
}
