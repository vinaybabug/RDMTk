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


<html>
    <head>
        <meta charset="UTF-8">
        <title>DelayD Task</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <meta name="author" content="Praneet Soni" />
      
        <!-- jQuery -->
        <script src="../../js/jquery.min.js"></script>
		<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
     
    </head>
    <body>
        <?php
        // put your code here
        include 'include/class/oe_databasemanager.php';
	include 'users/controller/user_dbo.php';
        $experimentid= $_GET['exp'];
	$participantid= $_GET['MID'];
            
        $userdbo = new UserDBO();
        /* Database call to check whether the experiment in url exists,
	 if exists fecthing number of trials assigned to this experiment */
	$viewusers= $userdbo->viewFieldsExperimentCond('nooftrials,confirmationcode,expertrial_outcome_type,experend_conf_page_type,experend_conf_customtext','id="'.$experimentid.'"');
	$viewusers = json_decode($viewusers);
	$exprExists=count($viewusers);       
        $confirmationcode = $viewusers[0]->confirmationcode;   
        
        ?>
        
            
        	<br><br>
           <div  class="container" >     
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <b>Task Complete</b>
                        </div>
                        <div class="panel-body">
                            
				<?php if($viewusers[0]->experend_conf_page_type=="DEFAULT"){?>
					Thank you for your participation in this task. 

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
