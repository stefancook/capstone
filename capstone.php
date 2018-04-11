<?php
#get cookie from login - if cookie is not present then redirect, else function
if (!isset($_COOKIE["username"]))
{
    header('Location: http://www.aimscapstone.site/login2.php');
    exit;
}


// if(!isset($_COOKIE['lg'])) {
//     setcookie('lg', 'ro');
//     $_COOKIE['lg'] = 'ro';
// }
// echo $_COOKIE['lg'];


//connect to database
$db_host = 'capstone.cfiax0xaq0zu.us-west-1.rds.amazonaws.com'; // Server Name
$db_user = 'stefancook'; // Username
$db_pass = 'SCapril5'; // Password
$db_name = 'capstone'; // Database Name

//notification if not connected
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$conn) {
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}

//Select statment to acquire data for use in html website - should match up with what is being displayed
$sql = 'SELECT first_name, last_name, position, goals, assists, points, score_stats.game_date, pic
		FROM daily_players
		JOIN score_stats
		ON daily_players.player_id = score_stats.player_id';

$query = mysqli_query($conn, $sql);

if (!$query) {
	die ('SQL Error: ' . mysqli_error($conn));
}
// require_once("login2.php");
//
// if(!$fgmembersite->CheckLogin())
// {
//     $fgmembersite->RedirectToURL("login2.php");
//     exit;
// }
// function CheckLogin()
// {
//      session_start();
//
//      $sessionvar = $this->GetLoginSessionVar();
//
//      if(empty($_SESSION[$sessionvar]))
//      {
//         return false;
//      }
//      return true;
// }
?>
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width">
  <meta name="description" content="filter &amp; sort magical layouts">

  <title>Hockey Data Engine</title>

    <!-- stylesheet -->
  <link rel="stylesheet" href="/css/capstone.css" media="screen">

  </head>
  <body class="page--sorting">
    <div id="content" class="main">
      <div class="container">
          <h1>Hockey Data Engine</h1>


  <p><?php

	if(isset($_COOKIE["username"])){
	    echo "Hi " . $_COOKIE["username"];
	} else{
	    echo "Welcome Guest!";
	}

	?> </p>
  <div class="big-demo go-wide" data-js="sorting-demo">
  	<div class="button-group sort-by-button-group js-radio-button-group">
  		<button class="button" data-sort-value="original-order">original order</button>
  		<button class="button" data-sort-value="name">first name</button>
  		<button class="button" data-sort-value="symbol">last name</button>
      <button class="button" data-sort-value="weight">weight</button>

  	</div>
		<p><input type="text" class="quicksearch" placeholder="Search" color = white id="myInput" /></p>
		<!-- <button class="clear" onclick="document.getElementById('myInput').value = ''">X</button> -->
    <div class="grid">
			<?php
			$no 	= 1;
			$total 	= 1;
			while ($row = mysqli_fetch_array($query))
			{
				#similar to JSON object
				echo '<div class="grid-item">
				<div class="element-item player">
	        <h5 class="name">'.$row['first_name'].'</h5>
					<h5 class="symbol">'.$row['last_name'].'</h5>
          <h5 class="weight">'.$row['game_date'].'</h5>
          <img class="image" src='.$row['pic'].' background=linear-gradient(to left, rgba(255,0,0,0), rgba(255,0,0,1))>

			</div>';
				// $no++;
  }?>

  <!-- Javascript files are here... -->
  <!-- Jquery -->
  <script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>
  <!-- Isotope JS file -->
  <script src="js/isotope-docs.min.js?6"></script>
  <!-- Custom JS file here -->
  <script src="js/isotope.js"></script>
	<script src="js/isotope1.js"></script>

  <script src="isotope.js"></script>
  </body>
	<div class="footer">
	  <p>©2018 Stefan Cook and Marcus Norstrom. Template by Isotope.</p>

	</div>
  </html>
