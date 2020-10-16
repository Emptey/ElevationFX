@extends('v1.master.admin')

@section('title', 'class management')

@section('content')

    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="user-card">
                
                <h3 class="bottom-border">Add Class</h3>

                <form action="{{ route('post-add-class') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row x2-margin-top">

                        <div class="col">
                            <div class="form-group">
                                <label for="course">Course</label>
                                <select name="course" id="course" style="width:80%">
                                    <option value="">-SELECT COURSE-</option>
                                    @if($course->count() > 0)
                                        @foreach($course as $courses)
                                            <option value="{{ $courses->id }}">{{ $courses->title }}</option>
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
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" autocomplete="off" placeholder="ENTER CLASS TITLE" style="width:80%" value="{{ Request::old('title') }}" />
                                <p class="text-danger">
                                    @error('title')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>

                            <div class="form-group x2-margin-top">
                                <label for="date">Date</label>
                                <input type="datetime-local" name="date" id="date" style="width:80%"/>
                                <p class="text-danger">
                                    @error('date')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>

                            <div class="form-group x2-margin-top">
                                <label for="link">Link</label>
                                <input type="url" name="link" id="link" placeholder="ENTER CLASS LINK" autocomplete="off" style="width:80%" value="{{ Request::old('link') }}" />
                                <p class="text-danger">
                                    @error('link')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="thumbnail">Thumbnail</label>
                                <input type="file" name="thumbnail" id="thumbnail" style="width:80%; padding: 2%"/>
                                <p class="text-danger">
                                    @error('thumbnail')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>

                            <div class="form-group x2-margin-top">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" cols="30" rows="40" style="width:80%; height: 290px;">{{ Request::old('description') }}</textarea>
                                <p class="text-danger">
                                    @error('description')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>
                        </div>

                    </div>

                    <div class="form-group no-padding x2-margin-top">
                        <button type="submit" style="margin:0">Upload Class</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@stop