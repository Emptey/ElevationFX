@extends('v1.master.user')

@section('title', 'investment')

@section('content')

    <style>
        @media (max-width: 480px) {
            .col-md-8> .investment-fix, .col-lg-8 > .investment-fix {
                margin-left: 0 !important;
            }

            .active-investment {
                text-align: center;
            }
        }

        /* @media (max-width: 768px) {
            .col-md-8> .investment-fix, .col-lg-8 > .investment-fix {
                display: block !important;
            }

            .active-icon {
                display: none;
            }

            .active-investment-text {
                margin-left: 0;
            }
        } */

        @media (max-width: 1024px) { 
            .col-md-8> .investment-fix, .col-lg-8 > .investment-fix {
                margin-left: 25%;
            }

            .active-icon {
                display: none;
            }

            .active-investment-text {
                margin-left: 0;
            }
        }
    </style>
    
    @if($user_investment->count() > 0)
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="main-card">
                <div class="container-fluid">
                    <div class="row ipad-flex">

                        <div class="col-md-4 col-lg-4 col-sm-12 circle-center" style="padding-top: 2%">
                            <div class="investment-loader-div">
                                <div class="circle">
                                    @foreach($user_investment->pluck('user_investment_payment') as $user_investment_payment)
                                        <?php $investment_payment_count = $user_investment_payment; ?>
                                    @endforeach
                                    <h3 class="loader-progress">{{ app('App\Http\Controllers\Helper')->userInvestmentCounter ($payment_count, $user_investment->pluck('investment')->pluck('duration')->first()) }}</h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8 col-lg-8 col-sm-12 investment-content-div ipad-extended">
                            
                            <div class="investment-fix new-settings">
                                <div>
                                    <h3 class="active-investment"> <span class="active-icon" style="margin-top: 1.5%;"></span>  <span class="active-investment-text">active investment</span></h3>
                                </div>

                                <div>
                                    <p class="investment-text">  <span style="font-weight:bold">Name:</span> {{ ucfirst($user_investment->pluck('investment')->pluck('name')->first()) }} </p>
                                </div>

                                <div>
                                    <p class="investment-text"> <span style="font-weight:bold">Duration:</span> {{ $user_investment->pluck('investment')->pluck('duration')->first() }} Months</p>
                                </div>

                                <div>
                                    <p class="investment-text"> <span style="font-weight:bold">Profit:</span> {{ $user_investment->pluck('investment')->pluck('percentage')->first() }}% </p>
                                </div>


                                <div>
                                    <p class="investment-text"> <span style="font-weight:bold">Payment Date</span> {{ substr($user_investment->pluck('start_date')->first(), 0, 10) }} </p>
                                </div>

                                <div>
                                    <p class="investment-text"> <span style="font-weight:bold">Expiry date:</span> {{ substr($user_investment->pluck('end_date')->first(), 0, 10) }} </p>
                                </div>
                            </div>
                            
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 text-center">
                <p class="text-danger resource-content-warning"> <i class="fa fa-times-circle"></i> You have no active investments </p>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <p class="other-investment"> {{ $user_investment->count() > 0 ? 'Other investment packages' : 'select an investment package' }} </p>
        </div>
    </div>

    <!-- other investments -->
    @if($other_investment->count() > 0)
        @foreach($other_investment as $other_investments)
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="main-card">
                    <div class="container-fluid">
                        <div class="row ipad-flex">
                            
                            <div class="col-md-4 col-lg-4 col-sm-12 circle-center">
                                <img src="{{ Storage::url('public/avatars/'.$other_investments->thumbnail) }}"  alt="investment-image" class="image">
                            </div>

                            <div class="col-md-8 col-lg-8 col-sm-12 investment-content-div ipad-extended">
                                
                                <div class="investment-fix new-settings">

                                    <div>
                                        <p class="active-investment"> {{ ucfirst($other_investments->name) }} </p>
                                    </div>

                                    <div>
                                        <p class="investment-text">
                                            <span style="font-weight: bold">Duration:</span> <span>{{ $other_investments->duration }} Months</span>
                                        </p>
                                    </div>

                                    <div>
                                        <p class="investment-text">
                                            <span style="font-weight: bold">Profit:</span> <span>{{ $other_investments->percentage }}% Monthly</span>
                                        </p>
                                    </div>

                                    <div>
                                        <p class="investment-text">
                                            <span style="font-weight: bold">Price:</span> <span> NGN{{ number_format($other_investments->price, 2) }} </span>
                                        </p>
                                    </div>

                                    <div class="container-fluid">
                                        <div class="row">

                                            <div class="col-md-6 col-lg-6 col-sm-12 no-padding">
                                            @if(!is_null($other_investments->slot) || !is_null($other_investments->available_slot))
                                                <div>
                                                    <p class="investment-text">
                                                        <span style="font-weight: bold">Avail Slot:</span> <span> {{ $other_investments->available_slot }} </span>
                                                    </p>
                                                </div>
                                            @endif      
                                            </div>

                                            <div class="col-md-6 col-lg-6 col-sm-12">
                                                <a href="{{ route('user-investment-pay', \Crypt::encrypt($other_investments->id)) }}" id="invest" class="link investIt">Invest <i class="fa fa-bar-chart"></i> </a>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    @endif 

    <!-- end other investments -->
@stop