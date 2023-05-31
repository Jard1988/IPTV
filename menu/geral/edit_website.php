<?php
error_reporting (E_ALL ^ E_NOTICE);
include('../../session.php');
?>

<script type="text/javascript">

$(document).on("click", ".editEmail", function () {

  var email_host = document.getElementById('email_host').value;
  var email_name = document.getElementById('email_name').value;
  var email_pass = document.getElementById('email_pass').value;
  var email_port = document.getElementById('email_port').value;
  var email_user = document.getElementById('email_user').value;

  $.ajax({
    url: "./backend/editemail.php",
    type: "post",
    data: {
    email_host: email_host,
    email_name: email_name,
    email_pass: email_pass,
    email_port: email_port,
    email_user: email_user
 },
    datatype: "html",
    contenttype: 'application/html; charset=utf-8',
    async: true,
  success : function(response) {
      if (response == 1){
        showAlert(response);
        $('#outputMSG').fadeOut(5000);

      }else {
        showAlert(response);
        $('#outputMSG').fadeOut(5000);
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
        showAlert(response);
        $('#outputMSG').fadeOut(5000);
      }else {
        showAlert(response);
        $('#outputMSG').fadeOut(5000);

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
  var site_url = document.getElementById('site_url').value;

  $.ajax({
    url: "./backend/editgeral.php",
    type: "post",
    data: {
    caminho: caminho,
    site_url: site_url,
    list_url: list_url
 },
    datatype: "html",
    contenttype: 'application/html; charset=utf-8',
    async: true,
  success : function(response) {
        if (response == 1){
          showAlert(response);
          $('#outputMSG').fadeOut(5000);
        }else {
          showAlert(response);
          $('#outputMSG').fadeOut(5000);
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
$geralsite = explode("'", $linhas[25]);
$geralcaminho = explode("'", $linhas[27]);

$dbuser = explode("'", $linhas[4]);
$dbpass = explode("'", $linhas[5]);
$dbname = explode("'", $linhas[6]);

$email_user = explode("'", $linhas[14]);
$email_pass = explode("'", $linhas[15]);
$email_host = explode("'", $linhas[13]);
$email_name = explode("'", $linhas[17]);
$email_port = explode("'", $linhas[16]);

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
          <input type="text" name="caminho_m3u" id="caminho_m3u" class="form-control" value=" <?php echo trim($geralm3u[3]); ?>" />
        </div><p>
          <div class="form-outline md-4">
                <label class="form-label" for="form2Example1">URL do Site: </label>
                <input type="text" name="site_url" id="site_url" class="form-control" value="  <?php echo trim($geralsite[3]); ?>"  />
          </div><p>
        <div class="form-outline md-4">
              <label class="form-label" for="form2Example1">URL das Listas: </label>
              <input type="text" name="list_url" id="list_url" class="form-control" value="  <?php echo trim($geralcaminho[3]); ?>"  />
        </div><p>
        <br><button class="editURL btn btn-success" style="text-align: center;">Guardar</button><br>
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
      <br>
    </p>
  </div>
  <div id="email" class="tab-pane fade">
    <p>

        <div class="form-outline md-4">
              <label class="form-label" for="form2Example1">Host</label>
              <input type="text" name="email_host" id="email_host" class="form-control" value="<?php echo trim($email_host[3]); ?>" />
        </div><p>
        <div class="form-outline md-4">
          <label class="form-label" for="form2Example2">Username</label>
          <input type="text" name="email_user" id="email_user" class="form-control" value="<?php echo trim($email_user[3]); ?>"/>
        </div><p>
        <div class="form-outline md-4">
          <label class="form-label" for="form2Example3">Password</label>
          <input type="text" id="email_pass" name="email_pass" class="form-control" value="<?php echo trim($email_pass[3]); ?>"/>
        </div><p>
        <div class="form-outline md-4">
          <label class="form-label" for="form2Example4">Porta</label>
          <input type="text" id="email_port" name="email_port" class="form-control" value="<?php echo trim($email_port[3]); ?>"/>
        </div><p>
        <div class="form-outline md-4">
          <label class="form-label" for="form2Example5">Titulo do Email</label>
          <input type="text" id="email_name" name="email_name" class="form-control" value="<?php echo trim($email_name[3]); ?>"/>
        </div><p>
            <br><button class="editEmail btn btn-success" style="text-align: center;">Guardar</button><br>        
      <br>
    </p>
  </div>
</div>
