<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Password;

class ForgotPassword extends Component
{
    #[Layout('components.layouts.auth')]

    public $email = '';
    public $emailSent = false;

    protected $rules = [
        'email' => 'required|email|exists:users,email',
    ];

    protected $messages = [
        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'email.exists' => 'Email tidak terdaftar dalam sistem.',
    ];

    public function sendResetLink()
    {
        $this->validate();

        $status = Password::sendResetLink(
            ['email' => $this->email]
        );

        if ($status === Password::RESET_LINK_SENT) {
            $this->emailSent = true;
            session()->flash('success', 'Link reset password telah dikirim ke email Anda.');
        } else {
            session()->flash('error', 'Gagal mengirim link reset password. Silakan coba lagi.');
        }
    }

    public function render()
    {
        return view('livewire.auth.forgot-password');
    }
}
