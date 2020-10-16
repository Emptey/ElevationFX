@extends('v1.master.user_auth')

@section('title', 'recover password')

@section('content')


    <div class="container signin-con">
        
        <div class="sign-in-wrapper" style="  background-image: url(asset/image/sign-in-bg.svg);
            background-repeat: no-repeat;
            background-position: bottom;
            background-size: cover;
            background-attachment: fixed;
            background-position-x: 60%;">

            <div class="sign-in-container Rc_psd">

                <form action="{{ route('post-recover-password') }}" method="post">
                    @csrf
                    <h1>Password Recovery</h1>
                    <div class="input">
                        <label for="email">enter email address</label>
                        <input type="email" name="email" id="email" required="yes" placeholder="email" autocomplete="off" />
                        <p style="color: rgb(206, 3, 3); width:100%; text-align: left">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>

                    <button class=" button sign-in-btn" type="submit">
                            <span class="btn-text sign-in-btn-text" id="sign-in-btn-text ">Recover</span> 
                            <span class="btn-icon ">
                                <img src="asset/icons/bx_bxs-log-in-circle.svg " alt=" ">
                            </span>
                    </button>
                    <span><a href="{{ route('get-user-register') }}">Register a new account</a></span>
                </form>

            </div>



        </div>
    </div>
    </div>

@stop