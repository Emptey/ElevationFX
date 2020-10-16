    @extends('v1.master.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="row">

        <div class="col-md-3 col-lg-3 col-sm-12">
            <div class="dashboard-card">
                <p class="no-margin"><i class="fa fa-users"></i></p>
                <div class="container-fluid x1-margin-top">
                    <div class="row">
                        <div class="col no-padding">
                            <p> users</p>
                        </div>
                        <div class="col">
                            <p class="figure progress-title-green">20000</p>
                        </div>
                        
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-lg-3 col-sm-12">
            <div class="dashboard-card">
                <p class="no-margin"> <i class="fa fa-calendar"></i></p>
                <div class="container-fluid x1-margin-top">
                    <div class="row">
                        <div class="col no-padding">
                            <p> courses</p>
                        </div>
                        <div class="col">
                            <p class="figure progress-title-yellow">20000</p>
                        </div>
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-lg-3 col-sm-12">
            <div class="dashboard-card">
                <p class="no-margin"> <i class="fa fa-comments-o"></i> </p>
                <div class="container-fluid x1-margin-top">
                    <div class="row">
                        <div class="col no-padding">
                            <p> classes</p>
                        </div>
                        <div class="col">
                            <p class="figure progress-title-blue">20000</p>
                        </div>
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-lg-3 col-sm-12">
            <div class="dashboard-card">
                <p class="no-margin"><i class="fa fa-line-chart"></i></p>
                <div class="container-fluid x1-margin-top">
                    <div class="row">
                        <div class="col no-padding">
                            <p> resources</p>
                        </div>
                        <div class="col">
                            <p class="figure progress-title-red">2000</p>
                        </div>
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 40%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>

    </div>

    <div class="row x2-margin-top">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="dashboard-card" style="padding: 2%">
                <h3 class="bottom-border">USER INVESTMENTS BY MONTH</h3>
                <div class="x2-margin-top">
                    {!! $chart1->renderHtml() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
{!! $chart1->renderChartJsLibrary() !!}
{!! $chart1->renderJs() !!}
@endsection
