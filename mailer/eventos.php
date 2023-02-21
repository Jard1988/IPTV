<?php
error_reporting (E_ALL ^ E_NOTICE);
include("db.php");
session_start();

if(!isset($_SESSION['isLoggedIn']) || !($_SESSION['isLoggedIn']))
{
    //code for authentication comes here
    //ASSUME USER IS VALID
    $_SESSION['isLoggedIn'] = false;
    /////////////////////////////////////////
    $_SESSION['timeOut'] = 1800; // time in seconds 30m intatividade
    $logged = time();
    $_SESSION['loggedAt']= $logged;
}
else
{
    $_SESSION['isLoggedIn'] = true;
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
?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airsoft Planner</title>

    <!-- script-->
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <!-- Custom Theme files -->
    <link href="css/iconeffects.css" rel='stylesheet' type='text/css' />
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="css/swipebox.css">
    <script src="js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="js/move-top.js"></script>
    <script type="text/javascript" src="js/InitScript.js"></script>
    <script type="text/javascript" src="js/easing.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="js/jquery.swipebox.min.js"></script>
    <link rel="stylesheet" href="css/colorbox.css" />
    <script src="js/jquery.colorbox.js"></script>
    <!--/web-font-->
    <link href='//fonts.googleapis.com/css?family=Italianno' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Merriweather+Sans:400,300,700' rel='stylesheet' type='text/css'>
    <!--/script-->

    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('html,body').animate({scrollTop:$(this.hash).offset().top},900);
        });

        jQuery(function($) {
            $(".swipebox").swipebox();
        });
    </script>

    <!--animate-->
    <link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
    <script src="js/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
</head>

<body>
<!-- LOG IN BOX -->
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div id="forgotbox" style="display: none; margin-top: -8px; margin-left: 0px; width: -webkit-fill-available;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="panel panel-info" >
                        <div class="panel-heading">
                            <div class="panel-title">Forgot Password</div>
                            <div style="float:right; font-size: 80%; position: relative; top:-10px">
                                <a href="#" onClick="$('#loginbox').show(); $('#forgotbox').hide()">Sign in</a>
                            </div>
                        </div>

                        <div style="padding-top:30px" class="panel-body" >
                            <form action = "" method = "post">

                                <div style="margin-bottom: 25px" class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input id="forgot-email" required="" type="text" class="form-control" name="email" value="" placeholder="email">
                                </div>

                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->
                                    <input id="forgotbutton" required="" class="btn btn-success" type = "submit" value = "Recuperar"/><br><br>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12 control">
                                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                            Don't have an account!
                                            <a onClick="$('#loginbox').hide(); $('#forgotbox').hide(); $('#signupbox').show()">
                                                Sign Up Here
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div id="outputforgot" style = "text-align: center; font-size:11px; color:#cc0000; margin-top:10px"></div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="loginbox" style="margin-top: -7px; margin-left: 0px; width: -webkit-fill-available;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="panel panel-info" >
                        <div class="panel-heading">
                            <div class="panel-title">Sign In</div>
                            <div style="float:right; font-size: 80%; position: relative; top:-10px">
                                <a href="#" onClick="$('#loginbox').hide(); $('#forgotbox').show()">Forgot password?</a>
                            </div>
                        </div>
                        <div style="padding-top:30px" class="panel-body" >
                            <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            <form action = "" method = "post">
                                <div style="margin-bottom: 25px" class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input id="signin-email" required="" class="form-control" type = "text" name = "email" class = "box" placeholder="email">
                                </div>
                                <div style="margin-bottom: 25px" class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input id="signin-pwd" required="" type="password" class="form-control" class = "box" name="password" placeholder="password">
                                </div>
                                <input id="loginbutton" class="btn btn-success" type = "submit" value = "Submit"/><br><br>
                                <div class="form-group">
                                    <div class="col-md-12 control">
                                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                            Don't have an account!
                                            <a href="#" onClick="$('#loginbox').hide(); $('#forgotbox').hide(); $('#signupbox').show()">
                                                Sign Up Here
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <br>
                            <div id="outputlogin" style = "text-align: center; font-size:11px; color:#cc0000; margin-top:10px"></div>
                        </div>
                    </div>
                </div>
                <div id="signupbox" style=" display:none; margin-top: -8px; margin-left: 0px; width: -webkit-fill-available;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="panel-title">Sign Up</div>
                            <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="#" onclick="$('#signupbox').hide(); $('#loginbox').show()">Sign In</a></div>
                        </div>
                        <div class="panel-body" >
                            <form action = "" method = "post">
                                <div style="margin-bottom: 25px" class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input id="signup-email" required="" class="form-control" type = "text" name = "email" class = "box" placeholder="email">
                                </div>
                                <div style="margin-bottom: 25px" class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input id="signup-pwd" required="" type="password" class="form-control" class = "box" name="password" placeholder="password">
                                </div>
                                <div style="margin-bottom: 25px" class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input id="signup-pwd2" required="" type="password" class="form-control" class = "box" name="password2" placeholder="re-password">
                                </div>
                                <input id="signupbutton" class="btn btn-success" type = "submit" value = "Sign Up"/><br />

                            </form>
                            <br>
                            <div id="outputsignup" style = "text-align: center; font-size:16px; color:#cc0000; margin-top:10px"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<!-- END LOGIN BOX -->

