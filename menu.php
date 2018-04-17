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
//
//Select statment to acquire data for use in html website - should match up with what is being displayed
$sql = 'SELECT Player_ID, CONCAT(player_first_name," ", player_last_name) As fullname
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
	<h1> Player Menu <?php echo $p_id ?></h1>
	<p></p>



	<div class="buttonHolder">
<!-- show player name -->
		<h2>
						<?php
						$no     = 0;
						$total     = 0;
						while ($row = mysqli_fetch_array($query))
						{
								#similar to JSON object
								echo $row['fullname'];
		}?>
	</h2>
	<br></br>
<!-- Client BTN-->
			<div class="dropdown">
				<button onclick="myFunction()" class="button_slide slide_right" button class="btn rel">Client Development</button>
				<div id="myDropdown" class="dropdown-content">
					<a href="/analytics.php?=<?php echo $p_id?>">Analytics</a>
					<a href="#">Achievement Stats</a>
				</div>
			</div>
<br></br>
<!-- Relationship Management BTN-->
			<div class="dropdown">
				<button onclick="myFunction()" class="button_slide slide_right" button class="btn rel">Relationship Management</button>
				<div id="myDropdown" class="dropdown-content">
					<a href="/contact.php?=<?php echo $p_id?>">Player Contact</a>
					<a href="#">Agent Info</a>
				</div>
			</div>
<br></br>
<!-- Contract BTN-->
			<div class="dropdown">
				<button onclick="myFunction()" class="button_slide slide_right" button class="btn rel">Contract</button>
				<div id="myDropdown" class="dropdown-content">
					<a href="/analytics.php?=<?php echo $p_id?>">Analytics</a>
					<a href="#">Achievement Stats</a>
				</div>
			</div>
<br></br>
<!-- Back BTN-->
	<div class="dropdown">
		<div class="button_slide slide_right">Back
		<a href="/capstone.php"></a>
		 </div>
	</div>

	</div>
</body>
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
