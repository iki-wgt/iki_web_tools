<script type="text/javascript" type="text/javascript">
  var projectionMatrix = [];
  var canvas = document.getElementById('myCanvas');
  var context = canvas.getContext('2d');
  var elements = [];

  canvas.addEventListener('click', function(event) {
    var canvasPos = canvas.getBoundingClientRect();
    
    var x = event.pageX - canvasPos.left,
        y = event.pageY - canvasPos.top;
    elements.forEach(function(element) {
      var euclidDistance = Math.sqrt(Math.pow(x - element.coordinates[0], 2) + Math.pow(y - element.coordinates[1], 2));
      if (euclidDistance <= element.radius) {
        console.log('clicked element: ' + element.name);

        var desired_object = new ROSLIB.Message({data : element.name});
        desiredObjPub.publish(desired_object);
      }
    });
  }, false);

	function projectPoint(point, projMatrix) {	// projMatrix is a 12 element vector representing the 3x4 matrix, point is of type geometry_msgs/Point
		u = projMatrix[0] * point.x + projMatrix[1] * point.y + projMatrix[2] * point.z + projMatrix[3];
    v = projMatrix[4] * point.x + projMatrix[5] * point.y + projMatrix[6] * point.z + projMatrix[7];
    w = projMatrix[8] * point.x + projMatrix[9] * point.y + projMatrix[10] * point.z + projMatrix[11];

    x = u / w;
    y = v / w;

    return [x, y - 30];   // dirty hack. The origings of our models are at the bottom of the object. This puts the position a little bit more to the center.
	}

  var objectInfoClient = new ROSLIB.Service({
    ros : ros,
    name : '/get_object_info',
    serviceType : 'object_recognition_msgs/GetObjectInformation'
  });

  var desiredObjPub = new ROSLIB.Topic({
    ros : ros,
    name : '/desired_object',
    messageType : 'std_msgs/String'
  });
  
  var cameraInfoListener = new ROSLIB.Topic({
    ros : ros,
    name : '/camera/rgb/camera_info',
    messageType : 'sensor_msgs/CameraInfo'
  });

  var objectListener = new ROSLIB.Topic({
    ros : ros,
    name : '/recognized_object_array',
    messageType : 'object_recognition_msgs/RecognizedObjectArray'
  });

  cameraInfoListener.subscribe(function(message) {
  	projectionMatrix = message.P;
    console.log('Received message on ' + cameraInfoListener.name + ': ' + projectionMatrix);
    cameraInfoListener.unsubscribe();
    
    // this needs to be here, outside this callback we can't assure that we have the projection matrix
    objectListener.subscribe(function(message) {
      // clear everything
      context.clearRect(0, 0, canvas.width, canvas.height);
      elements = [];

      var i;
      for (i = 0; i < message.objects.length; i++) {
        if (message.objects[i].type.key != 'table') {
          console.log('Saw object with key: ' + message.objects[i].type.key);

          if (projectionMatrix.length == 12) {
            var coords = projectPoint(message.objects[i].pose.pose.pose.position, projectionMatrix);
            var radius = 30;

            // get the name of the object
            var request = new ROSLIB.ServiceRequest({
              type : {
                key : message.objects[i].type.key,
                db : message.objects[i].type.db
              }
            });

            var push_name = function(coords, radius, key) {
              return function(result) {
                elements.push({
                  name: result.information.name,
                  coordinates: coords,
                  radius: radius,
                  key: key
                });

                context.beginPath();
                context.arc(coords[0], coords[1], radius, 0, 2 * Math.PI, false);
                context.fillStyle = "rgba(255, 255, 255, 0.5)";
                context.fill();

                context.font = "30px Arial";
                context.fillStyle = "rgba(255, 255, 255, 1.0)";
                context.textAlign = "center";
                context.textBaseline = 'top';
                context.fillText(result.information.name, coords[0], coords[1] + radius);
              };
            };

            objectInfoClient.callService(request, push_name(coords, radius, message.objects[i].type.key));

            
          } else {
            console.log('No valid projection matrix yet!');
          }
        }
      }
    });
  });

  

  

  
</script>

<div id="parentDiv">
<div style="position: absolute; z-index:100"><img src="http://192.168.5.2:8080/stream?topic=/camera/rgb/image_rect_color&type=mjpeg"></img></div>
<div style="position: absolute; z-index:5000" id="canvasDiv"><canvas id="myCanvas" width="640" height="480"></canvas></div>

</div>