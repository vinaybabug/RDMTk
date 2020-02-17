<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="A Toolkit for Risky Decision Making" content="">
    <meta name="Vinay B Gavirangaswamy" content="">

    <title>RDMTk - A Toolkit for Risky Decision Making</title>

    <!-- Bootstrap Core CSS -->
     {{ HTML::style('css/bootstrap.min.css') }} 

    <!-- Custom CSS -->
     {{ HTML::style('css/grayscale.css') }} 

    <!-- Custom Fonts -->
    {{ HTML::style('font-awesome-4.1.0/css/font-awesome.css') }} 
    {{ HTML::style('https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic') }} 
    {{ HTML::style('https://fonts.googleapis.com/css?family=Montserrat:400,700') }}     

</head>

<body id="page-top">

     <!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                </button>
                <a class="navbar-brand">RDMTK</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#about">About</a></li>
                    <li><a href="#login">Login</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

     <!-- Intro Header -->
    <div class="intro-header">
        <div class="row">
            <div class="col-lg-12">
                <div class="intro-message">
                    <h1>RDMTK</h1>
                    <h3>An open-source and easy-to-use Risky Decision Making Toolkit.</h3>
                </div>
            </div>
        </div>
    </div>

     <!-- About Section -->
    <section id="about">  
        <div class="section-a">
            <div class="row">
                <div class="col-lg-5 col-sm-6">
                    <hr>
                    <div class="clearfix"></div>
                    <h2>About</h2>
                    <p class="lead">The Risky Decision Making Toolkit (RDMTk) represents a collective experience of experts and resources geared towards research in decision-making and, in particular, RDM.</p>
                     <a href="https://github.com/vinaybabug/RDMTk" class="btn btn-default btn-lg">Learn More on Github</a>
                </div>
                <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                    <img class="img-responsive" src="./img/decision.jpg" alt="">
                </div>
            </div>
        </div>
    </div>

     <!-- Login Section -->
    <section id="login">
        <div class="section-a">
            <div class="row">
                <div class="col-lg-5 col-lg-offset-1 col-sm-push-6  col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">Access RDMTk</h2>

                    <p class="lead">You can  start using RDMTk for free! Create a researcher's or participant's account on the login page and start your Empirical Studies.</p>
                    <a href="{{URL::to('/login')}}" class="btn btn-default btn-lg">Visit login Page</a>
                </div>
                <div class="col-lg-5 col-sm-pull-6  col-sm-6">
                    <img class="img-responsive" src="./img/login.jpg" alt="">
                </div>
            </div>
        </div>
    </section>

     <!-- Contact Section -->
    <section id="contact">
        <div class="section-a">
            <div class="row">
                <div class="col-lg-5 col-sm-6">
                    <hr>
                    <div class="clearfix"></div>
                    <h2 class="section-heading">Feel free to contact us for any questions!</h2>
                    <a href="mailto:cs-rdmtk@wmich.edu" class="btn btn-default btn-lg">cs-rdmtk@wmich.edu</a>
                </div>
                <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                    <img class="img-responsive" src="./img/email.jpg" alt="">
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p>Copyright &copy; RDMTk: A Toolkit for Risky Decision Making 2016</p>
<span id="siteseal"><script async type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=C42Pn3okXzbfX8GdrDXxetaeul9ReF9g0fJu4HbLxYpkmNJy2V6S4dREtBc9"></script></span>
        </div>
    </footer>

    <!-- jQuery -->
    
    {{ HTML::script('js/jquery.js'); }}

    <!-- Bootstrap Core JavaScript -->
    {{ HTML::script('js/bootstrap.min.js') }} 
    

    <!-- Plugin JavaScript -->
    {{ HTML::script('js/jquery.easing.min.js') }} 
    

    <!-- Google Maps API Key - Use your own API key to enable the map feature. More information on the Google Maps API can be found at https://developers.google.com/maps/
    {{ HTML::script('https://maps.googleapis.com/maps/api/js?key=AIzaSyCRngKslUGJTlibkQ3FkfTxj3Xss1UlZDA&sensor=false') }} -->
    

    <!-- Custom Theme JavaScript -->
    {{ HTML::script('js/grayscale.js') }} 
    

</body>

</html>
