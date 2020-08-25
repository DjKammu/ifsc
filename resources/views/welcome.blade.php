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
        
        <link rel="apple-touch-icon" sizes="180x180" href="{{ url(env('ASSET_URL','').'favicon/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ url(env('ASSET_URL','').'favicon/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ url(env('ASSET_URL','').'favicon/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ url(env('ASSET_URL','').'favicon/site.webmanifest') }}">

        <script type="text/javascript">
            var BaseUrl = "{{ url('/') }}"
        </script>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-132785386-2"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-132785386-2');
        </script> -->


    </head>
    <body>
    <div class="super_container">
        
        <div id="app"></div>
        <!-- footer -->

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col ">
                    <div class="copyright text-center">
                        <p>© <script>document.write(new Date().getFullYear());</script> Get Bank IFSC. All rights reserved | <a href="{{ url('/') }}">getbankifsc.co.in</a></p>  
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
     <script src="{{ url(env('ASSET_URL','').'js/app.js') }}" type="text/javascript"></script>
     <script src="{{ url(env('ASSET_URL','').'js/jquery-3.2.1.min.js') }}" type="text/javascript">
     </script>
     <script src="{{ url(env('ASSET_URL','').'js/bootstrap.min.js') }}" type="text/javascript"></script>
    </body>
</html>