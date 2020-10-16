@extends('v1.master.admin')

@section('title', 'user management')

@section('content')
    <!-- search box -->
    <div class="row">
        
        <div class="col-md-12 col-lg-12 col-sm-12">
            
            <div class="user-card">
                
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="personal-tab" data-toggle="tab" href="#personal" role="tab" aria-controls="personal" aria-selected="true"> Personal</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="bank-tab" data-toggle="tab" href="#bank" role="tab" aria-controls="bank" aria-selected="false">Bank</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="course-tab" data-toggle="tab" href="#course" role="tab" aria-controls="course" aria-selected="false">Course</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="investment-tab" data-toggle="tab" href="#investment" role="tab" aria-controls="investment" aria-selected="false">Investment</a>
                    </li>

                </ul>

                <div class="tab-content" id="myTabContent">

                    <!-- personal panel -->
                    <div class="tab-pane fade show active" id="personal" role="tabpanel" aria-labelledby="personal-tab">
                        
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col no-padding">
                                    <div class="content">
                                        <h3>Name</h3>
                                        <p>{{ ucwords($user->pluck('full_name')->first()) }}</p>
                                    </div>

                                    <div class="content">
                                        <h3>Gender</h3>
                                        <p>{{ ucfirst($user->pluck('gender')->first()) }}</p>
                                    </div>

                                    <div class="content">
                                        <h3>Date of Birth</h3>
                                        <p>{{ ucfirst($user->pluck('dob')->first()) }}</p>
                                    </div>

                                    <div class="content">
                                        <h3>Phone</h3>
                                        <p>{{ $user->pluck('phone')->first() }}</p>
                                    </div>

                                </div>

                                <div class="col">

                                    <div class="content">
                                        <h3>Email</h3>
                                        <p>{{ $user->pluck('email')->first() }}</p>
                                    </div>

                                    <div class="content">
                                        <h3>Country</h3>
                                        <p>{{ ucfirst($user->pluck('country')->first()) }}</p>
                                    </div>

                                    <div class="content">
                                        <h3>Address</h3>
                                        <p>{{ ucfirst($user->pluck('address')->first()) }}</p>
                                    </div>

                                    <div class="content">
                                        <h3>Joined</h3>
                                        <p>{{ e($user->pluck('created_at')->first()) }}</p>
                                    </div>

                                </div>

                                <div class="col text-right">
                                    <a href="{{ route('user-status', \Crypt::encrypt($user->pluck('id')->first())) }}" class="{{ $user->pluck('isActive')->first() === 1 ? 'link-deactivate' : 'link-activate' }}"> {{ $user->pluck('isActive')->first() === 1 ? 'De-activate' : 'Activate' }} </a>
                                </div>

                            </div>

                        </div>

                    </div>
                    <!-- end pane -->

                    <!-- bank pane -->
                    <div class="tab-pane fade" id="bank" role="tabpanel" aria-labelledby="bank-tab">

                        <div class="container-fluid">
                            <div class="row">

                                <div class="col no-padding">

                                    <div class="content">
                                        <h3>Bank Name</h3>
                                        <p>{{ e(ucwords($user->user_bank->pluck('bank_name')->first())) }}</p>
                                    </div>

                                    <div class="content">
                                        <h3>Account Name</h3>
                                        <p>{{ e(ucwords($user->user_bank->pluck('account_name')->first())) }}</p>
                                    </div>

                                    <div class="content">
                                        <h3>Account Number</h3>
                                        <p>{{ e(ucwords($user->user_bank->pluck('account_number')->first())) }}</p>
                                    </div>
                                    
                                </div>

                                <div class="col"></div>

                                <div class="col text-right">
                                    <a href="{{ route('user-status', \Crypt::encrypt($user->pluck('id')->first())) }}" class="{{ $user->pluck('isActive')->first() === 1 ? 'link-deactivate' : 'link-activate' }}"> {{ $user->pluck('isActive')->first() === 1 ? 'De-activate' : 'Activate' }} </a>
                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- end pane -->

                    <!-- course pane -->
                    <div class="tab-pane fade" id="course" role="tabpanel" aria-labelledby="course-tab">
    
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 col-lg-12 col-sm-12 no-padding">
                                    <h4 class="course_title"> <i class="fa fa-circle success"></i> Active Course</h4>
                                </div>
                            </div>

                            @if($user_course->count() > 0)

                                <div class="row">

                                    <div class="col no-padding">

                                        <div class="content">
                                            <h3>Course</h3>
                                            <p>{{ e(ucwords($user_course->pluck('course')->pluck('title')->first())) }}</p>
                                        </div>

                                        <div class="content">
                                            <h3>Cost</h3>
                                            <p>N {{ number_format($user_course->pluck('course')->pluck('cost')->first(), 2) }}</p>
                                        </div>

                                        <div class="content">
                                            <h3>Duration</h3>
                                            <p>{{ e(ucwords($user_course->pluck('course')->pluck('duration')->first())) }} Month(s) </p>
                                        </div>

                                    </div>

                                    <div class="col">

                                        <div class="content">
                                            <h3>Registration Date</h3>
                                            <p>{{ e(ucwords($user_course->pluck('start_date')->first())) }}</p>
                                        </div>

                                        <div class="content">
                                            <h3>Expiration Date</h3>
                                            <p>{{ e(ucwords($user_course->pluck('end_date')->first())) }}</p>
                                        </div>

                                    </div>

                                    <div class="col text-right">
                                        <a href="{{ route('user-status', \Crypt::encrypt($user->pluck('id')->first())) }}" class="{{ $user->pluck('isActive')->first() === 1 ? 'link-deactivate' : 'link-activate' }}"> {{ $user->pluck('isActive')->first() === 1 ? 'De-activate' : 'Activate' }} </a>
                                    </div>
                                    
                                </div>

                            @else

                                <div class="row">
                                    <p class="lead text-danger">There are active course(s) for this user.</p>
                                </div>
                            @endif

                            </div>

                            <div class="container-fluid x2-margin-top">

                                <div class="row">

                                    @if($user_courses->count() > 0)
                                    <div class="col-md-12 col-lg-12 col-sm-12 no-padding">

                                        <div class="table-responsive">
                                            <table class="table table-borderless">
                                                <thead>
                                                    <tr>
                                                        <th>title</th>
                                                        <th class="text-center">cost</th>
                                                        <th class="text-center">duration</th>
                                                        <th class="text-center">registration date</th>
                                                        <th class="text-center">expiration date</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                        @foreach($user_courses as $all_user_courses)
                                       
                                                    <tr>
                                                        <td>{{ ucfirst($all_user_courses->course->title) }}</td>
                                                        <td class="text-center"> N{{ number_format($all_user_courses->course->cost,2) }} </td>
                                                        <td class="text-center">  {{ $all_user_courses->course->duration }} Month(s) </td>
                                                        <td class="text-center"> {{ $all_user_courses->start_date }} </td>
                                                        <td class="text-center"> {{ $all_user_courses->end_date }} </td>
                                                    </tr>
                                        @endforeach
                                                </tbody>

                                                        </table>
                                                    </div>

                                                    <div class="x2-margin-top pagination">
                                                        
                                                    </div>

                                                </div>
                                    @else
                                        <div class="col-md-12 col-lg-12 col-sm-12">
                                            <p class="lead text-danger">
                                                User is yet to purchase a course.
                                            </p>
                                        </div>
                                    @endif

                                </div>

                            </div>

                    </div>
                    <!-- end pane -->

                    <!-- investment pane -->
                    <div class="tab-pane fade" id="investment" role="tabpanel" aria-labelledby="investment-tab">Investment</div>
                    <!-- end pane -->
                    
                </div>

            </div>

        </div>

        
    </div>

@stop