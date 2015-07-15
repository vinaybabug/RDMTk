<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
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

        
        <link href='http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
        <link href='css/canvas.css' rel='stylesheet' type='text/css'>
        <script type="text/javascript" src="js/lib/plugins/CSSPlugin.min.js"></script>
        <script type="text/javascript" src="js/lib/easing/EasePack.min.js"></script>
        <script type="text/javascript" src="js/lib/TimelineLite.min.js"></script>
        <script type="text/javascript" src="js/lib/TweenLite.min.js"></script>
        <script type="text/javascript" src="js/lib/TweenMax.min.js"></script>
        <!--<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>-->
        <script type="text/javascript" src="js/lib/Three.js"></script>
        
         <!--<script type="text/javascript" src="js/input.js"></script>-->
        <!--<script type="text/javascript" src="js/lib/install.js"></script>-->
        <script type="text/javascript" src="js/app.js"></script>
        
        <script type="text/javascript" src="js/ThreeScene.js"></script>
        <script type="text/javascript" src="js/task-code.js"></script>
        
        </head>
    <body>
        <?php
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
        
        if ($exprExists > 0) {
            
            $_SESSION['dataparticipant'] = array();
            $_SESSION['experimentid'] = $experimentid;
            $_SESSION['mid'] = $participantid;
            $totalTrials = $viewusers[0]->nooftrials;
            $order = $viewusers[0]->expertrial_outcome_type;
            $_SESSION['order'] = $order;   
            $_SESSION['totalTrials'] = $totalTrials;
            /* Database call to check whether the participant id in url exists to this experiment ,
              if exists fecthing number of trials done by the participant corresponding to this experiment */
            $viewexpts = $userdbo->viewFieldsParticipantCond('*', 'mid="' . $participantid . '" and experid="' . $experimentid . '" order by trialno');
            $viewexpts = json_decode($viewexpts); 
            //$trialno = 0;//count($viewexpts);   
            $trialAttempted = count($viewexpts);            

            if ($trialAttempted > 0) {
                // participant already took task, forward him/her redirect to end.php
                $confirmationcode = $viewusers[0]->confirmationcode;
                $totalpoints = 10;//$viewexpts[$trialno-1]->paytotal;
                $_SESSION['totalpoints'] = $totalpoints;
                // Check if task is using DEFAULT = end.php or CUSTOM_TXT                 
                $url = 'http://' . $_SERVER['HTTP_HOST'];            // Get the server
                $url .= rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); // Get the current directory
                $url .= '/end.php?exp='.$experimentid.'&MID='.$participantid.'&TOTALPOINTS='.$totalpoints;         
                header('Location: ' . $url, true, 302);              // Use either 301 or 302
                
                
            } else {
                $totalpoints = 0.0;
                $_SESSION['totalpoints'] = $totalpoints;
                $confirmationcode = $viewusers[0]->confirmationcode;
            }
        }

//        echo '<script language="javascript">';
//        echo 'alert('.$trialAttempted.')';  //not showing an alert box.
//        echo '</script>';
        
        ?>
        <div class="wrapper">
<!--            <div class="navbar-inner">
                <div class="container">
                    <span class="btn-navheader">Timeline Demo - Horse</span>
                    <a href="#" class="btn btn-default" style="display: none;">Reset</a>
                    <a href="#" class="btn btn-default" style="display: none;">Pause</a>
                    <a href="#" class="btn btn-default" style="display: none;">Start</a>
                </div>
            </div>-->
            <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">                
                <a class="navbar-brand">Balloon Task v1.0</a>
            </div>
            <!-- /.navbar-header -->           
        </nav>
        
        <div class="container-fluid"> 
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="row">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">                                
                                <div class="col-xs-6 text-left">                                    
                                    <div class="">Balloon Number</div>
                                </div>
                                <div class="col-xs-6 text-right" id="BalloonNumber">
                                    <div class="huge">1/<?php echo $_SESSION['totalTrials']; ?></div>
                                </div>
                            </div>
                        </div>
                        
                            <div class="panel-footer">
                                <div class="col-xs-4" id="Pump">
                                    <span class="pull-left small">Pump:0</span>
                                </div>
                                <div class="col-xs-4" id="CurrentScore">
                                    <span class="pull-left small">Current Score:0</span>
                                </div>
                                <div class="col-xs-4" id="TotalScore">
                                    <span class="pull-left small">Total Score:0</span>
                                </div>                                                             
                                <div class="clearfix"></div>
                            </div>
                        
                    </div>
                    </div>
                    <!--Legend -->
                    <div class="row">
                        <div class="panel panel-info">
                            <div class="panel-heading">
