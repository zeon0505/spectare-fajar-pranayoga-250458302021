<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;

class ResetPassword extends Component
{
    #[Layout('components.layouts.auth')]

    public $token;
    public $email = '';
    public $password = '';
    public $password_confirmation = '';

    protected $rules = [
        'email' => 'required|email|exists:users,email',
        'password' => 'required|min:6|confirmed',
        'password_confirmation' => 'required',
    ];

    protected $messages = [
        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'email.exists' => 'Email tidak terdaftar dalam sistem.',
        'password.required' => 'Password wajib diisi.',
        'password.min' => 'Password minimal 6 karakter.',
        'password.confirmed' => 'Konfirmasi password tidak cocok.',
        'password_confirmation.required' => 'Konfirmasi password wajib diisi.',
    ];

    public function mount($token)
    {
        $this->token = $token;
        $this->email = request()->query('email', '');
    }

    public function resetPassword()
    {
        $this->validate();

        $status = Password::reset(
            [
                'email' => $this->email,
                'password' => $this->password,
                'password_confirmation' => $this->password_confirmation,
                'token' => $this->token
            ],
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            session()->flash('success', 'Password Anda telah berhasil direset. Silakan login.');
            return redirect()->route('login');
        } else {
            session()->flash('error', 'Token reset password tidak valid atau sudah kadaluarsa.');
        }
    }

    public function render()
    {
        return view('livewire.auth.reset-password');
    }
}
