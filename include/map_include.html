<script>
  var gridClient;
  var testVar = 3;
  /**
   * Setup all visualization elements when the page is loaded. 
   */
  function init() {
    // Connect to ROS.
    var ros = new ROSLIB.Ros({
      url : 'ws://192.168.5.2:9090'
    });

    // Create the main viewer.
    var viewer = new ROS2D.Viewer({
      divID : 'map',
      width : 992,
      height : 544
    });

    var zoomView = new ROS2D.ZoomView({
      rootObject : viewer.scene
    });

    // Setup the map client.
    gridClient = new NAV2D.OccupancyGridClientNav({
      ros : ros,
      rootObject : viewer.scene,
      viewer : viewer,
      withOrientation : true
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
  }

  function cancel() {
    gridClient.navigator.cancelGoal();
  }

  
</script>
<style type="text/css">
   .btn-xlarge {
    padding: 48px 68px;
    font-size: 62px; //change this to your desired size
    line-height: normal;
    -webkit-border-radius: 18px;
       -moz-border-radius: 18px;
            border-radius: 18px;
  }
  </style>

  <div id="map" onload="init()"></div>
  <button class="btn btn-default btn-xlarge" role="submit" onclick="cancel()">Abbrechen</a>

  <script type="text/javascript">
    var myimage = document.getElementById("map");
  if (myimage.addEventListener) {
    // IE9, Chrome, Safari, Opera
    myimage.addEventListener("mousewheel", MouseWheelHandler, false);
    //myimage.onmousewheel = MouseWheelHandler;
    // Firefox
    myimage.addEventListener("DOMMouseScroll", MouseWheelHandler, false);
  }
  // IE 6/7/8
  else myimage.attachEvent("onmousewheel", MouseWheelHandler);

  function MouseWheelHandler(e) {
    // cross-browser wheel delta
    var e = window.event || e; // old IE support
    var delta = Math.max(-1, Math.min(1, (e.wheelDelta || -e.detail)));

    console.log('mousewheel delta ' + delta);
    console.log('testVar ' + testVar);

    return false;
  }
  </script>