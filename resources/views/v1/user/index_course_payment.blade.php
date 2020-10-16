@extends('v1.master.user_auth')

@section('title', 'course payment')

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
                                <p> {{ ucfirst($course->title) }}</p>
                            </div>

                            <div>
                                <h3>Order cost</h3>
                                <p>N{{ number_format($course->cost, 2) }}</p>
                            </div>
                        </div>


                        <div>

                            <form id="paymentForm">
    
                                <div class="form-group">
                                    <input type="hidden" id="email-address" required value="{{ \Auth::user()->email }}"/>
                                </div>

                                <div class="form-group">
                                    <input type="hidden" id="amount" required value="{{ $course->cost }}"/>
                                </div>

                                <div class="form-group">
                                    <input type="hidden" name="id" id="id" value="{{ Auth::user()->id }}">
                                </div>

                                <div class="form-group">
                                    <input type="hidden" name="course_id" id="course_id"  value="{{ $course->id }}">
                                </div>

                                <div class="form-group">
                                    <input type="hidden" name="start_date" id="start_date" value="{{ date('Y-m-d') }}" />
                                </div>
                                
                                <div> 
                                    <input type="hidden" name="end_date" id="end_date" value="{{ app('App\Http\Controllers\Helper')->endDate($course->duration) }}">
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
                                        // verify payment
                                        $.ajax({
                                            type: 'GET',
                                            url: '/authenticate/pay/confirmation/'+reference,
                                            success: function (data) {
                                                var report = JSON.parse(data); // parse json response

                                                // check if payment was successful
                                                if (report.status == true) {
                                                    // transaction successful
                                                    $.ajax({
                                                        type: "POST",
                                                        url: "{{ route('upload-user-purchased-course') }}",
                                                        dataType: 'json',
                                                        data: {
                                                            'user_id': $('#id').val(),
                                                            'course_id': $('#course_id').val(),
                                                            'reference': reference,
                                                            'start_date': $('#start_date').val(),
                                                            'end_date': $('#end_date').val(),
                                                            'isPaid': 1,
                                                            'isActive': 1,
                                                        },
                                                        headers: {
                                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                        },
                                                        success: function (data) {
                                                            if (data.message == 'success') {
                                                                window.location = '/logged-in/verify/course/purchase/'+reference;
                                                            } else {
                                                                alert(data.message);
                                                            }
                                                        }, 
                                                        error: function (data) {
                                                            alert(data.message);
                                                        },
                                                    });
                                                } else {
                                                    // transaction failed
                                                    alert('Course payment failed');
                                                }
                                                
                                            },
                                            error: function (data) {
                                                alert('error');
                                            }
                                        })
                                    
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