@extends('v1.master.user_auth')

@section('title', 'about us')

@section('content')

    <div class="container">
        <x-user-gen-nav />

        <div class="about-wrapper">

            <div class="about-hero">
                <div class="about-page-content">
                    <h1>About us</h1>
                    <span><img src="asset/image/about-page-div.svg" alt=""></span>
                    <p>
                        Elevation FX is a Forex Trading and Capital Investment Limited Company, which has its focus on innate Forex─ training, as well as capital investment. This company was established with the sole aim of equipping as many people as possible, with a general
                        knowledge of trade on the financial market. We also focus on creating diverse portfolios in investing, which will bring about a steady cash flow. Gaining financial freedom is indeed a possibility, and Elevation FX that dream of
                        yours become a reality. With Elevation FX, this financial freedom is not short-lived, but rather a life-long one. If you are interested in creating multiple streams of income for yourself, Elevation FX is definitely one to add
                        to your streams-of-steady-cash-flow-for-financial-freedom list.
                    </p>
                </div>

                <div class="about-image">
                    <img src="asset/image/about-graphics.svg" alt="">
                </div>
            </div>
            <div class="about-team">
                <div class="about-team-content">
                    <h1>meet the team</h1>
                    <span><img src="asset/image/about-team.svg" alt=""></span>
                    <p>
                        The team comprises of young, talented, dedicated, as well as innovative mater minds; who were burdened with the aim of being of value to young, average, and also older persons in the society. We are living our dreams by giving you
                        a chance to live yours in investing in Forex, transportation, agriculture, and other sectors of economic enhancement.
                    </p>
                    <p>
                        We provide a well-defined funding structure which accommodates both high and low income earners. If you
                        have a nagging, or even a little interest to invest in any of these sectors for a profitable ROI then you 
                        should think of investing with us. Since we have introduced you to what we are about as a company and what we offer, we deemed
                        it equally exciting for you to meet the brains behind this brilliant innovation.
                    </p>
                </div>
                <div class="about-team-profile">
                    <!-- team members -->
                    <div class="team-profile">
                        <img src="asset/image/team/ceo.PNG" alt="">
                        <div class="team-info">
                            <h2>Everest samuel imoni</h2>
                            <h1>CEO</h1>
                        </div>
                    </div>
                    <div class="team-profile">
                        <img src="asset/image/team/1.PNG" alt="">
                        <div class="team-info">
                            <h2>name</h2>
                            <h1>position</h1>
                        </div>
                    </div>

                    <div class="team-profile">
                        <img src="asset/image/team/2.PNG" alt="">
                        <div class="team-info">
                            <h2>name</h2>
                            <h1>position</h1>
                        </div>
                    </div>

                    <div class="team-profile">
                        <img src="asset/image/team/3.PNG" alt="">
                        <div class="team-info">
                            <h2>name</h2>
                            <h1>position</h1>
                        </div>
                    </div>

                    <div class="team-profile">
                        <img src="asset/image/team/4.PNG" alt="">
                        <div class="team-info">
                            <h2>name</h2>
                            <h1>position</h1>
                        </div>
                    </div>

                    <div class="team-profile">
                        <img src="asset/image/team/5.PNG" alt="">
                        <div class="team-info">
                            <h2>name</h2>
                            <h1>position</h1>
                        </div>
                    </div>


                </div>
                <!-- more company -->
                <div class="extra-company-stuff">

                    <h1>
                        more company stuff
                    </h1>
                    <img src="asset/image/about-extra-div.svg" alt=" ">
                    <p>
                        Our services at Elevation FX and Xpress covers a range of things. All of these, in a bid to leave you atop your investing game, especially in Forex and Transportation. While we give you the opportunity as our prospect, to co-fund in order to purchase
                        a vehicle for commercial purposes, we have two major services. <br>
                        <ul>
                            <li>We offer you small amounts of money to invest in the transport sector. We therefore, serve as the middlemen between you and the drivers and give out vehicles on hire purchase to eligible drivers who want to work full time,
                                be it inter or intra-state.</li>
                            <li>Based on the duration of the contract─ minimum of a year and a half, and maximum of 2 years─ there will be a legal transfer of ownership of the vehicle. All the necessary papers would also be attached and handed over to the
                                driver, as long as he can fulfill the terms and conditions of the hire purchase agreement.
                            </li>
                        </ul>
                        Hire Purchase Plan There are different price ranges if you want to hire a vehicle; all of these having their determining factors and conditions. It is however, worthy of note that these prices are not fixed, but are rather the least amount any driver
                        would be charged for inter-state travels.
                    </p>

                </div>
            </div>

            <!--  footer-->
            <div class=" footer-widget ">
                <div class=" footer-content ">
                    <div class=" company-info ">
                        <img class="footer-img " src="asset/icons/LOGO 2.svg " alt=" ">
                        <p class="company-info-text ">
                            Elevation FX is a Forex Trading and Capital Investment Limited Company, which has its focus on innate Forex─ training, as well as capital investment. This company was established with the sole aim of equipping as many people as possible,
                            with a general knowledge of trade on the financial market. We also focus on creating diverse portfolios in investing, which will bring about a steady cash flow.
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
                                <a href="# "><img src="asset/icons/entypo-social_twitter-with-circle.svg " alt=" "></a>
                            </li>
                            <li>
                                <a href=" # "><img src="asset/icons/ri_facebook-circle-fill.svg " alt=" "></a>
                            </li>
                            <li>
                                <a href="# "><img src="asset/icons/entypo-social_linkedin-with-circle.svg " alt=" "></a>

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