<x-layouts.base>
<link rel="stylesheet" href="<?php echo asset('css/register.css')?>" type="text/css">
<div class="container" id="container">
	<div class="form-container sign-up-container">
		<x-form method="post" action="{{ route('register.store') }}">
			<h1>Create Account</h1>
			Name<input name="name" label="name">
			Email<input name="email" label="Email" />
			Password<input name="password" label="Пароль" type="password" />
			<button>Sign Up</button>
		</x-form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>Welcome Back!</h1>
				<p>To keep connected with us please login with your personal info</p>
				<a href="{{ route('login') }}"><button class="ghost" id="signUp">Sign In</button></a>
			</div>
		</div>
	</div>
</div>
</x-layouts.base>