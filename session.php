<?php
   include('db.php');
   session_start();

   $user_check = $_SESSION['login_user'];

   $ses_sql = mysqli_query($db,"select email from users where email = '$user_check' ");

   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

   $login_session = $row['email'];

   $sql = "SELECT * FROM users WHERE email = '$login_session' and valid='1'";
   $result = mysqli_query($db,$sql);
   $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
   $users_id = $row['users_id'];
   $users_email = $row['email'];
   // $caminho_git = "https://raw.githubusercontent.com/Jard1988/IPTV/main/Listas/";
   $caminho_git = CAMINHO_URL;


   if(!isset($_SESSION['login_user'])){
      header("location:index.php");
   }
?>
