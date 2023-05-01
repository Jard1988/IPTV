<?php
error_reporting (E_ALL ^ E_NOTICE);
include('../../session.php');
?>

<script type="text/javascript">

$(document).on("click", ".editURL", function () {
  var caminho = document.getElementById('caminho_m3u').value;
  alert(caminho);

  $.ajax({
    url: "./backend/editgeral.php",
    type: "post",
    data: {
    opt: "1",
    caminho: caminho
 },
    datatype: "html",
    contenttype: 'application/html; charset=utf-8',
    async: true,
  success : function(response) {
      if (response == 1){
           $('#outputEditGeral').html(response);
      }else {
          $('#outputEditGeral').html(response);

      }
      //$('#outputlogin').html(response);
  },
  beforeSend: function () {
      $('#loader').show();
  },
  complete: function () {
      $('#loader').hide();
  }
  });
});

</script>

<div class="logo">
   <h1><a>Editar Website</a></h1>
</div><br>

<ul class="nav nav-tabs nav-justified">
  <li class="active"><a data-toggle="tab" href="#geral">Geral</a></li>
  <li><a data-toggle="tab" href="#db">Base de Dados</a></li>
  <li><a data-toggle="tab" href="#email">Email</a></li>
  <li><a data-toggle="tab"></a></li>
</ul>

<div class="tab-content">
  <div id="geral" class="tab-pane fade in active">
    <p>
      <form id="form" action="<?php echo $PHP_SELF; ?>" method="post" enctype="multipart/form-data">
        <div class="form-outline md-4">
          <label class="form-label" for="form2Example2">URL M3U:</label>
          <input type="text" name="caminho_m3u" id="caminho_m3u" class="form-control" value=""/>
        </div><p>
        <div class="form-outline md-4">
              <label class="form-label" for="form2Example1">URL das Listas: </label>
              <input type="text" name="list_url" id="list_url" class="form-control" value=""  />
        </div><p>
        <br><button class="editURL btn btn-success" style="text-align: center;">Guardar</button><br>
        <div id="outputEditGeral" style = "font-size:11px; color:#cc0000; margin-top:10px" align="center"></div><br>
      </form><br>
    </p>
  </div>
  <div id="db" class="tab-pane fade">
    <p>
      <form id="form" action="backend/edit_geral.php?opt=2" method="post" enctype="multipart/form-data">
        <div class="form-outline md-4">
          <label class="form-label" for="form2Example2">Servidor:</label>
          <input type="text" name="servidor" id="sevidor" class="form-control" value="localhost" readonly/>
        </div><p>
        <div class="form-outline md-4">
              <label class="form-label" for="form2Example1">Utilizador</label>
              <input type="text" name="user_db" id="user_fb" class="form-control" value=""  />
        </div><p>
        <div class="form-outline md-4">
          <label class="form-label" for="form2Example3">Password</label>
          <input type="text" id="password_db" name="password_db" class="form-control" value="<?php echo $row['nome']; ?>"/>
        </div><p>
        <div class="form-outline md-4">
          <label class="form-label" for="form2Example4">Apelido</label>
          <input type="text" id="database_nome" name="database_nome" class="form-control" value="<?php echo $row['apelido']; ?>"/>
        </div><p>
        <br><button class="btn btn-success">Guardar</button><br>
        <div id="outputEditDB" style = "font-size:11px; color:#cc0000; margin-top:10px" align="center"></div>
        <br>
      </form><br>
    </p>
  </div>
  <div id="email" class="tab-pane fade">
    <p>
      <form id="form" action="backend/edit_geral.php?opt=3" method="post" enctype="multipart/form-data">
        <div class="form-outline md-4">
              <label class="form-label" for="form2Example1">Host</label>
              <input type="text" name="host" id="host" class="form-control" value="<?php echo $row['email']; ?>" readonly />
        </div><p>
        <div class="form-outline md-4">
          <label class="form-label" for="form2Example2">Username</label>
          <input type="text" name="mail_username" id="mail_username" class="form-control" value="<?php echo $row['password']; ?>"/>
        </div><p>
        <div class="form-outline md-4">
          <label class="form-label" for="form2Example3">Password</label>
          <input type="text" id="mail_password" name="mail_password" class="form-control" value="<?php echo $row['nome']; ?>"/>
        </div><p>
        <div class="form-outline md-4">
          <label class="form-label" for="form2Example4">Porta</label>
          <input type="text" id="port" name="port" class="form-control" value="<?php echo $row['apelido']; ?>"/>
        </div><p>
        <div class="form-outline md-4">
          <label class="form-label" for="form2Example5">Nome DB</label>
          <input type="text" id="database" name="database" class="form-control" value="<?php echo $row['data_nascimento']; ?>"/>
        </div><p>
            <br><button class="btn btn-success" >Guardar</button><br>
            <div id="outputEditEmail" style = "font-size:11px; color:#cc0000; margin-top:10px" align="center"></div>
      </form><br>
    </p>
  </div>
</div>
