

<script type="text/javascript" type="text/javascript">
  $(document).ready(function(){
  //function init() {
    /*var ros = new ROSLIB.Ros({
      url : 'ws://192.168.5.2:9090'
    });*/

    var viewer = new ROS3D.Viewer({
        divID : 'urdf',
        width : window.innerWidth,
        height : window.innerHeight,
        antialias : true
    });
    viewer.addObject(new ROS3D.Grid());


    var tfClient = new ROSLIB.TFClient({
      ros : ros,
      angularThres : 0.01,
      transThres : 0.01,
      rate : 10.0,
      fixedFrame: 'odom_combined',
      serverName : 'tf2_web_republisher'
    });

    new ROS3D.UrdfClient({
      ros : ros,
      tfClient : tfClient,
      //param : 'robot_description',
      path : 'http://192.168.5.2/',
      rootObject : viewer.scene,
      loader :  ROS3D.COLLADA_LOADER
    });

    // Setup the marker client.
    var gridClient = new ROS3D.OccupancyGridClient({
      ros : ros,
      tfClient : tfClient,
      rootObject : viewer.scene,
      topic : 'map'
    });

    gridClient.on('change', function() {
      console.log('Map changed');
    });

    // Setup the marker client.
    var imClientPTU = new ROS3D.InteractiveMarkerClient({
      ros : ros,
      tfClient : tfClient,
      topic : 'ptu/ptu_interactive_marker',
      camera : viewer.camera,
      rootObject : viewer.selectableObjects
    });

    // Setup the marker client.
    var imClientMPO = new ROS3D.InteractiveMarkerClient({
      ros : ros,
      tfClient : tfClient,
      topic : 'mpo700_interactive_teleop',
      camera : viewer.camera,
      rootObject : viewer.selectableObjects
    });

    var imClientObject = new ROS3D.InteractiveMarkerClient({
      ros : ros,
      tfClient : tfClient,
      topic : 'interactive_object_markers',
      camera : viewer.camera,
      rootObject : viewer.selectableObjects,
      menuFontSize : '2em',
      path : 'http://192.168.5.2/'
    });

    var laserClient = new ROS3D.LaserScan({
      ros : ros,
      topic : 'scan_front',
      tfClient : tfClient,
      rootObject : viewer.scene
    });

    var laserClientRear = new ROS3D.LaserScan({
      ros : ros,
      topic : 'scan_rear',
      tfClient : tfClient,
      rootObject : viewer.scene
    });

    var pathClient = new ROS3D.Path({
      ros : ros,
      topic : 'move_base/NavfnROS/plan',
      tfClient : tfClient,
      rootObject : viewer.scene
    });

    var poseArrayClient = new ROS3D.PoseArray({
      ros : ros,
      topic : 'particlecloud',
      tfClient : tfClient,
      rootObject : viewer.scene,
      length : 0.2,
      color : 0xff0000
    });

    // Setup Kinect DepthCloud stream
    /*depthCloud = new ROS3D.DepthCloud({
      url : 'http://192.168.5.2:8080/stream?topic=/depthcloud_encoded&type=vp8&bitrate=250000&quality=best',
      f : 525.0
    });
    depthCloud.startStream();

    // Create Kinect scene node
    var kinectNode = new ROS3D.SceneNode({
      frameID : '/camera_rgb_optical_frame',
      tfClient : tfClient,
      object : depthCloud
    });
    viewer.scene.add(kinectNode);*/

    ros.on('connection', function() {
      console.log('Connected to websocket server.');
    });

    ros.on('error', function(error) {
      console.log('Error connecting to websocket server: ', error);
    });

    ros.on('close', function() {
      console.log('Connection to websocket server closed.');
    });
  });
</script>

<div id="urdf"></div>


