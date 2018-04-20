<?php

if ($_REQUEST['Submit']) {
  check_login();
} else {
  display_form();
}

function check_login () {
//connect to database
$db_host = 'capstone.cfiax0xaq0zu.us-west-1.rds.amazonaws.com'; // Server Name
$db_user = 'stefancook'; // Username
$db_pass = 'SCapril5'; // Password
$db_name = 'Capstone_DB_2.0'; // Database Name

//notification if not connected
$conn = mysql_connect($db_host, $db_user, $db_pass);

if (!$conn) {
	die ('Failed to connect to MySQL: ' . mysql_connect_error());
}
$db_selected = mysql_select_db($db_name, $conn);

$username = trim($_REQUEST['username']);
$password = trim($_REQUEST['password']);
// $md5_password = md5($password);
$md5_password = ($password);

$sql = "SELECT email, `password`, agent_fullname, agent_id
		FROM Player_Agents
    WHERE email ='$username'
    AND `password` ='$md5_password'";


// echo $sql;
// parse_str($username)
$result = mysql_query($sql, $conn) or die(mysql_error());
$row = mysql_fetch_row($result);
$namez = $row[2];

if(!$result || mysql_num_rows($result) <= 0)
{
  echo "<p></p>login failed<p></p>";
  echo "<a class='button' href='/login3.php'> <button>Back to Login</button></a>";

  return true;
} else {
#set cookie
#$namez can be used to display concatenated first and last name of agent - requires
#$display_name = "SELECT CONCAT(first_name,' ',last_name FROM login JOIN agent ON login.agent_ID = agent.agent_ID)"
// $trimmed = trim($username, "Hdle");
// $namez = var_dump($trimmed);
// $namez = "$username";
setcookie("username", $namez, time()+30*24*60*60);
setcookie("name", $row[3], time()+30*24*60*60);
header('Location: http://www.aimscapstone.site/capstone.php?='.$row[3].'');
}
}

function display_form () {

echo <<<END

<link rel="stylesheet" class="w3-grayscale-min" href="menu.css" media="screen">
<meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0"/>

  <form class=login id='login' action='login2.php' method='post' accept-charset='UTF-8'>
  <script src="js/login2.js"></script>

  <fieldset>
  <h1>Client <br></br>Management<br></br> Engine</h1>

  <input type='hidden' name='submitted' id='submitted' value='1'/>

  <input type='text' placeholder="Username" style="color: white;"name='username' id='username'  maxlength="50" />

  <input type='password' placeholder="Password" style="color: white;" name='password' id='password' maxlength="50" />

  <input class="button_slide slide_down" type='submit' name='Submit' value='Submit' />
</fieldset>
</form>

END;
}
?>
<style>
html {
  font-family: Texta, sans-serif;  line-height: 1.15; /* 2 */
  -ms-text-size-adjust: 100%; /* 3 */
  -webkit-text-size-adjust: 100%; /* 3 */
}
.login {
  outline: none;
  border: none;
}
body{

  font-family: sans-serif;
  background: black url('lbg.jpg');
  width: 100%;
  background-repeat: no-repeat;
  background-size: 100%;

  text-align: center;
  background-size: contain;
  background-position: center;
  background-repeat: no-repeat;
}
input[type="text"], input[type="password"]{
  float: centered;

    outline: none;
    font-size: 2em;
    padding: 10px;
    display: block;
    width: 300px;
    border-radius: 3px;
    margin: 20px auto;
    background: none;
    border-top: none;
    border-left: none;
    border-right: none;
    color: white;

    border-bottom: white solid 8px;
}
input[type="submit"]{
  padding: 10px;
  font-size: 1.4em;

  color: black;
  background: white;
  width: 320px;
  margin: 20px auto;
  margin-top: 0px;
  border: 0px;
  border-radius: 3px;
  cursor: pointer;
}
input[type="submit"]:hover{
background: none;

}
.header{
  border-bottom: 1px solid #eee;
  padding: 10px 0px;
  width: 100%;
  text-align: center;
}
.header a{
  color: grey;
  text-decoration: none;
  width: 100%;
}
h1 {
  color: white;
  float: left;
  font-weight: bold;
  font-size: 4em;
  margin-bottom: 0.2em;
  margin-left: 0.2em;

  margin-top: 2.0em;
  text-align: left;

}
h3 {
  color: white;
  font-weight: normal;
  font-size: 1.4em;
  margin-top: 2.0em;
  margin-bottom: 0.8em;
}
.relog {
  width: 100%
  display: inline-block;
  padding: 10px 15px;
  margin-bottom: 10px;
}
.button {
  width: 100%;
}
.form {
  display: none;
}
fieldset {
  border: none;
}
.container {
  position: relative;
  top: 20px;
  margin-top: -20px;
  bottom: 0;
  left: 0;
  right: 0;
  height: relative;
  width: 30%;
  margin: auto;
  border-radius: 8px;
}
@media only screen and (max-width: 1000px) {
    .container {
        position: inherit;
        float: center;
        width: 100%;
    }
}
</style>
dfsf