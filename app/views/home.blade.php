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
    {{ HTML::style('http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic') }} 
    {{ HTML::style('http://fonts.googleapis.com/css?family=Montserrat:400,700') }}     
    

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">
                    <i class="fa fa-bars"></i>  <span class="light">RDMTk</span> 
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#about">About</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#login">Login</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Intro Header -->
<!--    <header class="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h1 class="brand-heading">RDMTk</h1>
                        <p class="intro-text">A Toolkit for Studying Risky Decision Making Globally.<br></p>
                        <a href="#about" class="btn btn-circle page-scroll">
                            <i class="fa fa-angle-double-down animated"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>-->

    <!-- About Section -->
    <section id="about" class="container content-section text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>About RDMTk</h2>
                <p align="justify">The process or activity of making choices when subject to possibility of loss can be understood as risky decision-making (RDM). Results from computational decision-making are used in a variety of disciplines including marketing, sales, inventory management, psychology, behavioral research and finance. Researchers in RDM typically analyze data collected through empirical experiments. These experiments involve data from participant’s performance on a certain task/game. These tasks are designed to measure a specific aspect of decision making. Conventional approach to conducting empirical experiment is limited to local setting in a lab, where only restricted number of participants can be accommodated. Facilitating global studies for bigger and diverse participant’s pool would allow practioners to extract precise knowledge. Most of the available alternatives are proprietary, not specifically geared towards RDM and are not built to scale for bigger diverse participants pool. Proposed toolkit RDMTk (a Risky Decision Making Toolkit) is an attempt to build such a platform. RDMTk is intended to be a one-stop shop for conducting global-scale empirical experiments.</p>

                <p align="justify">RDMTk toolkit is envisioned to represent collective experience of experts and resources geared towards researching in decision-making and, in particular, RDM. Researchers would benefit tremendously from incorporating best practices, tools and techniques at one convenient place. Automating commonly practiced activities and integrating external tools, such as mTurk, Qualtrics, etc. used in setting up empirical studies furthers its cause. Bundling data analysis tools along with empirical experimentation features will empower researchers and practitioners to identify decision patterns with ease. Toolkit is open source, highly extensible and web-based solution. It is implemented using latest technologies such as PHP 5.4, Laravel, MySql, javascript and runs on Ubuntu based LAMP server.</p>

                <p align="justify">Current implementation of the toolkit supports a good number of constituent elements. RDMTk architecture is split into 2 different components. First component is the dashboard, which aids in managing users, experiments, tasks, data managements, and analysis tools. Dashboard is primarily targeted to 3 types of users. Administrators maintain and are overall responsible for technical aspects of the toolkit; researchers have access to features that help in conducting empirical studies, analyzing data and to facilitate collaboration. Third types of users are participants who can just access experiments assigned to them. Second component is the collection of tasks/games, which facilitate empirical studies and collection of pertinent data. There are currently six tasks implemented and more tasks can be added through manage tasks feature. Experiments are created based on these tasks and data can be downloaded as an excel file at the end of the study for further analysis. Downloaded data can either be summary of participant’s performance or detailed raw listing.</p>
                
            </div>
        </div>
    </section>

    <!-- Download Section -->
    <section id="login" class="content-section text-center">
        <div class="download-section">
            <div class="container">
                <div class="col-lg-8 col-lg-offset-2">
                    <h2>Access RDMTk</h2>
                    <p> You can  start using RDMTk for free! Create a researcher's or participant's account on the login page and start your Empirical Studies.</p>
                    <a href="{{URL::to('login')}}" class="btn btn-default btn-lg">Visit login Page</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="container content-section text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>Contact RDMTk Developers</h2>
                <p>Feel free to email us to provide some feedback on our toolkit, give us suggestions for new features and tasks, or to just say hello!</p>
                <p><a href="mailto:vinay.b.gavirangaswamy@wmich.edu">vinay.b.gavirangaswamy@wmich.edu</a>
                </p>
                <ul class="list-inline banner-social-buttons">
<!--                    <li>
                        <a href="https://twitter.com/SBootstrap" class="btn btn-default btn-lg"><i class="fa fa-twitter fa-fw"></i> <span class="network-name">Twitter</span></a>
                    </li>-->
                    <li>
                        <a href="https://github.com/vinaybabug/RDMTk" class="btn btn-default btn-lg"><i class="fa fa-github fa-fw"></i> <span class="network-name">Github</span></a>
                    </li>
<!--                    <li>
                        <a href="https://plus.google.com/+Startbootstrap/posts" class="btn btn-default btn-lg"><i class="fa fa-google-plus fa-fw"></i> <span class="network-name">Google+</span></a>
                    </li>-->
                </ul>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p>Copyright &copy; RDMTk: A Toolkit for Risky Decision Making 2016</p>
        </div>
    </footer>

    <!-- jQuery -->
    
    {{ HTML::script('js/jquery.js'); }}

    <!-- Bootstrap Core JavaScript -->
    {{ HTML::script('js/bootstrap.min.js') }} 
    

    <!-- Plugin JavaScript -->
    {{ HTML::script('js/jquery.easing.min.js') }} 
    

    <!-- Google Maps API Key - Use your own API key to enable the map feature. More information on the Google Maps API can be found at https://developers.google.com/maps/ -->
    {{ HTML::script('https://maps.googleapis.com/maps/api/js?key=AIzaSyCRngKslUGJTlibkQ3FkfTxj3Xss1UlZDA&sensor=false') }} 
    

    <!-- Custom Theme JavaScript -->
    {{ HTML::script('js/grayscale.js') }} 
    

</body>

</html>
