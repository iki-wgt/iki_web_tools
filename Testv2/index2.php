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

    <title>Marvin User Interface</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="css/styles.css" />

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
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
        <script type="text/javascript" src="js/iki_robot.js"></script> <!-- ros has to be defined for this script -->
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
</head>

<body>

    <!-- Navigationsleiste -->
    <a id="menu-toggle" href="#" class="btn btn-dark btn-lg toggle"><i class="fa fa-bars"></i></a>
    <nav id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <a id="menu-close" href="#" class="btn btn-light btn-lg pull-right toggle"><i class="fa fa-times"></i></a>
            <li class="sidebar-brand">
                <a href="#top"  onclick = $("#menu-close").click(); >Marvin</a>
            </li>
            <li>
                <a href="#start" onclick = $("#menu-close").click(); >Start</a>
            </li>
            <li>
                <a href="#sprache" onclick = $("#menu-close").click(); >Sprache</a>
            </li>
            <li>
                <a href="#navigation" onclick = $("#menu-close").click(); >Navigation</a>
            </li>
            <li>
                <a href="#hand" onclick = $("#menu-close").click(); >Hand steuern</a>
            </li>
            <li>
                <a href="#kamera" onclick = $("#menu-close").click(); >Kamera</a>
            </li>
        </ul>
    </nav>

    <!-- Start -->
    <header id="start" class="start">
        <div class="text-vertical-center">
            <div class="container-fluid">
      <div class="row">
          <div class="col-sm-3">
            <div class="row">
              <a href="#sprache"><div class="col-sm-10 col-sm-offset-1 text-center"><img class="iconCircle" src="img/talk11.png">
              <h1>Sprache</h1></div></a>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="row">
              <a href="#navigation"><div class="col-sm-10 col-sm-offset-1 text-center"><img class="iconCircle" src="img/compass68.png">
              <h1>Navigation</h1></div></a>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="row">
              <a href="#hand"><div class="col-sm-10 col-sm-offset-1 text-center"><img class="iconCircle" src="img/factory26.png">
              <h1>Hand steuern</h1></div></a>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="row">
              <a href="#kamera"><div class="col-sm-10 col-sm-offset-1 text-center"><img class="iconCircle" src="img/security50.png">
              <h1>Kamera</h1></div></a>
            </div>
          </div>
      </div><!--/row-->
  </div><!--/container-->
        </div>
    </header>

    <!-- Sprache -->
    <section id="sprache" class="sprache">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text-center">
                  <h1>Was soll Marvin sagen?</h1>
                  <br>
                  <?php include 'include/speech.php';?>
	  			</div>
  			</div>
        </div> <!-- /.container -->
    </section>

    <!-- Navigation -->
    <!-- The circle icons use Font Awesome's stacked icon classes. For more information, visit http://fontawesome.io/examples/ -->
    <section id="navigation" class="navigation bg-primary">
        <div class="container">
            <div class="row">
            	<div class="col-sm-8 col-sm-offset-2 text-center">
        	        <h1>Wohin soll Marvin navigieren?</h1>
                    <br>
                    <?php include 'include/navigation.php';?>
                </div>
    		</div>
        </div>  <!-- /.container -->
    </section>

    <!-- Callout -->
    <aside class="callout">
        <div class="text-vertical-center">
            <h1>Vertically Centered Text</h1>
        </div>
    </aside>

    <!-- Portfolio -->
    <section id="hand" class="portfolio">
        <div class="container">
            <div class="row">
            	<div class="col-sm-6">
                	<div class="row" onclick="gripper_control(0.0)">
                    	<div class="col-sm-12 col-sm-offset-1 text-center"><img class="iconCircle" src="img/factory26.png">
                      		<h1>Hand öffnen</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-5">
                	<div class="row" onclick="gripper_control(0.7)">
                    	<div class="col-sm-10 col-sm-offset-1 text-center"><img class="iconCircle" src="img/factory26.png">
                      		<h1>Hand schlie&szlig;en</h1>
                        </div>
                    </div>
                </div>
      		</div><!--/row-->
        </div>
        <!-- /.container -->
    </section>

    <!-- Call to Action -->
    <aside class="call-to-action bg-primary">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h3>The buttons below are impossible to resist.</h3>
                    <a href="#" class="btn btn-lg btn-light">Click Me!</a>
                    <a href="#" class="btn btn-lg btn-dark">Look at Me!</a>
                </div>
            </div>
        </div>
    </aside>

    <!-- Map -->
    <section id="kamera" class="map">
        <iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Twitter,+Inc.,+Market+Street,+San+Francisco,+CA&amp;aq=0&amp;oq=twitter&amp;sll=28.659344,-81.187888&amp;sspn=0.128789,0.264187&amp;ie=UTF8&amp;hq=Twitter,+Inc.,+Market+Street,+San+Francisco,+CA&amp;t=m&amp;z=15&amp;iwloc=A&amp;output=embed"></iframe>
        <br />
        <small>
            <a href="https://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=Twitter,+Inc.,+Market+Street,+San+Francisco,+CA&amp;aq=0&amp;oq=twitter&amp;sll=28.659344,-81.187888&amp;sspn=0.128789,0.264187&amp;ie=UTF8&amp;hq=Twitter,+Inc.,+Market+Street,+San+Francisco,+CA&amp;t=m&amp;z=15&amp;iwloc=A"></a>
        </small>
        </iframe>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1 text-center">
                    <h4><strong>Marvin</strong>
                    </h4>
                    <p>Hochschule Ravensburg-Weingarten, 88250 Weingarten, Germany</p>
                    <ul class="list-unstyled">
                        <li><i class="fa fa-phone fa-fw"></i> (123) 456-7890</li>
                        <li><i class="fa fa-envelope-o fa-fw"></i>  <a href="mailto:marvin@hs-weingarten.de">marvin@hs-weingarten.de</a>
                        </li>
                    </ul>
                    <br>
                    <ul class="list-inline">
                        <li>
                            <a href="#"><i class="fa fa-facebook fa-fw fa-3x"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-twitter fa-fw fa-3x"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-dribbble fa-fw fa-3x"></i></a>
                        </li>
                    </ul>
                    <hr class="small">
                    <p class="text-muted">Copyright &copy; Hochschule Ravensburg-Weingarten 2015</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script>
    // Closes the sidebar menu
    $("#menu-close").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });

    // Opens the sidebar menu
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });

    // Scrolls to the selected menu item on the page
    $(function() {
        $('a[href*=#]:not([href=#])').click(function() {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {

                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });
    });
    </script>

</body>

</html>
