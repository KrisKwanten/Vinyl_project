<?php

namespace App\Livewire\Testjes;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Quote extends Component
{

    public $quote= 'quote here';
    public $author = 'author here';

    public function render()
    {
        $response = Http::get('https://dummyjson.com/quotes/random')->json();
        $this->quote = $response["quote"];
        $this->author = $response["author"];
//        dd($response);
        return view('livewire.testjes.quote');
    }
}
