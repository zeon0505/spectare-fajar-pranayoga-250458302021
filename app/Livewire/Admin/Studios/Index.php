<?php

namespace App\Livewire\Admin\Studios;

use Livewire\Component;
use App\Models\Studio;

class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.studios.index', [
            'studios' => Studio::latest()->get(),
        ]);
    }
}
