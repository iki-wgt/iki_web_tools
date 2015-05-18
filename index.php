<!DOCTYPE html>
<html lang="en" class="no-js">
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
		
		<link rel="stylesheet" type="text/css" href="css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="css/icons.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<link rel="stylesheet" type="text/css" href="css/iki_robot.css" />
		
		
		<script src="js/modernizr.custom.js"></script>
		<script src="js/jquery-2.1.3.min.js"></script>
		
		<script type="text/javascript" src="js/eventemitter2.js"></script>
		<script type="text/javascript" src="js/roslib.js"></script>
		<script type="text/javascript" src="js/three.js"></script>
		<script type="text/javascript" src="js/ColladaLoader.js"></script>
		<script type="text/javascript" src="js/STLLoader.js"></script>
		<script type="text/javascript" src="js/ros3d.js"></script>
		<script type="text/javascript" src="js/ros2d.js"></script>
		<script type="text/javascript" src="js/nav2d.js"></script>
		<script type="text/javascript" src="js/iki_robot.js"></script>
		
		<script type="text/javascript" type="text/javascript">
			var ros = new ROSLIB.Ros({
				url : 'ws://192.168.5.2:9090'
			});
			var ttsClient = new ROSLIB.ActionClient({
				ros : ros,
				serverName : '/TTS',
				actionName : 'cerevoice_tts_msgs/TtsAction'
			});

			var navClient = new ROSLIB.ActionClient({
					ros : ros,
					serverName : '/navigation_position_db_server/goto_position',
					actionName : 'marvin_navigation_tools/GotoPositionAction'
			});

			var gripperClient = new ROSLIB.ActionClient({
				ros : ros,
				serverName : '/gripper_controller/gripper_action',
				actionName : 'control_msgs/GripperCommand'
			});
		 </script>

	</head>
	
	<?php
		ini_set('error_reporting', E_ALL);

		$tasklist = array(
				array("Karte","ajax","task3"),
				array("Sprache","ajax","say_form"),
				array("Karte2","ajax","map_include"),
				array("Navigation",
					array(
							array("Home","goto","home"),
							array("Kitchen1","goto","kitchen1"),
							array("Kitchen2","goto","kitchen2"),
							array("Table1","goto","table1"),
							array("Table2","goto","table2"),
							array("Small Table","goto","smalltable"),
							array("Sofa","goto","sofa"),
							array("Shelf","goto","shelf"),
							array("Speakpos","goto","speakpos"),
							array("Charging","goto","chargepos"),
							array("Change Battery","goto","changebatterypos"),
					)
				),
				array("grippertest","gripper",0.6),
				array("grippertest2","gripper",0.0),
				array("saytest","say","hallo"),
				array("ajaxtestmap","ajax","task3"),
				array("zwavetest","zwave","test"),
		);
		
		function buildMenu($tasklist,$backlinks=true){
			$menu = '';
			$menu .= '<ul>';
			foreach ($tasklist as $task){
				
				if (is_array($task[1])){
					$menu .= '
							<li class="icon icon-arrow-left">
								<a class="" href="#">'.$task[0].'</a>
								<div class="mp-level">
									<h2 class="">'.$task[0].'</h2>
									<a class="mp-back" href="#">zurück</a>
									';
					$menu .= buildMenu($task[1]);
					$menu .= '
								</div>
							</li>';
				}else{
					$menu .= '<li><a id="" class="" href="#" onclick="execute(\''.$task[1].'\',\''.$task[2].'\')">'.$task[0].'</a></li>';
					#$menu .= '<script>$("'.$task[0].'").click(function(){$("#content").load("say2.html");});</script>';
				}
				
			}
			$menu .= "</ul>";
			return $menu;
		}
	?>
	
	<body>
	
		<div class="main_wrapper">
			<!-- Push Wrapper -->
			<div class="mp-pusher" id="mp-pusher">
				
				<div id="content"></div>
				
				<!-- mp-menu -->
				<nav id="mp-menu" class="mp-menu">
					<div class="mp-level">
						<h2 class="icon icon-world">Robot Control</h2>
						<?php echo buildMenu($tasklist); ?>
					</div>
				</nav>
				<!-- /mp-menu -->

				<a href="#" id="trigger_menu" class="menu-trigger icon icon-params"> </a>
			</div><!-- /pusher -->
			
		</div><!-- /container -->
		
		<script src="js/classie.js"></script>
		<script src="js/mlpushmenu.js"></script>
		<script>
			// initialize the menu
			new mlPushMenu( document.getElementById( 'mp-menu' ), document.getElementById( 'trigger_menu' ) );
			//new mlPushMenu( document.getElementById( 'mp-menu' ), document.getElementById( 'trigger' ), {
			//	type : 'cover'
			//} );
		</script>
		
		<script>
		$(document).ready(function(){
			ajaxload('say_form');
			//ajaxload('task3');

		});
		</script>
	</body>
</html>