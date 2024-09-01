@extends('layouts.user')

@section('content')
<section class="breadcrumb-area mt-15">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Account</li>
                    </ol>
                </nav>
                <h5>Account</h5>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Area End -->

<!--Acount Area Start -->
<section class="account">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Dashboard-Nav  Start-->
                <div class="dashboard-nav">
                    <ul class="list-inline">
                        <li class="list-inline-item"><a href="{{ route('user.dashboard') }}" class="active">Account settings</a></li>
                        <li class="list-inline-item"><a href="#">Billing information</a></li>
                        <li class="list-inline-item"><a href="#}">My wishlist</a></li>
                        <li class="list-inline-item"><a href="{{ route('user.cart.index') }}">My cart</a></li>
                        <li class="list-inline-item"><a href="#">Order</a></li>
                
                        <!-- Logout functionality -->
                        <li class="list-inline-item">
                            <a href="#" class="mr-0"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                               Log-out
                            </a>
                        </li>
                    </ul>
                </div>
                
                <!-- Hidden form for logout -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                
                <!-- Dashboard-Nav  End-->
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="account-setting">
                    <h6>Account settings</h6>
                    <form action="#" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form__div">
                            <input type="text" class="form__input" name="name" value="{{ old('name', Auth::user()->name) }}" placeholder=" ">
                            <label for="name" class="form__label">Full Name</label>
                        </div>
                        <div class="form__div">
                            <input type="email" class="form__input" name="email" value="{{ old('email', Auth::user()->email) }}" placeholder=" ">
                            <label for="email" class="form__label">Email</label>
                        </div>
                        <button type="submit" class="btn bg-primary">Save Changes</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="change-password">
                    <h6>Change password</h6>
                    {{-- <form action="{{ route('user.password.update') }}" method="POST"> --}}
                    <form action="#" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form__div">
                            <input type="password" class="form__input" name="current_password" placeholder=" ">
                            <label for="current_password" class="form__label">Current password</label>
                        </div>
                        <div class="form__div">
                            <input type="password" class="form__input" name="new_password" placeholder=" ">
                            <label for="new_password" class="form__label">New password</label>
                        </div>
                        <div class="form__div mb-40">
                            <input type="password" class="form__input" name="new_password_confirmation" placeholder=" ">
                            <label for="new_password_confirmation" class="form__label">Confirm password</label>
                        </div>
                        <button type="submit" class="btn bg-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Acount Area End -->
@endsection
