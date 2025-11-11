<?php

namespace App\Livewire\Admin;

use App\Models\Film;
use Livewire\Component;
use Livewire\Attributes\Layout;

class Dashboard extends Component
{

    #[Layout('components.layouts.app')]

    public function render()
    {
        $totalFilms = Film::count();

        return view('livewire.admin.dashboard', compact('totalFilms'));
    }
}
