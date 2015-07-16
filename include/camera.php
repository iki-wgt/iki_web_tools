<script type="text/javascript" type="text/javascript">
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
    console.log('Received message on ' + listener.name + ': ' + message.objects[0].type.key);
  });
</script>
<img src="http://192.168.5.2:8080/stream?topic=/camera/rgb/image_rect_color&type=mjpeg"></img>
