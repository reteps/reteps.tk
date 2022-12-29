<!doctype html>
<html>
  <head>
    <title>
Blog
    </title>
    <style>
#smenu a {
  color: black;
  text-decoration: none;
}
.button:hover {
  background-color: #A9A9A9;
}
.button {
  border: 1px solid black;
  cursor: pointer;
  background-color: #d3d3d3;
  width: 250px;

}
td {
  border: 1px solid black;
}
table { 
  width: 400px; 
}
.right {
  text-align: center;
}
    </style>
    <link rel="stylesheet" type="text/css" href="navbar.css">
    </head>
  <body>
<?php
  $articles = glob("/home/retep/www/reteps.tk/blog/" . "*.html");
  foreach($articles as $article) {

    $base = basename($article,'.html');
		echo "<a href=/blog/$base.html>".$base."</a>";
  }
?>
  </body>
</html>
 
