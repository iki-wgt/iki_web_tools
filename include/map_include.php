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

  <div id="map"></div>
  <button class="btn btn-default btn-xlarge" role="submit" onclick="cancel()">Abbrechen</a>

  <script type="text/javascript">
    // Create the main viewer.
  var viewer = new ROS2D.Viewer({
    divID : 'map',
    //topic : 'map_metadata',
    width : 992,
    height : 544
  });

  var zoomView = new ROS2D.ZoomView({
    rootObject : viewer.scene
  });

  // Setup the map client.
  var gridClient = new NAV2D.OccupancyGridClientNav({
    ros : ros,
    rootObject : viewer.scene,
    viewer : viewer,
    withOrientation : true,
    topic : '/marvin/map',
    serverName : '/marvin/move_base',
    robot_pose : '/marvin/robot_pose'
  });

  function cancel() {
    gridClient.navigator.cancelGoal();
  }

  var myimage = viewer.scene.canvas;//document.getElementById("map");
  if (myimage.addEventListener) {
    // IE9, Chrome, Safari, Opera
    myimage.addEventListener("mousewheel", MouseWheelHandler, false);
    // Firefox
    myimage.addEventListener("DOMMouseScroll", MouseWheelHandler, false);
  }
  // IE 6/7/8
  else myimage.attachEvent("onmousewheel", MouseWheelHandler);

  var zoomLevel = 20;

  function MouseWheelHandler(e) {
    // cross-browser wheel delta
    var delta = Math.max(-1, Math.min(1, (e.wheelDelta || -e.detail)));

    if(delta > 0) {
      if(zoomLevel > 0) {
        zoomView.zoom(1.1);
        zoomLevel = zoomLevel - 1;
      }
    }
    else {
      if(zoomLevel < 20) {
        zoomView.zoom(1/1.1);
        zoomLevel = zoomLevel + 1;
      }
    }

    e.preventDefault();
    return false;
  }

  function getMousePos(canvas, evt) {
    var rect = canvas.getBoundingClientRect();
    return {
      x: evt.clientX - rect.left,
      y: evt.clientY - rect.top
    };
  }

  viewer.scene.canvas.addEventListener('mousemove', function(evt) {
        var mousePos = getMousePos(viewer.scene.canvas, evt);

        zoomView.startZoom(mousePos.x, mousePos.y);
      }, false);
</script>