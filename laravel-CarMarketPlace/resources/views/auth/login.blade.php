<x-guest-layout title="Login" bodyClass="page-login">

  <h1 class="auth-page-title">Login</h1>

  <form action="{{ route('login.store') }}" method="POST">
    @csrf
    <div class="form-group">
      <input type="email" name="email" placeholder="Your Email" value="{{ old('email') }}" />
      @error('email')
        <span class="error-message" style="color: red; font-size: 0.875rem;">{{ $message }}</span>
      @enderror
    </div>
    <div class="form-group">
      <input type="password" name="password" placeholder="Your Password" />
      @error('password')
        <span class="error-message" style="color: red; font-size: 0.875rem;">{{ $message }}</span>
      @enderror
    </div>
    <div class="text-right mb-medium">
      <a href="/password-reset.html" class="auth-page-password-reset">Reset Password</a>
    </div>

    <button type="submit" class="btn btn-primary btn-login w-full">Login</button>
  </form>

  <x-slot:footerLink>
    Don't have an account? -
    <a href="{{ route('signup') }}"> Click here to create one</a>
  </x-slot:footerLink>
  

</x-guest-layout>