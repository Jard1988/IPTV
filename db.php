<?php


define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'iptvplanner');

define('MAIL_HOST', 'smtp.gmail.com');
<<<<<<< HEAD
define('MAIL_USERNAME', 'geraliptvplanner@gmail.com');
define('MAIL_PASSWORD', 'vwscapohsysmhsia');
=======
define('MAIL_USERNAME', 'geral.iptvplanner@gmail.com');
define('MAIL_PASSWORD', 'jpyvtiushigoyazx');
>>>>>>> 5e00555278730878cd44c94cb32264ec13d846c6
define('MAIL_PORT', '587');
define('MAIL_NAME', 'IPTV Planner');

//define('DB_SERVER', '81.88.53.63');
//define('DB_USERNAME', 'bv56glrq_1060735');
//define('DB_PASSWORD', '90#P1pr)kB&C');
//define('DB_DATABASE', 'bv56glrq_airsoftplanner');

// Create connection
$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

// Check connection
if (!$db){
	die("Connection failed: " . mysqli_connect_error());
}

?>
