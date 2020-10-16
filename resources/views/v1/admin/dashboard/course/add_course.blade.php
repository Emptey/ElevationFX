@extends('v1.master.admin')

@section('title', 'course management')

@section('content')

    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="user-card">
                <h3 class="bottom-border">Add Course</h3>

                <form action="{{ route('post-add-course') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row x2-margin-top">

                        <div class="col">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" placeholder="ENTER COURSE TITLE" style="width:80%" autocomplete="off" value="{{ Request::old('title') }}"/>
                                <p class="text-danger">
                                    @error('title')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>

                            <div class="form-group x5-margin-top">
                                <label for="cost">Cost</label>
                                <input type="number" name="cost" id="cost" placeholder="ENTER COST" style="width:80%" value="{{ Request::old('cost') }}"/>
                                <p class="text-danger">
                                @error('cost')
                                    {{ $message }}
                                @enderror
                                </p>
                            </div>

                            <div class="form-group x5-margin-top">
                                <label for="cost">Duration</label>
                                <input type="number" name="duration" id="duration" placeholder="ENTER DURATION" style="width:80%" value="{{ Request::old('duration') }}"/>
                                <p class="text-danger">
                                @error('duration')
                                    {{ $message }}
                                @enderror
                                </p>
                            </div>

                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="title">Thumbnail</label>
                                <input type="file" name="thumbnail" id="thumbnail" placeholder="SELECT THUMBNAIL" style="width:80%; padding: 2%" />
                                <p class="text-danger">
                                @error('thumbnail')
                                    {{ $message }}
                                @enderror
                                </p>
                                
                            </div>

                            <div class="form-group">
                                <textarea name="description" id="description" cols="30" rows="40" placeholder="ENTER DESCRIPTION" style="width:80%; height: 250px">{{ Request::old('description') }}</textarea>
                                <p class="text-danger">
                                @error('description')
                                    {{ $message }}
                                @enderror
                                </p>
                               
                            </div>
                        </div>

                    </div>

                    <div>
                        <button type="submit" style="margin:0">Upload Course</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

@stop