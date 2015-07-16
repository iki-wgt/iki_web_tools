<script type="text/javascript" type="text/javascript">
	function projectPoint(point, projMatrix) {	// projMatrix is a 12 element vector representing the 3x4 matrix, point is of type geometry_msgs/Point
		//x = 
	}

  var projectionMatrix;
  var cameraInfoListener = new ROSLIB.Topic({
    ros : ros,
    name : '/camera/rgb/camera_info',
    messageType : 'sensor_msgs/CameraInfo'
  });

  cameraInfoListener.subscribe(function(message) {
  	projectionMatrix = message.P;
    console.log('Received message on ' + listener.name + ': ' + P);
    listener.unsubscribe();
  });

  var objectListener = new ROSLIB.Topic({
    ros : ros,
    name : '/recognized_object_array',
    messageType : 'object_recognition_msgs/RecognizedObjectArray'
  });

  objectListener.subscribe(function(message) {
    for (var object in message.objects) {
      if (object.type.key != 'table') {
        console.log('Saw object with key: ' + object.type.key);

      }
  //    for (j = 0; j < object..length; j++) {
//pose.pose.pose.position
    //  }
    }
  });
</script>
<img src="http://192.168.5.2:8080/stream?topic=/camera/rgb/image_rect_color&type=mjpeg"></img>
