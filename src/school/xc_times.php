<!doctype html>
<html>
  <head>
    <title>
XC times
    </title>
    <style>
    .btn {
      border-radius: 5px;
      border: 1px solid black;
      cursor: pointer;
      background: white;
    }
    .input, .btn {
      padding: 0px;
      margin: 0px;
      line-height: 40px;
      font-size:20px;
      width:300px;
      text-align: center;
    }
    </style>
  </head>
  <body>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/menu.php';?>
    <p>please allow for up to <b>30 seconds</b> for it to load.</p>
    <form action="/php/xc_times.php" method="get">
      <input class="input" name="search" type="text" placeholder="name"><br>
      <input class="input" name="school" type="text" placeholder="school (optional)"><br>
      <input class="input" name="state" type="text" placeholder="state abbr.(optional)"><br>
      <input class="btn" type="submit" value="Go"><br>
    </form>
  </body>
</html>
