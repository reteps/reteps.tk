<link rel="stylesheet" href="/menu.css" type="text/css"/>
<nav id="menu_wrap">
      <ul>
        <li><a id="home" href="/">Home</a></li>
        <li><a id="school" href="">School</a>
          <ul>
            <li><a id="trinomial" href="/school/trinomial_calculator.php">Trinomial Calculator</a></li>
            <li><a id="radical" href="/school/radical_calculator.php">Radical Calculator</a></li>
            <li><a id="grades" href="/school/grades_calculator.php">Grade Calculator</a></li>
            <li><a id="trig" href="/school/trig_calculator.php">Trig Calculator</a></li>
            <li><a id="kahoot" href="/school/kahoot_bot.php">Kahoot Bot</a></li>
            <li><a id="xc" href="/school/xc_times.php">XC times</a></li>
          </ul>
        </li>
        <li><a href="/blog/home">Blog</a></li>
        <li><a href="" id="other">Other</a>
          <ul>
            <li><a id="cms" href="/other/cms_data">CMS email database</a></li>
            <li><a id="spotify" href="/other/spotify_gen">Spotify Generator</a></li>
          </ul>
        </li>
        <li><a href="https://github.com/reteps">Github</a></li>
      </ul>
</nav>
<script>
  var path = window.location.pathname;
  if (path == "/") {
    document.getElementById("home").style.background = "#0FA3B1";
  } else {
    var sections = path.split("/");
    for (var i = 1;i < sections.length;i++) {
      document.getElementById(sections[i].split("_")[0]).style.background = "#0FA3B1";
    }
  }
</script>
