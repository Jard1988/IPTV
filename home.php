<?php
   include('session.php');
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Airsoft Planner - Cpanel</title>
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
	                 <h1><a href="home.php">Airsoft Planner Cpanel</a></h1>
	              </div>
	           </div>
	           <div class="col-md-8">
	              <div class="navbar navbar-inverse" role="banner">
	                  <div class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
	                    <ul class="nav navbar-nav">
                            <li>
                                <select  class="styled-select" id="language" name="language">
                                    <option id="1" value="pt">Português</option>
                                    <option id="2" value="en">Inglês</option>
                                </select>
					        </li>
	                    </ul>
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
                        <li class="sidebar-header">MAIN NAVIGATION</li>
                        <li>
                            <a href="#" onClick="getPage('geral');"><i class="fa fa-circle-o text-aqua"></i>
                                <span>Geral</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="sidebar-submenu" style="display: none;">
                                <li><a href="#"><i class="fa fa-circle-o"></i> Editar Website</a></li>
                                </li>
                            </ul>
                        </li>
                        <?php
                          $sql = "SELECT * FROM users WHERE email = '$login_session' and permission_id >= '3'";
                          $result = mysqli_query($db,$sql);
                          $count = mysqli_num_rows($result);

                          if ($count >= 1){
                        ?>
                        <li>
                            <a href="" >
                                <i class="fa fa-files-o"></i>
                                <span>Utilizadores</span>
                                <i class="fa fa-angle-left pull-right"></i>
<!--                                <span class="label label-primary pull-right">4</span>-->
                            </a>
                            <ul class="sidebar-submenu" style="display: none;">
<<<<<<< HEAD
                                <li><a href="#" onClick="getPage('search-user');"><i class="fa fa-circle-o"></i> Procurar</a></li>
                                <li><a href="#" onClick="getPage('all_users');"><i class="fa fa-circle-o"></i> Listar Todos</a></li>
                                <li><a href="#" onClick="getPage('invalid_users');"><i class="fa fa-circle-o"></i> Inativos</a></li>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="" >
                                <i class="fa fa-files-o"></i>
                                <span>Email</span>
                                <i class="fa fa-angle-left pull-right"></i>
<!--                                <span class="label label-primary pull-right">4</span>-->
                            </a>
                            <ul class="sidebar-submenu" style="display: none;">
                                <li><a href="#" onClick="getPage('send-email');"><i class="fa fa-circle-o"></i> Enviar Email</a></li>
                                <li><a href="#" onClick="getPage('send-email-all');"><i class="fa fa-circle-o"></i> Mass Email</a></li>
=======
                                <li><a href="#" onClick="getPage('all_users');"><i class="fa fa-circle-o"></i> Visualizar Todos</a></li>
                                <li><a href="#" onClick="getPage('search-user');"><i class="fa fa-circle-o"></i> Procurar</a></li>
                                <li><a href="#" onClick="getPage('invalid_users');"><i class="fa fa-circle-o"></i> Inválidos</a></li>
                                <li><a href="#" onClick="getPage('send-email-all');"><i class="fa fa-circle-o"></i> Enviar Email</a></li>
>>>>>>> 9adbd58bdcf58534e22595f52351bcce59c30c54
                                </li>
                            </ul>
                        </li>
                        <?php
                        }

                        $sql = "SELECT * FROM users, users_organizador WHERE email = '$login_session' and users_organizador.users_id=users.users_id or users.permission_id >= '2'";
                        $result = mysqli_query($db,$sql);
                        $count = mysqli_num_rows($result);

                        if ($count >= 1){
                        ?>
                        <li>
                            <a href="#">
                                <i class="fa fa-files-o"></i>
                                <span>Eventos</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            <ul class="sidebar-submenu" style="display: none;">
                                <li><a href="#"><i class="fa fa-circle-o"></i> Visualizar Todos</a></li>
                                <li><a href="#" onClick="getPage('novoevento');"><i class="fa fa-circle-o"></i> Novo Evento</a></li>
                                <li><a href="#"><i class="fa fa-circle-o"></i> Apagar Evento</a></li>
                                <li><a href="#"><i class="fa fa-circle-o"></i> Editar Evento</a></li>
                                </li>
                            </ul>
                        </li>
                        <?php
                        }
                        ?>
                        <li>
                            <a href="../widgets.html">
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
          <div style="font-size: 30px; text-align: center;">
            <div class="col-md-6">
              <span>Bem Vindo</span> <?php echo $users_email; ?>
            </div>
            <div class="col-md-6">
              <img src="img/home.png" alt="Italian Trulli">
            </div>
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
