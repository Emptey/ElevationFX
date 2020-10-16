@extends('v1.master.user')

@section('title', 'settings')


@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="main-card">
               
                    <div class="text-right" style="margin-bottom: 2%">
                        <a href="{{ route('get-user-settings') }}" class="{{ Route::is('get-user-settings') ? 'active-settings' : 'settings-link' }}"><i class="fa fa-cog"></i></a>
                    </div>

                    <div class="content-holder">
                        <form action="{{ route('post-user-settings') }}" method="post">
                        @csrf
                            <div class="form-row">

                                <div class="col-md-6 col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        
                                        <label class="title" for="current_password">Current password </label>
                                        <input type="password" name="password" placeholder="ENTER CURRENT PASSWORD" required="yes" autocomplete="off" style="width: 80%" />
                                        
                                        <p class="text-danger">
                                            @error('password')
                                                {{ $message }}
                                            @enderror
                                        </p>
                                    </div>

                                </div>

                                <div class="col-md-6 col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        
                                        <label class="title" for="new_password">New password </label>
                                        <input type="password" name="new_password" placeholder="ENTER NEW PASSWORD" required="yes" autocomplete="off" style="width: 80%" />
                                        
                                        <p class="text-danger">
                                            @error('new_password')
                                                {{ $message }}
                                            @enderror
                                        </p>
                                    </div>

                                </div>

                            </div>

                            <div class="form-row" style="margin-top: 1%">

                                <div class="col-md-6 col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        <button type="submit" style="width: 80% !important">
                                            Save password
                                            <i class="fa fa-save"></i>
                                        </button>
                                    </div>

                                </div>

                                <div class="col-md-6 col-lg-6 col-sm-12">
                                

                                </div>

                            </div>

                        </form>
                        
                    </div>

                    <form action="{{ route('post-change-bank') }}" method="post">
                        @csrf
                        <div class="content-holder" style="margin-top: 10%">
                            
                            <div class="form-row">
                            
                                <div class="col-md-6 col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        
                                        <label class="title" for="bank_name">Bank name </label>
                                        <input type="text" name="bank" value="{{ !is_null(\Auth::user()->user_bank) ? ucwords(\Auth::user()->user_bank->bank_name) : ''  }}" placeholder="ENTER BANK NAME" required="yes" autocomplete="off" style="width: 80%" />
                                        
                                        <p class="text-danger">
                                            @error('bank')
                                                {{ $message }}
                                            @enderror
                                        </p>
                                    </div>

                                </div>

                                <div class="col-md-6 col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        
                                        <label class="title" for="account_name">Account name </label>
                                        <input type="text" name="account_name" value="{{!is_null(\Auth::user()->user_bank) ? ucwords(\Auth::user()->user_bank->account_name) : ''  }}" placeholder="ENTER ACCOUNT NAME" required="yes" autocomplete="off" style="width: 80%" />
                                        
                                        <p class="text-danger">
                                            @error('account_name')
                                                {{ $message }}
                                            @enderror
                                        </p>
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="content-holder">
                            
                            <div class="form-row">
                                
                                <div class="col-md-6 col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        
                                        <label class="title" for="account_number">Account number </label>
                                        <input type="number" name="account_number" value="{{ !is_null(\Auth::user()->user_bank) ? ucwords(\Auth::user()->user_bank->account_number)  : '' }}" placeholder="ENTER ACCOUNT NUMBER" required="yes" autocomplete="off" style="width: 80%" />
                                        
                                        <p class="text-danger">
                                            @error('account_number')
                                                {{ $message }}
                                            @enderror
                                        </p>
                                    </div>

                                </div>

                                <div class="col-md-6 col-lg-6 col-sm-12">
                                    
                                </div>

                            </div>

                        </div>

                        <div class="content-holder">
                            <div class="form-row" style="margin-top: 1%">

                                <div class="col-md-6 col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        <button type="submit" style="width: 80% !important">
                                            Save details <i class="fa fa-save"></i>
                                        </button>
                                    </div>

                                </div>

                                <div class="col-md-6 col-lg-6 col-sm-12">
                                

                                </div>

                            </div>
                        </div>
                    </form>
            </div>

        </div>

    </div>

@stop