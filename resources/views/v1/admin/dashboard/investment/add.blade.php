@extends('v1.master.admin')

@section('title', 'investment management')

@section('content')

    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="user-card">
                <h3 class="bottom-border">Add Investment</h3>
            
                <!-- add admin -->
                <form action="{{ route('post-add-investment') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-row">

                        <div class="col">
                            <div class="form-group x2-margin-top">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" placeholder="ENTER INVESTMENT NAME" autocomplete="off" value="{{ Request::old('name') }}" style="width:80%" />
                                <p class="text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group x2-margin-top">
                                <label for="thumbnail">Thumbnail</label>
                                <input type="file" name="thumbnail" id="thumbnail" placeholder="SELECT THUMBNAIL" style="width:80%" />
                                <p class="text-danger">
                                    @error('thumbnail')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>
                        </div>

                    </div>

                    <div class="form-row">

                        <div class="col">

                            <div class="form-group x2-margin-top">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" cols="100" rows="15" style="width: 80%; height: 20%"></textarea>
                                <!-- <input type="text" name="description" id="description" placeholder="ENTER DESCRIPTION" autocomplete="off" value="{{ Request::old('description') }}" style="width:80%" /> -->
                                <p class="text-danger">
                                    @error('description')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group x2-margin-top">
                                <label for="slot">Slot</label>
                                <input type="number" name="slot" id="slot" placeholder="ENTER SLOT OR LEAVE IT EMPTY" autocomplete="off" value="{{ Request::old('slot') }}" style="width:80%" />
                                <p class="text-danger">
                                    @error('slot')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>

                            <div class="form-group x2-margin-top">
                                <label for="percentage">Percentage</label>
                                <input type="number" name="percentage" id="percentage" placeholder="ENTER RETURN PERCENTAGE" autocomplete="off" value="{{ Request::old('percentage') }}" style="width:80%" />
                                <p class="text-danger">
                                    @error('percentage')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>

                            <div class="form-group x2-margin-top">
                                <label for="duration">Duration</label>
                                <input type="number" name="duration" id="percentage" placeholder="ENTER RETURN PERCENTAGE" autocomplete="off" value="{{ Request::old('duration') }}" style="width:80%" />
                                <p class="text-danger">
                                    @error('percentage')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>

                            <div class="form-group x2-margin-top">
                                <label for="price">Price</label>
                                <input type="number" name="price" id="price" placeholder="ENTER INVESTMENT COST" autocomplete="off" value="{{ Request::old('price') }}" style="width:80%" />
                                <p class="text-danger">
                                    @error('price')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>

                        </div>

                    </div>           

                    <div class="form-group x2-margin-top no-padding">
                        <button type="submit" style="margin: 0"> Add Investment</button>
                    </div>
                </form>
                <!-- end admin -->

            </div>
        </div>
    </div>

@stop