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

		$savedTextList = array(
				'hallo, mein name ist marvin',
				'wie heisst du?',
				'das ist aber ein schöner name',
				'ich bin ein service roboter prototyp',
				'darf ich dir eine tasse kaffee anbieten?',
				'&lt;spurt audio=\\\'g0001_026\\\'&gt;x&lt;/spurt&gt;',
				'&lt;prosody pitch=\\\'1.5\\\'&gt;Ich mag Helium Luftballons.&lt;/prosody&gt;',
				'&lt;prosody pitch=\\\'0.7\\\'&gt;Ich nicht.&lt;/prosody&gt;',
				'&lt;prosody pitch=\\\'1.5\\\'&gt;Ich mag Helium Luftballons.&lt;/prosody&gt;&lt;prosody pitch=\\\'0.7\\\'&gt;Ich nicht.&lt;/prosody&gt;&lt;spurt audio=\\\'g0001_026\\\'&gt;x&lt;/spurt&gt;. Ok jetzt aber zur&uuml;ck an die Arbeit!'
				
		);
		
		function buildPredefinedText($savedTextList){
			$html = '';
			foreach ($savedTextList as $text){
					$html .= '<div class="historyElement" onclick="say(\''.$text.'\')">'.$text.'</div>';
			}
			return $html;
		}
	?>


<div id="wrapper" style="padding:100px;">
	<form id="frm1" action="#">
	  <input type="text" size="65" name="teststr" onkeypress="keyDetect(event)" class="btn btn-default btn-xlarge">
	  <input type="button" onclick="sayAndSave()" value="Say it" class="btn btn-default btn-xlarge">
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

