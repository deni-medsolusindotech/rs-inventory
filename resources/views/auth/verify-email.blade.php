<x-guest-layout>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
    
        </div>
        <div class="form-container sign-in-container">
            <div style=" margin-left: 20px; margin-top:40px;
            margin-right: 20px;
            border:1px solid rgb(88, 185, 241);
            margin-bottom: -100px;
            border-left: 5px solid rgb(27, 193, 243); /* Ganti dengan lebar dan warna yang Anda inginkan */
            padding-left: 15px; /* Jarak antara border dan teks */
            font-size: 12px;">
              <p style="font-size:12px;">{{ __('Terima kasih telah mendaftar! Sebelum memulai, bisakah Anda memverifikasi alamat email Anda dengan mengklik tautan yang baru saja kami kirimkan ke Anda? Jika Anda tidak menerima email tersebut, dengan senang hati kami akan mengirimkan yang lain.') }}</p>  
            </div>
        
            <form style="margin-top:-50px;" method="POST" action="{{ route('verification.send') }}">
                @if (session('status') == 'verification-link-sent')
                    <div style="
                    border-left: 5px solid rgb(19, 228, 243); /* Ganti dengan lebar dan warna yang Anda inginkan */
                    padding-left: 15px; /* Jarak antara border dan teks */
                    font-size: 12px;">
                        {{ __('Sebuah tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat registrasi.') }}
                    </div>
                @endif
                @csrf
    
                <input class="submit" type="Submit" name="login" value="Kirim lagi email verifikasi" style="margin-top:20px;" required/>
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
                    <h1>Email Verifikasi!</h1>
                    <p>Jika ingin mendaftarkan data lain silahkan log out dibawah ini</p>
                    <form method="POST" id="logout" style="display: none;" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="ghost" id="signIn" >
                            {{ __('Log Out') }}
                        </button>
                    </form>
                    <button onclick="document.getElementById('logout').submit();" class="ghost" id="signIn" >log Out</button>
                </div>
               
            </div>
        </div>
    </div>
</x-guest-layout>
