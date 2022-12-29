<!doctype html>
<html>
  <head>
    <title>
Spotify Account Generator
    </title>
    <style>
      input {
        height:24px;
        width: 140px;
      }
      button {
        width: 150px;
        height:24px;
      }
    </style>
    <script>
      document.getElementById("go").onclick = generateAccount;
      function generateAccount() {
        var old_username = document.getElementById("old_username");
        var old_password = document.getElementById("old_password");
        var new_username_base = document.getElementById("username");
        var new_password = document.getElementById("password");
      }
    </script>
  </head>
  <body>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/menu.php';?>
    <input id="old_username" placeholder="old username"><br>
    <input id="old_password" placeholder="old password"><br>
    <input id="username" placeholder="new username base"><br>
    <input id="password" placeholder="new password"><br>
    <button id="go">Go</button><br>
    <p id="results"></p>
    <!-- From account USERNAME, we transferred NUM songs and NUM playlists to account NEW_USERNAME, and signed up for a free trial.
Account information:
 * email - EMAIL
 * username - USERNAME
 * password - PASSWORD [show]
    -->
  </body>
</html>
