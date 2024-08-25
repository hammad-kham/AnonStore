@extends('layouts.user')

@section('content')
    <section class="account-sign d-flex align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="account-sign-in">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <h5 class="text-center">Sign in</h5>
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="form__div">
                                <input type="email" name="email" class="form__input" placeholder=" " required>
                                <label for="email" value="{{ old('email') }}" class="form__label">Email</label>
                            </div>
                            <div class="form__div mb-0">
                                <input type="password" name="password" class="form__input" placeholder=" " required>
                                <label for="password" class="form__label">Password</label>
                            </div>
                            <div class="password-info d-flex align-items-center justify-content-between flex-wrap">
                                <div class="password-info-left">
                                    <input type="checkbox" id="showpass" class="mb-0">
                                    <label for="showpass" class="mb-0">Show Password</label>
                                </div>
                                <div class="password-info-right">
                                    <a href="#">Forget Password</a>
                                </div>
                            </div>
                            <button type="submit" class="btn bg-primary w-100">Sign in</button>
                        </form>
                        <!-- Anchor link added below the login button -->
                        <div class="text-center mt-3">
                            <a href="{{ route('register.show') }}" class="btn btn-link">Don't have an account? Register</a>
                        </div>
                        <div class="social-signing mt-3">
                            <p class="text-center">or sign in with</p>
                            <div class="social-signing-link d-flex justify-content-center">
                                <!-- Social login buttons here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
