<?php
?>
<html>

   <head>
      <title>IPTV Planner - Contato</title>
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

			        <div class="box" style="margin-top: -50%;">
			            <div class="content-wrap">
			                <h6>Contato</h6>
                      <form action="" style="width: 100%; margin-left:5%;">
                        <div class="form-group">
                          <label for="exampleFormControlInput2">Assunto</label>
                          <input type="text" class="form-control" id="input-assunto">
                        </div>
                        <div class="form-group">
                          <label for="exampleFormControlTextarea1">Mensagem</label>
                          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        <div class="form-group" style="text-align: center;">
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Enviar</button>
                        </div>
                      </form>

								<div style = "font-size:11px; color:#cc0000; margin-top:0px"><?php echo $error; ?></div>
						</div>
					</div><br>
          <a href=""> Contato </a> | <a href=""> FAQ </a>

        <div>
        </div>
			</div>
		</div>
	</div>

   </body>
</html>
