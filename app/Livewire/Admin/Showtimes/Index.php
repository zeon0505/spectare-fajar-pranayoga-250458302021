<?php

namespace App\Livewire\Admin\Showtimes;

use Livewire\Component;
use App\Models\Showtime;
use App\Models\Film;
use App\Models\Studio;

class Index extends Component
{
    public $showtimes;

    public function mount()
    {
        $this->showtimes = Showtime::with(['film', 'studio'])->get();
    }

    public function delete($id)
    {
        Showtime::find($id)->delete();
        session()->flash('message', 'Showtime deleted successfully.');
        $this->showtimes = Showtime::with(['film', 'studio'])->get();
    }

    public function render()
    {
        return view('livewire.admin.showtimes.index');
    }
}
