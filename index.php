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
		<link rel="stylesheet" type="text/css" href="css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="css/icons.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<link rel="stylesheet" type="text/css" href="css/custom.css" />
		<script src="js/modernizr.custom.js"></script>
		<script src="js/jquery-2.1.3.min.js"></script>
		
		<script type="text/javascript" src="http://cdn.robotwebtools.org/EventEmitter2/current/eventemitter2.js"></script>
		<script type="text/javascript" src="http://cdn.robotwebtools.org/roslibjs/current/roslib.js"></script>
		<script type="text/javascript" src="http://cdn.robotwebtools.org/threejs/r61/three.js"></script>
		<script type="text/javascript" src="http://cdn.robotwebtools.org/threejs/r61/ColladaLoader.js"></script>
		<script type="text/javascript" src="http://cdn.robotwebtools.org/threejs/r61/STLLoader.js"></script>
		<script type="text/javascript" src="http://cdn.robotwebtools.org/ros3djs/current/ros3d.js"></script>

		<script type="text/javascript" type="text/javascript">
		  var ros = new ROSLIB.Ros({
			url : 'ws://192.168.5.2:9090'
		  });
		 </script>
	</head>
	
	<?php
		ini_set('error_reporting', E_ALL);

		$tasklist = array(
			array("id","name","icon")
		);
		
		function buildMenu($tasklist,$backlinks=true){
			$menu = '';
			foreach ($tasklist as $task){
			  $menu += '<ul>';
			}
			return $menu;
		}
	?>
	
	<body>
	
		<div class="container">
		
			<!-- Push Wrapper -->
			<div class="mp-pusher" id="mp-pusher">
				<!-- mp-menu -->
				<div id="content">fasdfxxxxxxxxxxxxxxxxxxxxxx</div>
				<nav id="mp-menu" class="mp-menu">
					
					<div class="mp-level">
						<h2 class="icon icon-world">Robot Control</h2>
						
						<?php buildMenu($tasklist); ?>
						<ul>
							<li><a id="testx" href="#">sayTest</a></li>
							<li><a id="testx2" href="#">mapTest</a></li>
						</ul>
						<ul>
							<li class="icon icon-arrow-left">
								<a class="icon icon-display" href="#">Aufgaben</a>
								<div class="mp-level">
									<h2 class="icon icon-display">Aufgaben</h2>
									<a class="mp-back" href="#">zurück</a>
									<ul>
										<li>
											<a href="#">Wasser holen</a>
										</li>
										<li class="icon icon-arrow-left">
											<a class="icon icon-tv" href="#">Televisions</a>
											<div class="mp-level">
												<h2>Televisions</h2>
												<a class="mp-back" href="#">back</a>
												<ul>
													<li><a href="#">Flat Superscreen</a></li>
													<li><a href="#">Gigantic LED</a></li>
													<li><a href="#">Power Eater</a></li>
													<li><a href="#">3D Experience</a></li>
													<li><a href="#">Classic Comfort</a></li>
												</ul>
											</div>
										</li>
										<li class="icon icon-arrow-left">
											<a class="icon icon-camera" href="#">Cameras</a>
											<div class="mp-level">
												<h2>Cameras</h2>
												<a class="mp-back" href="#">back</a>
												<ul>
													<li><a href="#">Smart Shot</a></li>
													<li><a href="#">Power Shooter</a></li>
													<li><a href="#">Easy Photo Maker</a></li>
													<li><a href="#">Super Pixel</a></li>
												</ul>
											</div>
										</li>
									</ul>
								</div>
							</li>
						</ul>
						<!--
						<ul>
							<li class="icon icon-arrow-left">
								<a class="icon icon-display" href="#">Devices</a>
								<div class="mp-level">
									<h2 class="icon icon-display">Devices</h2>
									<ul>
										<li class="icon icon-arrow-left">
											<a class="icon icon-phone" href="#">Mobile Phones</a>
											<div class="mp-level">
												<h2>Mobile Phones</h2>
												<ul>
													<li><a href="#">Super Smart Phone</a></li>
													<li><a href="#">Thin Magic Mobile</a></li>
													<li><a href="#">Performance Crusher</a></li>
													<li><a href="#">Futuristic Experience</a></li>
												</ul>
											</div>
										</li>
										<li class="icon icon-arrow-left">
											<a class="icon icon-tv" href="#">Televisions</a>
											<div class="mp-level">
												<h2>Televisions</h2>
												<ul>
													<li><a href="#">Flat Superscreen</a></li>
													<li><a href="#">Gigantic LED</a></li>
													<li><a href="#">Power Eater</a></li>
													<li><a href="#">3D Experience</a></li>
													<li><a href="#">Classic Comfort</a></li>
												</ul>
											</div>
										</li>
										<li class="icon icon-arrow-left">
											<a class="icon icon-camera" href="#">Cameras</a>
											<div class="mp-level">
												<h2>Cameras</h2>
												<ul>
													<li><a href="#">Smart Shot</a></li>
													<li><a href="#">Power Shooter</a></li>
													<li><a href="#">Easy Photo Maker</a></li>
													<li><a href="#">Super Pixel</a></li>
												</ul>
											</div>
										</li>
									</ul>
								</div>
							</li>
							<li class="icon icon-arrow-left">
								<a class="icon icon-news" href="#">Magazines</a>
								<div class="mp-level">
									<h2 class="icon icon-news">Magazines</h2>
									<ul>
										<li><a href="#">National Geographic</a></li>
										<li><a href="#">Scientific American</a></li>
										<li><a href="#">The Spectator</a></li>
										<li><a href="#">The Rambler</a></li>
										<li><a href="#">Physics World</a></li>
										<li><a href="#">The New Scientist</a></li>
									</ul>
								</div>
							</li>
							<li class="icon icon-arrow-left">
								<a class="icon icon-shop" href="#">Store</a>
								<div class="mp-level">
									<h2 class="icon icon-shop">Store</h2>
									<ul>
										<li class="icon icon-arrow-left">
											<a class="icon icon-t-shirt" href="#">Clothes</a>
											<div class="mp-level">
												<h2 class="icon icon-t-shirt">Clothes</h2>
												<ul>
													<li class="icon icon-arrow-left">
														<a class="icon icon-female" href="#">Women's Clothing</a>
														<div class="mp-level">
															<h2>Women's Clothing</h2>
															<ul>
																<li><a href="#">Tops</a></li>
																<li><a href="#">Dresses</a></li>
																<li><a href="#">Trousers</a></li>
																<li><a href="#">Shoes</a></li>
																<li><a href="#">Sale</a></li>
															</ul>
														</div>
													</li>
													<li class="icon icon-arrow-left">
														<a class="icon icon-male" href="#">Men's Clothing</a>
														<div class="mp-level">
															<h2>Men's Clothing</h2>
															<ul>
																<li><a href="#">Shirts</a></li>
																<li><a href="#">Trousers</a></li>
																<li><a href="#">Shoes</a></li>
																<li><a href="#">Sale</a></li>
															</ul>
														</div>
													</li>
												</ul>
											</div>
										</li>
										<li>
											<a class="icon icon-diamond" href="#">Jewelry</a>
										</li>
										<li>
											<a class="icon icon-music" href="#">Music</a>
										</li>
										<li>
											<a class="icon icon-food" href="#">Grocery</a>
										</li>
									</ul>
								</div>
							</li>
							<li><a class="icon icon-photo" href="#">Collections</a></li>
							<li><a class="icon icon-wallet" href="#">Credits</a></li>
						</ul>
						-->
					</div>
				</nav>
				<!-- /mp-menu -->

				<h2><a href="#" id="trigger_menu" class="menu-trigger icon icon-params"> </a></h2>
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
			$("#content").load("task3.html");
			
		    $("#testx").click(function(){
		        $("#content").load("say2.html");
		    });
		    $("#testx2").click(function(){
		        $("#content").load("task3.html");
		    });
		});
		</script>
	</body>
</html>