<!-- LOADER -->
<div id="loader" style="display: none; margin: 0px; padding: 0px; position: fixed; right: 0px; top: 0px; width: 100%; height: 100%; background-color: rgb(102, 102, 102); z-index: 30001; opacity: 0.8;">
    <p style="position: absolute; color: White; top: 50%; left: 45%;">
        Loading, please wait...
        <img src="images/ajax-loader.gif">
    </p>
</div>
<!-- END LOADER -->

<!--start-home-->
<div class="banner" id="home">
    <div class="header-bottom wow slideInDown"  data-wow-duration="1s" data-wow-delay=".3s">
        <div class="container">
            <div class="fixed-header">
                <!--logo-->
                <div class="logo">
                    <a href="index.php"><h1>A<span>irsoft Planner</span></h1></a>
                </div>
                <!--end logo-->
                <<!--MENU-->
                <div class="top-menu">
                    <span class="menu"></span>
                    <nav class="link-effect-4" id="link-effect-4">
                        <ul>
                            <li><a data-hover="Inicio" href="index.php">Inicio</a></li>
                            <li><a data-hover="Sobre " href="#about" class="scroll">Sobre</a></li>
                            <li><a data-hover="Serviços" href="#services" class="scroll">Serviços</a></li>
                            <li><a data-hover="Galeria" href="#gallery" class="scroll">Galeria</a></li>
                            <li><a data-hover="Comentários" href="#review" class="scroll">Comentários</a></li>
                            <?php
                            if ($_SESSION['isLoggedIn'] == true){
                                ?>
                                <li><a data-hover="Eventos" href="eventos.php" class="scroll">Eventos</a></li>
                            <?php } ?>
                            <li><a data-hover="Contato" href="#contact" class="scroll">Contato</a></li>
                        </ul>
                    </nav>
                </div>
                <!-- script-for-menu -->
                <script>
                    $("span.menu").click(function(){
                        $(".top-menu ul").slideToggle("slow" , function(){
                        });
                    });
                </script>
                <!-- script-for-menu -->

                <div class="clearfix"></div>
                <script>
                    $(document).ready(function() {
                        var navoffeset=$(".header-bottom").offset().top;
                        $(window).scroll(function(){
                            var scrollpos=$(window).scrollTop();
                            if(scrollpos >=navoffeset){
                                $(".header-bottom").addClass("fixed");
                            }else{
                                $(".header-bottom").removeClass("fixed");
                            }
                        });

                    });
                </script>
            </div>

            <?php
            if ($_SESSION['isLoggedIn'] == false){
                ?>
                <!-- LOGIN -->
                <div class="login" id="login">
                    <button id="buttonlogin" type="button" data-toggle="modal" data-target="#myModal" class="btn btn-success" type="button">Login</button>
                </div>
                <!-- END LOGIN -->
            <?php } else { ?>
                <!-- LOGOUT -->
                <div class="logout" id="logout">
                    <button id="buttonlogout" onclick="location.href='logout.php';" class="btn btn-success" type="button">Logout</button>
                </div>
                <!-- END LOGOUT -->
            <?php } ?>

            <div class="dropdown">
                <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">Idioma
                    <span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li><a href="index.php?lang=pt" value='pt'>Português</a></li>
                    <li><a href="index.php?lang=en" value='en' >Inglês</a></li>
                </ul>
            </div>
        </div>
    </div>
