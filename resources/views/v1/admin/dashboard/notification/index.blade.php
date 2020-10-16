@extends('v1.master.admin')

@section('title', 'notification management')

@section('content')

    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="user-card">
                
                <!-- searchbox -->
                <form action="{{ route('notification-search') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <input type="text" name="search" id="search" autocomplete="off" placeholder="ENTER NOTIFICATION TITLE" />
                        <button type="submit">Search</button>
                        <p class="text-danger">
                            @error('search')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>

                </form>
                <!-- end searchbox -->

                <!-- course list -->
                <div class="container-fluid x3-margin-top">

                    <div class="row">

                        <div class="col-md-12 col-lg-12 col-sm-12 no-padding">

                            <div class="table-responsive">

                                <table class="table table-borderless">

                                    <thead>
                                        <tr>
                                            <th class="text-left">id</th>
                                            <th class="text-left">title</th>
                                            <th>message</th>
                                            <th class="text-center">action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                       @if($notification->count() > 0)
                                       <?php $count = 1; ?>
                                           @foreach($notification->unique() as $notifications)
                                           <tr>
                                                <td class="text-left">{{ $count }}</td>
                                                <td class="text-left">{{ $notifications->title }}</td>
                                                <td>{{ $notifications->message }}</td>
                                                <td class="text-center">
                                                   <i class="fa fa-{{ $notifications->isActive === 1 ? 'check-circle success' : 'times-circle error' }}"></i>
                                                </td>
                                            </tr>
                                            <?php $count++; ?>
                                           @endforeach
                                       @else
                                            <tr>
                                                <td class="text-danger" colspan="3">There are no uploaded notifications.</td>
                                            </tr>
                                       @endif
                                    </tbody>

                                </table>

                            </div>

                            <div class="x2-margin-top">
                                <a href="{{ route('create-notification') }}" class="link"> <i class="fa fa-plus-circle"></i> Send Notification</a>
                            </div>

                        </div>

                    </div>

                </div>
                <!-- end course list -->
            </div>

        </div>

    </div>

@stop