@extends('layouts.user')

@section('content')
<section class="account-sign d-flex align-items-center justify-content-center" style="min-height: 100vh; margin-top:0; padding-top: 0;">
    <div class="container" style="padding-top: 10px;">
        <div class="row justify-content-center" style="margin-top: 0;">
            <div class="col-lg-6 col-md-8" style="padding-top: 0;">
                <div class="account-sign-up">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <h5 class="text-center">Sign Up</h5>
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="form__div">
                            <input id="name" name="name" type="text" class="form__input" placeholder=" " required>
                            <label for="name" class="form__label">Full Name</label>
                        </div>
                        <div class="form__div">
                            <input id="email" name="email" type="email" class="form__input" placeholder=" " required>
                            <label for="email" class="form__label">Email</label>
                        </div>
                        <div class="form__div">
                            <input id="password" name="password" type="password" class="form__input" placeholder=" " required>
                            <label for="password" class="form__label">Password</label>
                        </div>
                        <div class="form__div mb-0">
                            <input id="password_confirmation" name="password_confirmation" type="password" class="form__input" placeholder=" " required>
                            <label for="password_confirmation" class="form__label">Repeat Password</label>
                        </div>
                        <div class="password-info-show">
                            <input type="checkbox" id="showpassagain" class="mb-0">
                            <label for="showpassagain" class="mb-0">Show Password</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="{{ route('login') }}" class="btn btn-link">Already have an account? Sign In</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
