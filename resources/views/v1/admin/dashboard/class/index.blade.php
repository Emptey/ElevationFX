@extends('v1.master.admin')

@section('title', 'class management')

@section('content')

    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="user-card">
                
                <!-- searchbox -->
                <form action="{{ route('search-class') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <input type="text" name="search" id="search" autocomplete="off" placeholder="ENTER CLASS TITLE" />
                        <button type="submit">Search</button>
                        <p class="text-danger">
                            @error('search')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>

                </form>
                <!-- end searchbox -->

                <!-- class table -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12 no-padding">
                            <div class="table-responsive x2-margin-top">
                                <table class="table table-borderless">
                                    
                                    <thead>
                                        <tr>
                                            <th>course</th>
                                            <th class="text-center">Title</th>
                                            <th class="text-center">link</th>
                                            <th class="text-center">class date</th>
                                            <th class="text-center">created on</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if($class->count() > 0)
                                            @foreach($class as $classes)
                                            <tr>
                                                <td>{{ ucfirst($classes->course->title) }}</td>
                                                <td class="text-center">{{ ucfirst($classes->title) }}</td>
                                                <td class="text-center"> <a href="{{ $classes->link }}"> Open class</a> </td>
                                                <td class="text-center">{{ $classes->date }}</td>
                                                <td class="text-center">{{ $classes->created_at }}</td>
                                            </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td class="text-danger" colspan="4">No class(es) have been uploaded.</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                    
                                </table>
                            </div>

                            <div class="x2-margin-top">
                                <a href="{{ route('add-class') }}" class="link"> <i class="fa fa-plus-circle"></i> Add Class</a>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end table -->

            </div>
        </div>
    </div>

@stop