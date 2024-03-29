<!doctype html>
<html>
  <head>
    <link rel="stylesheet" href="../menu.css" type="text/css"/>
    <link rel="icon" href="/assets/icon.ico" type="image/x-icon"/>
    <title>
Trig Calc
    </title>
    <style>
        .input {
            width: 180px;
        }
        p {
            margin: 0;
            padding: 0;
        }
        #output {
            color:blue;
        }
    </style>
    <script>
      function get(id) {
        try {
          var raw = document.getElementById(id).value;
          var result = parseFloat(raw);
          if (raw == "") {
            var message = id + " needs a valid value";
            throw message;
          } else if (result <= 0) {
            var message = id + " must be positive";
            throw message;
          }
          return result;
        } catch (e) {
          set("ERROROUT",e);
          throw new Error("Stopped execution because of invalid values");
        }
      }

      function ischecked(id) {
          return (document.getElementById(id).checked);
      }
      function resetall() {
          set('equation',null);
          set('equation2',null);
          set('output',null);
          setbox('num1',null);
          setbox('num2',null);
          setbox('num3',null);
      }
      function setbox(id,value) {
          document.getElementById(id).value = value;
      }
      function set(id,value) {
          document.getElementById(id).innerHTML = value;
      }
      function changetext() {
          resetall()
          if (ischecked("SAS")) {
              document.getElementById("num1").placeholder = "side";
              document.getElementById("num2").placeholder = "angle";
              document.getElementById("num3").placeholder = "side";
          } else if (ischecked("SSS")) {
              document.getElementById("num1").placeholder = "side to the left of angle";
              document.getElementById("num2").placeholder = "side to the right of angle";
              document.getElementById("num3").placeholder = "side";
          } else if (ischecked("ASA")) {
              document.getElementById("num1").placeholder = "angle opposite missing side";
              document.getElementById("num2").placeholder = "side";
              document.getElementById("num3").placeholder = "angle";
          } else if (ischecked("AAS")) {
              document.getElementById("num1").placeholder = "angle opposite missing side";
              document.getElementById("num2").placeholder = "angle";
              document.getElementById("num3").placeholder = "side";
          } else if (ischecked("SSA")) {
              document.getElementById("num1").placeholder = "side opposite missing angle";
              document.getElementById("num2").placeholder = "side";
              document.getElementById("num3").placeholder = "angle";
      	  }
      }

      function rad(deg) {
          return (deg * Math.PI / 180);
      }
      function deg(rad) {
          return (180/Math.PI * rad);
      }
      function round(num) {
          return (Math.round(num * 10000) / 10000);
      }
      function sss(n1, n2, n3) {
          return (round(deg(Math.acos(((n1**2) + (n2**2) - (n3**2)) / (2*n1*n2)))));
      }
      function sas(n1, n2, n3) {
          return (round(((n1**2) + (n3**2) - (2 * n1 * n3 * Math.cos(rad(n2))))**0.5));
      }
      function asa(n1, n2, n3) {
          return (round((n2 * Math.sin(rad(n1))) / Math.sin(rad(180 - n1 - n3))));
      }
      function aas(n1, n2, n3) {
          return (round((n3 * Math.sin(rad(n1))) / Math.sin(rad(n2))));
      }
      function ssa(n1,n2,n3) {
          return (round((deg(Math.asin(n1 * Math.sin(rad(n3)) / n2)))));
      }

      function solve() {

          var n1 = get("num1");
          var n2 = get("num2");/*uppercase=angle*/
          var n3 = get("num3");
          console.log(n1,n2,n3);
          if (ischecked("SSS")) {
              var output = sss(n1,n2,n3) + " degrees";
              set("output",output);
              if (ischecked("showequation")) {
                  set("equation",`cos⁻¹((${n1}² + ${n2}²- ${n3}²) / (2 * ${n1} * ${n2}))`);
              }
          } else if (ischecked("SAS")) {
              var output = sas(n1,n2,n3);
              set("output",output);
              if (ischecked("showequation")) {
                  set("equation",`√(${n1}² + ${n3}² - 2 * ${n1} * ${n3} * cos(${n2}))`);
              }
          } else if (ischecked("ASA")) {
              var output = asa(n1,n2,n3);
              var angle = 180 - n1 - n3;
              set("output",output);
              if (ischecked("showequation")) {
                  set("equation",`${angle} = 180 - ${n1} - ${n3}`);
                  set("equation2",`(${n2} * sin(${n1})) / sin(${angle})`);
              }
          } else if (ischecked("AAS")) {
              var output = aas(n1,n2,n3);
              set("output",output);
              if (ischecked("showequation")) {
                  set("equation",`(${n3} * sin(${n1})) / sin(${n2})`);
              }
          } else if (ischecked("SSA")) {
              var output = ssa(n1,n2,n3) + " degrees";
              set("output",output);
              if (ischecked("showequation")) {
                  set("equation",`sin⁻¹(${n1} * sin(${n3}) / ${n2})`);
              }
          }

      }
    </script>
  </head>
  <body>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/menu.php';?>
    <h3>Trig Calculator</h3>
    <h5>Fill in everything you know, then hit go</h5>
    <p id="ERROROUT"></p>
    <input id="SAS" onclick="changetext()" type="radio" name="option">SAS
    <input id="SSS" onclick="changetext()" type="radio" name="option">SSS
    <input id="SSA" onclick="changetext()" type="radio" name="option">SSA
    <input id="ASA" onclick="changetext()" type="radio" name="option">ASA
    <input id="AAS" onclick="changetext()" type="radio" name="option">AAS<br>
    <input class="input" id="num1" type="number" placeholder="Number 1"><br>
    <input class="input" id="num2" type="number" placeholder="Number 2"><br>
    <input class="input" id="num3" type="number" placeholder="Number 3"><br>
    <input id="showequation" type="checkbox">Show equation<br>
    <button onclick="solve()">Go</button>
    <button onclick="resetall()">Reset</button>
    <p id="output"></p>
    <p id="equation"></p>
    <p id="equation2"></p>

  </body>
</html>
