<!--
* Copyright (C) 2015  WiSe Lab, Computer Science Department, Western Michigan University
* Project Members Involved: Ajay Gupta, Aakash Gupta, Baba Shiv, Praneet Soni, Shrey Gupta and Vinay B Gavirangaswamy
*
* This program is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with this program.  If not, see <http://www.gnu.org/licenses/>
-->
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
    {{ HTML::style('css/rdmcustom.css') }} 
    <!-- Bootstrap Core CSS -->
    {{ HTML::style('css/bootstrap.min.css') }} 
    <!-- MetisMenu CSS -->
    {{ HTML::style('css/plugins/metisMenu/metisMenu.min.css') }} 
    <!-- Custom CSS -->
    {{ HTML::style('css/sb-admin-2.css') }}
    <!-- Custom Fonts -->
    {{ HTML::style('font-awesome-4.1.0/css/font-awesome.min.css') }}

    {{ HTML::style('css/mousemarker.css') }}
    <!-- jQuery -->
    {{ HTML::script('js/jquery.min.js'); }}
    <!-- Bootstrap Core JavaScript -->
    {{ HTML::script('js/bootstrap.min.js') }} 
    <!-- Metis Menu Plugin JavaScript -->
    {{ HTML::script('js/plugins/metisMenu/metisMenu.min.js') }} 
    <!-- Custom Theme JavaScript -->
    {{ HTML::script('js/sb-admin-2.js') }} 
    
    <!-- Custom Theme JavaScript -->
    {{ HTML::script('js/opencpu/opencpu-0.4.js') }} 
    
    <!-- Script to track mouse movement -->
    <!--{{ HTML::script('js/track.js') }} -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<script>
var minsToLogout = 10;
var secsToLogout= 60* minsToLogout;
var secondTimer= 0;
    $(function(){

        $("body").on("click keypress mousemove",function(){
            ResetThisSession();
        });

    });
    function ResetThisSession(){
        secondTimer=0;
    }

    function StartTheSession(){
        secondTimer++;
        
        if(secondTimer>secsToLogout){
            clearTimeout(timer);
            window.location = "{{URL::to('logout')}}";
            return;
        }

        timer=setTimeout("StartTheSession()",1000)
    }

    StartTheSession();
</script>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                {{ HTML::linkAction('dashboard', 'RDMTk', array(), array('class' => 'navbar-brand')) }}
                
                <!--<a class="navbar-brand" href="index.html">RDMTK v0.01</a>-->
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                @yield('dropdowns')            
                <!-- /.dropdown -->
                
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        @yield('side-menu')  
                        
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    @yield('flash-content')
                </div>
                <div class="row">
                    @yield('error-message')
                </div>
                <div class="row">
                    @yield('page-content')
                    
                    
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    
</body>

</html>
