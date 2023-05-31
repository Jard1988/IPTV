<?php
//ATENÇÃO AOS NUMEROS DAS LINHAS PODE ALTERAR CODIGO NO MENU/GERAL/EDIT_WEBSITE.PHP

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'iptvplanner');

// define('DB_SERVER', 'localhost');
// define('DB_USERNAME', 'u615300448_geral');
// define('DB_PASSWORD', 'AdminAdmin1+');
// define('DB_DATABASE', 'u615300448_iptvplanner');

define('MAIL_HOST', 'smtp.titan.emailklh');
define('MAIL_USERNAME', 'IPTV Planner');
define('MAIL_PASSWORD', 'IPTVPlanner1*');
define('MAIL_PORT', '587');
define('MAIL_NAME', 'IPTV Planner');

// define('TWILIO_ACCOUNT_SID', 'ACef846a8f5f3a07ae3246486fef91e8bf');
// define('TWILIO_AUTH_TOKEN', '03eff5324631e0d38e91ed2f9c56651e');
// define('TWILIO_AUTH_PHONE', '+14345973989');

define('M3U', 'http://iptvplanner.pt/Listas/Teste.m3u');

define('CAMINHO_URL', 'http://localhost/IPTV/');

define('RAIZ_CAMINHO', 'Listas/');


// Create connection
$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

// Check connection
if (!$db){
	//die("Connection failed: " . mysqli_connect_error());
	die("Connection failed. Verifique as suas ligações se estão corretas nas definições do Site");
}

?>
