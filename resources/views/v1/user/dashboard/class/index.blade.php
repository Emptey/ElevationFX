@extends('v1.master.user')

@section('title', 'class')

@section('content')
   @if (\Auth::user()->user_course->count() > 0)
        @foreach(\Auth::user()->user_course->pluck('course') as $courses)
            @foreach($courses->user_class as $classes)
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <div class="main-card">
                        <div class="container-fluid">
                            <div class="row no-padding">
                                <div class="col-md-6 col-lg-6 col-sm-12">
                                    <img src="{{ Storage::url('avatars/'.$classes->thumbnail) }}" alt="download_image" style="border-radius: 5px"/>
                                </div>

                                <div class="col-md-6 col-lg-6 col-sm-12">
                                    <div>
                                        <p class="resource-content">{{ ucfirst($classes->description) }}</p>
                                        <a href="{{ $classes->link }}" class="link" target="_blank">
                                            Join Class
                                            <i class="fa fa-graduate"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @endforeach
    
    @else
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <p class="text-danger resource-content-warning text-center">
                    <i class="fa fa-times-circle"></i> Sorry, you don't have any available classes.
                </p>
            </div>
        </div>
   @endif
@stop