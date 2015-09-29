
function ajaxload(content){
	if (typeof objectListener != 'undefined') {
		objectListener.unsubscribe();
	}
	$("#content").load("include/"+content+".php");
}

function execute(task, data){
	if (task == "ajax"){
		ajaxload(data);
	}
	else if (task == "say"){
		say(data);
	}
	else if (task == "goto"){
		nav_goto(data);
	}
	else if (task == "gripper"){
		gripper_control(data);
	}
	else if (task == "manip"){
		manipulation_control(data);
	}
	else if (task == "clear_oct"){
		clear_octomap();
	}
}
	
function say(text_input) {
	console.log('Saying: ' + text_input);
	var goal = new ROSLIB.Goal({
		actionClient : ttsClient,
		goalMessage : {
		  voice : 'Alex',
		  text : text_input
		}
	});
	goal.on('result', function(result) {
		console.log('finished');
	});
	goal.send();
}

function nav_goto(place_goal){
	console.log('Navigate to: ' + place_goal);
	var goal = new ROSLIB.Goal({
		actionClient : navClient,
		goalMessage : {
		  room_name : 'lab',
		  pos_name : place_goal
		}
	});
	goal.on('result', function(result) {
		console.log('finished');
	});
	goal.send();
}

function nav_save(place_name){
	console.log('Save Landmark: ' + place_name);
	var goal = new ROSLIB.Goal({
		actionClient : navSaveClient,
		goalMessage : {
		  room_name : 'lab',
		  pos_name : place_name
		}
	});
	goal.on('result', function(result) {
		console.log('finished');
	});
	goal.send();
}

function gripper_control(position_goal){
	console.log('control gripper: ' + position_goal);
	
	var goal = new ROSLIB.Goal({
		actionClient : gripperClient,
		goalMessage : {
			command : {
				position : parseFloat(position_goal),
				max_effort: 0.1
				}
		} 
	});
	
	goal.on('result', function(result) {
		console.log('finished');
	});
	goal.send();
}

function manipulation_control(position_goal){
	console.log('control arm: ' + position_goal);
	
	var goal = new ROSLIB.Goal({
		actionClient : manipulationClient,
		goalMessage : {
				pose_name : position_goal
		} 
	});
	
	goal.on('result', function(result) {
		console.log('finished');
	});
	goal.send();
}

function manipulation_save_pose(position_name){
	console.log('saving pose: ' + position_name);
	
	var goal = new ROSLIB.Goal({
		actionClient : manipulationSaveClient,
		goalMessage : {
				pose_name : position_name
		} 
	});
	
	goal.on('result', function(result) {
		console.log('finished');
	});
	goal.send();
}

function clear_octomap(){
	console.log('clearing octomap');
	octomapClient.callService();
}
	
/*
function notused(){

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
	  fixedFrame: 'odom_combined'
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
	  rootObject : viewer.scene
	});
	
	gridClient.on('change', function() {
	  console.log('Map changed');
	});
	
	// Setup the marker client.
	var imClientPTU = new ROS3D.InteractiveMarkerClient({
	  ros : ros,
	  tfClient : tfClient,
	  topic : '/ptu_interactive_marker',
	  camera : viewer.camera,
	  rootObject : viewer.selectableObjects
	});
	
	// Setup the marker client.
	var imClientMPO = new ROS3D.InteractiveMarkerClient({
	  ros : ros,
	  tfClient : tfClient,
	  topic : '/mpo700_interactive_teleop',
	  camera : viewer.camera,
	  rootObject : viewer.selectableObjects
	});
	
	// Setup Kinect DepthCloud stream
	depthCloud = new ROS3D.DepthCloud({
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
	viewer.scene.add(kinectNode);
	
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
*/


