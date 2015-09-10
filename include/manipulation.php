<style>

#history{
	display:inline-block;
	vertical-align: text-top;
	margin-right: 50px;
	width: 250px;
}

#predefined{
	display:inline-block;
	vertical-align: text-top;
	//float:right;
	width: 250px;
}

.historyElement{
	border-radius: 25px;
	margin-top:10px; 
	padding:20px; 
	background:#383838; 
	cursor: pointer; 
	cursor: hand;
}

.historyElement:hover{
	background: #336ca6;
}

</style>

	<?php
		ini_set('error_reporting', E_ALL);

		$savedPositions = array(
								array("Carry","manip","carry"),
								array("Carry Safe","manip","carry_save"),
								array("out of sight","manip","out_of_sight_save"),
								array("place","manip","place"),
							);
		
		function buildPredefined($savedPositions){
			$html = '';
			foreach ($savedPositions as $pose){
					$html .= '<div class="historyElement" onclick="execute(\''.$pose[1].'\',\''.$pose[2].'\')">'.$pose[0].'</div>';
			}
			return $html;
		}
	?>


<div id="wrapper" style="padding:100px;">
	<form id="frm1" action="#">
	  <input type="text" size="65" name="teststr" onkeypress="keyDetect(event)" class="btn btn-default btn-xlarge">
	  <input type="button" onclick="SavePosition()" value="Save Position" class="btn btn-default btn-xlarge">
	</form>
	<div>
		<div id="history">
			<h2>Gerade eingegeben:</h2>
		</div>
		<div id="predefined">
			<h2>Gespeicherte Vorgaben:</h2>
			<?php echo buildPredefined($savedPositions); ?>
		</div>
	</div>
</div>
<script>

function keyDetect( event ){
	if (event.keyCode == 13) {
			event.preventDefault();
			sayAndSave();
		}
}

function SavePosition() {
	manipulation_save_pose(document.forms["frm1"]["teststr"].value);
    //document.getElementById("frm1").submit();
    //say(document.forms["frm1"]["teststr"].value);
	$("#history").append('<div class="historyElement" onclick="execute(\'manip\',\''+document.forms["frm1"]["teststr"].value+'\',\''+document.forms["frm1"]["teststr"].value+'\')">'+document.forms["frm1"]["teststr"].value+'</div>');
}
</script>

