<div class="register-section">
    <!-- Logo -->
    <div class="logo">
        <div class="logo-icon">🎬</div>
        <div class="logo-text">Spectare</div>
    </div>

    <h1>Reset Password</h1>
    <p class="subtitle">Masukkan password baru Anda untuk melanjutkan.</p>

    @if (session('error'))
        <div style="background: #ef4444; color: white; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit.prevent="resetPassword">
        <!-- Email -->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" wire:model="email" placeholder="Masukkan email Anda" required>
            @error('email')
                <small style="color:#f87171; display: block; margin-top: 5px;">{{ $message }}</small>
            @enderror
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="password">Password Baru</label>
            <input type="password" id="password" wire:model="password" placeholder="Masukkan password baru" required>
            @error('password')
                <small style="color:#f87171; display: block; margin-top: 5px;">{{ $message }}</small>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password</label>
            <input type="password" id="password_confirmation" wire:model="password_confirmation" placeholder="Konfirmasi password baru" required>
            @error('password_confirmation')
                <small style="color:#f87171; display: block; margin-top: 5px;">{{ $message }}</small>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn-register">Reset Password</button>
    </form>

    <div class="footer-links">
        <div>
            <span style="color: #a0a8c0;">Ingat password Anda? <a href="{{ route('login') }}">Login di sini</a></span>
        </div>
    </div>
</div>
