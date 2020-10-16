@extends('v1.master.admin')

@section('title', 'settings')

@section('content')

    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="user-card">
                
                <h3 class="bottom-border">Settings</h3>

                <form action="{{ route('post-admin-settings') }}" method="post">
                    @csrf


                    <div class="form-group x2-margin-top">
                        <label for="ttile">Current Password</label>
                        <input type="password" name="current_password" id="current_password" placeholder="ENTER CURRENT PASSWORD" autocomplete="off" value="{{ Request::old('title') }}"/>
                        <p class="text-danger">
                            @error('current_password')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>

                    <div class="form-group x2-margin-top">
                        <label for="new_password">New Password</label>
                        <input type="password" name="password" id="password" placeholder="ENTER NEW PASSWORD" />
                        <p class="text-danger">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>

                    <div class="form-group x2-margin-top">
                        <label for="confirm-password">Confirm New Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="RE-ENTER NEW PASSWORD" />
                        <p class="text-danger">
                            @error('password_password_confirmation')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>
                    
                    <div class="form-group no-padding x2-margin-top">
                        <button type="submit" style="margin:0">Change Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@stop