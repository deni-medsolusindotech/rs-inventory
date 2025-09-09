<x-guest-layout>
      
    <div class="container" id="container">
        <div class="form-container sign-in-container">
            <form method="POST" action="{{ route('password.store') }}">
                @csrf
                <h1>Reset Password</h1>
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                <div class="social-container">
                </div>
                <input class="username" value="{{ request('email') }}" type="text" name="email" placeholder="Email" required/>
                <input class="password" value="{{ old('password') }}" type="password" name="password" placeholder="Password" required />
                <input class="password" type="password" name="password_confirmation" placeholder="Password Konfirmasi" required />
                <input class="submit" type="Submit" name="login" value="Reset Password" style="margin-top:20px;" required/>
                
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
                    <button class="ghost" id="signIn">log In</button>
                </div>
            </div>
        </div>
    </div>
    </x-guest-layout>