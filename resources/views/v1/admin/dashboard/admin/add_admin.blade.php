@extends('v1.master.admin')

@section('title', 'Administrator Manegement')

@section('content')

    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="user-card">
                <h3 class="bottom-border">Add Admin</h3>
            
                <!-- add admin -->
                <form action="{{ route('post-add-admin') }}" method="post">
                    @csrf
                    <div class="form-group x2-margin-top">
                        <label for="full_name">Full Name</label>
                        <input type="text" name="full_name" id="full_name" placeholder="ENTER FULL NAME" autocomplete="off" value="{{ Request::old('full_name') }}" />
                        <p class="text-danger">
                            @error('full_name')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>

                    <div class="form-group x2-margin-top">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" placeholder="ENTER EMAIL" autocomplete="off" value="{{ Request::old('email') }}" />
                        <p class="text-danger">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>

                    <div class="form-group x2-margin-top">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="ENTER PASSWORD" autocomplete="off" />
                        <p class="text-danger">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>

                    <div class="form-group x2-margin-top">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="RE-ENTER PASSWORD" autocomplete="off" />
                        <p class="text-danger">
                            @error('password_confirmation')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>

                    <div class="form-group x2-margin-top no-padding">
                        <button type="submit" style="margin: 0"> Add Admin</button>
                    </div>
                </form>
                <!-- end admin -->

            </div>
        </div>
    </div>

@stop