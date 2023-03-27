<?php
error_reporting (E_ALL ^ E_NOTICE);
include('../../session.php');
?>

<script type="text/javascript">

    $(' .btn-primary').click(function() {
      var email = document.getElementById("inputItemEmail").value;
      var pago = document.getElementById("inputItemPago").value;
      var data_ini = document.getElementById("inputItemDataIni").value;
      var data_fim = document.getElementById("inputItemDataFim").value;
     $.ajax({
       url: "./backend/linhas/newline.php",
       type: "post",
       data: {
         email: email,
         pago: pago,
         data_ini: data_ini,
         data_fim: data_fim
    },
       datatype: "html",
       contenttype: 'application/html; charset=utf-8',
       async: true,
     success : function(response) {
         if (response == 1){
              $('#outputNewUser').html(response);
         }else {
             $('#outputNewUser').html(response);

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

<!-- New Modal -->
<div class="" id="newModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="">
        <div class="">
            <div class="">
              <h4 class="" id="myModalLabel">Criar Linha</h4>
            </div>
            <div class="">
              <table class="table table-hover">
                <tbody>
                <tr>
                  <td>Email</td>
                  <td><input type="text" class="form-control" id="inputItemEmail" value=""></td>
                </tr>
                <tr>
                  <td>Data de Inicio</td>
                  <td><input type="date" class="form-control" id="inputItemDataIni" value=""></td>
                </tr>
                <tr>
                  <td>Data de Fim</td>
                  <td><input type="date" class="form-control" id="inputItemDataFim" value=""></td>
                </tr>
                <tr>
                  <td>Pago</td>
                  <td>
                    <select id="inputItemPago" name="cars" class="form-control">
                      <option selected value="0">Não</option>
                      <option value="1">Sim</option>
                    </select>
                  </td>
                </tr>
                </tr>
                </tbody>
              </table>
            </div>
            <div class="" align="center">
                <button type="button" class="btn btn-primary">Guardar</button>
            </div>
            <div id="outputNewUser" style = "font-size:11px; color:#cc0000; margin-top:10px" align="center"></div>
        </div>
    </div>
</div>
<!-- End New Modal -->




<script>
document.addEventListener('DOMContentLoaded', e => {
    $('#input-datalist').autocomplete()
}, false);
</script>
