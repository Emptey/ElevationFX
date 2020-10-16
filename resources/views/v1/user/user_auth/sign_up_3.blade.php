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
                        <a href="{{ route('get-user-register-step-two') }}">
                            <img src="{{ asset('asset/icons/round-progress-inactive.svg') }}" alt="" />
                        </a>
                    </div>

                    <div class="primg">
                        <img src="{{ asset('asset/icons/round-progress-active.svg') }}" alt=""/>
                    </div>


                </div>
                <form action="{{ route('post-user-register-step-three') }}" method="post">
                    @csrf

                    <div id="first-form">
                        
                        <div class="input">
                            <label for="address">address</label>
                            <input type="text" name="address" id="address" autocomplete="off" value="{{ !empty(Request::old('address')) ? Request::old('address') : session()->get('address') }}" />
                            <p style="color: rgb(206, 3, 3); width:100%; text-align: left">
                                @error('address')
                                    {{ $message }}
                                @enderror
                            </p>
                        </div>
                        <div class="input">
                            <label for="country"> country</label>
                            <select name="country" id="country">
                                <option value="nigeria">Nigeria</option>
                            </select>
                            <p style="color: rgb(206, 3, 3); width:100%; text-align: left">
                                @error('country')
                                    {{ $message }}
                                @enderror
                            </p>
                        </div>

                        <div class="input">
                            <label for="state"> state </label>
                            <input type="text" name="state" id="state" autocomplete="off" value="{{ !empty(Request::old('state')) ? Request::old('state') : session()->get('state') }}" />
                            <p style="color: rgb(206, 3, 3); width:100%; text-align: left">
                                @error('state')
                                    {{ $message }}
                                @enderror
                            </p>
                        </div>


                        <button class=" button sign-up-btn " style="margin:0 auto 3%">
                                <span class="btn-text sign-up-btn-text" id="sign-up-btn-text ">Complete</span> 
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