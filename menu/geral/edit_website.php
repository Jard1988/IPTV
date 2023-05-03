<?php
error_reporting (E_ALL ^ E_NOTICE);
include('../../session.php');
?>

<script type="text/javascript">

$(document).on("click", ".editDB", function () {

  var dbname = document.getElementById('name_db').value;
  var dbuser = document.getElementById('user_db').value;
  var dbpass = document.getElementById('password_db').value;

  $.ajax({
    url: "./backend/editdb.php",
    type: "post",
    data: {
    dbname: dbname,
    dbuser: dbuser,
    dbpass: dbpass
 },
    datatype: "html",
    contenttype: 'application/html; charset=utf-8',
    async: true,
  success : function(response) {
      if (response == 1){
           $('#outputEditDB').html(response);
      }else {
          $('#outputEditDB').html(response);

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

$(document).on("click", ".editURL", function () {
  var caminho = document.getElementById('caminho_m3u').value;
  var list_url = document.getElementById('list_url').value;

  $.ajax({
    url: "./backend/editgeral.php",
    type: "post",
    data: {
    caminho: caminho,
    list_url: list_url
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

<!--LER DO FICHEIRO DB.PHP -->
<?php
$linhas = explode("\n", file_get_contents("../../db.php"));
$geralm3u = explode("'", $linhas[23]);
$geralcaminho = explode("'", $linhas[25]);

$dbuser = explode("'", $linhas[4]);
$dbpass = explode("'", $linhas[5]);
$dbname = explode("'", $linhas[6]);

 ?>

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
        <div class="form-outline md-4">
          <label class="form-label" for="form2Example2">URL M3U:</label>
          <input type="text" name="caminho_m3u" id="caminho_m3u" class="form-control" value=" <?php echo trim($geralm3u[3]); ?>"/>
        </div><p>
        <div class="form-outline md-4">
              <label class="form-label" for="form2Example1">URL das Listas: </label>
              <input type="text" name="list_url" id="list_url" class="form-control" value="  <?php echo trim($geralcaminho[3]); ?>"  />
        </div><p>
        <br><button class="editURL btn btn-success" style="text-align: center;">Guardar</button><br>
        <div id="outputEditGeral" style = "font-size:11px; color:#cc0000; margin-top:10px" align="center"></div><br>
        <br>
    </p>
  </div>
  <div id="db" class="tab-pane fade">
    <p>
        <div class="form-outline md-4">
          <label class="form-label" for="form2Example2">Servidor:</label>
          <input type="text" name="servidor" id="sevidor" class="form-control" value="localhost" readonly/>
        </div><p>
        <div class="form-outline md-4">
              <label class="form-label" for="form2Example1">Utilizador</label>
              <input type="text" name="user_db" id="user_db" class="form-control" value="<?php echo trim($dbuser[3]); ?>"  />
        </div><p>
        <div class="form-outline md-4">
          <label class="form-label" for="form2Example3">Password</label>
          <input type="text" id="password_db" name="password_db" class="form-control" value="<?php echo trim($dbpass[3]); ?>"/>
        </div><p>
        <div class="form-outline md-4">
          <label class="form-label" for="form2Example4">DB Nome</label>
          <input type="text" id="name_db" name="name_db" class="form-control" value="<?php echo trim($dbname[3]); ?>"/>
        </div><p>
        <br><button class="editDB btn btn-success" style="text-align: center;">Guardar</button><br>
        <div id="outputEditDB" style = "font-size:11px; color:#cc0000; margin-top:10px" align="center"></div>
        <br>
      <br>
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
