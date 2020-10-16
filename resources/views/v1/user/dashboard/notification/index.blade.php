@extends('v1.master.user')

@section('title', 'notification')

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            @if(\Auth::user()->notification->count() > 0)
                <?php $count = 1; ?>
            @foreach(\Auth::user()->notification as $notifications)
            <div class="main-card">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-md-1 col-lg-1 col-sm-12">
                            <div class="{{ $count % 2 == 0 ? 'notification-bar-1' : 'notification-bar-2' }}">

                            </div>
                        </div>

                        <div class="col-md-8 col-lg-8 col-sm-12">
                            <h3 class="notification-title">{{ ucfirst($notifications->title) }}</h3>
                            <p class="notification-content">{{ ucfirst($notifications->message) }}</p>
                        </div>

                        <div class="col-md-2 col-lg-2 col-sm-12 text-right">
                            <h4 class="notification-date">{{ substr($notifications->created_at, 0, 10) }}</h4>
                        </div>

                    </div>
                </div>
            </div>
            <?php $count++; ?>
            @endforeach
            @else
                <div class="text-center">
                    <p class="text-danger resource-content-warning"> You have no notification(s).</p>
                </div>
            @endif
        </div>
    </div>
@stop