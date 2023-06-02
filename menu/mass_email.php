<?php
error_reporting (E_ALL ^ E_NOTICE);
include('../session.php');

$sql="SELECT * FROM users where valid=1";
$result_users = mysqli_query($db,$sql);
?>
<script type="text/javascript">
$('.modal-footer .btn-primary').click(function() {
  var assunto = document.getElementById("input-assunto").value;
  var texto = document.getElementById("exampleFormControlTextarea1").value;

  $.ajax({
    url: "./backend/mass-email.php",
    type: "post",
    data: {
      assunto: assunto,
      texto: texto
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

})
</script>

<div class="logo">
   <h1><a>Enviar Email</a></h1>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Enviar Email</h4>
      </div>
      <div class="modal-body">
        <p>Têm a certeza que pretende enviar o Email?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Sim</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>

    </div>

  </div>
</div>
<!-- End Modal Content -->

<form action="" style="width: 80%; margin-left:5%;">
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
