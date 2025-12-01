<div class="register-section">
    <!-- Logo -->
    <div class="logo">
        <div class="logo-icon">🎬</div>
        <div class="logo-text">Spectare</div>
    </div>

    <h1>Lupa Password</h1>
    <p class="subtitle">Masukkan email Anda dan kami akan mengirimkan link untuk mereset password.</p>

    @if (session('success'))
        <div style="background: #10b981; color: white; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div style="background: #ef4444; color: white; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            {{ session('error') }}
        </div>
    @endif

    @if (!$emailSent)
        <form wire:submit.prevent="sendResetLink">
            <!-- Email -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" wire:model="email" placeholder="Masukkan email Anda" required>
                @error('email')
                    <small style="color:#f87171; display: block; margin-top: 5px;">{{ $message }}</small>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-register">Kirim Link Reset Password</button>
        </form>
    @else
        <div style="text-align: center; margin: 30px 0;">
            <div style="font-size: 60px; margin-bottom: 20px;">✉️</div>
            <p style="color: #10b981; font-size: 16px; margin-bottom: 20px;">
                Email dengan link reset password telah dikirim!
            </p>
            <p style="color: #a0a8c0; font-size: 14px;">
                Silakan cek inbox atau folder spam Anda.
            </p>
        </div>
    @endif

    <div class="footer-links">
        <div>
            <span style="color: #a0a8c0;">Ingat password Anda? <a href="{{ route('login') }}">Login di sini</a></span>
        </div>
    </div>
</div>
