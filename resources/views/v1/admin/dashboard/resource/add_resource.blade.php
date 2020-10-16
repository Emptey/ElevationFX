@extends('v1.master.admin')

@section('title', 'resource management')

@section('content')

    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="user-card">
                
                <h3 class="bottom-border">Add Resource</h3>

                <form action="{{ route('post-add-resource') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group x2-margin-top">
                        <label for="course">Course</label>
                        <select name="course" id="course">
                            <option value="">-SELECT COURSE-</option>
                            @if($course->count() > 0)
                                @foreach($course as $courses)
                                <option value="{{ $courses->id }}"> {{ ucfirst($courses->title) }} </option>
                                @endforeach
                            @endif
                        </select>
                        <p class="text-danger">
                            @error('course')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>

                    <div class="form-group x2-margin-top">
                        <label for="ttile">Title</label>
                        <input type="text" name="title" id="title" placeholder="ENTER RESOURCE TITLE" autocomplete="off" value="{{ Request::old('title') }}"/>
                        <p class="text-danger">
                            @error('title')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>

                    <div class="form-group x2-margin-top">
                        <label for="document">Document</label>
                        <input type="file" name="document" id="document" />
                        <p class="text-danger">
                            @error('document')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>
                    
                    <div class="form-group no-padding x2-margin-top">
                        <button type="submit" style="margin:0">Upload Resource</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@stop