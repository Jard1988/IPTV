<?php
  include("db.php");
	session_start();
	if(!isset($_SESSION['isLoggedIn']) || !($_SESSION['isLoggedIn']))
	{
		//code for authentication comes here
		//ASSUME USER IS VALID
		$_SESSION['isLoggedIn'] = true;
		/////////////////////////////////////////
		$_SESSION['timeOut'] = 3600; // time in seconds
		$logged = time();
		$_SESSION['loggedAt']= $logged;
	}
	else
	{
		require 'timeCheck.php';
		$hasSessionExpired = checkIfTimedOut();
		if($hasSessionExpired)
		{
			session_unset();
			header("Location:index.php");
			exit;
		}
		else
		{
			$_SESSION['loggedAt']= time();// update last accessed time
		}
	}
   $error="";

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form

      $myemail = mysqli_real_escape_string($db,$_POST['email']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']);

      $sql = "SELECT users_id FROM users WHERE email = '$myemail' and password = '$mypassword' and valid='1'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];

      $count = mysqli_num_rows($result);

      // If result matched $myusername and $mypassword, table row must be 1 row

      if($count == 1) {
         //session_register("myusername");
         $_SESSION['login_user'] = $myemail;

         header("Location: home.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>
<html>

   <head>
      <title>IPTV Planner - Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
       <script type="text/javascript" src="js/timeCheck.js.js"></script>
    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">

   </head>

   <body bgcolor = "#FFFFFF">
     <center>
       <img style="width: 30%;" src="img/fundo.png"/>
     </center><br><br><br><br><br><br><br><br><br><br>
	<div class="page-content container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="login-wrapper">
			        <div class="box" style="margin-top: -50%;">
			            <div class="content-wrap">
			                <h6>Sign Up</h6>
			                    <form action = "" method = "post">
									<input class="form-control" type = "text" name = "email" class = "box"/><br /><br />
									<input class="form-control" type = "password" name = "password" class = "box" /><br/><br />
									<input class="btn btn-primary signup" type = "submit" value = " Submit "/>
								</form>

								<div style = "font-size:11px; color:#cc0000; margin-top:0px"><?php echo $error; ?></div>
						</div>
					</div>
          <a href="contact.php"> Contato </a> | <a href="faq"> FAQ </a>
				</div>
        <div>
        </div>
			</div>
		</div>
	</div>

   </body>
</html>
