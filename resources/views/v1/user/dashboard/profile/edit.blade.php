@extends('v1.master.user')

@section('title', 'profile')


@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="main-card">
                <form action="" method="post">
                    @csrf

                    <div class="content-holder">
                        <div class="form-group">
                                
                                <label class="title" for="name">Name </label>
                                <input type="text" name="name" value="{{ ucwords(\Auth::user()->full_name) }}" placeholder="ENTER FULL NAME" required="yes" autocomplete="off" />
                                
                                <p class="text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </p>
                        </div>
                    </div>

                    <div class="content-holder">

                        <div class="form-group">
                            
                            <label class="title" for="email">Email </label>
                            <input type="email" name="email" value="{{ ucwords(\Auth::user()->email) }}" placeholder="ENTER EMAIL" required="yes" autocomplete="off" />

                            <p class="text-danger">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </p>
                            
                        </div>
                    </div>

                    <div class="content-holder">
                        <div class="form-group">
                            <label for="phone" class="title">Phone</label>
                            <input type="number" name="phone" id="phone" placeholder="ENTER PHONE NUMBER" autocomplete="off" required="yes" value="{{ \Auth::user()->phone }}" />
                            
                            <p class="text-danger">
                                @error('phone')
                                    {{ $message }}
                                @enderror
                            </p>
                        </div>

                    </div>

                    <div class="content-holder">
                        <div class="form-group">
                            <label for="address" class="title">Address</label>
                            <input type="text" name="address" id="address" placeholder="ENTER ADDRESS" autocomplete="off" required="yes" value="{{ ucfirst(\Auth::user()->address) }}" />
                            
                            <p class="text-danger">
                                    @error('address')
                                        {{ $message }}
                                    @enderror
                            </p>
                        </div>
                    </div>

                    <div class="content-holder">
                        <div class="form-group">
                            <label for="dob" class="title">Date of birth</label>
                            <input type="date" name="dob" id="dob" placeholder="ENTER DATE OF BIRTH" required="yes" value="{{ \Auth::user()->dob }}" />

                            <p class="text-danger">
                                @error('dob')
                                    {{ $message }}
                                @enderror
                            </p>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 col-lg-4 col-sm-12 offset-md-8 offset-lg-8 offset-sm-0">
                                <button type="submit">
                                    Save Profile
                                    <i class="fa fa-save"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>

        <!-- <div class="col-md-6 col-lg-6 col-sm-12">
            <div class="dashboard-card">
                <label class="figure">3</label>
                <p class="title">Classes</p>
            </div>
        </div>     -->
</div>

@stop