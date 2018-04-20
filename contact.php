<?php
$urlstring = $_SERVER[ 'REQUEST_URI' ];
$p_id = substr( $urlstring, 15 );
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
$sql = 'SELECT CONCAT(player_first_name," ",player_last_name) as p_fullname, CONCAT(NHL_Coach_First_Name," ",NHL_Coach_Last_Name) as c_name, NHL_Coach_Phone_Number as c_email, NHL_Coach_Email as c_phone, NHL_Coach_Pic as c_pic, CONCAT(NHL_GM_First_Name," ",NHL_GM_Last_Name) as gmname, NHL_GM_Email as gm_email, NHL_GM_Phone_Number as gm_phone, NHL_GM_Photo as gm_pic
        FROM NHL_Coaches
        JOIN Teams
        ON NHL_Coaches.teams_team_id = Teams.team_ID
        JOIN gen_managers
        ON Teams.team_id = gen_managers.Teams_Team_ID
        JOIN hockey_players
        ON Teams.team_id = hockey_players.teams_team_id
			  WHERE Player_ID = '.$p_id.'';
$query = mysqli_query($conn, $sql);
// $agentquery = mysqli_query($conn, $agent);

if (!$query) {
    die ('SQL Error: ' . mysqli_error($conn));
}

$result = mysql_query($sql);

?>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>

<h2>Contact Page</h2>
<p>Resize the browser window to see the responsive effect (the columns will stack on top of each other instead of floating next to each other, when the screen is less than 600px wide).</p>


<?php
$no     = 0;
$total     = 0;
while ($row = mysqli_fetch_array($query))
{
    #similar to JSON object
    echo '<div class="row">
  <div class="column" style="background-color:#aaa;">
    <h2>Coach</h2>
    <img style="float: left;" class="image" src=Coach_Photos/'.$row['c_pic'].'>
      <h3>'.$row['c_name'].'</h3>
      <h3>'.$row['c_email'].'</h3>
      <h3>'.$row['c_phone'].'</h3>
  </div>
  <div class="column" style="background-color:#bbb;">
    <h2>General Manager</h2>
    <img style="float: left;" class="image" src=gm_pics/'.$row['gm_pic'].'>
      <h3>'.$row['gmname'].'</h3>
      <h3>'.$row['gm_email'].'</h3>
      <h3>'.$row['gm_phone'].'</h3>
  </div>
  <div class="column" style="background-color:#ccc;">
    <h2>Owner</h2>
    <p>Some text..</p>
    <p>Some text..</p>
  </div>
</div>';
}?>
</body>
</html>
<style>
* {
    box-sizing: border-box;
}

/* Create three equal columns that floats next to each other */
.column {
    float: left;
    width: 33.33%;
    padding: 10px;
    height: 300px; /* Should be removed. Only for demonstration */
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}

/* Responsive layout - makes the three columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
    .column {
        width: 100%;
    }
}
.image {
  height: 200px;
  width: 200px;
  position: inherit;
  opacity: .6;
  z-index: 2;
  transition: .3s;
}
h3 {
    text-align: center;
}
</style>
