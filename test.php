<?php
#get cookie from login - if cookie is not present then redirect, else function
if (!isset($_COOKIE["username"]))
{
    header('Location: http://www.aimscapstone.site/login2.php');
    exit;
}
//connect to database
$db_host = 'capstone.cfiax0xaq0zu.us-west-1.rds.amazonaws.com'; // Server Name
$db_user = 'stefancook'; // Username
$db_pass = 'SCapril5'; // Password
$db_name = 'Capstone_DB_2.0'; // Database Name
//notification if not connected
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$conn) {
    die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}
//Select statment to acquire data for use in html website - should match up with what is being displayed
$sql = 'SELECT Player_ID, player_first_name, player_last_name, player_picture, Teams.team_name, CONCAT(agent_Fname, " ",agent_lname) as agent_name
        FROM hockey_players
        JOIN Teams
        ON hockey_players.teams_team_id = Teams.team_id
    JOIN Player_Agents
    ON hockey_players.player_agents_agent_id = Player_Agents.agent_id';
$query = mysqli_query($conn, $sql);
// $agentquery = mysqli_query($conn, $agent);
if (!$query) {
    die ('SQL Error: ' . mysqli_error($conn));
}
?>
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width">
  <meta name="description" content="filter &amp; sort magical layouts">

  <title>Client Management Engine </title>

    <!-- stylesheet -->
  <link rel="stylesheet" href="css/capstone.css" media="screen">



  </head>
  <body class="page--sorting">
    <div id="content" class="main">
      <div class="container">
    <h1>Client Management Engine </h1>


  <p><?php
    if(isset($_COOKIE["username"])){
        echo "Welcome Mr. " . $_COOKIE["username"];
    } else{
        echo "Welcome Guest!";
    }
    ?> </p>
  <!-- <a href="https://public.tableau.com/views/NHL_Data1/Domi_LastGame?:embed=y&:display_count=yes&publish=yes&player_id=5100" target=_blank><img class="image" src='.$row['pic'].' background=linear-gradient(to left, rgba(255,0,0,0), rgba(255,0,0,1))> </a> -->

  <div class="big-demo go-wide" data-js="sorting-demo">
      <div class="button-group sort-by-button-group js-radio-button-group">
          <button class="button" data-sort-value="original-order">original order</button>
          <button class="button" data-sort-value="name">first name</button>
          <button class="button" data-sort-value="symbol">last name</button>
      <button class="button" data-sort-value="weight">weight</button>
      </div>
    <div class="button-group filter-button-group">
      <button data-filter=".weight">Judd Moldaver</button>

    </div>

  <button data-filter="*">show all</button>
        <p><input type="text" class="quicksearch" placeholder="Search" color = white id="myInput" /></p>
        <!-- <button class="clear" onclick="document.getElementById('myInput').value = ''">X</button> -->
    <!-- <a href="#popupVideo" data-rel="popup" data-position-to="window" class="ui-btn ui-corner-all ui-shadow ui-btn-inline">Launch video player</a> -->
    <!-- trying to create popout iframe -->
    <!-- <div data-role="popup" id="popupVideo" data-overlay-theme="b" data-theme="a" data-tolerance="15,15" class="ui-content">
        <iframe src="http://player.vimeo.com/video/41135183?portrait=0" width="497" height="298" seamless=""></iframe>
    </div> -->
    <div class="grid">

            <?php
            $no     = 0;
            $total     = 0;
            while ($row = mysqli_fetch_array($query))
            {
                #similar to JSON object
                echo '<div class="grid-item">
                <div class="element-item player">
                <h5 class="name">'.$row['player_first_name'].'</h5>
                <h5 class="symbol">'.$row['player_last_name'].'</h5>
                <a href="/menu.php?='.$row['Player_ID'].'"><img class="image" src='.$row['player_picture'].'>
            </div>';
  }?>
  </div
  <div class="footer">
    <p>©2018 Stefan Cook and Marcus Nordstrom. Template by Isotope.</p>

  </div>
  <!-- Javascript files are here... -->
  <!-- Jquery -->
  <script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>
  <!-- Isotope JS file -->
  <script src="js/isotope-docs.min.js?6"></script>
  <!-- Custom JS file here -->
  <script src="js/isotope.js"></script>
  <script src="isotope.js"></script>
  <!-- create cookie on click referencing player_id
   <script
    $("a#cookielink").bind("click", function() {
    $.cookie("test5", $row['Player_ID'], time()+30*24*60*60,"/");>
  </script> -->

</body>
</html>
