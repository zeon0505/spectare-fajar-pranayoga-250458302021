<?php

namespace App\Livewire\User;

use Livewire\Component;

class Dashboard extends Component
{
    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.user.dashboard');
    }
}
