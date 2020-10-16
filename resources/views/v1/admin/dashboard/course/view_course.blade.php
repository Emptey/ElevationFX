@extends('v1.master.admin')

@section('title', 'user management')

@section('content')
    <!-- search box -->
    <div class="row">
        
        <div class="col-md-12 col-lg-12 col-sm-12">
            
            <div class="user-card">
                
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="course-tab" data-toggle="tab" href="#course" role="tab" aria-controls="course" aria-selected="true"> Course</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="student-tab" data-toggle="tab" href="#student" role="tab" aria-controls="student" aria-selected="false">Students</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="class-tab" data-toggle="tab" href="#class" role="tab" aria-controls="class" aria-selected="false">Classes</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="resource-tab" data-toggle="tab" href="#resource" role="tab" aria-controls="resource" aria-selected="false">Resources</a>
                    </li>

                </ul>

                <div class="tab-content" id="myTabContent">

                    <!-- course panel -->
                    <div class="tab-pane fade show active" id="course" role="tabpanel" aria-labelledby="course-tab">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-4 col-lg-4 col-sm-12">
                                    <div class="content">
                                        <h3>Title</h3>
                                        <p>{{ ucfirst($course->title) }}</p>
                                    </div>

                                    <div class="content">
                                        <h3>Cost</h3>
                                        <p>N{{ number_format($course->cost, 2) }}</p>
                                    </div>

                                </div>


                                <div class="col-md-4 col-lg-4 col-sm-12">
                                    <div class="content">
                                        <h3>Duration</h3>
                                        <p>{{ $course->duration }} Month(s)</p>
                                    </div>

                                    <div class="content">
                                        <h3>Description</h3>
                                        <p>{{ ucfirst($course->description) }}</p>
                                    </div>

                                </div>
                            </div>
                            
                            <div class="row x2-margin-top">
                                <div class="col">
                                    <a href="{{ route('add-course') }}" class="link"> <i class="fa fa-plus-circle"></i> Add Course</a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- end course -->

                    <!-- students panel -->
                    <div class="tab-pane fade " id="student" role="tabpanel" aria-labelledby="student-tab">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">email</th>
                                        <th class="text-center">phone</th>
                                        <th class="text-center">registration date</th>
                                        <th class="text-center">expiry date</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if($course->user_course->count() > 0)
                                        @foreach($course->user_course as $user_courses)
                                        <tr>
                                            <td class="text-center">{{ ucwords($user_courses->user->full_name) }}</td>
                                            <td class="text-center"> {{ $user_courses->user->email }} </td>
                                            <td class="text-center"> {{ $user_courses->user->phone }} </td>
                                            <td class="text-center"> {{ $user_courses->start_date }} </td>
                                            <td class="text-center"> {{ $user_courses->end_date }} </td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-danger">There are no students for this course.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end student -->

                    <!-- class panel -->
                    <div class="tab-pane fade" id="class" role="tabpanel" aria-labelledby="class-tab">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th class="text-center">link</th>
                                        <th class="text-center">class date</th>
                                        <th class="text-center">created on</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if($course->user_class->count() > 0)
                                        @foreach($course->user_class as $user_classes)
                                            <tr>
                                                <td>{{ ucfirst($user_classes->title) }}</td>
                                                <td class="text-center"> <a href="{{ $user_classes->link }}" target="_blank">Open class</a> </td>
                                                <td class="text-center"> {{ $user_classes->date }} </td>
                                                <td class="text-center"> {{ $user_classes->created_at }} </td>
                                            </tr>
                                        @endforeach
                                    @else 
                                        <tr>
                                            <td colspan="4" class="text-danger">No classes conducted for this course.</td>
                                        </tr>
                                    @endif
                                </tbody>

                            </table>
                        </div>

                        <div class="x2-margin-top">
                            <a href="{{ route('add-class') }}" class="link"> <i class="fa fa-plus-circle"></i> Add Class</a>
                        </div>
                    </div>
                    <!-- end class -->

                    <!-- resource panel -->
                    <div class="tab-pane fade" id="resource" role="tabpanel" aria-labelledby="resource-tab">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th class="text-center">Downloads</th>
                                        <th class="text-center">Uploaded on</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if($course->user_resource->count() > 0)
                                       @foreach($course->user_resource as $user_resources)
                                       <tr>
                                            <td> {{ ucfirst($user_resources->title) }} </td>
                                            <td class="text-center"> {{ $user_resources->downloads }} </td>
                                            <td class="text-center"> {{ $user_resources->created_at }} </td>
                                        </tr>
                                       @endforeach
                                    @else
                                        <tr>
                                            <td colspan="3" class="text-danger">There are no uploaded resources for this course.</td>
                                        </tr>
                                    @endif
                                </tbody>

                            </table>
                        </div>

                        <div class="x2-margin-top">
                            <a href="{{ route('add-resource') }}" class="link"> <i class="fa fa-plus-circle"></i> Add Resource</a>
                        </div>
                    </div>
                    <!-- end resource -->

                </div>
                        
            </div>

        </div>

        
    </div>

@stop