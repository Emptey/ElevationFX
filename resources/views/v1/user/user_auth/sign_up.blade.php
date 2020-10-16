@extends('v1.master.user_auth')

@section('title', 'register')

@section('content')

    <div class="container signup-con">
        <x-user-gen-nav />

        <div class="sign-up-wrapper">

            <div class="sign-up-container">
                <div class="sign-up-progress">
                    <div class="primg"> 
                        <img src="{{ asset('asset/icons/round-progress-active.svg') }}" alt="" />
                    </div>

                    <div class="primg">
                        <img src="{{ asset('asset/icons/round-progress-inactive.svg') }}" alt="">
                    </div>

                    <div class="primg">
                        <img src="{{ asset('asset/icons/round-progress-inactive.svg') }}" alt="">
                    </div>

                </div>
                
                <form action="{{ route('post-register-one') }}" method="post">
                    @csrf

                    <div id="first-form">
                        
                        <div class="input">
                            <label for="full-name">full name</label>
                            <input type="text" name="full_name" id="full_name" autocomplete="off" value="{{ !empty(Request::old('full_name')) ? Request::old('full_name') : session()->get('full_name') }}" />
                            <p style="color: rgb(206, 3, 3); width:100%; text-align: left">
                                @error('full_name')
                                    {{ $message }}
                                @enderror
                            </p>
                        </div>
                        <div class="input">
                            <label for="dob"> date of birth</label>
                            <input type="date" name="dob" id="dob" autocomplete="off" value="{{ !empty(Request::old('dob')) ? Request::old('dob') : session()->get('dob') }}" />
                            <p style="color: rgb(206, 3, 3); width:100%; text-align: left">
                                @error('dob')
                                    {{ $message }}
                                @enderror
                            </p>
                        </div>

                        <div style="margin-bottom: 10%">
                            <label for="gender" style="display:block; margin-bottom:4%"> gender</label>
                            
                            <label for="male" class="male">
                                <i class="fa fa-check radio-fa" id="male-click"></i>Male
                                <input type="radio" name="gender" id="male-radio" value="male" style="display: inline !important"/>
                            </label>

                            <label for="female" class="male"> 
                                <i class="fa fa-check radio-fa" id="female-click"></i>Female
                                <input type="radio" name="gender" id="female-radio" value="female"  style="display: inline !important"/>
                            </label>
                            
                            <p style="color: rgb(206, 3, 3); width:100%; text-align: left">
                                @error('gender')
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

                    <script>
                        var male = $('#male-radio');
                        var female = $('#female-radio');
                        $(document).on('click', '#male-click', function(e){
                            $(this).addClass('radio-fa-checked');
                            $('#female-click').removeClass('radio-fa-checked');
                            male.prop("checked", true);
                            female.prop("checked", false);
                        });

                        $(document).on('click', '#female-click', function(e) {
                            $(this).addClass('radio-fa-checked');
                            $('#male-click').removeClass('radio-fa-checked');
                            male.prop("checked", false);
                            female.prop("checked", true);
                        });
                    </script>

                    <span><a href="sign-in.html">Already have an account? log in</a></span>
                </form>

            </div>



        </div>


    </div>

@stop