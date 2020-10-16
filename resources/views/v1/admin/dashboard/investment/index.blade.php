@extends('v1.master.admin')

@section('title', 'investment management')

@section('content')

    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="user-card">
                <!-- searchbox -->
                <form action="{{ route('add-investment') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <input type="text" name="search" id="search" autocomplete="off" placeholder="ENTER INVESTMENT NAME" />
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
                                <th>name</th>
                                <th class="text-center">price</th>
                                <th class="text-center">percentage</th>
                                <th class="text-center">duration</th>
                                <th class="text-center">status</th>
                                <th class="text-center">action </th>
                            </tr>
                        </thead>

                        <tbody>
                            @if($investment->count() > 0)
                                @foreach($investment as $investments)
                                <tr>
                                    <td>{{ ucfirst($investments->name) }}</td>
                                    <td class="text-center"> N{{ number_format($investments->price, 2) }} </td>
                                    <td class="text-center"> {{ $investments->percentage }}% </td>
                                    <td class="text-center">{{ $investments->duration }} Month(s)</td>
                                    <td class="text-center"> <i class="fa fa-{{ $investments->isActive === 1 ? 'check-circle success' : 'times-circle error' }}"></i> </td>
                                    <td class="text-center">
                                        <div class="drop-down">
                                            <i class="fa fa-ellipsis-v drop-trigger"></i>
                                            <div class="drop-down-content">
                                                <a href="{{ route('edit-investment', \Crypt::encrypt($investments->id)) }}">Edit</a>
                                                <a href="{{ route('view-investment', \Crypt::encrypt($investments->id)) }}">View</a>
                                                <a href="{{ route('investment-status', \Crypt::encrypt($investments->id)) }}"> {{ $investments->isActive === 1 ? 'De-activate' : 'Activate' }} </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                               
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-danger" colspan="6">There are no uploaded investment(s).</td>
                                </tr>
                            @endif
                        </tbody>

                    </table>
                </div>
                <!-- end admin table -->

               <div class="x2-margin-top">
                    <a href="{{ route('add-investment') }}" class="link"><i class="fa fa-plus-circle"></i> Add Investment</a>
               </div>
            </div>
        </div>
    </div>

@stop