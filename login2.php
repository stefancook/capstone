<?php
echo $_REQUEST['Submit'];

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
$db_name = 'capstone'; // Database Name

//notification if not connected
$conn = mysql_connect($db_host, $db_user, $db_pass);

if (!$conn) {
	die ('Failed to connect to MySQL: ' . mysql_connect_error());
}
$db_selected = mysql_select_db($db_name, $conn);

$username = trim($_REQUEST['username']);
$password = trim($_REQUEST['password']);
$md5_password = md5($password);

$sql = "SELECT username, `password`
		FROM login
    WHERE username ='$username'
    AND `password` ='$md5_password'";
#echo $sql;

$result = mysql_query($sql, $conn) or die(mysql_error());
#echo "RESULT: $result";

if(!$result || mysql_num_rows($result) <= 0)
{
  echo "login failed";
  return false;
} else {
#set cookie
#$namez can be used to display concatenated first and last name of agent - requires
#$display_name = "SELECT CONCAT(first_name,' ',last_name FROM login JOIN agent ON login.agent_ID = agent.agent_ID)"
$namez = "$username";
setcookie("username", $namez, time()+30*24*60*60); //ideal
// setcookie("username", "aimscapstone", time()+30*24*60*60); //emergency
header('Location: http://www.aimscapstone.site/capstone.php');
}
}

function display_form () {

echo <<<END

<link rel="stylesheet" href="/login2.css" media="screen">
<form class=login id='login' action='login2.php' method='post' accept-charset='UTF-8'>
<script src="js/login2.js"></script>

<fieldset>
<h1>Hockey Data Engine</h1>
<input type='hidden' name='submitted' id='submitted' value='1'/>

<h3 for='username' >Username:</h3>
<input type='text' name='username' id='username'  maxlength="50" />

<h3 for='password' >Password:</h3>
<input type='password' name='password' id='password' maxlength="50" />

<input type='submit' name='Submit' value='Submit' />

</fieldset>
</form>

END;
}
?>
