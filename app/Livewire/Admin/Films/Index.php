<?php

namespace App\Livewire\Admin\Films;

use Livewire\Component;
use App\Models\Film;

class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.films.index', [
            'films' => Film::latest()->get(),
        ]);
    }
}
