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
ob_implicit_flush(true);
ob_start();
if ($type == "bot") {
  $call = "~/www/reteps.tk/go/kahoot-auto " . $_GET['gamepin'] . " " . $_GET['username'] . " ";
  echo($call);
  ob_flush();
}
$pageUrl = 'https://create.kahoot.it/rest/kahoots/' . $kahootId;
$loginheader = array(); 
$loginheader[] = 'content-type: application/json';
$loginpost = new stdClass();
$loginpost->username = $username;
$loginpost->password = $password;
$loginpost->grant_type = "password";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $loginUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($loginpost));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true); 
curl_setopt($ch, CURLOPT_HTTPHEADER,$loginheader);
$store = curl_exec($ch);
curl_close($ch);
$token = json_decode($store,true)["access_token"];
//get questions
$quizheader = array(); 
$quizheader[] = 'authorization: ' . $token;
$options = array(
    'http' => array(
        'method'  => 'GET',
        'header'  => "Authorization: ".$token."\r\n"
    )
  );
$pairs = array(
     0 => "red",
     1 => "blue",
     2 => "yellow",
     3 => "green",
);
$context = stream_context_create($options);
$raw_result = file_get_contents($pageUrl, false, $context);
$result = json_decode($raw_result,true)["questions"];

echo("<a href='kahoot_bot'>back</a><br>");
ob_flush();
foreach($result as $value) {
  if ($type == "text") {
    echo($value['question']."  ");
  }
  $choices = $value['choices'];
  for($i=0;$i<count($choices);$i++) {
    if ($choices[$i]['correct'] == true) {
      if ($type == "text") {
        echo($choices[$i]['answer']."<br>");
      } elseif ($type == "bot") {
        $call .= $i;
      } else {
        echo($pairs[$i].", ");
      }
      break 1;
    }
  }
}
if ($type == "bot") {
  $old_result = "";
  $handle = popen($call . " 2>&1", "r");
  $result = fread($handle, 2096);
  echo($result);
  while ((strpos($result, "end") !== false) != true) {
    $result = fread($handle, 2096);
    sleep(1); 
    if ($result != $old_result) {
      echo($result);
      ob_flush();
      $old_result = $result;
    }
  }
  pclose($handle);
}
?>
</body>
</html>
