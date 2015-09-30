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
        
        <script type="text/javascript" src="http://cdn.robotwebtools.org/EventEmitter2/current/eventemitter2.js"></script>
<script type="text/javascript" src="http://cdn.robotwebtools.org/roslibjs/current/roslib.js"></script>
		
		<script type="text/javascript" src="js/eventemitter2.js"></script>
		<script type="text/javascript" src="js/roslib.js"></script>
		<script type="text/javascript" src="js/three.js"></script>
		<script type="text/javascript" src="js/ColladaLoader.js"></script>
		<script type="text/javascript" src="js/STLLoader.js"></script>
		<script type="text/javascript" src="js/ros3d.js"></script>
		<script type="text/javascript" src="js/easeljs.js"></script>
		<script type="text/javascript" src="js/ros2d.js"></script>
		<script type="text/javascript" src="js/nav2d.js"></script>
		<script type="text/javascript" src="js/iki_robot.js"></script>
        <script type="text/javascript" src="js/roslib_marvin.js"></script>
        <script type="text/javascript" src="js/roslib_marvin_speech.js"></script>
		<?php
		ini_set('error_reporting', E_ALL);

		$savedTextList = array(
				'hallo!',
				'danke',
				'ja',
				'nein',
				'kein problem.',
				'es tut mir leid. das kenne ich noch nicht.',
				'hallo, mein name ist marvin',
				'wie heisst du?',
				'das ist aber ein schöner name',
				'ich bin ein service-roboter prototyp',
				'darf ich dir eine tasse kaffee anbieten?',
				'&lt;spurt audio=\\\'g0001_026\\\'&gt;x&lt;/spurt&gt;',
				'&lt;prosody pitch=\\\'1.5\\\'&gt;Ich mag Helium Luftballons.&lt;/prosody&gt;',
				'&lt;prosody pitch=\\\'0.7\\\'&gt;Ich nicht.&lt;/prosody&gt;',
				'&lt;prosody pitch=\\\'1.5\\\'&gt;Ich mag Helium Luftballons.&lt;/prosody&gt;&lt;prosody pitch=\\\'0.7\\\'&gt;Ich nicht.&lt;/prosody&gt;&lt;spurt audio=\\\'g0001_026\\\'&gt;x&lt;/spurt&gt;. Ok jetzt aber zur&uuml;ck an die Arbeit!'
				
		);
		
		function buildPredefinedText($savedTextList){
			$html = '';
			foreach ($savedTextList as $text){
					$html .= '<div class="historyElement" onclick="say(\''.$text.'\')">'.$text.'</div>';
			}
			return $html;
		}
	?>

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
              <div class="col-sm-10 col-sm-offset-1 text-center"><a href="#section2"><img class="iconCircle" src="img/talk11.png">
              </a><h1>Sprache</h1></div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="row">
              <div class="col-sm-10 col-sm-offset-1 text-center"><a href="#section3"><img class="iconCircle" src="img/compass68.png">
              </a><h1>Navigation</h1></div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="row">
              <div class="col-sm-10 col-sm-offset-1 text-center"><a href="#section4"><img class="iconCircle" src="img/factory26.png">
              </a><h1>Hand steuern</h1></div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="row">
              <div class="col-sm-10 col-sm-offset-1 text-center"><a href="#section5"><img class="iconCircle" src="img/security50.png">
              </a><h1>Kamera</h1></div>
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
		<p class="lead">
        	<div class="input-group">
      			<input type="text" class="form-control" name="teststr" onkeypress="keyDetect(event)" placeholder="Hier bitte den Text eingeben...">
      			<span class="input-group-btn">
        			<button class="btn btn-default" onclick="sayAndSave()" type="button">Sag es</button>
				</span>
   			</div><!-- /input-group -->
    	</p>
        <div>
		<div id="history">
			<h2>Gerade eingegeben:</h2>
		</div>
		<div id="predefined">
			<h2>Gespeicherte Vorgaben:</h2>
			<?php echo buildPredefinedText($savedTextList); ?>
		</div>
	</div>
</div>
    </div>
  </div>
</section>

<section class="container-fluid" id="section3">
    <div class="row">
      <div class="col-sm-8 col-sm-offset-2 text-center">
        <h1>Wohin soll Marvin navigieren?</h1>
        <br>
		<p class="lead">
        <div class="input-group">
      <input type="text" class="form-control" placeholder="Hier bitte den Text eingeben...">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button">Navigiere</button>
      </span>
      </div>
   </div>
</section>

<section class="container-fluid" id="section4">
    <div class="row">
          <div class="col-sm-6">
            <div class="row">
              <div class="col-sm-12 col-sm-offset-1 text-center"><a href="#section2"><img class="iconCircle" src="img/factory26.png">
              </a><h1>Hand öffnen</h1></div>
            </div>
          </div>
          <div class="col-sm-5">
            <div class="row">
              <div class="col-sm-10 col-sm-offset-1 text-center"><a href="#section3"><img class="iconCircle" src="img/factory26.png">
              </a><h1>Hand schlie&szlig;en</h1></div>
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
        <script>
		
			function keyDetect( event ){
				if (event.keyCode == 13) {
					event.preventDefault();
					sayAndSave();
				}
			}
	
			function sayAndSave() {
				//document.getElementById("frm1").submit();
				say(document.forms["frm1"]["teststr"].value);
				$("#history").append('<div class="historyElement" onclick="say(\''+document.forms["frm1"]["teststr"].value+'\')">'+document.forms["frm1"]["teststr"].value+'</div>');
			}
		</script>
	</body>
</html>