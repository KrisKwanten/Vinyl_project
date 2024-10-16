<?php

namespace App\Livewire;


use App\Models\Genre;
use App\Models\Record;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Demo extends Component
{
    use WithPagination;
    public $MaxPrice = 100;
    public $perPage = 8;

    #[Layout('layouts.vinylshop', [
        'title' => 'Eloquent models',
        'subtitle' => 'Eloquent models: part 2',
        'description' => 'Eloquent models: part 2',
    ])]


    public function render()
    {
        $records = Record::orderBy('artist')
            ->orderBy('title')
            ->MaxPrice($this->MaxPrice)
//            ->get();
            ->paginate($this->perPage);
        $genres = Genre::orderBy('name')
            ->with('records')
            ->has('records')
            ->get();

//        $genres->makeVisible('created_at');
        return view('livewire.demo', compact('records', 'genres'));
    }
}
