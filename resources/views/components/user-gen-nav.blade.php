<header>
            <nav>
                <div class="head-chart">
                    <!-- TradingView Widget BEGIN -->
                    <div class="tradingview-widget-container">
                        <div class="tradingview-widget-container__widget"></div>
                        <!-- <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com" rel="noopener" target="_blank"><span class="blue-text">Ticker Tape</span></a> by TradingView</div> -->
                        <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
                            {
                                "symbols": [{
                                    "proName": "FOREXCOM:SPXUSD",
                                    "title": "S&P 500"
                                }, {
                                    "proName": "FOREXCOM:NSXUSD",
                                    "title": "Nasdaq 100"
                                }, {
                                    "proName": "FX_IDC:EURUSD",
                                    "title": "EUR/USD"
                                }, {
                                    "proName": "BITSTAMP:BTCUSD",
                                    "title": "BTC/USD"
                                }, {
                                    "proName": "BITSTAMP:ETHUSD",
                                    "title": "ETH/USD"
                                }],
                                "colorTheme": "dark",
                                "isTransparent": true,
                                "displayMode": "regular",
                                "locale": "en"
                            }
                        </script>
                    </div>
                    <!-- TradingView Widget END -->
                </div>

                <div class=" nav-container">
                    <div class="icon">
                        <a href="{{ route('get-user-home') }}"> <img src="{{ asset('asset/icons/LOGO 2.svg') }}" alt=""></a>
                    </div>

                    <div class="primary-links-wrapper">
                        <!-- <div class="hambuger"> -->

                        <input class="menu-btn" type="checkbox" id="menu-btn" />

                        <label for="menu-btn" class="menu-icon"><div class="nav-icon-bg"><span class="nav-icon"></span></div></label>




                        <div class="links">
                            <ul>

                                <li class="nav-item first-nav {{ Route::is('get-user-home') ? 'active' : '' }}">
                                    <a class="nav-link " href="{{ route('get-user-home') }}">home </a>
                                </li>
                                <li class=" nav-item ">
                                    <a class="nav-link " href="{{ route('get-user-home') }}#invest ">invest</a>
                                </li>
                                <li class="nav-item {{ Route::is('get-user-about') ? 'active':'' }} ">
                                    <a class="nav-link " href="{{ route('get-user-about') }}">about</a>
                                </li>
                                @if(\Auth::check())
                                <li class="nav-item">
                                    <a class="nav-link " href="{{ route('get-user-logout') }}">logout</a>
                                </li>

                                <li class="nav-item sign-up-nav {{ Route::is('get-user-dashboard') ? 'active':'' }} ">
                                    <span class="sign-up-btn "><a class="nav-link " href="{{ route('get-user-dashboard') }}">dashboard</a></span>
                                </li>
                                @else
                                <li class="nav-item {{ Route::is('get-user-login') ? 'active':'' }}">
                                    <a class="nav-link " href="{{ route('get-user-login') }}">sign in</a>
                                </li>

                                <li class="nav-item sign-up-nav {{ Route::is('get-user-register') || Route::is('get-user-register-step-two') || Route::is('post-user-register-step-two') 
                                    || Route::is('get-user-register-step-three') || Route::is('post-user-register-step-three') ? 'active':'' }} ">
                                    <span class="sign-up-btn "><a class="nav-link " href="{{ route('get-user-register') }}">sign up</a></span>
                                </li>
                                @endif

                            </ul>
                            <!-- </div> -->

                        </div>

                    </div>


                </div>


            </nav>
        </header>
