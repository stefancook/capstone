<?php
$urlstring = $_SERVER[ 'REQUEST_URI' ];
$p_id = substr( $urlstring, 8 );
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
?>


<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Client Page</title>
  <link rel="stylesheet" href="menu.css" media="screen">
</head>
<body>
  <h1> Player Menu <?php echo $p_id ?></h1>



</body>
</html>
