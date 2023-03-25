<?php
   include('session.php');
?>

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
    	function getPage(id) {
            jQuery.ajax({
                url: "menu/"+id+".php",
                type: "POST",
                success:function(data){$('#output').html(data);},
                beforeSend: function() { $('#loader').show(); },
                complete: function() { $('#loader').hide(); }
            });
    	}

      function getPageRaiz(id) {
            jQuery.ajax({
                url: id+".php",
                type: "POST",
                success:function(data){$('#output').html(data);},
                beforeSend: function() { $('#loader').show(); },
                complete: function() { $('#loader').hide(); }
            });
    	}
	   </script>
   </head>
   <body>

  	<div id="loader" style="display: none; margin: 0px; padding: 0px; position: fixed; right: 0px; top: 0px; width: 100%; height: 100%; background-color: rgb(102, 102, 102); z-index: 30001; opacity: 0.8;">
	<p style="position: absolute; color: White; top: 50%; left: 45%;">
	Loading, please wait...
	<img src="img/ajax-loader.gif">
	</p>
	</div>

  	<div class="header">
	     <div class="container">
	        <div class="row">
	           <div class="col-md-4">
	              <!-- Logo -->
	              <div class="logo">
	                 <h1><a href="home.php">IPTV Planner</a></h1>
	              </div>
	           </div>
	           <div class="col-md-8">
	              <div class="navbar navbar-inverse" role="banner">
	                  <div class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
                          <ul class="nav navbar-nav">
                              <li class="dropdown">

                                      <a class="dropdown-toggle" type="button" data-toggle="dropdown">Notifications
                                          <span class="badge badge-light">4</span>&nbsp;<span class="caret"></span></a>
                                      <ul class="dropdown-menu">
                                          <li><a href="#">notificacao 1</a></li>
                                          <li><a href="#">notificacao 2</a></li>
                                          <li><a href="#">notificacao 3</a></li>
                                      </ul>
                              </li>
                              <li><a href="logout.php">Logout</a></li>
                          </ul>
	                  </div>
	              </div>
	           </div>
	        </div>
	     </div>
	</div>

    <div class="page-content" id="page-content">
    	<div class="row">
		  <div class="col-md-2">
                <section style="width: 200px">
                    <ul class="sidebar-menu">
                        <li class="sidebar-header">NAVEGAÇÂO</li>
                        <?php
                          $sql = "SELECT * FROM users WHERE email = '$login_session' and permission_id >= '3'";
                          $result = mysqli_query($db,$sql);
                          $count = mysqli_num_rows($result);

                          if ($count >= 1){
                        ?>
                        <li>
                            <a href="#" onClick="getPageRaiz('refresh');">
                                <i class="fa fa-spinner" aria-hidden="true"></i>
                                <span><b>Atualizar</b></span>
                              </a>
                        </li>
                        <li>
                            <a href="#" onClick="getPage('geral');"><i class="fa fa-home" aria-hidden="true"></i>
                                <span>Geral</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="sidebar-submenu" style="display: none;">
                                <li><a href="#" onClick="getPageRaiz('404');"><i class="fa fa-circle-o"></i> Editar Website</a></li>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" onClick="getPage('users/all-users');">
                                <i class="fa fa-users" aria-hidden="true"></i>
                                <span>Utilizadores</span>
                                <i class="fa fa-angle-left pull-right"></i>
<!--                                <span class="label label-primary pull-right">4</span>-->
                            </a>
                            <ul class="sidebar-submenu" style="display: none;">
                                <li><a href="#" onClick="getPage('users/search-user');"><i class="fa fa-search" aria-hidden="true"></i>Procurar</a></li>
                                <li><a href="#" onClick="getPage('users/all-users');"><i class="fa fa-list" aria-hidden="true"></i> Listar Todos</a></li>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" onClick="getPage('send-email');">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                <span>Email</span>
                                <i class="fa fa-angle-left pull-right"></i>
<!--                                <span class="label label-primary pull-right">4</span>-->
                            </a>
                            <ul class="sidebar-submenu" style="display: none;">
                                <li><a href="#" onClick="getPage('send-email');"><i class="fa fa-reply" aria-hidden="true"></i>Enviar Email</a></li>
                                <li><a href="#" onClick="getPageRaiz('404');"><i class="fa fa-reply-all" aria-hidden="true"></i>Mass Email</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"">
                                <i class="fa fa-users" aria-hidden="true"></i>
                                <span>Linhas</span>
                                <i class="fa fa-angle-left pull-right"></i>
<!--                                <span class="label label-primary pull-right">4</span>-->
                            </a>
                            <ul class="sidebar-submenu" style="display: none;">
                                <li><a href="#" onClick="getPageRaiz('404');"><i class="fa fa-search" aria-hidden="true"></i>Procurar</a></li>
                                <li><a href="#" onClick="getPage('linhas/all-lines');"><i class="fa fa-list" aria-hidden="true"></i> Listar Todos</a></li>
                                </li>
                            </ul>
                        </li>
                        <?php
                        }
                        ?>
                        <li>
                            <a href="#" onClick="getPageRaiz('404');">
                                <i class="fa fa-th"></i> <span>Widgets</span>
                                <small class="label pull-right label-info">new</small>
                            </a>
                        </li>
                        <li><a href="#" onClick="getPage('teste');"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
                    </ul>
                </section>
		  </div>
		  <div class="col-md-10">
				<div id="output">
          <div style="font-size: 30px; text-align: left;">
            <div class="col-md-10">
              <span>Bem Vindo</span> <b><?php echo $users_email; ?></b>
            </div>
          </div>
          <div class="col-md-12" style="margin-bottom: 7%; margin-top: 6%; text-align: center;">
            <img src="img/fundo.png">
          </div>
		  </div>
		</div>
    </div>
	<a href="#0" class="cd-top">Top</a>
    <footer>
         <div class="container">

            <div class="copy text-center">
               <span>Copyright © 2020 | <a href="http://bootstraptaste.com/">TECH-DEV Themes</a> by TECH-DEV Team </span>
            </div>

         </div>
      </footer>
	</body>
  <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
  <script src="./js/sidebar-menu.js"></script>
  <script>
      $.sidebarMenu($('.sidebar-menu'))
  </script>
</html>
