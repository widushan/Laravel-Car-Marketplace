

<x-guest-layout title="Signup" bodyClass="page-signup">

  <h1 class="auth-page-title">Signup</h1>

  <form action="{{ route('signup.store') }}" method="POST">
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
    <div class="form-group">
      <input type="password" name="password_confirmation" placeholder="Repeat Password" />
    </div>
    <hr />
    <div class="form-group">
      <input type="text" name="first_name" placeholder="First Name" value="{{ old('first_name') }}" />
      @error('first_name')
        <span class="error-message" style="color: red; font-size: 0.875rem;">{{ $message }}</span>
      @enderror
    </div>
    <div class="form-group">
      <input type="text" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}" />
      @error('last_name')
        <span class="error-message" style="color: red; font-size: 0.875rem;">{{ $message }}</span>
      @enderror
    </div>
    <div class="form-group">
      <input type="text" name="phone" placeholder="Phone" value="{{ old('phone') }}" />
      @error('phone')
        <span class="error-message" style="color: red; font-size: 0.875rem;">{{ $message }}</span>
      @enderror
    </div>
    <button type="submit" class="btn btn-primary btn-login w-full">Register</button>
  </form>
  

  <x-slot:footerLink>
    Already have an account? -
    <a href="{{ route('login') }}"> Click here to login </a>
  </x-slot:footerLink>

</x-guest-layout>