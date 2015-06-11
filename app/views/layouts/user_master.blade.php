<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RDMTK</title>
    <!-- Bootstrap CSS served from a CDN -->
    {{ HTML::style('bootstrap-3.3.1/css/bootstrap.css') }} 
    <!--{{ HTML::style('//netdna.bootstrapcdn.com/bootswatch/3.1.0/superhero/bootstrap.min.css') }}-->    
    {{ HTML::script('js/jquery.min.js'); }}
    {{ HTML::script('bootstrap-3.3.1/js/bootstrap.js') }}    
        <style>
            table form { margin-bottom: 0; }
            form ul { margin-left: 0; list-style: none; }
            .error { color: red; font-style: italic; }
            body { padding-top: 20px; }
        </style>
    </head>

    <body>

        <div class="container">
            @if (Session::has('message'))
                <div class="flash alert">
                    <p>{{ Session::get('message') }}</p>
                </div>
            @endif

            @yield('main')
        </div>

    </body>

</html>