@extends('v1.master.user')

@section('title', 'profile')


@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="main-card">
            <div class="text-right" style="margin-bottom: 2%">
                        <a href="{{ route('get-user-settings') }}" class="{{ Route::is('get-user-settings') ? 'active-settings' : 'settings-link' }}"><i class="fa fa-cog"></i></a>
                    </div>

                <div class="content-holder">
                    <h3 class="title">
                        Name
                    </h3>
                    <p class="content">
                        {{ ucwords(\Auth::user()->full_name) }}
                    </p>
                </div>

                <div class="content-holder">
                    <h3 class="title">
                        Email
                    </h3>
                    <p class="content">
                        {{ \Auth::user()->email }}
                    </p>
                </div>

                <div class="content-holder">
                    <h3 class="title">
                        Phone
                    </h3>
                    <p class="content">
                        {{ \Auth::user()->phone }}
                    </p>
                </div>

                <div class="content-holder">
                    <h3 class="title">
                        Address
                    </h3>
                    <p class="content">
                        {{ ucfirst(\Auth::user()->address) }}
                    </p>
                </div>

                <div class="content-holder">
                    <h3 class="title">
                        Date of birth
                    </h3>
                    <p class="content">
                        {{ \Auth::user()->dob }}
                    </p>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-lg-4 col-sm-12 offset-md-8 offset-lg-8 offset-sm-0">
                            <a href="{{ route('get-edit-user-profile') }}" class="link"> 
                                Edit Profile
                                <i class="fa fa-pencil"></i> 
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

@stop