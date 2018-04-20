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
$sql = 'SELECT CONCAT(player_first_name," ",player_last_name) as p_fullname, player_first_name as pfname,
               CONCAT(NHL_Coach_First_Name," ",NHL_Coach_Last_Name) as c_name,
               NHL_Coach_Phone_Number as c_email, NHL_Coach_Email as c_phone,
               NHL_Coach_Pic as c_pic, CONCAT(NHL_GM_First_Name," ",NHL_GM_Last_Name) as gmname,
               NHL_GM_Email as gm_email, NHL_GM_Phone_Number as gm_phone, NHL_GM_Photo as gm_pic,
               CONCAT(Owner_First_Name," ",Owner_Last_Name) as o_name, Owner_Email as o_email,
               Owner_Phone_Number as o_phone, Owner_pic as o_pic,
               CONCAT(Contact_First_Name," ",Contact_Last_Name) as f_name, Contact_Email_Address as f_email,
               Contact_Phone_Number as f_phone, Family_Primary_Contact_Picture as f_pic
                FROM NHL_Coaches
                JOIN Teams
                ON NHL_Coaches.teams_team_id = Teams.team_ID
                JOIN gen_managers
                ON Teams.team_id = gen_managers.Teams_Team_ID
                JOIN hockey_players
                ON Teams.team_id = hockey_players.teams_team_id
                JOIN Team_Owners
                ON Teams.team_id = Team_Owners.Teams_Team_ID
                JOIN Family_Primary_Contact
                ON hockey_players.player_id = Family_Primary_Contact.CAA_Hockey_Players_Player_ID
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
<link rel="stylesheet" href="menu.css" media="screen">
<meta charset="UTF-8">

</head>
<body>

  <div class="dropdown">
  	<button onclick="myFunction()" class="button_slide slide_left" button class="btn rel">Menu</button>
  	<div id="myDropdown" class="dropdown-content">
  		<a href="/analytics.php?=<?php echo $p_id?>">Analytics</a>
  		<a href="/metric.php?=<?php echo $p_id?>">Client Metric Monitor</a>
      <a href="/salary.php?=<?php echo $p_id?>">Contract Analytics</a>
      <a href="/contact2.php?=<?php echo $p_id?>">Player Contact</a>
      <a href="/acquisition.php?=<?php echo $p_id?>" >Acquisitions</a>
      <a href="/menu.php?=<?php echo $p_id ?>"class="button_slide slide_left">Back</a>
  	</div>
  </div>
  <div style="width:1000px; margin:0 auto;">

<div style="margin-top: -130px;">

<h1 style="font-family: sans-serif;">Contact page</h1>
</div>
	</div>



<?php
$no     = 0;
$total     = 0;
while ($row = mysqli_fetch_array($query))
{
    #similar to JSON object
    echo '
    <h3 style="text-align: center; font-size: 17px;">Contacts for '.$row['p_fullname'].'</h3>
    <br></br>

    <div class="container">
    <div class="row">
    <div class="column">
    <h2>Head Coach</h2>
    <img style="float: left; border-radius: 50%;" class="image" src=Coach_Photos/'.$row['c_pic'].'>
    <h3>'.$row['c_name'].'</h3>
    <a href="mailto:'.wordwrap($row['c_email'],10,"<br>\n").'?Subject=Reaching%20out%about%'.$row['pfname'].'" target="_top"><h3>'.wordwrap($row['c_email'],10,"<br>\n").'</h3></a>
    <a href="tel:+'.$row['c_phone'].'"><h3>+'.$row['c_phone'].'</h3></a>

  </div>
  <div class="column" style="background-color: WhiteSmoke; border-radius: 20px;">
    <h2>General Manager</h2>
    <img style="float: left; border-radius: 50%;" class="image" src=gm_pics/'.$row['gm_pic'].'>
    <div class="content">
    <h3>'.$row['gmname'].'</h3>
    <a href="mailto:'.wordwrap($row['gm_email'],10,"<br>\n").'?Subject=Reaching%20out%about%'.$row['pfname'].'" target="_top"><h3>'.wordwrap($row['gm_email'],10,"<br>\n").'</h3></a>
    <a href="tel:+'.$row['gm_phone'].'"><h3>+'.$row['gm_phone'].'</h3></a>
    </div>

  </div>
  <br>
  <div class="column"style="background-color: WhiteSmoke; border-radius: 20px;">
    <h2>Team Owner</h2>
    <img style="float: left; border-radius: 50%;" class="image" src=pics/'.$row['o_pic'].'>
    <div class="content">
    <h3>'.$row['o_name'].'</h3>
    <a href="mailto:'.wordwrap($row['o_email'],10,"<br>\n").'?Subject=Reaching%20out%about%'.$row['pfname'].'" target="_top"><h3>'.wordwrap($row['o_email'],10,"<br>\n").'</h3></a>
    <a href="tel:+'.$row['o_phone'].'"><h3>+'.$row['o_phone'].'</h3></a>
    </div>
  </div>
  <div class="column">
    <h2>Family Contact</h2>
    <img style="float: left; border-radius: 50%;" class="image" src='.$row['f_pic'].'>
    <div class="content">
    <h3>'.$row['f_name'].'</h3>
    <a href="mailto:'.wordwrap($row['f_email'],10,"<br>\n").'?Subject=Reaching%20out%about%'.$row['pfname'].'" target="_top"><h3>'.wordwrap($row['f_email'],10,"<br>\n").'</h3></a>
    <a href="tel:+'.$row['f_phone'].'"><h3>+'.$row['f_phone'].'</h3></a>
    </div>

  </div>



  <br></br>
  <p></p>

  <div>
    <p style="text-align: center; margin-left: 450px;">©2018 Stefan Cook and Marcus Nordstrom.</p>

  </div>
  </div>';
}?>


</div>
</body>

</html>
<style>
* {
    box-sizing: border-box;
}

/* Create three equal columns that floats next to each other */
.column {
    float: left;
    width: 35%;
    padding: 10px;
    margin: 4px;
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
  height: 100px;
  width: 100px;
  position: inherit;
  z-index: 2;

}
h3 {
  margin: 2px;
  padding: 3px;
  padding-left: 8px;
  word-break: break-all;
}
h2 {
  border-top: 3px;
  border-radius: 4px;
  margin-left: 4px;
  text-align: center;
  font-size: 28px;
  font-family: sans-serif;

}
.container {
  float: center; margin-left: 400px;
}
.head{
  font-weight: bold;
  font-size: 80px;
  margin-bottom: 0.2em;
  color: black;
  font-family: sans-serif;
  text-align: center;

}
@media only screen and (max-width: 1300px) {
  .container {
    float: center; margin-left: 200px;
  }
}
.footer {
    position: fixed;
    bottom-margin: 10px;
    width: 100%;
    background: red;
    text-align: center;
    color: #white;
}
h3{
  font-size: 17px;
  text-align: center;
  }
.content{
  text-align: left;
}
</style>
