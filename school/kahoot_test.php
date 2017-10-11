<html>
  <head>
    <title>Kahoot bot</title>
  </head>
  <body>
<?php
$username = 'kahootbot28@gmail.com';
$password = 'botkahoot28';
$loginUrl = 'https://create.kahoot.it/rest/authenticate';
$kahootId = $_GET['quizid'];
$type = $_GET['what'];
if ($type == "bot") {
  $call = "~/www/reteps.tk/go/kahoot-auto " . $_GET['gamepin'] . " " . $_GET['username'] . " ";
  echo($call);
}
echo($username);
echo($password);
echo($loginUrl);
echo($kahootId);
echo($type);
?>
</body>
</html>
