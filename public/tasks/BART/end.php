<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Balloon Task</title>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <meta name="author" content="Vinay Gavirangaswamy" />

        <!-- Bootstrap Core CSS -->
        <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="css/timeline.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/sb-admin-2.css" rel="stylesheet">
        
        <!-- Custom CSS For end.php-->
        <link href="css/end.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="bower_components/morrisjs/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
            
        <!-- jQuery -->
        <script src="bower_components/jquery/dist/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

        <!-- Morris Charts JavaScript -->
        <script src="bower_components/raphael/raphael-min.js"></script>
        <script src="bower_components/morrisjs/morris.min.js"></script>
        <script src="js/morris-data.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="js/sb-admin-2.js"></script>
    </head>
    <body>
        <?php
        // put your code here
        include 'include/class/oe_databasemanager.php';
	include 'users/controller/user_dbo.php';
        $experimentid= $_GET['exp'];
	$participantid= $_GET['MID'];
        $totalpoints = $_GET['TOTALPOINTS'];
        
        $_SESSION['totalpoints'] = $totalpoints;
        
        $userdbo = new UserDBO();
        /* Database call to check whether the experiment in url exists,
	 if exists fecthing number of trials assigned to this experiment */
	$viewusers= $userdbo->viewFieldsExperimentCond('nooftrials,confirmationcode,expertrial_outcome_type,experend_conf_page_type,experend_conf_customtext','id="'.$experimentid.'"');
	$viewusers = json_decode($viewusers);
	$exprExists=count($viewusers);       
        $confirmationcode = $viewusers[0]->confirmationcode;   
        
        ?>
        
            
        	
           <div  class="container" >     
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <b>Task Complete</b>
                        </div>
                        <div class="panel-body">
                            
				<?php if($viewusers[0]->experend_conf_page_type=="DEFAULT"){?>
					Thank you for your participation in this task. You earned a total of  <strong><?php echo $_SESSION['totalpoints']; ?></strong> points.<br>

					Please note the confirmation code, <strong><?php echo $confirmationcode; ?></strong>. Please input this in the survey that directed you to this experiment. That will allow you to continue on with the HIT and get paid for your time.

					<p>
						When you have input the confirmation code and were successfully able to move on to the next step of the survey, you may close this window.
					</p>
					<?php } else
                                            if($viewusers[0]->experend_conf_page_type=="CUSTOM_TXT"){
					echo $viewusers[0]->experend_conf_customtext;
				 } ?>
		
                        </div>
                        <div class="panel-footer">
                            Thank you!
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-4 -->

            </div>
           </div>
    </body>
</html>
