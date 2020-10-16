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

                <form action="{{ route('reset-password') }}" method="post">
                    @csrf
                    <h1>Reset Password</h1>
                    
                    <input type="hidden" name="id" id="id" value="{{ $user->pluck('id')->first() }}">
                    <p style="color: red">@error('id') {{ $message }}  @enderror</p>
                    <div class="input">
                        <label for="email">new password</label>
                        <input type="password" name="password" id="password" required="yes" placeholder="new password" autocomplete="off" />
                        <p style="color: rgb(206, 3, 3); width:100%; text-align: left">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>

                    <div class="input">
                        <label for="email">confirm new password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required="yes" placeholder="re-enter new password" autocomplete="off" />
                        <p style="color: rgb(206, 3, 3); width:100%; text-align: left">
                            @error('password_confirmation')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>

                    <button class=" button sign-in-btn" type="submit">
                            <span class="btn-text sign-in-btn-text" id="sign-in-btn-text ">reset</span> 
                            <span class="btn-icon ">
                                <img src="{{ asset('asset/icons/bx_bxs-log-in-circle.svg') }}" alt=" ">
                            </span>
                    </button>
                </form>

            </div>



        </div>
    </div>
    </div>

@stop