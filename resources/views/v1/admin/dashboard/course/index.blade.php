@extends('v1.master.admin')

@section('title', 'course management')

@section('content')

    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="user-card">
                
                <!-- searchbox -->
                <form action="{{ route('search-course') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <input type="text" name="search" id="search" autocomplete="off" placeholder="ENTER COURSE TITLE" />
                        <button type="submit">Search</button>
                        <p class="text-danger">
                            @error('search')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>

                </form>
                <!-- end searchbox -->

                <!-- course list -->
                <div class="container-fluid x3-margin-top">

                    <div class="row">

                        <div class="col-md-12 col-lg-12 col-sm-12 no-padding">

                            <div class="table-responsive">

                                <table class="table table-borderless">

                                    <thead>
                                        <tr>
                                            <th>title</th>
                                            <th class="text-center">cost</th>
                                            <th class="text-center">duration</th>
                                            <th class="text-center">no. of students</th>
                                            <th class="text-center">status</th>
                                            <th class="text-center">action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if($courses->count() > 0)
                                            @foreach($courses as $all_courses)
                                            <tr>
                                                <td>{{ ucfirst($all_courses->title) }}</td>
                                                <td class="text-center"> N{{ number_format($all_courses->cost, 2) }} </td>
                                                <td class="text-center"> {{ $all_courses->duration }} </td>
                                                <td class="text-center">{{ $all_courses->user_course->count()}}</td>
                                                <td class="text-center"> <i class="fa fa-{{ $all_courses->isActive === 1 ? 'check-circle success' : 'times-circle error' }}"></i> </td>
                                                <td class="text-center">
                                                    <div class="drop-down">
                                                        <i class="fa fa-ellipsis-v drop-trigger"></i>
                                                        <div class="drop-down-content">
                                                            <a href="{{ route('edit-course', \Crypt::encrypt($all_courses->id)) }}">Edit</a>
                                                            <a href="{{ route('view-course', \Crypt::encrypt($all_courses->id)) }}">View</a>
                                                            <a href=" {{ route('course-status', \Crypt::encrypt($all_courses->id)) }} "> {{ $all_courses->isActive === 1 ? 'De-activate' : 'Activate' }} </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6" class="text-center">There are no course available.</td>
                                            </tr>
                                        @endif
                                    </tbody>

                                </table>

                            </div>

                            <div class="x2-margin-top">
                                <a href="{{ route('add-course') }}" class="link"> <i class="fa fa-plus-circle"></i> Add Course</a>
                            </div>

                        </div>

                    </div>

                </div>
                <!-- end course list -->
            </div>

        </div>

    </div>

@stop