<!DOCTYPE html>
<html>
  <head>
    <title>IPTV Planner</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->

    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	  <link href="css/back_to_top.css" rel="stylesheet">
    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">
    <script type="text/javascript" src="js/ajax.js"></script>
	  <script src="http://code.jquery.com/jquery-2.1.1.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="js/back_to_top.js"></script> <!-- Gem jQuery -->

	  <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <link href="vendors/form-helpers/css/bootstrap-formhelpers.min.css" rel="stylesheet">
    <link href="vendors/select/bootstrap-select.min.css" rel="stylesheet">
    <link href="vendors/tags/css/bootstrap-tags.css" rel="stylesheet">
	  <link href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
    <link href="css/forms.css" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/sidebar-menu.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <script type="text/javascript">
      function ForgotPassword() {
        var email = document.getElementById("forgot-email").value;
        alert(email);

        jQuery.ajax({
            url: "forgotpassword.php",
            type: "post",
            data: {
              email: email
            },
            datatype: "html",
            contenttype: 'application/html; charset=utf-8',
            async: true,
            success:function(data){$('#outputForgotPassword').html(data);},
            beforeSend: function() { $('#loader').show(); },
            complete: function() { $('#loader').hide(); }
        });
      }
    </script>
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

     <div id="loader" style="display: none; margin: 0px; padding: 0px; position: fixed; right: 0px; top: 0px; width: 100%; height: 100%; background-color: rgb(102, 102, 102); z-index: 30001; opacity: 0.8;">
   <p style="position: absolute; color: White; top: 50%; left: 45%;">
   Loading, please wait...
   <img src="img/ajax-loader.gif">
   </p>
   </div>

     <center>
       <img style="width: 30%;" src="img/fundo.png"/>
     </center><br><br><br><br><br><br><br><br><br><br>

     <!-- ForgotPassword Modal -->
     <div class="modal fade" id="recoverypass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="modal-header">
                   <h4 class="modal-title" id="myModalLabel">Recuperar Password</h4>
                     <button type="button" class="close" data-dismiss="modal"> <span aria-hidden="true" class="">× </span><span class="sr-only">Close</span>
                     </button>
                 </div>
                 <div class="modal-body-2">
                   <form action = "" method = "post" style="margin-left: 20%; margin-top: 20px;">

                                    <div style="margin-bottom: 25px; width: 80%;" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="forgot-email" required="" type="text" class="form-control" name="email" value="" placeholder="email">
                                    </div>

                                    <!-- <div class="form-group">
                                        <div class="col-md-12 control">
                                            <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                                Don't have an account!
                                                <a onClick="$('#loginbox').hide(); $('#forgotbox').hide(); $('#signupbox').show()">
                                                    Sign Up Here
                                                </a>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div id="outputforgot" style = "text-align: center; font-size:11px; color:#cc0000;"></div>
                                </form>
                 </div>
                 <div class="modal-footer" style="text-align: center;">
                   <div class="form-group">
                       <!-- Button -->
                       <input onclick="ForgotPassword();" id="forgotbutton" required="" class="btn btn-primary" type = "submit" value = "Recuperar"/>
                   </div>
                 </div>
                 <div id="outputForgotPassword" style = "font-size:11px; color:#cc0000;" align="center"></div>
             </div>
         </div>
     </div>
     <!-- End ForgotPassword Modal -->

	<div class="page-content container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="login-wrapper">
			        <div class="box" style="margin-top: -50%;">
			            <div class="content-wrap">
			                <h6>Sign Up</h6>
			                    <form action = "" method = "post">
									<input class="form-control" type = "text" name = "email" class = "box"/><br />
									<input class="form-control" type = "password" name = "password" class = "box" /><br/><br />
									<input class="btn btn-primary signup" type = "submit" value = " Submit "/>
								</form>
                <div >
                  <a data-toggle="modal" data-target="#recoverypass">Forgot password?</a>
                </div><br>

								<div style = "font-size:11px; color:#cc0000; margin-top:0px"><?php echo $error; ?></div>
						</div>
					</div>
				</div>
        <div>
        </div>
			</div>
		</div>
	</div>
   </body>
</html>