<!--                                <div class="row">                                
                                    <div class="col-xs-6 text-left">                                    
                                        <div class="">Legend</div>                           
                                    </div>                               
                                </div>-->
                            </div>
                            <div class="panel-footer">
                                <div class="row">
                                    <!--<div class="col-xs-2">-->
                                    <p>&nbsp;<i class="fa fa-smile-o fa-2x"></i>&nbsp; Balloon Collected</p>
                                    <p>&nbsp;<i class="fa fa-frown-o fa-2x"></i>&nbsp; Balloon Popped</p>
                                    <!--</div>-->                                                           
                                </div>

                                <div class="clearfix"></div>
                            </div>

                        </div>
                    </div>
                    <!--Balloons -->
                    <div class="row">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">                                
                                <div class="col-xs-6 text-left">                                    
                                    <div class="">Trials</div>                           
                                </div>                               
                            </div>
                        </div>
                        
                            <div class="panel-footer">
                                <?php 
                                    $row = floor($totalTrials/5);
                                    $remainder = $totalTrials%5;
                                    $balloonCount = 0;
                                    for ($rc = 0; $rc < $row; $rc++) {
                                        
                                        echo "<div class=\"row\">";
                                        for ($cc = 0; $cc < 5; $cc++) {
                                            
                                            echo "<div class=\"col-xs-2\" id=\"B".($balloonCount = $balloonCount+1)."\"><i class=\"fa fa-ban fa-3x\"></i></div>";                                           
                                            
                                        } 
                                        echo  "</div>";
                                    }
                                      echo "<div class=\"row\">";
                                        for ($cc = 0; $cc < $remainder; $cc++) {
                                            
                                            echo "<div class=\"col-xs-2\" id=\"B".($balloonCount = $balloonCount+1)."\"><i class=\"fa fa-ban fa-3x\"></i></div>";                                           
                                            
                                        } 
                                        echo  "</div>";
                                ?>
