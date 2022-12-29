<!doctype html>
<html>
  <head>
    <link rel="shortcut icon" href="/assets/icon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="../menu.css" type="text/css"/>
    <title>
Radical Calculator
    </title>
    <script>
      function solve() {
        var radical = parseInt(document.getElementById('r').value);
        var printI = false;
        var persq = [400,361,324,289,256,225,196,169,144,121,100,81,64,49,36,25,16,9,4];
        var output = "Cannot be simplified: √" + radical.toString();
        if (radical < 0) {
          radical *= -1;
          printI = true;
        }
        for (var i = 0;i < persq.length; i++) {
          if (radical % persq[i] == 0) {
            if (radical / persq[i] == 1) {//perfect square

              if (printI) {
                output = (persq[i] ** 0.5).toString() + "i"
              } else {
                output = (persq[i] ** 0.5).toString()
              }
            } else if (printI) {
              output = (persq[i] ** 0.5).toString()+"i√"+(radical/persq[i]).toString();
            } else {
              output = (persq[i] ** 0.5).toString()+"√"+(radical/persq[i]).toString();
            }
            break;
          }
        }
        document.getElementById('output').innerHTML = output;
      }
    </script>
  </head>
  <body>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/menu.php';?>
    <h3>Radical Calculator</h3>
    <input id='r' placeholder='radical'><br>
    <button onclick='solve()'>go</button>
    <p id='output'></p>

  </body>
</html>