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
    function showAlert(id) {
      $('#outputMSG').show();
      $('#outputMSG').html('<div class="alert alert-warning" style="color: black;" role="alert">' + id + '<button class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }

function RemoveUnusedLines(id) {
  jQuery.ajax({
      url: "backend/linhas/deleteunused.php",
      type: "post",
      datatype: "html",
      contenttype: 'application/html; charset=utf-8',
      async: true,
      success:function(data){$('#output').html(data);},
      beforeSend: function() { $('#loader').show(); },
      complete: function() { $('#loader').hide(); }
  });

}

      function refresh(id) {
        jQuery.ajax({
            url: "backend/file_download.php",
            type: "post",
            data: {
            id: id
          },
            datatype: "html",
            contenttype: 'application/html; charset=utf-8',
            async: true,
            success:function(data){$('#output').html(data);},
            beforeSend: function() { $('#loader').show(); },
            complete: function() { $('#loader').hide(); }
        });

      }

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

      $( document ).ready(function() {

        jQuery.ajax({
            url: "backend/notification.php",
            type: "post",
            datatype: "html",
            contenttype: 'application/html; charset=utf-8',
            async: true,
            success:function(data){$('#result_notification').html(data);},
            beforeSend: function() { $('#loader').show(); },
            complete: function() { $('#loader').hide(); }
        });
      });
	   </script>
   </head>
   <body>

	<div id="loader" style="display: none; margin: 0px; padding: 0px; position: fixed; right: 0px; top: 0px; width: 100%; height: 100%; background-color: rgb(102, 102, 102); z-index: 30001; opacity: 0.8;">
	<p style="position: absolute; color: White; top: 50%; left: 45%;">
	Loading, please wait...
	<img src="img/ajax-loader.gif">
	</p>
	</div>

  <?php
  $sql5 = "SELECT * FROM users WHERE email = '$login_session'";
  $result5 = mysqli_query($db,$sql5);
  $row5 = mysqli_fetch_array($result5,MYSQLI_ASSOC);
  ?>

	              <div class="navbar navbar-inverse" role="banner" style="background-color:#2c3742; top:-5px;  border: 0;">
	                  <div class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
                          <ul class="nav navbar-nav">
                            <li class="dropdown">
                              <div class="notification">

                                                       <a class="dropdown-toggle" type="button" data-toggle="dropdown">
                                                         <img class="img_notification" src="images/notification.jpg">
                                                         <?php
                                                         $sql6 = "SELECT * FROM notification where vista=0";
                                                         $result6 = mysqli_query($db,$sql6);
                                                         $contador_notification = mysqli_num_rows($result6);
                                                         ?>
                                                          <!-- <span style="margin-right: 10px;" class="caret"></span> -->
                                                                      <ul class="dropdown-menu">
                                                                        <li><a href="#" id="result_notification"></a></li>
                                                                        <?php
                                                                        while ($notifiy = mysqli_fetch_assoc($result6)){
                                                                        ?>
                                                                          <li><a href="#"><?php echo $notifiy['texto']; ?></a></li>
                                                                        <?php } ?>
                                                                      </ul>
                                                                      <span class="badge">
                                                                        <?php echo $contador_notification + 1; ?>
                                                                      </span>&nbsp;&nbsp;
                                                        </a>
                              </div>
                            </li>

                              <li class="dropdown">
                                <div class="notification">

                                                         <a class="dropdown-toggle" type="button" data-toggle="dropdown">
                                                           <img class="img_notification" src="<?php echo $row['avatar_path']; ?>">
                                                                        <ul class="dropdown-menu">
                                                                            <li><a href="#" onClick="getPage('geral/edit_profile');">Editar Perfil</a></li>
                                                                            <li><a style="color: red;" href="logout.php"><b>Logout</b></a></li>
                                                                        </ul></a>
                                </div>
                              </li>
                              <li class="dropdown">
                                <div class="logo">
                                  <a class="dropdown-toggle" type="button" data-toggle="dropdown">
                                  </a>
                                </div>
                              </li>
                          </ul>
	                  </div>
                    <div class="logo">IPTV Planner</div>
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
                        ?>
                        <li>
                            <a href="#" onClick="refresh('<?php echo $users_id; ?>');">
                                <i class="fa fa-spinner" aria-hidden="true"></i>
                                <span><b>Atualizar</b></span>
                              </a>
                        </li>
                        <?php
                          if ($count >= 1){
                        ?>
                        <li>
                            <a href="#" onClick="getPage('geral');"><i class="fa fa-home" aria-hidden="true"></i>
                                <span>Geral</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="sidebar-submenu" style="display: none;">
                                <li><a href="#" onClick="getPage('geral/edit_website');"><i class="fa fa-circle-o"></i> Editar Website</a></li>
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
                            <a href="#">
                                <i class="fa fa-external-link" aria-hidden="true"></i>
                                <span>Linhas</span>
                                <i class="fa fa-angle-left pull-right"></i>
<!--                                <span class="label label-primary pull-right">4</span>-->
                            </a>
                            <ul class="sidebar-submenu" style="display: none;">
                                <li><a href="#" onClick="getPage('linhas/search-line');"><i class="fa fa-search" aria-hidden="true"></i>Procurar</a></li>
                                <li><a href="#" onClick="getPage('linhas/all-lines');"><i class="fa fa-list-alt" aria-hidden="true"></i> Listar Todos</a></li>
                                <li>
                                    <a href="#" onClick="RemoveUnusedLines();">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                        <span><b>Limpar</b></span>
                                      </a>
                                </li>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" onClick="#">
                                <i class="fa fa-credit-card" aria-hidden="true"></i>
                                <span>Pagamentos</span>
                                <i class="fa fa-angle-left pull-right"></i>
<!--                                <span class="label label-primary pull-right">4</span>-->
                            </a>
                            <ul class="sidebar-submenu" style="display: none;">
                                <li><a href="#" onClick="getPageRaiz('404');"><i class="fa fa-reply" aria-hidden="true"></i>Estado</a></li>
                                <li><a href="#" onClick="getPageRaiz('404');"><i class="fa fa-reply-all" aria-hidden="true"></i>Expirados</a></li>
                                <li><a href="#" onClick="getPageRaiz('404');"><i class="fa fa-reply-all" aria-hidden="true"></i>Visualizar</a></li>
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
                                <li><a href="#" onClick="getPage('mass-email');"><i class="fa fa-reply-all" aria-hidden="true"></i>Mass Email</a></li>
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
        <div id="outputMSG" style = "font-size:11px; color:#cc0000; margin-top:10px" align="center"></div>
				<div id="output">
          <div style="font-size: 30px; text-align: left;">
            <div class="col-md-10">
              <span>Bem Vindo</span> <b><?php echo $users_name . " ". $users_apelido ?></b>
              <img class="home_fundo" src="img/fundo.png">
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