<!-- end MENU -->

    <!-- Google Map -->
<div class="section-map" id="map">
    <div class="map wow fadeInDown"  data-wow-duration=".8s" data-wow-delay=".5s">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1675115.8258740564!2d-98.4671417929578!3d34.91371150021706!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x54eab584e432360b%3A0x1c3bb99243deb742!2sUnited+States!5e0!3m2!1sen!2sin!4v1434956093308"></iframe>
    </div>
</div>
<!-- End Google Map -->

<!--/contact-->
<div class="section-contact" id="contact">
    <div class="container">
        <div class="contact-main">
            <div class="col-md-6 contact-grid wow fadeInUp"  data-wow-duration="1s" data-wow-delay=".3s">
                <h3 class="tittle wow bounceIn"  data-wow-duration=".8s" data-wow-delay=".2s">Contato</h3>
                <div class="arrows-three"><img src="images/border.png" alt="border"></div>
                <p class="wel-text wow fadeInDown"  data-wow-duration=".8s" data-wow-delay=".4s">Descrição</p>

                <form action="" method="post">

                    <div class="field name-box">
                        <input type="text" name="name" id="contactName" placeholder="Nome" required=""/>
                        <label for="name">Nome</label>
                        <span class="ss-icon">Nome Botão</span>
                    </div>

                    <div class="field phonenum-box">
                        <input type="text" name="phone" id="contactPhone" placeholder="Telefone" required=""/>
                        <label for="phone">Telefone</label>
                        <span class="ss-icon">Telefone</span>
                    </div>

                    <div class="field email-box">
                        <input type="text" name="email" id="contactEmail" placeholder="Email" required=""/>
                        <label for="email">Email</label>
                        <span class="ss-icon">Email</span>
                    </div>

                    <div class="field msg-box">
                        <textarea id="contactMsg" name="msg" rows="4" placeholder="Mensagem" required=""/ ></textarea>
                        <label for="msg">Mensagem</label>
                        <span class="ss-icon">Mensagem</span>
                    </div>
                    <div class="send wow shake"  data-wow-duration="1s" data-wow-delay=".3s">
                        <input name="submit" type="submit" id="contactbutton" value="Enviar" >
                    </div>

                </form>
                <div id="outputContact" style = "text-align: center; font-size:18px; color:#cc0000; margin-top:10px"></div>
            </div>
            <div class="col-md-6 contact-in wow fadeInUp"  data-wow-duration="1s" data-wow-delay=".5s">
                <h4 class="info">Informação</h4>
                <p class="para1">Informação Descrição</p>
                <div class="con-top">
                    <h4>Distrito</h4>
                    <ul>
                        <li>Morada</li>
                        <li>Código Postal</li>
                        <li>Localização</li>
                        <li>Telefone</li>
                        <li><a href="nuno_jard@hotmail.com">nuno_jard@hotmail.com</a></li>
                    </ul>
                </div>
            </div>

            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<!--//contact-->

<!--footer-->
<div class="footer text-center">
    <div class="container">
        <!--logo2-->
        <div class="logo2 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
            <a href="index.php"><h2><span>Cerberus Airsoft Team</span></h2></a>
            <p>Titulo</p>
        </div>
        <!--//logo2-->
        <a href="single.html" class="flag_tag2">Contacto</a>
        <ul class="social wow slideInDown" data-wow-duration="1s" data-wow-delay=".3s">
            <li><a href="#" class="tw"></a></li>
            <li><a href="#" class="fb"> </a></li>
            <li><a href="#" class="in"> </a></li>
            <li><a href="#" class="dott"></a></li>
            <div class="clearfix"></div>
        </ul>
        <p class="copy-right wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">&copy; 2019 Tech4Us. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>

    </div>
</div>
<!-- end footer -->

<a href="#home" id="toTop" class="scroll" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>

</body>
</html>
