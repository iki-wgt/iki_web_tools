<style>

#navHistory{
	display:inline-block;
	vertical-align: text-top;
	margin-right: 50px;
	width: 250px;
}

#navPredefined{
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
								array("Home","goto","home"),
								array("Kitchen1","goto","kitchen1"),
								array("Kitchen2","goto","kitchen2"),
								array("Table1","goto","table1"),
								array("Table2","goto","table2"),
								array("Small Table","goto","smalltable"),
								array("Sofa","goto","sofa"),
								array("Shelf","goto","shelf"),
								array("Speakpos","goto","speakpos"),
								array("Charging","goto","chargepos"),
								array("Change Battery","goto","changebatterypos"),
							);
		
		function buildPredefinedTextNav($savedPositions){
			$html = '';
			foreach ($savedPositions as $pose){
					$html .= '<button class="btn btn-default" onclick="execute(\''.$pose[1].'\',\''.$pose[2].'\')">'.$pose[0].'</button>';
			}
			return $html;
		}
	?>


<div id="wrapper" style="padding:100px;">
	<!--<form id="frm1" action="#">
	  <input type="text" size="65" name="teststr" onkeypress="keyDetect(event)" class="btn btn-default btn-xlarge">
	  <input type="button" onclick="SavePosition()" value="Save Position" class="btn btn-default btn-xlarge">
	</form>-->
	<div>
		<div id="navHistory">
			<h2>Gerade eingegeben:</h2>
		</div>
		<div id="navPredefined">
			<h2>Gespeicherte Vorgaben:</h2>
			<?php echo buildPredefinedTextNav($savedPositions); ?>
		</div>
	</div>
	<p class="lead">
    <div class="input-group">
      <input type="text" class="form-control" id="navStr" placeholder="Hier bitte den Text eingeben...">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button" onclick="SavePosition()">Speichere aktuelle Position</button>
      </span>
    </div>
  </p>
</div>
<script>

function keyDetect( event ){
	if (event.keyCode == 13) {
			event.preventDefault();
			sayAndSave();
		}
}

function SavePosition() {
    var navStr = document.getElementById('navStr').value
    nav_save(navStr);
    $("#navHistory").append('<button class="btn btn-default" onclick="nav_goto(\''+navStr+'\')">'+navStr+'</div>');
}
</script>

