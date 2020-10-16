@extends('v1.master.admin')

@section('title', 'user management')

@section('content')
    <!-- search box -->
    <div class="row">
        
        <div class="col-md-12 col-lg-12 col-sm-12">
            
            <div class="user-card">
                
                <!-- searchbox -->
                <form action="{{ route('search-user') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <input type="text" name="search" id="search" autocomplete="off" placeholder="ENTER USER EMAIL" />
                        <button type="submit">Search</button>
                        <p class="text-danger">
                            @error('search')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>

                </form>
                <!-- end searchbox -->

                <!-- user table -->
                <div class="container-fluid x3-margin-top">

                    <div class="row">

                        <div class="col-md-12 col-lg-12 col-sm-12 no-padding">

                            <div class="table-responsive">

                                <table class="table table-borderless">

                                    <thead>

                                        <tr>
                                            <th>full name</th>
                                            <th class="text-center">email</th>
                                            <th class="text-center">Phone</th>
                                            <th class="text-center">status</th>
                                            <th class="text-center">action</th>
                                        </tr>

                                    </thead>

                                    <tbody>
                                        @if(!is_null($user))
                                            @foreach($user as $users)
                                            <tr>
                                                <td>{{ ucwords($users->full_name) }}</td>
                                                <td class="text-center">{{ $users->email }}</td>
                                                <td class="text-center">{{ $users->phone }}</td>
                                                <td class="text-center"> <i class="fa fa-{{ $users->isActive === 1 ? 'check-circle success' : 'times-circle error' }}"></i> </td>
                                                <td class="text-center">
                                                    <div class="drop-down">
                                                        <i class="fa fa-ellipsis-v drop-trigger"></i>
                                                        <div class="drop-down-content">
                                                            <a href="{{ route('user-record', \Crypt::encrypt($users->id)) }}">View</a>
                                                            <a href="{{ route('user-status', \Crypt::encrypt($users->id)) }}"> {{ $users->isActive === 1 ? 'De-activate' : 'Activate' }} </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @else

                                        @endif
                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>
                <!-- end table -->

            </div>

        </div>

        
    </div>

@stop