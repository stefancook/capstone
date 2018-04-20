<?php
$urlstring = $_SERVER[ 'REQUEST_URI' ];
$p_id = substr( $urlstring, 11 );
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
$sql = 'SELECT Player_ID, CONCAT(player_first_name," ", player_last_name) As fullname,CONCAT(player_first_name, player_last_name) As twit, player_picture
        FROM hockey_players
				WHERE Player_ID = '.$p_id.'';

$query = mysqli_query($conn, $sql);
// $agentquery = mysqli_query($conn, $agent);

if (!$query) {
    die ('SQL Error: ' . mysqli_error($conn));
}

$result = mysql_query($sql);
while($row = mysql_fetch_array($result)) {
echo $row['Player_ID'];
}

?>

<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Player Menu</title>
	<link rel="stylesheet" href="menu.css" media="screen">
</head>

<body>
  <div class="dropdown">
		<a href="/capstone.php" class="button_slide slide_left">Back
		</a>
		 </div>
 <div style="margin-top: -130px;">
 <h1 style="font-family: sans-serif;">Client Menu</h1>
 </div>

<div class="headstuff" style="margin: 0;"
<!-- show player name -->
		<h2 style="font-size: 17px;">
      <?php
      $no     = 0;
      $total     = 0;
      while ($row = mysqli_fetch_array($query))
      {
          #similar to JSON object
          echo '
          <img style="border-radius: 50%;   border: 2px solid rgb(206, 17, 39);
          width: 100px; height: 100px; display=:block;  text-align:right;  position: relative;"  src='.$row['player_picture'].'>

          <h2 <span>'.$row['fullname'].'</span></h2>
          <a href="https://twitter.com/search/?q=%28'.$row['twit'].'"><img class="twitter" src="/twitter.svg"></a>
          <a href="https://www.instagram.com/explore/tags/'.$row['twit'].'"><img class="twitter" src="/insta.png"></a>';
}?>
<div class="spacer" style="clear: both;"></div>
</div>
	</h2>
	<br></br>
  <div class="buttonHolder">

<!-- Client BTN-->
<div class="dropdown">
	<button onclick="myFunction()" class="button_slide slide_down" button class="btn rel"> Client Development </button>
	<div id="myDropdown" class="dropdown-content">
		<a href="/analytics.php?=<?php echo $p_id?>">Analytics</a>
		<a href="/metric.php?=<?php echo $p_id?>">Client Metric Monitor</a>
	</div>
</div>
<!-- Contract BTN-->
<div class="dropdown">
  <a href="/salary.php?=<?php echo $p_id?>" class="button_slide slide_left">Contract Analytics
  </a>
   </div>
<br></br>
<p></p>
<h2>SELECT AN OPTION.</h2>
<p></p>
<br></br>
<!-- Relationship Management BTN-->
<div class="dropdown">
  <a href="/contact2.php?=<?php echo $p_id?>" class="button_slide slide_diagonal">Relationship Management
  </a>
   </div>
<div class="dropdown">
  <a href="/acquisition.php?<?php echo $p_id?>" class="button_slide slide_right">Acquisitions
  </a>
   </div>
</div>
<!-- Back BTN-->

	</div>
</div>
	</div>
</body>
<div class="footer">
  <br></br>
    <br></br>

  <p style="margin-bottom: 400px;">©2018 Stefan Cook and Marcus Nordstrom.</p>
</div>

</html>

<!-- Dropdown Script-->
<script>
	/* When the user clicks on the button,
	toggle between hiding and showing the dropdown content */
	function myFunction() {
		document.getElementById( "myDropdown" ).classList.toggle( "show" );
	}

	// Close the dropdown menu if the user clicks outside of it
	window.onclick = function ( event ) {
		if ( !event.target.matches( '.dropbtn' ) ) {

			var dropdowns = document.getElementsByClassName( "dropdown-content" );
			var i;
			for ( i = 0; i < dropdowns.length; i++ ) {
				var openDropdown = dropdowns[ i ];
				if ( openDropdown.classList.contains( 'show' ) ) {
					openDropdown.classList.remove( 'show' );
				}
			}
		}
	}
</script>
<style>
@font-face {
	font-family: 'Conv_Lovelo Line Bold';
	src: url('fonts/Lovelo Line Bold.eot');
	src: local('☺'), url('fonts/Lovelo Line Bold.woff') format('woff'), url('fonts/Lovelo Line Bold.ttf') format('truetype'), url('fonts/Lovelo Line Bold.svg') format('svg');
	font-weight: normal;
	font-style: normal;
}
.headstuff {
  text-align: center;
  position: relative;}
.twitter{
  height: 5%;
  transition: .3;
  box-shadow: inset 0 0 0 0 rgb(206, 17, 39);
  -webkit-transition: ease-out 0.4s;
  -moz-transition: ease-out 0.4s;
  transition: ease-out 0.4s;
}
.twitter:hover{
  height: 5%;
  box-shadow: inset 0 0 0 50px rgb(206, 17, 39);

}
.footer {
    position: fixed;
    margin-bottom: -50px;
    width: 100%;
    text-align: center;
    color: #white;
    ma
}
</style>
