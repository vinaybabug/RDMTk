<!DOCTYPE html>
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


<!--
 Sample URL: http://localhost/bart/task.php?exp=myexpr&MID=TESTTEST
-->
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Balloon Task</title>

    <!-- Bootstrap Core CSS -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/half-slider.css" rel="stylesheet">
    
    <!-- jQuery -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
      <?php
        // put your code here
        $experimentid= $_GET['exp'];
	$participantid= $_GET['MID'];
    ?>   

    <!-- Half Page Image Background Carousel Header -->
    <header id="myCarousel" class="carousel slide">
        <!-- Indicators -->
<!--        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>-->

        <!-- Wrapper for Slides -->
        <div class="carousel-inner">
            <div class="item active">
                <!-- Set the first background image using inline CSS below. -->
                <div class="fill"><p align="middle"><img src="img/screen.PNG" alt="Start img"/></p></div>
                <div class="carousel-caption">
                    <h2></h2>
                </div>
            </div>
        </div>

        <!-- Controls -->
<!--        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>-->

    </header>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <div class="col-lg-12 panel-body">
                <h1>Welcome to the Balloon Game!</h1>
                Your objective in this task is to earn as many points as possible.

                <p>To earn points, you will be pumping 30 balloons. Each pump of a balloon nets you 10 points.

                But you cannot pump a particular balloon forever. Each balloon has a different point at which it will pop. So your goal is to pump the balloon as large as possible and collect it before it pops. If it pops, you will receive no points for that balloon.
                </p>
                <p>
                When you are done pumping a balloon, hit 'Collect points' to move on to the next balloon.
                </p>
                <p>Good luck!</p>
                
                <a class="btn btn-lg btn-success" href=<?php echo "init.php?exp=".$experimentid."&MID=".$participantid ?>>Start</a>
            </div>
        </div>

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <!--<p>Copyright &copy; Your Website 2014</p>-->
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
   <!-- /.container -->   


<!-- Modal -->
<div class="modal fade" id="aboutModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Nirnayi Toolkit</h4>
      </div>
      <div class="modal-body">          
          <p class="text-justify">
          RDMTk Toolkit is an open source platform, used for studying Risky Decision Making (RDM) in 
          Behavior Psychology. It is currently hosted and provided by Wireless Sensornets Laboratory
          (WiSe Lab) at Computer Science Department, Western Michigan University.
          </p>
          <p class="text-justify">
          If you have questions about our research, feel free to stop by the Wireless Sensornets Laboratory
          (WiSe Lab) in room B-213 on the Parkview Campus. You may also contact Dr. Ajay Gupta
          at ajay[DOT]gupta[AT]wmich[DOT]edu.
          </p>
      </div>
<!--      <div class="modal-footer">        
      </div>-->
    </div>
  </div>
</div>
  
    


    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })   
    </script>  


</body>

</html>


