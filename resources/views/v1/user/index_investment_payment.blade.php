@extends('v1.master.user_auth')

@section('title', 'investment payment')

@section('content')
<div class="container">
    <section class="investment" id="invest">

        <div class="investment-wrapper ">
            <div class="investment-cards-wrapper" style="padding-top: 90px">
                <div class="card-container">
                    <div class="card-inv ">
                        <div style="margin:5% 5% 2%; padding-bottom: 2%; border-bottom:1px solid rgba(255, 255, 255, 0.5)">
                            <h2 style="text-decoration:underline; margin-bottom:4%">ORDER DETAILS</h2>

                            <div>
                                <h3>Order name</h3>
                                <p> {{ ucfirst($investment->name) }}</p>
                            </div>

                            <div>
                                <h3>Order cost</h3>
                                <p>N{{ number_format($investment->price, 2) }}</p>
                            </div>
                        </div>


                        <div>
                            @if(!is_null($investment->slot) || !is_null($investment->available_slot))
                            <div style="margin: 0 5% 0">
                                <p>No. of slot(s)</p>
                                <div style="margin-top:2.5%">
                                    <i class="fa fa-minus-circle" style="font-size: 18pt; margin-right:1%; color: #db0505" id="minus"></i>
                                    <span style="border:1px solid #ffffff; padding: 1% 3% 1%" id="slot-counter">1</span>
                                    <i class="fa fa-plus-circle" style="font-size: 18pt; margin-left:1%; color: #05db45" id="plus"></i>
                                </div>
                            </div>

                            <script>
                                $(document).on('click', '#plus', function (e){
                                    var slot_counter = $('#slot-counter');
                                    var incre_limit = {{ $investment->available_slot }};

                                    // check if slot-counter has reached specified limit
                                    if (Number(slot_counter.text()) == incre_limit) {
                                        // slot_number has reach
                                    } else {
                                        // increment slot_counter value
                                        var new_number = Number(slot_counter.text()) + 1;
                                        slot_counter.text(new_number);
                                        $('#amount').val({{ $investment->price }} * new_number);
                                    }
                                });

                                $(document).on('click', '#minus', function(e) {
                                    var slot_counter = $('#slot-counter');
                                    var decre_limit = 1;

                                    // check if slot_counter hs reached specified limit
                                    if (Number(slot_counter.text()) == decre_limit) {
                                        
                                    } else {
                                        var new_number = Number(slot_counter.text()) - 1;
                                        slot_counter.text(new_number);
                                        $('#amount').val({{ $investment->price }} * new_number);
                                    }
                                });
                            </script>
                            @endif

                            <form id="paymentForm">
    
                                <div class="form-group">
                                    <input type="hidden" id="email-address" required value="{{ \Auth::user()->email }}"/>
                                </div>

                                <div class="form-group">
                                    <input type="hidden" id="amount" required value="{{ $investment->price }}"/>
                                </div>

                                <div class="form-group">
                                    <input type="hidden" name="id" id="id" value="{{ Auth::user()->id }}">
                                </div>

                                <div class="form-group">
                                    <input type="hidden" name="investment_id" id="investment_id"  value="{{ $investment->id }}">
                                </div>

                                <div class="form-group">
                                    <input type="hidden" name="start_date" id="start_date" value="{{ app('App\Http\Controllers\Helper')->nextPaymentDate() }}" />
                                </div>
                                
                                <div> 
                                    <input type="hidden" name="end_date" id="end_date" value="{{ app('App\Http\Controllers\Helper')->endDate($investment->duration) }}">
                                </div>

                                <div class="btn-wrapper">
                                    <button class=" button invest-btn" id="invest-btn" type="submit" onclick="payWithPaystack()">
                                        <span class="btn-text" id="invest-btn-text">checkout</span> 
                                        <span class="btn-icon">
                                            <img class="invest-btn-icon " src="{{  asset('asset/icons/invest-icon.svg') }}" alt=" ">
                                        </span>
                                    </button>
                                </div>
                                
                            </form>
                            
                            <script src="https://js.paystack.co/v1/inline.js"></script> 
                            <script>
                                const paymentForm = document.getElementById('paymentForm');
                                paymentForm.addEventListener("submit", payWithPaystack, false);
                                function payWithPaystack(e) {
                                e.preventDefault();
                                let handler = PaystackPop.setup({
                                    key: 'pk_test_0e18302d908150c92c7d338c967ab1ef6b475b78', // Replace with your public key
                                    email: document.getElementById("email-address").value,
                                    amount: document.getElementById("amount").value * 100,
                                    ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
                                    // label: "Optional string that replaces customer email"
                                    onClose: function(){
                                    alert('Window closed.');
                                    },
                                    callback: function(response){
                                        var reference = response.reference;
                                        $.ajax({
                                            type: 'GET',
                                            url: '/authenticate/pay/confirmation/'+reference,
                                            success: function (data) {
                                               $.ajax({
                                                   type: 'POST',
                                                   url: '/logged-in/investment/pay/verify-payment',
                                                   dataType: 'json',
                                                   data: {
                                                    'id': $('#id').val(),
                                                    'investment_id': $('#investment_id').val(),
                                                    'reference': reference,
                                                    'amount': $('#amount').val(),
                                                    'slot': ($('#slot').val() != '' || $('#slot') != null ? Number($('#slot-counter').text()) : null),
                                                    'start_date': $('#start_date').val(),
                                                    'end_date': $('#end_date').val(),
                                                    'isPaid': 1,
                                                    'isActive': 1,
                                                   },
                                                    headers: {
                                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                    },
                                                    success: function (data) {
                                                        window.location = '/logged-in/authenticate/pay/confirmation/check/{{ $investment->id }}/'+Number($('#slot-counter').text());
                                                    },
                                                    error: function (data) {
                                                        alert('Transaction failed, try again');
                                                    },
                                               });
                                            }, 
                                            error: function (data) {
                                                alert('Verification failed');
                                            }
                                        });
                                    // let message = 'Payment complete! Reference: ' + response.reference;
                                    // alert(message);
                                    }
                                });
                                handler.openIframe();
                                }
                            </script>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

     <!--  footer-->
     <div class=" footer-widget ">
            <div class=" footer-content ">
                <div class=" company-info ">
                    <img class="footer-img " src="{{ asset('asset/icons/LOGO 2.svg') }}" alt=" ">
                    <p class="company-info-text ">Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum, nisi amet quod nostrum impedit, nihil ab omnis autem cum perspiciatis fugiat est consequatur ullam modi, vero cupiditate exercitationem dolores dolorum?
                    </p>

                </div>
                <div class="footer-links ">
                    <h2 class="footer-header ">heading</h2>
                    <ul class="footer-nav ">
                        <li><a href="# ">link</a></li>
                        <li><a href="# ">link</a></li>
                        <li><a href="# ">link</a></li>
                        <li><a href="# ">link</a></li>
                    </ul>
                </div>
                <div class=" footer-social ">
                    <h2 class="footer-header ">social</h2>
                    <ul class="footer-social-links ">
                        <li>
                            <a href="# "><img src="{{ asset('asset/icons/entypo-social_twitter-with-circle.svg') }}" alt=" "></a>
                        </li>
                        <li>
                            <a href=" # "><img src="{{ asset('asset/icons/ri_facebook-circle-fill.svg') }}" alt=" "></a>
                        </li>
                        <li>
                            <a href="# "><img src="{{ asset('asset/icons/entypo-social_linkedin-with-circle.svg') }}" alt=" "></a>

                        </li>

                    </ul>

                </div>
            </div>
        </div>

        <!-- footer bottom -->
        <div class=" footer-bottom ">

            <div class="legal ">
                <span>content</span>
                <span>content</span>
            </div>
            <div class="copyright ">
                <span>  content   </span>
                <span>content</span>
            </div>

        </div>
</div>

@stop