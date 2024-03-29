<!doctype html>
<html>
	<head>
    <link rel="icon" href="/assets/icon.ico" type="image/x-icon"/>
    <title>
Peter's Kahoot Bot
    </title>
  	</head>
    <script>
	function change_display() {
    	if (document.getElementById('bot_radio').checked) {
        	document.getElementById('gamepin').style.display = 'block';
			    document.getElementById('username').style.display = 'block';
    	} else {
			    document.getElementById('gamepin').style.display = 'none';
			    document.getElementById('username').style.display = 'none';
    	}
  }
  change_display()
	</script>
  	<body>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/menu.php';?>
		<form action="/php/kahoot_simple.php" method="get">
    		<input type="text" name="quizid" style="width:300px;" placeholder="Kahoot id"><br>
        <input type="radio" name="what" value="text" onclick="change_display()">Answers<br>
    		<input type="radio" name="what" value="code" onclick="change_display()">Colors<br>
    		<input type="radio" name="what" value="bot" id="bot_radio" onclick="change_display()">Bot<br>
        <input type="number" name="gamepin" placeholder="Gamepin" display="none" id="gamepin">
        <input type="text" name="username" placeholder="Username" display="none" id="username">
    		<input type="submit" value="Go"><br>
 		</form>
  	</body>
</html>
