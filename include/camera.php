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
<script type="text/javascript" type="text/javascript">
  var projectionMatrix = [];
  var stage = new createjs.Stage("myCanvas");
  var elements = [];

	function projectPoint(point, projMatrix) {	// projMatrix is a 12 element vector representing the 3x4 matrix, point is of type geometry_msgs/Point
		u = projMatrix[0] * point.x + projMatrix[1] * point.y + projMatrix[2] * point.z + projMatrix[3];
    v = projMatrix[4] * point.x + projMatrix[5] * point.y + projMatrix[6] * point.z + projMatrix[7];
    w = projMatrix[8] * point.x + projMatrix[9] * point.y + projMatrix[10] * point.z + projMatrix[11];

    x = u / w;
    y = v / w;

    return [x, y - 30];   // dirty hack. The origings of our models are at the bottom of the object. This puts the position a little bit more to the center.
	}

  function drawObject(object) {
    var handleClick = function(element) {
      return function(event) { 
        console.log('clicked element: ' + element.name);

        var desired_object = new ROSLIB.Message({data : element.name});
        desiredObjPub.publish(desired_object);
      }
    }

    var coords = projectPoint(object.pos, projectionMatrix);

    var container = new createjs.Container();
    container.x = coords[0];
    container.y = coords[1];
    stage.addChild(container);
    object.container = container;

    var text = new createjs.Text(object.name, "30px Arial", "rgba(255, 255, 255, 1.0)");
    text.textAlign = "center";
    text.textBaseline = 'top';
    text.y = object.radius;
    container.addChild(text);

    var circle = new createjs.Shape();
    circle.graphics.beginFill("rgba(255, 255, 255, 0.5)").drawCircle(0, 0, object.radius);
    
    container.addEventListener("click", handleClick(object));
    container.addChild(circle);
    
    stage.update();
  }

  function objectCallback(message) {
    // clear everything
    stage.removeAllChildren();
    elements = [];
    console.log('In object callback');
    var i;
    for (i = 0; i < message.objects.length; i++) {
      if (message.objects[i].type.key != 'table') {
        console.log('Saw object with key: ' + message.objects[i].type.key);

        if (projectionMatrix.length == 12) {
          var radius = 30;

          // get the name of the object
          var request = new ROSLIB.ServiceRequest({
            type : {
              key : message.objects[i].type.key,
              db : message.objects[i].type.db
            }
          });

          var push_name = function(pose, radius, key) {
            return function(result) {
              if(typeof invTfTransform != 'undefined') {
                var pose2 = new ROSLIB.Pose(pose);
                
                var transPos = pose2.clone();
                transPos.applyTransform(tfTransform);
              }

              element = {
                name : result.information.name,
                pos : pose.position,
                radius : radius,
                key : key,
                header : result.header,
                worldPose : transPos,
                container : {}
              }

              elements.push(element);

              drawObject(element);
            };
          };

          objectInfoClient.callService(request, push_name(message.objects[i].pose.pose.pose, radius, message.objects[i].type.key));
          
        } else {
          console.log('No valid projection matrix yet!');
        }
      }
    }
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
    messageType : 'object_recognition_msgs/RecognizedObjectArray',
    queue_length : 1
  });

  var tfClient = new ROSLIB.TFClient({
    ros : ros,
    angularThres : 0.01,
    transThres : 0.01,
    rate : 10.0,
    fixedFrame: 'odom_combined'
  });

  var tfTransform, invTfTransform;
  tfClient.subscribe('/camera_rgb_optical_frame', function(transformMsg) {

    tfTransform = new ROSLIB.Transform(transformMsg);
    
    // from InteractiveMarkerHandle.js
    invTfTransform = this.tfTransform.clone();
    invTfTransform.rotation.invert();
    invTfTransform.translation.multiplyQuaternion(invTfTransform.rotation);
    invTfTransform.translation.x *= -1;
    invTfTransform.translation.y *= -1;
    invTfTransform.translation.z *= -1;

    elements.forEach(function(element) {
      var new_pose = element.worldPose.clone();
      new_pose.applyTransform(invTfTransform);
      element.pos = new_pose.position;

      if (typeof element.container != 'undefined') {
        var coords = projectPoint(element.pos, projectionMatrix);
        element.container.x = coords[0];
        element.container.y = coords[1];
      }
    })
    stage.update();
  })

  cameraInfoListener.subscribe(function(message) {
  	projectionMatrix = message.P;
    console.log('Received message on ' + cameraInfoListener.name + ': ' + projectionMatrix);
    cameraInfoListener.unsubscribe();
    
    // this needs to be here, outside this callback we can't assure that we have the projection matrix
    objectListener.subscribe(objectCallback);
  });

  function detectObjects() {
    var orClient = new ROSLIB.ActionClient({
      ros : ros,
      serverName : '/recognize_objects',
      actionName : 'object_recognition_msgs/ObjectRecognitionAction'
    });
    console.log('clicked button');
    var goal = new ROSLIB.Goal({
      actionClient : orClient,
      goalMessage : {
        use_roi : false,
        filter_limits : []
      }
    });

    goal.on('result', function(result) {
      console.log('Final Result: ');
    });

    goal.send();
  }

  var maxPanParam = new ROSLIB.Param({
    ros : ros,
    name : 'ptu/max_pan'
  });

  var minPanParam = new ROSLIB.Param({
    ros : ros,
    name : 'ptu/min_pan'
  });

  var maxTiltParam = new ROSLIB.Param({
    ros : ros,
    name : 'ptu/max_tilt'
  });

  var minTiltParam = new ROSLIB.Param({
    ros : ros,
    name : 'ptu/min_tilt'
  });

  var maxPan, minPan, maxTilt, minTilt;

  maxPanParam.get(function(value) {maxPan = value;});
  minPanParam.get(function(value) {minPan = value;});
  maxTiltParam.get(function(value) {maxTilt = value;});
  minTiltParam.get(function(value) {minTilt = value;});

  function movePTU(direction) {
    var ptuJointStateListener = new ROSLIB.Topic({
      ros : ros,
      name : '/ptu/joint_states',
      messageType : 'sensor_msgs/JointState'
    });

    var ptuCmdPublisher = new ROSLIB.Topic({
      ros : ros,
      name : '/ptu/cmd',
      messageType : 'sensor_msgs/JointState'
    });

    ptuJointStateListener.subscribe(function(message) {
      ptuJointStateListener.unsubscribe();
      
      var panIndex = -1;
      var tiltIndex = -1;

      if (message.name[0] == 'ptu_pan') {
        panIndex = 0;
        tiltIndex = 1;
      } else {
        panIndex = 1;
        tiltIndex = 0;
      }

      switch (direction) {
        case 'up':
          message.position[tiltIndex] += 0.1;
          message.position[panIndex] *= -1.0;   // the PTU driver somehow inverts the pan joint positions
          if (message.position[tiltIndex] > maxTilt) {message.position[tiltIndex] = maxTilt;};
          break;
        case 'left':
          message.position[panIndex] = message.position[panIndex] * -1.0 + 0.1;
          if (message.position[tiltIndex] > maxPan) {message.position[tiltIndex] = maxPan;};
          break;
        case 'right':
          message.position[panIndex] = message.position[panIndex] * -1.0 - 0.1;
          if (message.position[tiltIndex] < minPan) {message.position[tiltIndex] = minPan;};
          break;
        case 'down':
          message.position[tiltIndex] -= 0.1;
          message.position[panIndex] *= -1.0;
          if (message.position[tiltIndex] < minTilt) {message.position[tiltIndex] = minTilt;};
          break;
        default:
          console.log("default block of switch statement shouldn't be reached! Valid directions: up, left, right, down");
      }

      message.header = {};
      message.velocity = [0.5, 0.5];

      ptuCmdPublisher.publish(message);
    })
  }
</script>

<div>
<div style="position: absolute; left: 80px" onclick="movePTU('up')">
  <img src="img/arrow_up.png" />
</div>
<div style="position: absolute; top: 80px" onclick="movePTU('left')">
  <img src="img/arrow_left.png" />
</div>
<div style="position: absolute; top: 80px; left: 720px" onclick="movePTU('right')">
  <img src="img/arrow_right.png" />
</div>
<div style="position: absolute; top: 80px; left: 80px">
  <div style="position: absolute; z-index:100"><img src="http://192.168.5.2:8080/stream?topic=/camera/rgb/image_rect_color&type=mjpeg"></img></div>
  <div style="position: absolute; z-index:5000" id="canvasDiv"><canvas id="myCanvas" width="640" height="480"></canvas></div>
</div>
<div style="position: absolute; top: 560px; left: 80px" onclick="movePTU('down')">
  <img src="img/arrow_down.png" />
</div>
</div>

<div style="position: absolute; top: 640px">
  <button class="btn btn-default btn-xlarge" role="submit" onclick="detectObjects()">Objekte erkennen</button>
</div>