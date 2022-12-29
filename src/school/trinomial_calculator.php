<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="../menu.css" type="text/css"/>
    <link rel="icon" href="/assets/icon.ico" type="image/x-icon"/>
    <title> Peter's Website</title>
    <meta charset="utf-8"/>
    <script>
      function solve() {
        var a = parseFloat(document.getElementById("a").value);
        var b = parseFloat(document.getElementById("b").value);
        var c = parseFloat(document.getElementById("c").value);

        var newb = b/a;
        var persq = Math.pow((newb/2),2);
        var total = ((c/a) * -1) + persq;
        var sq = Math.sqrt(total);
       
        var negb = (newb/2)*-1
        var total2 = negb - sq;
        var total1 = sq + negb;
        document.getElementById("output1").innerHTML = "(x +" + newb/2 + ")^2=" + total;
        document.getElementById("output2").innerHTML = "x=" + negb + "±√" + total;
        document.getElementById("output3").innerHTML = "x=" + total1 + "  or  x=" + total2;
        }
    </script>
  </head>
  <body>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/menu.php';?>
    <input type="number" placeholder="a value" id="a"><br>
    <input type="number" placeholder="b value" id="b"><br>
    <input type="number" placeholder="c value" id="c"><br>
    <button onclick="solve()">go</button>
    <p id='output1'></p>
    <p id='output2'></p>
    <p id='output3'></p>
    
  </body>
</html>