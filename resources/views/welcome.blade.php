<!doctype html>
<html id lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('title') }}</title>
        <link href="{{ url(env('ASSET_URL','').'css/bars.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{ url(env('ASSET_URL','').'css/bootstrap.min.css') }}" type="text/css" media="all" />
        <link rel="stylesheet" href="{{ url(env('ASSET_URL','').'css/style.css') }}" type="text/css" media="all" />
        <link rel="stylesheet" href="{{ url(env('ASSET_URL','').'css/font-awesome.css') }}" />

        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="{{ url(env('ASSET_URL','').'css/app.css') }}" type="text/css" rel="stylesheet" />
        <meta name="csrf-token" value="{{ csrf_token() }}" />
        <meta name="description" content="{{ config('description') }}"/>
        <meta name="keywords" content="{{ config('keywords') }}"/>
        <script type="text/javascript">
            var BaseUrl = "{{ url('/') }}"
        </script>
        <!-- Global site tag (gtag.js) - Google Analytics -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=UA-132785386-2"></script>
            <script>
              window.dataLayer = window.dataLayer || [];
              function gtag(){dataLayer.push(arguments);}
              gtag('js', new Date());

              gtag('config', 'UA-132785386-2');
            </script>


    </head>
    <body>
        
        <div id="app"></div>
        <!-- footer -->
        <section class="footer">
            <div class="container">
                <div class="footer-grids">
                    <div class="col-md-4 footer-grid1">
                        <div class="logo1">
                            <a href="{{ url('/') }}">Get Bank <span>IFSC</span></a>
                        </div>
                        <!-- <p> Donec in neque quis orci consequat lobortis. Sed non vestibulum mauris. Donec in neque quis orci</p>
                        <p> Donec in neque quis orci consequat lobortis. Sed non vestibulum mauris. Donec in neque quis orci</p> -->
                    </div>
                    <!-- <div class="col-md-3 footer-grid2">
                        <h4>Locations</h4>
                        <p class="p1">Stoke Newington,London,</p>
                        <p>Smith street,8814DM</p>
                        <p class="p1">Paris,arrondissement</p>
                        <p>on the Right Bank,2216TF</p>
                        <p class="p1">Los Vegas,Nevada,</p>
                        <p>Eiffel Tower road,2243FR</p>
                    </div>
                    <div class="col-md-2 footer-grid3">
                        <h4>menu</h4>
                            <p><a href="#index.html" class="scroll">home</a></p>
                            <p><a href="#about" class="scroll">about</a></p>
                            <p><a href="#services" class="scroll">services</a></p>
                            <p><a href="#skills" class="scroll">skills</a></p>
                            <p><a href="#team" class="scroll">team</a></p>
                            <p><a href="#payment" class="scroll">payment</a></p>
                            <p><a href="#blog" class="scroll">blog</a></p>
                            <p><a href="#contact" class="scroll">contact</a></p>
                    </div>
                    <div class="col-md-3 footer-grid4">
                        <h4>our links</h4>
                        <p><a href="#">Funds transfer</a></p>
                        <p><a href="#">Mobile banking</a></p>
                        <p><a href="#">Deposits</a></p>
                        <p><a href="#">New joint accounts</a></p>
                        <p><a href="#">Internet online banking</a></p>
                        <p><a href="#">Balance enquiry</a></p>
                    </div> -->
                    <div class="clearfix"></div>
                </div>
            </div>
        </section>
        <!-- //footer -->

        <!-- copyright -->
        <section class="copyright">
            <div class="agileits_copyright text-center">
                    <p>© {{ date('Y') }} Get Bank IFSC. All rights reserved | <a href="{{ url('/') }}" class="w3_agile">getbankifsc.co.in</a></p>
            </div>
        </section>
        <script src="{{ url(env('ASSET_URL','').'js/app.js') }}" type="text/javascript"></script>
    </body>
</html>