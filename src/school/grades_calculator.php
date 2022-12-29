<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="../menu.css" />
    <link rel="icon" href="/assets/icon.ico" type="image/x-icon"/>
    <title>Grade Calculator</title>
    <meta charset="utf-8"/>
    <script type="text/javascript" src="/js/gradecalc.js"></script>
    <style>
    #fog, #ing {
      width: 300px;
    }
    </style>
  </head>
  <body>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/menu.php';?>
    <h1>Grade Calculator</h1>
    <input id="ing" placeholder="Informal grades, seperate by commas."><br>
    <input id="fog" placeholder="Formal grades, seperate by commas."><br>
    <input type="radio" name='type' onclick="changeoldgradedisplay()" id='radio_new_grade' >New<br>
    <input type="radio" name='type' onclick="changeoldgradedisplay()" id='radio_old_grade' checked>Change<br>
    <input id="old_grade_input" display='none' placeholder="old grade">
    <input id="new_grade_input" placeholder="new grade"><br>
    <input type="radio" name='gradetype' id='informal_radio'>Informal<br>
    <input type="radio" name='gradetype' id='formal_radio' checked>Formal<br>
    <input type="radio" name='school' id='bailey'>Bailey
    <input type="radio" name='school' id='hough' checked>Hough<br>
    <button onclick="add_grades()" > Calculate Grade </button>
    <p id='previous_grade'></p>
    <p id='new_grade'></p>
  </body>
</html>