@extends('v1.master.user_auth')

@section('title', 'register')

@section('content')

    <div class="container signup-con">
        <x-user-gen-nav />

        <div class="sign-up-wrapper">

            <div class="sign-up-container">
                <div class="sign-up-progress">
                    
                    <div class="primg">
                        <a href="{{ route('get-user-register') }}">
                            <img src="{{ asset('asset/icons/round-progress-inactive.svg') }}" alt="" />
                        </a>
                    </div>

                    <div class="primg"> 
                        <img src="{{ asset('asset/icons/round-progress-active.svg') }}" alt=""/>
                    </div>

                    <div class="primg">
                        <img src="{{ asset('asset/icons/round-progress-inactive.svg') }}" alt="" />
                    </div>


                </div>
                <form action="{{ route('post-user-register-step-two') }}" method="post">
                    @csrf

                    <div id="first-form">
                        
                        <div class="input">
                            <label for="email">email</label>
                            <input type="email" name="email" id="email" autocomplete="off" value="{{ !empty(Request::old('email')) ? Request::old('email') : session()->get('email') }}"/>
                            <p style="color: rgb(206, 3, 3); width:100%; text-align: left">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </p>
                        </div>
                        <div class="input">
                            <label for="phone"> phone</label>
                            <input type="tel" name="phone" id="phone" style="padding-left: 3%; padding-right: 3%;" autocomplete="off" value="{{ !empty(Request::old('phone')) ? Request::old('phone') : session()->get('phone') }}" />
                            <p style="color: rgb(206, 3, 3); width:100%; text-align: left">
                                @error('phone')
                                    {{ $message }}
                                @enderror
                            </p>
                        </div>

                        <div class="input">
                            <label for="password"> password</label>
                            <input type="password" name="password" id="password" autocomplete="off" />
                            <p style="color: rgb(206, 3, 3); width:100%; text-align: left">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </p>
                        </div>


                        <button class=" button sign-up-btn" style="margin:0 auto 3%">
                                <span class="btn-text sign-up-btn-text" id="sign-up-btn-text ">Proceed</span> 
                                <span class="btn-icon ">
                                    <img src="{{ asset('asset/icons/bx_bxs-log-in-circle.svg') }}" alt=" ">
                                </span>
                        </button>

                    </div>

                    <div id="second-form">
                        
                    </div>

                    <span><a href="sign-in.html">Already have an account? log in</a></span>
                </form>

            </div>



        </div>


    </div>

@stop