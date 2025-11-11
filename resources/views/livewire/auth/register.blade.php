<div class="register-section">
                <div class="logo">
                    <div class="logo-icon">🎬</div>
                    <div class="logo-text">Spectare</div>
                </div>

                <h1>Daftar</h1>
                <p class="subtitle">Bergabunglah dengan Spectare dan nikmati pengalaman sinematik terbaik.</p>

                <form wire:submit.prevent="register">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" wire:model="email" placeholder="Masukkan email Anda"
                            required>
                        @error('email')
                            <small style="color:#f87171">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="username">Nama Lengkap</label>
                        <input type="text" id="username" wire:model="name" placeholder="Masukkan nama Anda"
                            required>
                        @error('name')
                            <small style="color:#f87171">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" wire:model="password"
                            placeholder="Buat password yang kuat" required>
                        @error('password')
                            <small style="color:#f87171">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="confirm-password">Konfirmasi Password</label>
                        <input type="password" id="confirm-password" wire:model="password_confirmation"
                            placeholder="Ulangi password Anda" required>
                    </div>

                    <div class="checkbox-group">
                        <input type="checkbox" id="terms" required>
                        <label for="terms">Saya setuju dengan <a href="#">Syarat & Ketentuan</a></label>
                    </div>

                    <button type="submit" class="btn-register">Daftar Sekarang</button>
                </form>


                <div class="footer-links">
                    <div>
                        <span style="color: #a0a8c0;">Sudah punya akun? <a href="{{ route('login') }}">Masuk di
                                sini</a></span>
                    </div>
                </div>
            </div>
