<?php
error_reporting (E_ALL ^ E_NOTICE);
include('../../session.php');
?>

<script type="text/javascript">

$(document).on("click", ".editModal", function () {
   var Id = $(this).data('id');
   var email = $("#myTable").find(".email"+Id+":first").text().trim();
   var inicio = $("#myTable").find(".data_ini"+Id+":first").text().trim();
   var fim = $("#myTable").find(".data_fim"+Id+":first").text().trim();
   var pago = $("#myTable").find(".pago"+Id+":first").text().trim();
   var caminho = $("#myTable").find(".caminho"+Id+":first").text().trim();

    $('#inputEditID').val(Id);
    $('#inputEditEmail').val(email);
    $('#inputEditDateIni').val(inicio);
    $('#inputEditDateFim').val(fim);
    $('#inputEditPago').val(pago);
    $('#inputEditCaminho').val(caminho);
 });

 $('.modal-footer .btn-success').click(function() {
       var id = document.getElementById("inputEditID").value;
       var email = document.getElementById("inputEditEmail").value;
       var inicio = document.getElementById("inputEditDateIni").value;
       var fim = document.getElementById("inputEditDateFim").value;
       var pago = document.getElementById("inputEditPago").value;
       var caminho = document.getElementById("inputEditCaminho").value;

    $.ajax({
      url: "./backend/linhas/editLine.php",
      type: "post",
      data: {
      id: id,
      email: email,
      inicio: inicio,
      fim: fim,
      pago: pago,
      caminho: caminho
   },
      datatype: "html",
      contenttype: 'application/html; charset=utf-8',
      async: true,
    success : function(response) {
      if (response == 1){
        showAlert(response);
        $('#closemodal1').click ();
        $('#outputMSG').fadeOut(5000);
      }else {
        showAlert(response);
        $('#closemodal1').click ();
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

  $(document).on("click", ".deleteModal", function () {
     var Id = $(this).data('id');

     var modalBody = $('<div id="modalContent1" style="margin-left: 30px;">Deseja apagar o Linha <input id="deleteID" style="border: none;" value="' + Id + '" disabled="disabled" /></div>');
     $('.modal-body-1').html(modalBody);
   });

   $('.modal-footer .btn-danger').click(function() {
     var id = document.getElementById("deleteID").value;

    $.ajax({
      url: "./backend/linhas/deleteline.php",
      type: "post",
      data: {
        id: id
   },
      datatype: "html",
      contenttype: 'application/html; charset=utf-8',
      async: true,
    success : function(response) {
      if (response == 1){
        showAlert(response);
        $('#closemodal2').click ();
        $('#outputMSG').fadeOut(5000);
      }else {
        showAlert(response);
        $('#closemodal2').click ();
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

    $('.modal-footer .btn-primary').click(function() {

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
         showAlert(response);
         $('#closemodal').click ();
         $('#outputMSG').fadeOut(5000);
       }else {
         showAlert(response);
         $('#closemodal').click ();
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

 $( document ).ready(function() {
		/*-------------------
    To sleect/deselect all
    ---------------------- */
    $(document).on("click", "#select_all", function () {
    var status = $(this).is(":checked") ? true : false;
    $('.emp_checkbox').prop('checked', status);
     $("#select_count").html($("input.emp_checkbox:checked").length+" Selected");
    });

    /*------------------------------
    TO select/deselect single check box
    ------------------------------------- */
    $(document).on("click", ".emp_checkbox", function () {
    	 var status = $(this).is(":checked") ? true : false;
        $(this).prop('checked', status);
       $("#select_count").html($("input.emp_checkbox:checked").length+" Selected");
    });

    $('#delete_records').on('click',
    function(e) {

        var employee = [];
        $(".emp_checkbox:checked").each (
            function() {
                employee.push($(this).data('emp-id'));
            });

    if(employee.length <=0) {
      var modalBody = $('<div id="modalContent" style="margin-left: 30px;">Selecione alguma linha...</div>');
    $('.modal-body-all-delete').html(modalBody);
    } else {

      var modalBody = $('<div id="modalContent" style="margin-left: 30px;">Deseja Apagar o(s) Linha(as)seleccionados?</div>');
      $('.modal-body-all-delete').html(modalBody);

      $('.modal-footer .btn-dark').click(function() {
        var selected_values = employee.join(",");
        const myArray = selected_values.split(",");

        for (let i = 0; i < myArray.length; i++) {

          $.ajax({
            url: "./backend/linhas/deletelinebyemail.php",
            type: "post",
            data: {
              id: myArray[i]
         },
            datatype: "html",
            contenttype: 'application/html; charset=utf-8',
            async: true,
          success : function(response) {
            if (response == 1){
              showAlert(response);
              $('#closemodal4').click ();
              $('#outputMSG').fadeOut(5000);
            }else {
              showAlert(response);
              $('#closemodal4').click ();
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
        }
      });
    }
  });
});

})
</script>
<div class="logo">
   <h1><a>Lista de Linhas</a></h1>
</div>
<div class="tabela" id="tabela">
  <button class="btn btn-primary" data-toggle="modal" data-target="#newModal"><i class="fa fa-user-plus" aria-hidden="true"></i></button>
  <button id="delete_records" class="btn btn-danger" data-toggle="modal" data-target="#deleteAllModal"><i class="fa fa-user-times" aria-hidden="true"></i></button>
  <br><br><form action="" style="width: 30%;">

    <?php
    $sql="SELECT *
        FROM users
        INNER JOIN users_linhas
        ON users.users_id = users_linhas.users_id
        INNER JOIN linhas
        ON users_linhas.linhas_id = linhas.linhas_id";

      $result_users = mysqli_query($db,$sql);

          echo '  <table id="myTable" class="table" id="myTable">
                <thead>
                    <tr>
                      <th scope="col"><input type="checkbox" id="select_all">#</th>
                      <th scope="col" onclick="sortTable(1)">Email</th>
                      <th scope="col" onclick="sortTable(2)">Linha</th>
                      <th scope="col" onclick="sortTable(3)">Inicio</th>
                      <th scope="col" onclick="sortTable(4)">Fim</th>
                      <th scope="col" onclick="sortTable(5)">Pago</th>
                      <th scope="col" onclick="sortTable(6)">Caminho</th>
                    </tr>
                </thead>
                <tbody>';
            while ($table_geral = mysqli_fetch_assoc($result_users)){
             echo '<tr>
              <td scope="row"> <input type="checkbox" class="emp_checkbox" data-emp-id="'. $table_geral['linhas_id'].'"></td>
              <td scope="row" class="email'. $table_geral['linhas_id'].'" value="'. $table_geral['email'].'"> '. $table_geral['email'].' </td>
              <td scope="row" class="linha'. $table_geral['linhas_id'].'" > '. $table_geral['nome_linha'].' </td>
              <td scope="row" class="data_ini'. $table_geral['linhas_id'].'" > '. $table_geral['data_ini'].' </td>
              <td scope="row" class="data_fim'. $table_geral['linhas_id'].'" > '. $table_geral['data_fim'].' </td>';

              if ($table_geral['pago'] == 1) {
                echo '<td scope="row" class="pago'. $table_geral['linhas_id'].'">Sim</td>';
              }else {
                  echo '<td scope="row" class="pago'. $table_geral['linhas_id'].'">Não</td>';
              }

              echo '<td scope="row" class="caminho"> '. $table_geral['caminho'].' </td>
              ';

             echo '<td scope="row"></td>';
             echo '<td scope="row"> <button id="closemodal1" class="editModal btn btn-success" data-id="'. $table_geral['linhas_id'].'" data-toggle="modal" data-target="#editModal">
                <i class="fa fa-pencil" aria-hidden="true"></i>
              </button></td>
              <td scope="row"> <button id="closemodal1" class="deleteModal btn btn-danger" data-id="'. $table_geral['linhas_id'].'" data-toggle="modal" data-target="#deleteModal">
                <i class="fa fa-trash-o" aria-hidden="true"></i>
              </button></td>
              </tr>';
              }
              echo '</tbody>
            </table>';
    ?>
</div>
</div>

<span class="rows_selected" id="select_count">0 Selected</span>

<!-- New Modal -->
<div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Criar Linha</h4>
                <button type="button" id="closemodal" class="close" data-dismiss="modal"> <span aria-hidden="true" class="">×   </span><span class="sr-only">Close</span>
                </button>
            </div>
            <div class="modal-body-2">
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
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
<!-- End New Modal -->

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Editar Linha</h4>
                <button type="button" class="close" id="closemodal1" data-dismiss="modal"> <span aria-hidden="true" class="">×   </span><span class="sr-only">Close</span>
                </button>
            </div>
            <div class="modal-body">
              <table class="table table-hover">
                <tbody>
                  <tr>
                    <td>ID</td>
                    <td><input type="text" class="form-control" id="inputEditID" value="" readonly></td>
                  </tr>
                <tr>
                  <td>Email</td>
                  <td><input type="text" class="form-control" id="inputEditEmail" value="" readonly></td>
                </tr>
                <tr>
                  <td>Data de Inicio</td>
                  <td><input type="date" class="form-control" id="inputEditDateIni" value=""></td>
                </tr>
                <tr>
                  <tr>
                    <td>Date de Fim</td>
                    <td><input type="date" class="form-control" id="inputEditDateFim" value=""></td>
                  </tr>
                  <td>Pagamento</td>
                  <td>
                    <select id="inputEditPago" name="inputEditPago" class="form-control">
                      <option value="1">Sim</option>
                      <option value="2">Não</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>Caminho</td>
                  <td><input type="text" class="form-control" id="inputEditCaminho" value="" readonly></td>
                </tr>
                </tbody>
              </table>
           </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success">Guardar</button>
            </div>
        </div>
    </div>
</div>
<!--End Edit Modal -->

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Apagar Linha</h4>
                <button type="button" id="closemodal2" class="close" data-dismiss="modal"> <span aria-hidden="true" class="">×   </span><span class="sr-only">Close</span>
                </button>
            </div>
            <div class="modal-body-1"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger">OK</button>
            </div>
        </div>
    </div>
</div>
<!-- End Delete Modal -->

<!-- DeleteAll Modal -->
<div class="modal fade" id="deleteAllModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
    <div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Apagar Linha(as)</h4>
                <button type="button" id="closemodal4" class="close" data-dismiss="modal"> <span aria-hidden="true" class="">×   </span><span class="sr-only">Close</span>
                </button>
            </div>
            <div class="modal-body-all-delete"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark">OK</button>
            </div>
        </div>
    </div>
</div>
<!-- End ReminderAll Modal -->

<script>
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("myTable");
  switching = true;
  //Set the sorting direction to ascending:
  dir = "asc";
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /*check if the two rows should switch place,
      based on the direction, asc or desc:*/
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount ++;
    } else {
      /*If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again.*/
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}

document.addEventListener('DOMContentLoaded', e => {
    $('#input-datalist').autocomplete()
}, false);
</script>
