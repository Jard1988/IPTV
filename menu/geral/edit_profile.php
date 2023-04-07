<?php
error_reporting (E_ALL ^ E_NOTICE);
include('../../session.php');
?>

<script type="text/javascript">

$(document).ready(function (e) {
 $("#form").on('submit',(function(e) {
  e.preventDefault();

  $.ajax({
     url: "backend/file_upload.php",
     type: "POST",
     data:  new FormData(this),
     contentType: false,
           cache: false,
     processData:false,
     beforeSend : function(){
      //$("#preview").fadeOut();
       $('#loader').show();
     },
     complete: function(){
        $('#loader').hide();
     },
     success: function(data){
      if(data=='invalid'){
       // invalid file format.
       $("#output").html("Invalid File !").fadeIn();
      }
      else{
       // view uploaded file.
       $("#preview").html(data).fadeIn();
      }
      }
    });
  }));
});

</script>

<ul class="nav nav-tabs nav-justified">
  <li class="active"><a data-toggle="tab" href="#geral">Geral</a></li>
  <li><a data-toggle="tab" href="#db">Menu 1</a></li>
  <li><a data-toggle="tab" href="#email">Menu 2</a></li>
  <li><a data-toggle="tab" href="#sms">Menu 2</a></li>
</ul>

<div class="tab-content">
  <div id="geral" class="tab-pane fade in active">
    <h3>Geral</h3>
    <?php

    $sql = "SELECT * FROM users WHERE email = '$login_session'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    ?>
    <p>
      <div class="col-md-8">
        <form id="form" action="backend/file_upload.php" method="post" enctype="multipart/form-data">
          <div class="form-outline md-4">
                <label class="form-label" for="form2Example1">Email address</label>
                <input type="email" name="email" id="email" class="form-control" value="<?php echo $row['email']; ?>" readonly />
          </div>
          <div class="form-outline md-4">
            <label class="form-label" for="form2Example2">Password</label>
            <input type="text" name="password" id="password" class="form-control" value="<?php echo $row['password']; ?>"/>
          </div>
          <div class="form-outline md-4">
            <label class="form-label" for="form2Example3">Nome</label>
            <input type="text" id="nome" name="nome" class="form-control" value="<?php echo $row['nome']; ?>"/>
          </div>
          <div class="form-outline md-4">
            <label class="form-label" for="form2Example4">Apelido</label>
            <input type="text" id="apelido" name="apelido" class="form-control" value="<?php echo $row['apelido']; ?>"/>
          </div>
          <div class="form-outline md-4">
            <label class="form-label" for="form2Example5">Data de Nscimento</label>
            <input type="date" id="data" name="data" class="form-control" value="<?php echo $row['data_nascimento']; ?>"/>
          </div>
          <div class="form-outline md-4">
            <label class="form-label" for="form2Example6">Telefone</label>
            <input type="phone" id="phone" name="phone" class="form-control" value="<?php echo $row['telefone']; ?>"/>
          </div>
          <div class="form-outline md-4">
            <label class="form-label" for="form2Example7">Avatar</label>
            <input type="text" id="avatar" name="avatar" class="form-control" value="<?php echo $row['avatar_path']; ?>" readonly />
            <input id="fileToUpload" type="file" accept="image/*" name="fileToUpload" />
            <div style="display: none;" id="preview"><img src="<?php echo $row['avatar_path']; ?>" /></div><br>
            <input style="margin: 0 50%; width: 100px; height: 30px;" class="btn btn-primary" type="submit" value="Editar">
          </div>
        </form><br>
      </div>
    </p>
  </div>
  <div id="db" class="tab-pane fade">
    <h3>Base de Dados</h3>
    <p>
      teste
    </p>
  </div>
  <div id="email" class="tab-pane fade">
    <h3>Email</h3>
    <p>Some content in menu 2.</p>
  </div>
  <div id="sms" class="tab-pane fade">
    <h3>Mensagens - SMS</h3>
    <p>Some content in menu 2.</p>
  </div>
</div>
