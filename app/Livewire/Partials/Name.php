<?php

namespace App\Livewire\Partials;

use Livewire\Attributes\On;
use Livewire\Component;

class Name extends Component
{
    #[On('refresh-navigation-menu')]  // refresh the NavBar component when the 'refresh-navigation-menu' event is emitted

    public function render()
    {
        return view('livewire.partials.name');
    }
}
