<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;

class TermsAndConditions extends Component
{
    #[Layout('components.layouts.auth')]

    public function render()
    {
        return view('livewire.terms-and-conditions');
    }
}
