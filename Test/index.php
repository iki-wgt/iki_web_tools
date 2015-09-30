GITLABROS / iki_web_tools
  3e5e37be493f60613ec2e35c24562ff5?s=40&d=mm
robot_web_tools
Files
Commits
Network
Issues 1
Merge Requests 0
Wall
Wiki
bdecea807d58253eb7365b64942ab3460535d9b9

master
bdecea807d58253eb7365b64942ab3460535d9b9
Source
SSH HTTP 
iki_web_tools / Test / index.php
 index.php 8.14 KB edit raw blame history
   1
   2
   3
   4
   5
   6
   7
   8
   9
  10
  11
  12
  13
  14
  15
  16
  17
  18
  19
  20
  21
  22
  23
  24
  25
  26
  27
  28
  29
  30
  31
  32
  33
  34
  35
  36
  37
  38
  39
  40
  41
  42
  43
  44
  45
  46
  47
  48
  49
  50
  51
  52
  53
  54
  55
  56
  57
  58
  59
  60
  61
  62
  63
  64
  65
  66
  67
  68
  69
  70
  71
  72
  73
  74
  75
  76
  77
  78
  79
  80
  81
  82
  83
  84
  85
  86
  87
  88
  89
  90
  91
  92
  93
  94
  95
  96
  97
  98
  99
 100
 101
 102
 103
 104
 105
 106
 107
 108
 109
 110
 111
 112
 113
 114
 115
 116
 117
 118
 119
 120
 121
 122
 123
 124
 125
 126
 127
 128
 129
 130
 131
 132
 133
 134
 135
 136
 137
 138
 139
 140
 141
 142
 143
 144
 145
 146
 147
 148
 149
 150
 151
 152
 153
 154
 155
 156
 157
 158
 159
 160
 161
 162
 163
 164
 165
 166
 167
 168
 169
 170
 171
 172
 173
 174
 175
 176
 177
 178
 179
 180
 181
 182
 183
 184
 185
 186
 187
 188
 189
 190
 191
 192
 193
 194
 195
 196
 197
 198
 199
 200
 201
 202
 203
 204
 205
 206
 207
 208
 209
 210
 211
 212
 213
 214
 215
 216
 217
 218
 219
 220
 221
 222
 223
 224
 225
 226
 227
 228
 229
 230
 231
 232
 233
 234
 235
 236
 237
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
		
        <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css" />
		<link rel="stylesheet" type="text/css" href="css/icons.css" />
		<link rel="stylesheet" type="text/css" href="css/iki_robot.css" />
        <link rel="stylesheet" type="text/css" href="css/styles.css" />
		
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
		<script type="text/javascript" src="js/iki_robot.js"></script>
		
		<script type="text/javascript" type="text/javascript">
			var ros = new ROSLIB.Ros({
				url : 'ws://192.168.5.2:9090'
			});
			var ttsClient = new ROSLIB.ActionClient({
				ros : ros,
				serverName : 'TTS',
				actionName : 'cerevoice_tts_msgs/TtsAction'
			});

			var navClient = new ROSLIB.ActionClient({
					ros : ros,
					serverName : 'navigation_position_db_server/goto_position',
					actionName : 'marvin_navigation_tools/GotoPositionAction'
			});

			var navSaveClient = new ROSLIB.ActionClient({
				ros : ros,
				serverName : 'navigation_position_db_server/save_position',
				actionName : 'marvin_navigation_tools/SavePositionAction'
			});

			var gripperClient = new ROSLIB.ActionClient({
				ros : ros,
				serverName : 'jaco_arm_driver/gripper_action',
				actionName : 'control_msgs/GripperCommandAction'
			});

			var manipulationClient = new ROSLIB.ActionClient({
				ros : ros,
				serverName : 'arm_posture_action_server/goto_arm_posture',
				actionName : 'marvin_manipulation/GotoArmPostureAction'
			});

			var manipulationSaveClient = new ROSLIB.ActionClient({
				ros : ros,
				serverName : 'arm_posture_action_server/save_arm_posture',
				actionName : 'marvin_manipulation/SaveArmPostureAction'
			});
			var octomapClient = new ROSLIB.Service({
		       ros : ros,
		       name : 'clear_octomap',
		       serviceType : 'std_srvs/Empty'
			});
		 </script>
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
        <button class="btn btn-default" onclick="sayAndSave()" value="Say it" type="button">Sag es</button>
      </span>
      <div id="predefined">
			<h2>Gespeicherte Vorgaben:</h2>
			<?php echo buildPredefinedText($savedTextList); ?>
		</div>
    </div><!-- /input-group -->
    </p>
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