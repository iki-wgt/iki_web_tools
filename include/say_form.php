<style>

#history{
	display:inline-block;
	vertical-align: text-top;
	width: 200px; 
	margin-right: 20px;
}

#predefined{
	display:inline-block;
	vertical-align: text-top;
	//float:right;
	width: 200px;
}

.historyElement{
	margin-top:10px; 
	padding:5px; 
	background:grey; 
	cursor: pointer; 
	cursor: hand;
}

</style>

	<?php
		ini_set('error_reporting', E_ALL);

		$savedTextList = array(
				"hallo, mein name ist marvin",
				"wie heisst du?",
				"das ist aber ein schöner name",
				"darf ich dir eine tasse kaffee anbieten?",
				
		);
		
		function buildPredefinedText($savedTextList){
			$html = '';
			foreach ($savedTextList as $text){
					$html .= '<div id="test" class="historyElement" onclick="say(\''.$text.'\')">'.$text.'</div>';
			}
			return $html;
		}
	?>


<div id="wrapper" style="padding:100px;">
	<form id="frm1" action="#">
	  Sage <input type="text" name="teststr" onkeypress="keyDetect(event)"><br>
	  <input type="button" onclick="sayAndSave()" value="Submit">
	</form>
	<div>
		<div id="history">
			<h2>Gerade eingegeben:</h2>
		</div>
		<div id="predefined">
			<h2>Gespeicherte Vorgaben:</h2>
			<?php echo buildPredefinedText($savedTextList); ?>
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

function sayAndSave() {
    //document.getElementById("frm1").submit();
    say(document.forms["frm1"]["teststr"].value);
    $("#history").append('<div class="historyElement" onclick="say(\''+document.forms["frm1"]["teststr"].value+'\')">'+document.forms["frm1"]["teststr"].value+'</div>');
}
</script>

