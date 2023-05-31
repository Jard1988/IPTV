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
       showAlert(data);
       $('#outputMSG').fadeOut(5000);
      }
      else{
       // view uploaded file.
       showAlert(data);
       $('#outputMSG').fadeOut(5000);
      }
      }
    });
  }));
});

$(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});

</script>
<div class="logo">
   <h1><a>Editar Perfil</a></h1>
</div>
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
            <input type="password" name="password" id="password" class="form-control" value="<?php echo $row['password']; ?>">
            <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span></input>
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
            <label class="form-label" for="form2Example5">Data de Nascimento</label>
            <input type="date" id="data" name="data" class="form-control" value="<?php echo $row['data_nascimento']; ?>"/>
          </div>
          <div class="form-outline md-4">
            <label class="form-label" for="form2Example6">Telefone</label>
            <input type="phone" id="phone" name="phone" class="form-control" value="<?php echo $row['telefone']; ?>"/>
          </div>
          <div class="form-outline md-4">
            <label class="form-label" for="form2Example7">Avatar</label>
            <input type="text" id="avatar" name="avatar" class="form-control" value="<?php echo $row['avatar_path']; ?>" readonly />
            <input id="fileToUpload" type="file" accept="image/*" name="fileToUpload" /><br>
<<<<<<< HEAD
            <div id="preview" style = "display: none; font-size:11px; color: red;" align="center">><img src="<?php echo $row['avatar_path']; ?>" /></div><br>
=======
            <!-- <div id="preview" style = "display: none; font-size:11px; color: red;" align="center">><img src="<?php echo $row['avatar_path']; ?>" /></div><br> -->
>>>>>>> 14a258789d039a8e7062f845b5c95d390f0d4696

            <input style="margin: 0 50%; width: 100px; height: 30px;" class="btn btn-primary" type="submit" value="Editar">
          </div>
        </form><br>
      </div>
    </p>
