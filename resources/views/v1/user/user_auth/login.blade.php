@extends('v1.master.user_auth')

@section('title', 'login')
<!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

@section('content')

    <div class="container signin-con ">
        
        <div class="sign-in-wrapper">

            <div class="sign-in-container">

                <form action="{{ route('post-user-login') }}" method="post">
                    @csrf

                    <h1>welcome back</h1>
                    <div class="input">
                        <label for="email">email</label>
                        <input type="email" name="email" id="" placeholder="email" autocomplete="off" />
                        <p style="color: rgb(206, 3, 3); width:100%; text-align: left">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>

                    <div class="input">
                        <label for="password"> password</label>
                        <input type="password" name="password" id=" " placeholder="password" />
                        <p style="color: rgb(206, 3, 3); width:100%; text-align: left">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </p>
                        <a href="{{ route('recover-password') }}">forgot your password?</a>
                    </div>


                    <button class=" button sign-in-btn ">
                            <span class="btn-text sign-in-btn-text" id="sign-in-btn-text ">Sign in</span> 
                            <span class="btn-icon ">
                                <img src="asset/icons/bx_bxs-log-in-circle.svg " alt=" ">
                            </span>
                    </button>
                    <span><a href="{{ route('get-user-register') }}}">Register a new account</a></span>
                </form>

            </div>



        </div>
    </div>

@stop