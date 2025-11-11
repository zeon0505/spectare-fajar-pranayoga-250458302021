<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    #[Layout('components.layouts.auth')]


    public $email = '';
    public $password = '';

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];

    protected $messages = [
        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'password.required' => 'Password wajib diisi.',
        'password.min' => 'Password minimal 6 karakter.',
    ];

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            session()->regenerate();

            $user = Auth::user();

            // jika user tidak ditemukan
            if (!$user) {
                session()->flash('error', 'Terjadi kesalahan saat login.');
                return redirect()->route('login');
            }

            // redirect sesuai role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('user.dashboard');
        }

        session()->flash('error', 'Email atau password salah.');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
