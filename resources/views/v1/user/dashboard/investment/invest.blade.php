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

    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="main-card">
                <div class="container-fluid">
                    <div class="row ipad-flex">

                        <div class="col-md-4 col-lg-4 col-sm-12 circle-center">
                            <img src="{{ Storage::url('public/avatars/'.$investment->pluck('thumbnail')->first()) }}" alt="investment-image" class="image">
                        </div>

                        <div class="col-md-8 col-lg-8 col-sm-12 investment-content-div ipad-extended">
                            <div class="investment-fix new-settings">
                                <div>
                                    <p class="active-investment"> {{ ucfirst($investment->pluck('name')->first()) }} </p>
                                </div>

                                <form id="paymentForm">
                                    <div class="form-group">
                                        <input type="hidden" id="email-address" required value="{{ \Auth::user()->email }}"/>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" id="amount" required value="{{ $investment->pluck('price')->first() }}" />
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="id" id="id" value="{{ \Auth::user()->id }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="investment_id" id="investment_id"  value="{{ $investment->pluck('id')->first() }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="start_date" id="start_date" value="{{ app('App\Http\Controllers\Helper')->nextPaymentDate() }}" />
                                    </div>
                                    
                                    <div> 
                                        <input type="hidden" name="end_date" id="end_date" value="{{ app('App\Http\Controllers\Helper')->endDate($investment->pluck('duration')->first()) }}">
                                    </div>

                                    <div>
                                        <p class="investment-text">
                                            <span style="font-weight: bold">Duration:</span> <span>{{ $investment->pluck('duration')->first() }} Months</span>
                                        </p>
                                    </div>

                                    <div>
                                        <p class="investment-text">
                                            <span style="font-weight: bold">Profit:</span> <span>{{ $investment->pluck('percentage')->first() }}% Monthly</span>
                                        </p>
                                    </div>

                                    <div>
                                        <p class="investment-text">
                                            <span style="font-weight: bold">Price:</span> NGN<span id="price">{{ number_format($investment->pluck('price')->first(), 2) }}</span>
                                        </p>
                                    </div>

                                    @if(!is_null($investment->pluck('slot')->first()) || !is_null($investment->pluck('available_slot')->first()))
                                    <div class="form-group investment-text">
                                        <label for="slot" style="font-weight:bold">Slot:</label>
                                        <select name="slot" id="slot" style="width: 15%">
                                            @for($i = 1; $i <= $investment->pluck('available_slot')->first(); $i++)
                                                <option value="{{ $i }}"> {{ $i }} </option>
                                            @endfor
                                        </select>
                                    </div>
                                    @endif

                                    <script>
                                        $('#slot').change( function (e){
                                            // getting slot value
                                            var slot = $(this).val();
                                            var priceLabel  = $('#amount').val({{ $investment->pluck('price')->first() }} * slot);
                                            $('#price').text($('#amount').val());
                                        });
                                    </script>
                                    
                                    <div class="form-submit">
                                        <button type="submit" onclick="payWithPaystack()"> Pay </button>
                                    </div>

                                </form>
                                <script src="https://js.paystack.co/v1/inline.js"></script> 

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop