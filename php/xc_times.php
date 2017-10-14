<?php
$SEARCH = $_GET['search'];
$STATE = $_GET['state'];
$SCHOOL = $_GET['school'];
$RESULT = array();
echo("<a href='https://reteps.tk/school/xc_times'>back</a><br>");
exec('/home/retep/www/reteps.tk/exec/milesplit.py '.$SEARCH." ".$STATE." ".$SCHOOL, $RESULT);
foreach ($RESULT as $line) {
  echo($line."\n");
}
?>
