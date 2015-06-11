<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>RDMTK</title>

    <!-- Bootstrap Core CSS -->
    {{ HTML::style('css/bootstrap.min.css') }} 
    <!-- MetisMenu CSS -->
    {{ HTML::style('css/plugins/metisMenu/metisMenu.min.css') }} 
    <!-- Custom CSS -->
    {{ HTML::style('css/sb-admin-2.css') }}
    <!-- Custom Fonts -->
    {{ HTML::style('font-awesome-4.1.0/css/font-awesome.min.css') }}
    <!-- jQuery -->
    {{ HTML::script('js/jquery.js'); }}
    <!-- Bootstrap Core JavaScript -->
    {{ HTML::script('js/bootstrap.min.js') }} 
    <!-- Metis Menu Plugin JavaScript -->
    {{ HTML::script('js/plugins/metisMenu/metisMenu.min.js') }} 
    <!-- Custom Theme JavaScript -->
    {{ HTML::script('js/sb-admin-2.js') }} 
    <style>
    body{
      background:url({{ URL::asset('img/binding_dark.png') }});
    }
    </style>
    
  </head>

  <body>
    <div class="container">
      @yield('content')
    </div>
  </body>
</html>