@extends('v1.master.user_auth')

@section('title', 'home')

@section('content')
    <div class="container">


        <div class="hero">

           <x-user-gen-nav />
            <section class="hero-container">

                <div class="hero-container-wrapper">
                    <div class="hero-container-content">
                        <h1>Welcome to Elevetion FX</h1>
                        <span class="hero-subtitle"></span>
                        <img src="{{ asset('asset/image/divider.svg') }}" alt="">
                        <p class="hero-container-content-text">
                            Get secured and direct access to a diverse portfolio of high yield investments across Nigeria bordering around Forex, transportation and Agriculture.
                        </p>

                        <button class="button hero-btn">
                        <span class="btn-text" id="hero-btn-text" style="color:#F2C94C;">Explore</span> 
                        <span class="btn-icon">
                        <img src="{{ asset('asset/icons/zondicons_explore.svg') }}" alt="">
                          </span>
                          </button>
                    </div>
                    <div class="hero-container-image">
                        <img src="{{ asset('asset/image/Graphic.svg') }}" alt="elevetion fx">
                    </div>
                </div>
            </section>
        </div>


        <!-- about -->
        <section class="about-container">


            <div class="about-content">
                <h1 class="h1-tag ">about</h1>
                <img class="page-dividers " src="{{ asset('asset/image/about-div.svg') }}" alt=" ">
                <p class="content-text ">
                    Elevation FX is a Forex Trading and Capital Investment Limited Company, which has its focus on innate Forex─ training, as well as capital investment. This company was established with the sole aim of equipping as many people as possible, with a general
                    knowledge of trade on the financial market. We also focus on creating diverse portfolios in investing, which will bring about a steady cash flow.
                </p>

                <a class=" button about-btn" href="{{ route('get-user-about') }}">
                    <span class="btn-text " id="about-btn-text" style="color: #56CCF2">Learn more</span> 
                    <span class="btn-icon ">
                        <img src="asset/icons/ion_search-circle-sharp.svg " alt=" ">
                    </span>
                </a>
            </div>

        </section>
        <!-- end of about -->


        <!-- forex courses -->
        <section class="forex-courses">

            <div class="forex-courses-wrapper">

                <div class=" fxcourse-content">
                    <h1 class="h1-tag ">
                        forex courses
                    </h1>
                    <img class="page-dividers" src="{{ asset('asset/image/courses-div.svg') }}" alt=" ">
                    <div class="content-text">
                        <p>
                            get the best forex training from a combined team of highly skilled traders dedicated to equip you with all the essential skills you need to become a forex guru, we offer courses on the latest trends and best practices you need to excell in forex trading.
                        </p>
                    </div>
                </div>

                <div class=" fxcourse-image">
                    <img class="courses-image" src="{{ asset('asset/image/courses-image.svg') }}" alt=" ">
                </div>


            </div>

            <!-- courses cards -->
            <section class="courses-cards">
                @if($course->count() > 0)
                    @foreach($course as $courses)
                    <div class="course-cards-wrapper">
                        <div class="course-card-container ">
                            
                            <div>
                                <h2 class="course-header ">
                                    {{ strtoupper($courses->title) }}
                                </h2>
                            </div>
                            
                            <div>
                                <p class="course-text ">
                                    {{ ucfirst($courses->description) }}
                                </p>
                            </div>

                            <div class="card-details ">
                                <div class=" course-duration ">
                                    <span class="tag">Duration: </span><br>
                                    <span class="duration">6 months</span>
                                </div>
                                <div class=" course-cost ">
                                    <br />
                                    NGN {{ number_format($courses->cost,2) }} 
                                </div>
                            </div>

                            <div class="enroll-div">
                            <a href="{{ route('verify-course-purchase', \Crypt::encrypt($courses->id)) }}" class="enrolment-link" >Enroll <i class="fa fa-arrow-right"></i> </a>
                        </div>

                        </div>

                    </div>
                    @endforeach
                @endif

            </section>
            <!-- end of course cards -->
        </section>
        <!-- end of courses -->


        <!-- elevation fx -->
        <section class="elevationEx">
            <div class="express-wrapper ">


                <div class=" express-content-container ">
                    <div class="express-image ">
                        <img src="{{ asset('asset/image/coming-soon.svg') }}" alt=" ">
                    </div>
                    <div class="express-text ">
                        <div class="ex-head">
                            <h1 class="express-header ">Elevation Express</h1>
                            <img class="ex-divider " src="{{ asset('asset/image/Elevation-express-div.svg') }}" alt=" ">
                        </div>
                        <p>
                            This is a platform for investing, which offers you the opportunity to invest in transportation. If you have an interest in this sector, then this is definitely the space for you to. As with any investment, there are risks and limitations. However, on
                            Elevation Xpress, this doesn’t have to deter you. Are you worried about not having sufficient funds to purchase a vehicle? Or perhaps it’s the process of getting a qualified and credible driver to handle your vehicles that
                            burdens you; whatever your concerns, that is why we exist─ to take care of all your uncertainties, that is. The services of our company seeks to serve as the bridge between you, as an investor, and your transportation investment
                            fears and concerns.

                        </p>
                    </div>
                </div>

            </div>
        </section>
        <!-- end of elevation fx -->

        <!-- investments -->
        <section class="investment" id="invest">

            <div class="investment-wrapper ">

                <div class="fx-container">
                    <h1 class="h1-tag ">
                        Forex investment
                    </h1>
                    <img class="page-dividers " src="{{ asset('asset/image/investment-div.svg') }}" alt=" ">
                    <div class="content-text ">
                        <p>
                            Too busy or confused to trade yourself? we got you covered, we offer a variety of forex investment packages for you to choose from, each package is unique to itself in terms of ROI, duration and capital.
                        </p>
                    </div>
                </div>


                <!-- investment cards -->
                <div class="investment-cards-wrapper">
                   @if($investment->count() > 0)
                        @foreach($investment as $investments)
                        <div class="card-container">
                            <div class="card-inv">
                                <div class="status ">
                                    <img src="{{ asset('asset/icons/status-icon-active.svg') }}" alt=" ">
                                    <span><h2>Active</h2></span>
                                </div>
                                
                                <div class="investment-details" style="margin-top:2%">

                                    <div class="cost">
                                        <span> N{{ $investments->price }}000000 </span>
                                        <p> {{ $investments->percentage }}% Return in {{ $investments->duration }} month(s)</p>
                                    </div>

                                    <div class="detail">
                                        <h3>{{ strtoupper($investments->name) }}</h3>
                                        <p>
                                            {{ ucfirst($investments->description) }}
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus non ut magni? Ea reiciendis, voluptatem repudiandae, molestiae alias doloribus neque totam deleniti aperiam magni quibusdam corporis tempore dolores veniam. Blanditiis.
                                        </p>
                                    </div>

                                </div>

                                <div class="btn-wrapper">
                                    <a class=" button invest-btn" id="invest-btn" href="{{ route('auth-transaction', \Crypt::encrypt($investments->id)) }}">
                                        <span class="btn-text " id="invest-btn-text" style="color: #00FF19;">invest</span> 
                                        <span class="btn-icon ">
                                            <img class="invest-btn-icon " src="{{ asset('asset/icons/invest-icon.svg') }}" alt=" ">
                                        </span>
                                    </a>

                                </div>
                                    
                                </form>

                            </div>
                        </div>
                        @endforeach
                   @endif                   

                </div>


            </div>

        </section>
        <!-- end of investment section -->

        <div class="footer-chart">
            <!-- TradingView Widget BEGIN -->
            <div class="tradingview-widget-container">
                <div class="tradingview-widget-container__widget"></div>
                <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com" rel="noopener" target="_blank"><span class="blue-text">Market overview</span></a> by ElevationFx</div>
                <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-market-overview.js" async>
                    {
                        "colorTheme": "dark",
                        "dateRange": "1d",
                        "showChart": true,
                        "locale": "en",
                        "width": "100%",
                        "height": "100%",
                        "largeChartUrl": "",
                        "isTransparent": true,
                        "plotLineColorGrowing": "rgba(0, 255, 0, 1)",
                        "plotLineColorFalling": "rgba(255, 0, 0, 1)",
                        "gridLineColor": "rgba(42, 46, 57, 1)",
                        "scaleFontColor": "rgba(244, 158, 21, 1)",
                        "belowLineFillColorGrowing": "rgba(33, 150, 243, 0.12)",
                        "belowLineFillColorFalling": "rgba(33, 150, 243, 0.12)",
                        "symbolActiveColor": "rgba(33, 150, 243, 0.12)",
                        "tabs": [{
                            "title": "Indices",
                            "symbols": [{
                                "s": "FOREXCOM:SPXUSD",
                                "d": "S&P 500"
                            }, {
                                "s": "FOREXCOM:NSXUSD",
                                "d": "Nasdaq 100"
                            }, {
                                "s": "FOREXCOM:DJI",
                                "d": "Dow 30"
                            }, {
                                "s": "INDEX:NKY",
                                "d": "Nikkei 225"
                            }, {
                                "s": "INDEX:DEU30",
                                "d": "DAX Index"
                            }, {
                                "s": "FOREXCOM:UKXGBP",
                                "d": "FTSE 100"
                            }],
                            "originalTitle": "Indices"
                        }, {
                            "title": "Commodities",
                            "symbols": [{
                                "s": "CME_MINI:ES1!",
                                "d": "E-Mini S&P"
                            }, {
                                "s": "CME:6E1!",
                                "d": "Euro"
                            }, {
                                "s": "COMEX:GC1!",
                                "d": "Gold"
                            }, {
                                "s": "NYMEX:CL1!",
                                "d": "Crude Oil"
                            }, {
                                "s": "NYMEX:NG1!",
                                "d": "Natural Gas"
                            }, {
                                "s": "CBOT:ZC1!",
                                "d": "Corn"
                            }],
                            "originalTitle": "Commodities"
                        }, {
                            "title": "Bonds",
                            "symbols": [{
                                "s": "CME:GE1!",
                                "d": "Eurodollar"
                            }, {
                                "s": "CBOT:ZB1!",
                                "d": "T-Bond"
                            }, {
                                "s": "CBOT:UB1!",
                                "d": "Ultra T-Bond"
                            }, {
                                "s": "EUREX:FGBL1!",
                                "d": "Euro Bund"
                            }, {
                                "s": "EUREX:FBTP1!",
                                "d": "Euro BTP"
                            }, {
                                "s": "EUREX:FGBM1!",
                                "d": "Euro BOBL"
                            }],
                            "originalTitle": "Bonds"
                        }, {
                            "title": "Forex",
                            "symbols": [{
                                "s": "FX:EURUSD"
                            }, {
                                "s": "FX:GBPUSD"
                            }, {
                                "s": "FX:USDJPY"
                            }, {
                                "s": "FX:USDCHF"
                            }, {
                                "s": "FX:AUDUSD"
                            }, {
                                "s": "FX:USDCAD"
                            }, {
                                "s": "FX_IDC:USDNGN"
                            }, {
                                "s": "FX_IDC:NGNEUR"
                            }],
                            "originalTitle": "Forex"
                        }, {
                            "title": "Cryptocurrency",
                            "symbols": [{
                                "s": "BITSTAMP:BTCUSD"
                            }, {
                                "s": "BINANCE:BTCNGN"
                            }, {
                                "s": "COINBASE:ETHUSD"
                            }, {
                                "s": "BITSTAMP:XRPUSD"
                            }]
                        }]
                    }
                </script>
            </div>
            <!-- TradingView Widget END -->
        </div>
        <!--  footer-->
        <div class=" footer-widget ">
            <div class=" footer-content ">
                <div class=" company-info ">
                    <img class="footer-img " src="{{ asset('asset/icons/LOGO 2.svg') }}" alt=" ">
                    <p class="company-info-text ">
                        Elevation FX is a Forex Trading and Capital Investment Limited Company, which has its focus on innate Forex─ training, as well as capital investment. This company was established with the sole aim of equipping as many people as possible,
                        with a general knowledge of trade on the financial market. We also focus on creating diverse portfolios in investing, which will bring about a steady cash flow.
                    </p>

                </div>
                <div class="footer-links ">
                    <h2 class="footer-header ">company links</h2>
                    <ul class="footer-nav ">
                        <li><a href="# ">home</a></li>
                        <li><a href="# ">invest</a></li>
                        <li><a href="# ">about</a></li>
                        <li><a href="# ">sign in</a></li>
                        <li><a href="# ">sign up</a></li>
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
