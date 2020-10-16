@extends('v1.master.user')

@section('title', 'dashboard')


@section('content')
    <div class="row justify-content-md-center">
        <div class="col-md-6 col-lg-6 col-sm-12">
            <div class="dashboard-card">
                <h3 class="figure">{{ $user->user_course->count() }}</h3>
                <p class="title">Active Course</p>
            </div>
        </div>

        <div class="col-md-6 col-lg-6 col-sm-12">
            <div class="dashboard-card">
                <h3 class="figure">{{ $user->user_course->pluck('course')->pluck('user_class')->count() }}</h3>
                <p class="title">Classes</p>
            </div>
        </div>
    </div>

    <div class="row justify-content-md-center">
        <div class="col-md-6 col-lg-6 col-sm-12">
            <div class="dashboard-card">
                <h3 class="figure">{{ $user->user_course->pluck('course')->pluck('user_resource')->count() }}</h3>
                <p class="title">Resources</p>
            </div>
        </div>

        <div class="col-md-6 col-lg-6 col-sm-12">
            <div class="dashboard-card">
                <h3 class="figure">{{ $user->user_investment->where('isPaid', 1)->where('isActive', 1)->count() }}</h3>
                <p class="title">Active Investment</p>
            </div>
        </div>
    </div>

@stop