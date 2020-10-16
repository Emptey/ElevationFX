@extends('v1.master.admin')

@section('title', 'investment management')

@section('content')
    <!-- search box -->
    <div class="row">
        
        <div class="col-md-12 col-lg-12 col-sm-12">
            
            <div class="user-card">
                
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="investment-tab" data-toggle="tab" href="#investment" role="tab" aria-controls="investment" aria-selected="true"> Investment</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="investor-tab" data-toggle="tab" href="#investor" role="tab" aria-controls="investor" aria-selected="false">Investors</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="payout-tab" data-toggle="tab" href="#payout" role="tab" aria-controls="payout" aria-selected="false">Payout</a>
                    </li>

                </ul>

                <div class="tab-content" id="myTabContent">

                    <!-- investment panel -->
                    <div class="tab-pane fade show active" id="investment" role="tabpanel" aria-labelledby="investment-tab">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-4 col-lg-4 col-sm-12">
                                    <div class="content">
                                        <h3>Name</h3>
                                        <p>{{ ucfirst($investment->name) }}</p>
                                    </div>

                                    <div class="content">
                                        <h3>Price</h3>
                                        <p>N{{ number_format($investment->price, 2) }}</p>
                                    </div>

                                    <div class="content">
                                        <h3>Slot</h3>
                                        <p> {{ (!is_null($investment->slot) ? $investment->slot : '0') }} </p>
                                    </div>

                                </div>

                                <div class="col-md-4 col-lg-4 col-sm-12">
                                    
                                    <div class="content">
                                        <h3>Percentage</h3>
                                        <p>{{ $investment->percentage }}%</p>
                                    </div>

                                    <div class="content">
                                        <h3>Duration</h3>
                                        <p>{{ $investment->duration }}</p>
                                    </div>

                                    @if (!is_null($investment->available_slot))
                                    <div class="content">
                                        <h3>Available Slot</h3>
                                        <p> {{ $investment->available_slot }} </p>
                                    </div>
                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>
                    <!-- end panel -->

                    <!-- investors panel -->
                    <div class="tab-pane fade" id="investor" role="tabpanel" aria-labelledby="investor-tab">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th class="text-center">STATUS</th>
                                </thead>

                                <tbody>
                                    @if ($investment->user_investment->count() > 0 )
                                        @foreach($investment->user_investment->where('isPaid', 1)->unique() as $users)
                                            <tr>
                                                <td>{{ ucwords($users->user->full_name) }}</td>
                                                <td>{{ strtolower($users->user->email) }}</td>
                                                <td>{{ $users->user->phone }}</td>
                                                <td class="text-center"> <i class="fa fa-{{ $users->user->isActive === 1 ? 'check-circle success' : 'times-circle error' }}"></i> </td>
                                            </tr>
                                        @endforeach
                                    @else 
                                        <tr>
                                            <td class="text-danger" colspan="4">There no investors for this Investment</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end panel-->

                    <!-- payout panel -->
                    <div class="tab-pane fade" id="payout" role="tabpanel" aria-labelledby="payout-tab">
                        <div class="table-responsive">
                            @if($investment->user_investment_payment->where('isPaid', 0)->count() > 0)
                                <form action="{{ route('pay-all') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <input type="hidden" name="id" value="{{ $investment->id }}" />
                                        <button type="submit"> <i class="fa fa-check-circle"></i> Pay all</button>
                                    </div>
                                </form>
                            @endif
                    

                                <table class="table table-borderless">
                                    <thead>
                                        <th>Bank</th>
                                        <th>Account Name</th>
                                        <th class="text-center">Account Number</th>
                                        <th>Amount</th>
                                        <th class="text-center">payout date</th>
                                        <th class="text-center">Action</th>
                                    </thead>

                                    <tbody>
                                        @if($investment->user_investment_payment->where('isPaid', 0)->count() > 0)
                                            @foreach($investment->user_investment_payment->where('isPaid', 0)->where('isActive', 1) as $investment_payout)
                                                
                                                <tr>
                                                    <td>{{ ucwords($investment_payout->user->user_bank->bank_name) }}</td>
                                                    <td>{{ ucwords($investment_payout->user->user_bank->account_name) }}</td>
                                                    <td class="text-center">{{ $investment_payout->user->user_bank->account_number }}</td>
                                                    <td>N{{ number_format($investment_payout->payout_amount, 2) }}</td>
                                                    <td class="text-center">{{ $investment_payout->created_at }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('pay-user', \Crypt::encrypt($investment_payout->id)) }}" class="link" style="padding:8%;"><i class="fa fa-check-circle"></i> Pay</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td class="text-danger" colspan="6">There are no payouts for this investment</td>
                                            </tr>
                                        @endif

                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                    <!-- end panel -->

                </div>
            
            </div>

        </div>
    
    </div>

@stop