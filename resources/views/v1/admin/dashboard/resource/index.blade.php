@extends('v1.master.admin')

@section('title', 'resource management')

@section('content')

    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="user-card">
                
                <!-- searchbox -->
                <form action="{{ route('search-class') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <input type="text" name="search" id="search" autocomplete="off" placeholder="ENTER RESOURCE TITLE" />
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
                                            <th class="text-center">title</th>
                                            <th class="text-center">downloads</th>
                                            <th class="text-center">uploaded on</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if($resource->count() > 0)
                                            @foreach($resource as $resources)
                                                <tr>
                                                    <td>{{ ucfirst($resources->course->title) }}</td>
                                                    <td class="text-center">{{ ucfirst($resources->title) }}</td>
                                                    <td class="text-center"> {{ e($resources->downloads) }} </td>
                                                    <td class="text-center"> {{ e($resources->created_at) }} </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="4" class="text-danger">No resources uploaded</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                    
                                </table>
                            </div>

                            <div class="x2-margin-top">
                                <a href="{{ route('add-resource') }}" class="link"> <i class="fa fa-plus-circle"></i> Add Resource</a>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end table -->

            </div>
        </div>
    </div>

@stop