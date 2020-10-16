@extends('v1.master.admin_auth')

@section('title', 'Login')

@section('content')
<div class="row justify-content-md-center">
    <form action="{{ route('post-admin-login') }}" method="post">
        @csrf
        <div class="col-md-4 col-lg-4 col-sm-12">
            
            <div class="login-form">

                <div class="text-center">
                    <img src="{{ asset('img/logo.png') }}" alt="logo" class="logo" />
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="ENTER EMAIL" autocomplete="off" />
                    <p class="text-danger">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </p>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="ENTER PASSWORD" />
                    <p class="text-danger">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </p>
                </div>

                <div class="form-group">
                    <button type="submit">Login</button>
                </diiv>
            </div>
            
        </div>
    </form>
</div>
@stop