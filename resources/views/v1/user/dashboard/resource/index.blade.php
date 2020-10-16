@extends('v1.master.user')

@section('title', 'resource')

@section('content')
    <div class="row x7-margin-bottom">
        <div class="col-md-12 col-lg-12 col-sm-12">
           <div class="resource-card">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3 col-lg-3 col-sm-12">
                            <h3 class="resource-heading">
                                {{ ( $user_resource->count() ) }}
                            </h3>
                        </div>
                        <div class="col-md-3 col-lg-3 col-sm-12">
                            <p class="resource-heading-content">Available Resources</p>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <form action="{{ route('search-user-resource') }}" method="post">
                                @csrf
                                <div class="resource-input-div">
                                    <button type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                    <input type="text" name="search" placeholder="ENTER COURSE TITLE" />
                                </div>
                                <p class="text-danger">
                                    @error('search')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
           </div>
        </div>
    </div>

 @if($user_resource->count() > 0)
        @foreach($user_resource as $user_resources)
        <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="main-card">
                            <div class="container-fluid">
                                <div class="row no-padding">
                                    <div class="col-md-6 col-lg-6 col-sm-12 resource-img-hanger">
                                        <img src="{{ asset('img/pdf.png') }}" alt="download_image" />
                                    </div>

                                    <div class="col-md-6 col-lg-6 col-sm-12">
                                        <div>
                                            <p class="resource-content">{{ ucfirst($user_resources->title) }}</p>
                                            <a href="{{ Storage::url('pdf/'.$user_resources->document) }}" class="link" target="_blank">
                                                Download
                                                <i class="fa fa-download"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        @endforeach
    @else 
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 text-center text-danger">
                <p class="resource-content-warning"> <i class="fa fa-times-circle"></i> There are no resources available for download</p>
            </div>
        </div>
    @endif
@stop