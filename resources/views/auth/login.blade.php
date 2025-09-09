<x-guest-layout>
      
<div class="container full" id="container">
	<div class="form-container sign-up-container">
		<form action="{{ route('register') }}" method="post">
			@csrf
			<h1>  Buat Akun</h1>
			<div class="social-container">
			</div>
			<input name="name" value="{{ old('name') }}" class="username" type="text"  placeholder="Nama Lengkap" required />
			<input name="email" value="{{ old('email') }}" class="username" type="email" placeholder="email" required/>
			<input name="password" class="password" type="password" placeholder="Password" required/>
			<input name="password_confirmation" class="password" type="password" placeholder="Konfirmasi Password" required/>
			<select name="status_medis" class="status" required>
				<option value="">Pilih Status Medis</option>
				<option value="perawat">Perawat</option>
				<option value="bidan">Bidan</option>
				<option value="dokter">Dokter</option>
				<option value="penunjang_medis">Penunjang Medis</option>
				<option value="umum">Umum</option>
			</select>
			<input name="nomor_hp" value="{{ old('nomor_hp') }}" class="username" type="text" name="username" placeholder="Nomor Telepon" required/>
			<input class="submit" type="Submit" name="tambah_masyarakat" value="Daftar" required/>

		 </form> 

	</div>
	<div class="form-container sign-in-container">
		<form action="{{ route('login') }}" method="post">
			@csrf
			
			<h1> Masuk</h1>
		
			<div class="social-container">
			</div>
			<input class="username" value="{{ old('email') }}" type="text" name="email" placeholder="Email" required/>
			<input class="password" value="{{ old('password') }}" type="password" name="password" placeholder="Password" required />
			<input class="submit" type="Submit" name="login" value="Masuk" style="margin-top:20px;" required/>
			
			{{-- <div class="forgot">
				<a href="/forgot-password" style="font-size:13px;">Lupa Password?</a>
			</div> --}}
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<a href="/">
					<div class="d-flex">
						<img src="/logo.png" alt="logo" height="60" style="margin-right:-10px;">
						<img src="/logo-2.png" alt="logo" height="60">
					</div>
				</a>
				<h1>Selamat Datang!</h1>
				<p>Jika sudah mempunyai akun silahkan Masuk dibawah ini</p>
				<button class="ghost" id="signIn">Masuk</button>
			</div>
			<div class="overlay-panel overlay-right">
				<a href="/">
					<div class="d-flex">
						<img src="/logo.png" alt="logo" height="60" style="margin-right:-10px;">
						<img src="/logo-2.png" alt="logo" height="60">
					</div>
				</a>
				<h1>Selamat Datang!!</h1>
				<p>Silahkan Daftar Jika belum mempunyai Akun </p>
				<button class="ghost" id="signUp">Daftar</button>
			</div>
		</div>
	</div>
</div>

<div class="container responsive-content" id="container">
	<div class="form-container sign-up-container">
		<form action="{{ route('register') }}" method="post">
			@csrf
			<a href="/" class="logo-container">
				<div class="logo-images">
					<img src="/logo.png" alt="logo" height="60">
					<img src="/logo-2.png" alt="logo" height="60">
				</div>
				<h1>Register</h1>
			</a>
			<div class="social-container">
			</div>
			<input name="name" value="{{ old('name') }}" class="username" type="text"  placeholder="Nama Lengkap" required />
			<input name="email" value="{{ old('email') }}" class="username" type="email" placeholder="email" required/>
			<input name="password" class="password" type="password" placeholder="Password" required/>
			<input name="password_confirmation" class="password" type="password" placeholder="Konfirmasi Password" required/>
			<select name="status_medis" class="status" required>
				<option value="">Pilih Status Medis</option>
				<option value="perawat">Perawat</option>
				<option value="bidan">Bidan</option>
				<option value="dokter">Dokter</option>
				<option value="penunjang_medis">Penunjang Medis</option>
				<option value="umum">Umum</option>
			</select>
			<input name="nomor_hp" value="{{ old('nomor_hp') }}" class="username" type="text" name="username" placeholder="Nomor Telepon" required/>
			<input class="submit" type="Submit" name="tambah_masyarakat" value="Sign Up" required/>

		 </form> 

	</div>
	<div class="form-container sign-in-container">
		<form action="{{ route('login') }}" method="post">
			@csrf
			<a href="/" class="logo-container">
				<div class="logo-images">
					<img src="/logo.png" alt="logo" style="height:40px;margin-right:-20px;" height="10">
					<img src="/logo-2.png" alt="logo" style="height:40px;" height="10">
				</div>
				<h1>Login</h1>
			</a>
		
			<div class="social-container">
			</div>
			<input class="username" value="{{ old('email') }}" type="text" name="email" placeholder="Email" required/>
			<input class="password" value="{{ old('password') }}" type="password" name="password" placeholder="Password" required />
			<a href="/forgot-password" style="font-size:13px;margin-top:-3px;align-item:left;">Lupa kata sandi?</a>
			<input class="submit" type="Submit" name="login" value="Log in" style="margin-top:20px;" required/>
			
			<div class="forgot">
				<a href="/register" id="signUp" style="font-size:13px;margin-top:50px;">Belum punya akun ? Register</a>
			</div>
		</form>
	</div>
</div>

</x-guest-layout>