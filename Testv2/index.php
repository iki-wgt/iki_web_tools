<!DOCTYPE html>
<html lang="en">
	<head>
		<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
		<meta content="utf-8" http-equiv="encoding">
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>Robot Control Web UI</title>
		<meta name="description" content="Robot Control Web UI" />
		<meta name="keywords" content="" />
		<meta name="author" content="IKI" />
		<link rel="shortcut icon" href="../favicon.ico">
		
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<!-- Optional theme 
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
		-->
	
		<link rel="stylesheet" type="text/css" href="css/icons.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<link rel="stylesheet" type="text/css" href="css/iki_robot.css" />
        <link rel="stylesheet" type="text/css" href="css/styles.css" />
		
		
		<script src="js/modernizr.custom.js"></script>
		<script src="js/jquery-2.1.3.min.js"></script>
		
		<script type="text/javascript" src="js/eventemitter2.js"></script>
		<script type="text/javascript" src="js/roslib.js"></script>
		<script type="text/javascript" src="js/three.js"></script>
		<script type="text/javascript" src="js/ColladaLoader.js"></script>
		<script type="text/javascript" src="js/STLLoader.js"></script>
		<script type="text/javascript" src="js/ros3d.js"></script>
		<script type="text/javascript" src="js/easeljs.js"></script>
		<script type="text/javascript" src="js/ros2d.js"></script>
		<script type="text/javascript" src="js/nav2d.js"></script>

    <script type="text/javascript" type="text/javascript">
  var ros = new ROSLIB.Ros({
    url : 'ws://192.168.5.2:9090'
  });

  ros.on('connection', function() {
    console.log('Connected to websocket server.');
  });

  ros.on('error', function(error) {
    console.log('Error connecting to websocket server: ', error);
  });

  ros.on('close', function() {
    console.log('Connection to websocket server closed.');
  });

  </script>

  <script type="text/javascript" src="js/iki_robot.js"></script> <!-- ros has to be defined for this script -->

	</head>
	<body>
<nav class="navbar navbar-trans navbar-fixed-top" role="navigation">
<ul class="nav navbar-brand">
		
            <a href="#section1"><img src="img/top_button.png"></a>
        
       
      </ul>

</nav>

<section class="container-fluid" id="section1">
  	
 	
  	<div class="container-fluid">
      <div class="row">
          <div class="col-sm-3">
            <div class="row">
              <a href="#section2"><div class="col-sm-10 col-sm-offset-1 text-center"><img class="iconCircle" src="img/talk11.png">
              <h1>Sprache</h1></div></a>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="row">
              <a href="#section3"><div class="col-sm-10 col-sm-offset-1 text-center"><img class="iconCircle" src="img/compass68.png">
              <h1>Navigation</h1></div></a>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="row">
              <a href="#section4"><div class="col-sm-10 col-sm-offset-1 text-center"><img class="iconCircle" src="img/factory26.png">
              <h1>Hand steuern</h1></div></a>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="row">
              <a href="#section5"><div class="col-sm-10 col-sm-offset-1 text-center"><img class="iconCircle" src="img/security50.png">
              <h1>Kamera</h1></div></a>
            </div>
          </div>
      </div><!--/row-->
  </div><!--/container-->
</section>

<section class="container-fluid" id="section2">
  <div class="row">
  	<div class="col-sm-8 col-sm-offset-2 text-center">
      <h1>Was soll Marvin sagen?</h1>
      <br>
      <?php include 'include/speech.php';?>
	   </div>
  </div>
</section>

<section class="container-fluid" id="section3">
    <div class="row">
      <div class="col-sm-8 col-sm-offset-2 text-center">
        <h1>Wohin soll Marvin navigieren?</h1>
        <br>
        <?php include 'include/navigation.php';?>
      </div>
    </div>
</section>

<section class="container-fluid" id="section4">
    <div class="row">
          <div class="col-sm-6">
            <div class="row" onclick="gripper_control(0.0)">
              <div class="col-sm-12 col-sm-offset-1 text-center"><img class="iconCircle" src="img/factory26.png">
              <h1>Hand öffnen</h1></div>
            </div>
          </div>
          <div class="col-sm-5">
            <div class="row" onclick="gripper_control(0.7)">
              <div class="col-sm-10 col-sm-offset-1 text-center"><img class="iconCircle" src="img/factory26.png">
              <h1>Hand schlie&szlig;en</h1></div>
            </div>
          </div>
      </div><!--/row-->
</section>

<section class="container-fluid" id="section5">
    <div class="row">
      <div class="col-sm-8 col-sm-offset-2 text-center">
      <h1>Was sieht Marvin gerade?</h1>
      <?php include 'include/camera.php';?>
      </div>
    </div>
</section>

	<!-- script references -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/scripts.js"></script>
	</body>
</html>