<style>

#history{
	display:inline-block;
	vertical-align: text-top;
	margin-right: 50px;
	width: 100%;
	padding-left:10px;
	padding-right:10px;
}

#predefined{
	display:inline-block;
	vertical-align: text-top;
	//float:right;
	width: 100%px;
	padding-right:10px;
	padding-left:10px;
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
				'hallo!',
				'danke',
				'ja',
				'nein',
				'kein problem.',
				'es tut mir leid. das kenne ich noch nicht.',
				'hallo, mein name ist marvin',
				'wie heisst du?',
				'das ist aber ein schöner name',
				'ich bin ein service-roboter prototyp',
				'darf ich dir eine tasse kaffee anbieten?'				
		);
		
		function buildPredefinedText($savedTextList){
			$html = '';
			foreach ($savedTextList as $text){
				  $html .= '<button style="padding:5px;" class="btn btn-default btn-lg" onclick="say(\''.$text.'\')" type="button">'.$text.'</button>';
			}
			return $html;
		}
	?>


<div id="wrapper" style="padding:100px;">
	<p class="lead">
        <div class="input-group">
      		<input type="text" class="form-control input-lg" name="sayStr" id="sayStr" onkeypress="keyDetect(event)" placeholder="Hier bitte den Text eingeben...">
      		<span class="input-group-btn">
        		<button class="btn btn-default btn-lg" onclick="sayAndSave()" type="button">Sag es</button>
				  </span>
   			</div><!-- /input-group -->
    	</p>
	<div>
		<div id="history">
			<h2>Gerade eingegeben:</h2>
		</div>
		<div id="predefined">
        	<h2>Häufig verwendet</h2>
            <br />
			<?php echo buildPredefinedText($savedTextList); ?>
		</div>
	</div>
</div>
<script>
var ttsClient = new ROSLIB.ActionClient({
  ros : ros,
  serverName : '/marvin/TTS',
  actionName : 'cerevoice_tts_msgs/TtsAction'
});

ttsClient.on('status', function(status) {
  console.log('action client status: ' + status.status + ' ' + status.text);
});

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

function keyDetect( event ){
	if (event.keyCode == 13) {
			event.preventDefault();
			sayAndSave();
		}
}

function sayAndSave() {
	var text = document.getElementById('sayStr').value;
  say(text);
	$("#history").append('<button class="btn btn-default" onclick="say(\'' 
		+ text + '\')">' + text + '</button>');
}
</script>