<!--                                <div class="row">
                                    <div class="col-xs-2" id="B1">
                                        <i class="fa fa-ban fa-3x"></i>
                                    </div>                                                           
                                </div>-->
                                                                                    
                                <div class="clearfix"></div>
                            </div>
                        
                    </div>
                    </div>
                    <!--End Balloons -->
                </div>         
       
                <div class="col-lg-9 col-md-18">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div id="taskcanvas" class="canvas"> 
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>

        <div class="row"> 
        <div class="col-md-4 col-lg-offset-6">            
            <button type="button" class="btn btn-lg inflate btn-danger">Inflate Balloon</button>
            <button type="button" class="btn btn-lg collect btn-success">Collect Points</button>
           
        </div>
        </div>
        </div>
           
            
        </div>    
        <!-- /#wrapper -->
        
        <script language="javascript" type="text/javascript">

            var width = 600,
                    height = 400,
                    camera,
                    scene,
                    renderer,
                    SHADOW_MAP_WIDTH = 600,
                    SHADOW_MAP_HEIGHT = 400,
                    dominoGeometry,
                    dominoMaterial,
                    dominoPos = -180,
                    tweens = [],
                    type = 0,
                    d = 8,
                    basicScene,
                    tl = new TimelineLite({onComplete: complete});
            
            var jsonExrData = {data:[]};
            // Variables.
            var timeoutHandle;
            var bustPoints;
            var balloon;           
            var pumpNo = 0;
            var currentScore = 0;
            var totalScore = 0;
            var balloonNumber = 1;
            var balloonMaxNoPump = 100;
            var BALLOON_MAX_SIZE = 220;
            var BALLOON_MIN_SIZE = 20;
            var currBalloonSize = BALLOON_MIN_SIZE;
            var BALLOON_MAX_VPOS = -300;            
            var BALLOON_MIN_VPOS = 100;
            var currBalloonVPos = BALLOON_MIN_VPOS;
            // revolutions per second
            var angularSpeed = 0.0008;
            
            var currentTime = new Date().getTime(), prevTime = new Date().getTime();
            
            init();
            
            function checkComplete(){
                
                currentTime = new Date().getTime();               
                                            
                if(balloonNumber >= <?php echo $_SESSION['totalTrials']; ?>){
                    
                        $('#balloonTrialModel').modal('hide');
                        
                        $('#storeDataModel').modal({
                                              backdrop:'static',
                                              keyboard: false
                                            });
                    
                        jsonExrData.data.push({
                        mid: "<?php echo $participantid; ?>",
                        experid: "<?php echo $experimentid; ?>",
                        trialstopindex: bustPoints.balloon[balloonNumber],
                        noofpumps: pumpNo,                        
                        trial_pts: currentScore,
                        total_pts: totalScore,
                        trialno: balloonNumber,
                        tracktime: currentTime - prevTime,
                        created_by: "<?php echo $participantid; ?>",
                        modified_by:"<?php echo $participantid; ?>",
                        created_at: "<?php echo date("Y-m-d H:i:s");?>",
                        updated_at: "<?php echo date("Y-m-d H:i:s");?>"
                        });    
                         
                        $url = "<?php  echo "http://" . $_SERVER['SERVER_NAME'] . substr($_SERVER['REQUEST_URI'],0,strrpos($_SERVER['REQUEST_URI'],"tasks"));  ?>"+"expr/rslts/bart/store";
                        $.ajax({
                        type: "POST",
                        url: $url,         
                        data: jsonExrData,                                   
                        dataType: "json",
                        success: function(data) { 
                            $('#storeDataModel').modal('hide');
                            //alert(data);
                            if(data == true){                           
                              window.location.href = "http://" + "<?php echo $_SERVER['HTTP_HOST'].rtrim(dirname($_SERVER['PHP_SELF']), '/\\');?>"+ "/end.php?exp="+"<?php echo $experimentid; ?>"+"&MID="+"<?php echo $participantid ?>"+"&TOTALPOINTS="+ totalScore;                                                                                                 
                            }
                            else
                            if(data == false){
                                
                                $('#errorModel').modal({
                                              backdrop:'static',
                                              keyboard: false
                                            });
                                //alert("Server Connection Failed. Replay Task!");
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                                        //alert(xhr.status);
                                        $('#storeDataModel').modal('hide');
                                        //alert(xhr.status+": "+thrownError);
                                        $('#errorModel').modal({
                                              backdrop:'static',
                                              keyboard: false
                                            });
                        }
                        });              
                    
                }
                else{                           
                                    
                        jsonExrData.data.push({
                        mid: "<?php echo $participantid; ?>",
                        experid: "<?php echo $experimentid; ?>",
                        trialstopindex: bustPoints.balloon[balloonNumber],
                        noofpumps: pumpNo,                        
                        trial_pts: currentScore,
                        total_pts: totalScore,
                        trialno: balloonNumber,
                        tracktime: currentTime - prevTime,
                        created_by: "<?php echo $participantid; ?>",
                        modified_by:"<?php echo $participantid; ?>",
                        created_at: "<?php echo date("Y-m-d H:i:s");?>",
                        updated_at: "<?php echo date("Y-m-d H:i:s");?>"
                        });      
                
                balloonNumber++;
                var balloonTxt = "<div class=\"huge\">"+balloonNumber+"/"+<?php echo $_SESSION['totalTrials']; ?>+"</div>";                               
                $('#BalloonNumber').html(balloonTxt);
                
                prevTime = currentTime;    
                currentScore = 0;
                pumpNo = 0;
                
                var totalScoreTxt = "<span class=\"pull-left small\">Total Score:"+totalScore+"</span>";               
                $('#TotalScore').html(totalScoreTxt); 
                
                var currentScoreTxt = "<span class=\"pull-left small\">Current Score:"+currentScore+"</span>";               
                $('#CurrentScore').html(currentScoreTxt); 
                
                var pumpTxt = "<span class=\"pull-left small\">Pump:"+pumpNo+"</span>";               
                $('#Pump').html(pumpTxt);
                }                              
                
                //console.log(jsonExrData);
            }
            
            function init() {
                basicScene = new THREE.BasicScene({width: width, height: height});

                TweenLite.ticker.addEventListener("tick", render);

                initObjects();                
                
                // load burst points
                initBustPoints();
                
                currentTime = new Date().getTime();
                $('.inflate').on('click', inflate).show();
                $('.collect').on('click', collect).show();
                
            }        
        
            function render() {
                basicScene.renderer.render(basicScene.scene, basicScene.camera);
                // update
                if(balloon != null){                    
                    
                    TweenLite.to(balloon.rotation, 0, { y: Date.now() * angularSpeed, ease: Linear.easeNone, delay: 0});
                    //balloon.rotation.x = (23.5/180)*Math.PI;
                    //balloon.rotation.y = Date.now() * angularSpeed;                    
                }

            }
            
            function initBustPoints() {
                var order = '<?php echo $_SESSION['order'] ?>';
                 if (order == "FIXED") {
                     bustPoints = loadBurstPoints();                     
                 }
                 else
                   if (order == "RANDOM") {                     
                     bustPoints = loadRandomBurstPoints();
                 }                   
            }
            
            function initObjects() {                

                var light = new THREE.DirectionalLight();
                light.intensity = 0.9;
                light.castShadow = false;
                //light.position.set(-320, 350, 100);
                light.position.set(5, 15, 200);
                basicScene.add(light);
                
                initBalloon();
            }
            
            
            
            
            function initBalloon() {               
                
                var loader = new THREE.JSONLoader();
                loader.load("models/balloon.js",function(geometry) {
                //for(var count = 0; count < 50; count++)
                  //  alert(getRandomColor());
                //var material = new THREE.MeshNormalMaterial({color: 0xffffff});
                var material = new THREE.MeshLambertMaterial({color: getRandomColor()});               
                

                //var mesh = new THREE.Mesh(geometry, material);
                balloon = new THREE.Mesh(geometry, material);
                
                balloon.scale = new THREE.Vector3(BALLOON_MIN_SIZE, BALLOON_MIN_SIZE, BALLOON_MIN_SIZE);
                balloon.position.set(0, BALLOON_MIN_VPOS, 0);
                balloon.rotationAutoUpdate = true;
                balloon.castShadow = false;
                balloon.receiveShadow = false;
                balloon.geometry.dynamic = true;           
                
                basicScene.add(balloon);                
                });
                
                currBalloonSize = BALLOON_MIN_SI
                currBalloonVPos = BALLOON_MIN_VPOS;
            }   
            
            
            function pause() {
                paused = true;
                tl.pause();
            }

     
            
            function inflate() {                     
               if(balloon != null && currBalloonSize != BALLOON_MAX_SIZE && currBalloonVPos != BALLOON_MAX_VPOS && bustPoints.balloon[balloonNumber] != pumpNo){
                   
                pumpNo++;                   
                currentScore +=10;   
                currBalloonSize += 1;      
                currBalloonVPos -=2.5;
                TweenLite.to(balloon.scale, 0, {x:currBalloonSize, y:currBalloonSize, z:currBalloonSize});
                TweenLite.to(balloon.position, 0, {y:currBalloonVPos});
                var pumpTxt = "<span class=\"pull-left small\">Pump:"+pumpNo+"</span>";               
                $('#Pump').html(pumpTxt);
                var currentScoreTxt = "<span class=\"pull-left small\">Current Score:"+currentScore+"</span>";               
                $('#CurrentScore').html(currentScoreTxt);
                
                
             }
             else{
                var audioElement = document.createElement('audio');
                audioElement.setAttribute('src', 'audio/explosion.wav');
		audioElement.setAttribute('autoplay', 'autoplay');
               
                
                var bNumber = "B"+balloonNumber;     
                document.getElementById(bNumber).innerHTML = "<i class=\"fa fa-frown-o fa-3x\"></i>";
                                
                basicScene.remove(balloon);
                
                document.getElementById("balloonTrialModelLabel").innerHTML =  "<span class=\"glyphicon glyphicon-info-sign\" aria-hidden=\"true\"></span> Balloon Popped"; 
                $('#balloonTrialModelTxt').text("Sorry! Your balloon popped. Your "+ pumpNo+" pumps were too much. So you did not get any added points. Better luck next time.\n Your current total score is " + totalScore+".");
                
                $('#balloonTrialModel').modal({
                                              backdrop:'static',
                                              keyboard: false
                                            });
                setTimeout(function() { $('#balloonTrialModel').modal('hide'); }, 3000);                
                
                checkComplete();
                initBalloon();
             }
            }
            
             function collect() {  
                
                totalScore += currentScore;
                
                var bNumber = "B"+balloonNumber;     
                document.getElementById(bNumber).innerHTML = "<i class=\"fa fa-smile-o fa-3x\"></i>";
                                
                basicScene.remove(balloon);
                
                document.getElementById("balloonTrialModelLabel").innerHTML =  "<span class=\"glyphicon glyphicon-info-sign\" aria-hidden=\"true\"></span> Balloon Collected"; 
                $('#balloonTrialModelTxt').text(" You have collected a balloon after pumping it "+ pumpNo +" number of times, for a total of "+currentScore+" points. This brings your current total to "+totalScore+"  points.");
                $('#balloonTrialModel').modal({
                                              backdrop:'static',
                                              keyboard: false
                                            });
                setTimeout(function() { $('#balloonTrialModel').modal('hide'); }, 3000);
                
               
                checkComplete();
                initBalloon();
                
             }

            function complete() {            
                pause();
                tl.progress(0);            
            }


        </script>       

        
<!-- Modal balloonTrialModel-->
<div class="modal fade" id="balloonTrialModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
        <h4 class="modal-title" id="balloonTrialModelLabel"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> </h4>
      </div>
      <div class="modal-body">          
          <p class="text-justify" id="balloonTrialModelTxt">
            Place holder text...
          </p>          
      </div>
      <div class="modal-footer">     
          <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
      </div>
    </div>
  </div>
</div>

<!-- Modal storeDataModel-->
<div class="modal fade" id="storeDataModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
        <h4 class="modal-title" id="storeDataModelLabel"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Processing... </h4>
      </div>
      <div class="modal-body">          
          <div class="progress">
              <div class="progress-bar" role="progressbar" aria-valuenow="70"
                   aria-valuemin="0" aria-valuemax="100" style="width:90%">                 
              </div>
          </div>  
      </div>
      <div class="modal-footer">     
          <!--<button type="button" class="btn btn-default" data-dismi"modal">Close</button>-->
      </div>
    </div>
  </div>
</div>

<!-- Modal errorModel-->
<div class="modal fade" id="errorModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
        <h4 class="modal-title" id="storeDataLabel"><img src="img/error.PNG" alt="error img" height="50" width="50"/></h4>
      </div>
      <div class="modal-body">            
           <p class="text-justify">
                Sorry, Balloon Task couldn't finish processing. You can either try to retake the task at a later time or try to contact system administrator and resolve the problem. 
                Thank you for being patient!
  
          </p> 
      </div>
      <div class="modal-footer">     
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

    </body>
</html>
