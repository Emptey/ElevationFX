@extends('v1.master.admin')

@section('title', 'administrator management')

@section('content')

    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="user-card">
                <!-- searchbox -->
                <form action="{{ route('search-admin') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <input type="text" name="search" id="search" autocomplete="off" placeholder="ENTER ADMINISTRATOR EMAIL" />
                        <button type="submit">Search</button>
                        <p class="text-danger">
                            @error('search')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>

                </form>
                <!-- end searchbox -->

                <!-- admin record table -->
                <div class="table-responsive x2-margin-top">
                    <table class="table table-borderless">
                        
                        <thead>
                            <tr>
                                <th>full name</th>
                                <th class="text-center">email</th>
                                <th class="text-center">added on</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if($admin->count() > 0)
                                @foreach($admin as $admins)
                                    <tr>
                                        <td> {{ ucwords($admins->full_name) }} </td>
                                        <td class="text-center"> {{ strtolower($admins->email) }} </td>
                                        <td class="text-center"> {{ $admins->created_at }} </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-danger" colspan="3">There are no registered administrators</td>
                                </tr>
                            @endif
                        </tbody>

                    </table>
                </div>
                <!-- end admin table -->

               <div class="x2-margin-top">
                    <a href="{{ route('add-admin') }}" class="link"><i class="fa fa-plus-circle"></i> Add Admin</a>
               </div>
            </div>
        </div>
    </div>

@stop