<x-guest-layout>
    <div class="container" id="container">
        <div class="form-container sign-in-container">
            @if(session('status') != null)
                <div style="margin-left:20px; margin-right:20px; margin-top:40px;border-left: 5px solid rgb(19, 228, 243); /* Ganti dengan lebar dan warna yang Anda inginkan */
                padding-left: 15px; /* Jarak antara border dan teks */ font-size: 12px;">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <a href="/" class="logo-container responsive-content">
                    <div class="logo-images">
                        <img src="/logo.png" alt="logo" style="height:40px;margin-right:-20px;" height="10">
                        <img src="/logo-2.png" alt="logo" style="height:40px;" height="10">
                    </div>
                    {{-- <h2>Lupa Password</h2> --}}
                </a>
                <h2 style="margin-top:-10px;" class="responsive-content">Lupa Kata Sandi</h2>
                <h1 class="full">Lupa Kata Sandi</h1>
                <div class="social-container">
                </div>
                <input class="username" value="{{ old('email') }}" type="text" name="email" placeholder="Email" required/>
                <input class="submit" type="Submit" name="login" value="email verifikasi" style="margin-top:20px;" required/>  
                <div class="forgot responsive-content">
                    <a href="/login-register" style="font-size:13px;">Login</a>
                </div>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-right">
                    <a href="/">
                        <div class="d-flex">
                            <img src="/logo.png" alt="logo" height="60" style="margin-right:-10px;">
                            <img src="/logo-2.png" alt="logo" height="60">
                        </div>
                    </a>
                    <h1>Selamat Datang!</h1>
                    <p>Jika sudah mempunyai akun silahkan log in dibawah ini</p>
                    <button onclick=" window.location.href = '/login-register'" class="ghost" id="signIn">log In</button>
                </div>
               
            </div>
        </div>
    </div>
</x-guest-layout>
