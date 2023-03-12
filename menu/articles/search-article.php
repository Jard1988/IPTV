<?php
error_reporting (E_ALL ^ E_NOTICE);
include('../../session.php');
?>

<script type="text/javascript">

$(document).on("click", ".editModal", function () {
   var Id = $(this).data('id');
   var nome = $("#myTable").find(".nome"+Id+":first").text().trim();
   var area = $("#myTable").find(".area"+Id+":first").text().trim();
   var ativo = $("#myTable").find(".ativo"+Id+":first").text().trim();

    $('#inputEditID').val(Id);
    $('#inputEditNome').val(nome);
    $('#inputEditArea').val(area);
    $('#inputEditAtivo').val(ativo);


    // document.getElementById('inputEditPermission').selectedIndex = permission-3;
 });

 $('.modal-footer .btn-success').click(function() {

       var id = document.getElementById("inputEditID").value;
       var nome = document.getElementById("inputEditNome").value;
       var area = document.getElementById("inputEditArea").value;
       var ativo = document.getElementById("inputEditAtivo").value;

    $.ajax({
      url: "./backend/articles/editarticle.php",
      type: "post",
      data: {
      id: id,
      nome: nome,
      area: area,
      ativo: ativo
   },
      datatype: "html",
      contenttype: 'application/html; charset=utf-8',
      async: true,
    success : function(response) {
        if (response == 1){
             $('#outputEditUser').html(response);
        }else {
            $('#outputEditUser').html(response);

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

     var modalBody = $('<div id="modalContent" style="margin-left: 30px;">Deseja apagar o Utilizador <input id="deleteID" style="border: none;" value="' + Id + '" disabled="disabled" /></div>');
     $('.modal-body-1').html(modalBody);
   });

   $('.modal-footer .btn-danger').click(function() {
     var id = document.getElementById("deleteID").value;

    $.ajax({
      url: "./backend/articles/deletearticle.php",
      type: "post",
      data: {
        id: id
   },
      datatype: "html",
      contenttype: 'application/html; charset=utf-8',
      async: true,
    success : function(response) {
        if (response == 1){
             $('#outputDeleteUser').html(response);
        }else {
            $('#outputDeleteUser').html(response);

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

      var nome = document.getElementById("inputItemNome").value;
      var area = document.getElementById("inputItemArea").value;
      var ativo = document.getElementById("inputItemAtivo").value;

     $.ajax({
       url: "./backend/articles/newarticle.php",
       type: "post",
       data: {
         nome: nome,
         area: area,
         ativo: ativo
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

      var modalBody = $('<div id="modalContent" style="margin-left: 30px;">Deseja Apagar o(s) Utilizador(es)seleccionados?</div>');
      $('.modal-body-all-delete').html(modalBody);
      $('.modal-footer .btn-dark').click(function() {
        var selected_values = employee.join(",");
        const myArray = selected_values.split(",");

        for (let i = 0; i < myArray.length; i++) {

          $.ajax({
            url: "./backend/articles/deletearticlebyemail.php",
            type: "post",
            data: {
              id: myArray[i]
         },
            datatype: "html",
            contenttype: 'application/html; charset=utf-8',
            async: true,
          success : function(response) {
              if (response == 1){
                   $('#outputDeleteAllUser').html(response);
              }else {
                  $('#outputDeleteAllUser').html(response);

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

$('.btn-light').click(function() {
  var id = $('#input-datalist').val();
    $.ajax({
      url: "./backend/articles/search-article.php",
      type: "post",
      data: {
        id: id
   },
      datatype: "html",
      contenttype: 'application/html; charset=utf-8',
      async: true,
    success : function(response) {
        if (response == 1){
             $('#outputSearchUser').html(response);
        }else {
            $('#outputSearchUser').html(response);

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

<?php
  $sql="SELECT * FROM artigos";
  $result_users = mysqli_query($db,$sql);
?>

<div class="tabela" id="tabela">
  <button class="btn btn-primary" data-toggle="modal" data-target="#newModal"><i class="fa fa-user-plus" aria-hidden="true"></i></button>
  <br><br><form action="" style="width: 30%;">
    <div class="card-body">
<label>Artigo</label>
  <div class="row">
    <div class="col-md-10">
      <div class="file-loading">
        <input type="text" class="form-control" list="list-timezone" id="input-datalist"/>
      </div>
     </div>
     <div class="col-md-2">
       <button type="button" class="btn btn-light"><i class="fa fa-search" aria-hidden="true"></i></button>
     </div>

  </div>
</div>
    <div class="form-group">
      <datalist id="list-timezone">
        <?php while ($table_geral = mysqli_fetch_assoc($result_users)){  ?>
          <option id="<?php echo $table_geral['users_id']; ?> " value="<?php echo $table_geral['nome']; ?>"><?php echo $table_geral['nome']; ?></option>
          <?php
          }
          ?>
      </datalist>
    </div>
<div id="outputSearchUser" style="width: 90%;">
    </div>
  </form>

</div>
</div>

<!-- New Modal -->
<div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Criar Artigo</h4>
                <button type="button" class="close" data-dismiss="modal"> <span aria-hidden="true" class="">×   </span><span class="sr-only">Close</span>
                </button>
            </div>
            <div class="modal-body-2">
              <table class="table table-hover">
                <tbody>
                  <td>Nome</td>
                  <td><input type="text" class="form-control" id="inputItemNome" value=""></td>
                </tr>
                <tr>
                  <td>Area</td>
                  <td>
                    <select id="inputItemArea" name="inputItemArea" class="form-control">
                    <option value="1">Sortido Geral</option>
                    <option value="2">Frescos</option>
                    <option value="3">Tiko</option>
                    <option value="4">BackOff</option>
                    <option value="5">DPH</option>
                    <option value="6">F&L</option>
                    <option value="7">Carnes</option>
                  </select>
                </td>
                </tr>
                <tr>
                  <tr>
                    <td>Ativo</td>
                    <td>
                      <select id="inputItemAtivo" name="inputItemAtivo" class="form-control">
                        <option value="Sim">Sim</option>
                        <option value="Nao">Nao</option>
                      </select>
                    </td>
                  </tr>
                </tr>
                </tbody>
              </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            <div id="outputNewUser" style = "font-size:11px; color:#cc0000; margin-top:10px" align="center"></div>
        </div>
    </div>
</div>
<!-- End New Modal -->

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Editar Artigo</h4>
                <button type="button" class="close" data-dismiss="modal"> <span aria-hidden="true" class="">×   </span><span class="sr-only">Close</span>
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
                  <td>Nome</td>
                  <td><input type="text" class="form-control" id="inputEditNome" value=""></td>
                </tr>
                <tr>
                  <td>Area</td>
                  <td>
                    <select id="inputEditArea" name="inputEditArea" class="form-control">
                    <option value="1">Sortido Geral</option>
                    <option value="2">Frescos</option>
                    <option value="3">Tiko</option>
                    <option value="4">BackOff</option>
                    <option value="5">DPH</option>
                    <option value="6">F&L</option>
                    <option value="7">Carnes</option>
                  </select>
                  </td>
                </tr>
                <tr>
                  <tr>
                    <td>Ativo</td>
                    <td>
                      <select id="inputEditAtivo" name="inputEditAtivo" class="form-control">
                      <option value="Sim">Sim</option>
                      <option value="Nao">Nao</option>
                    </select>
                  </td>
                  </tr>
                </tr>
                </tbody>
              </table>
           </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success">Guardar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            <div id="outputEditUser" style = "font-size:11px; color:#cc0000; margin-top:10px" align="center"></div>
        </div>
    </div>
</div>
<!--End Edit Modal -->

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Apagar Artigo</h4>
                <button type="button" class="close" data-dismiss="modal"> <span aria-hidden="true" class="">×   </span><span class="sr-only">Close</span>
                </button>
            </div>
            <div class="modal-body-1"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger">Sim</button>
                <button type="button" class="btn btn-info" data-dismiss="modal">Não</button>
            </div>
            <div id="outputDeleteUser" style = "font-size:11px; color:#cc0000; margin-top:10px" align="center"></div>
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
              <h4 class="modal-title" id="myModalLabel">Apagar Artigo(s)</h4>
                <button type="button" class="close" data-dismiss="modal"> <span aria-hidden="true" class="">×   </span><span class="sr-only">Close</span>
                </button>
            </div>
            <div class="modal-body-all-delete"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark">Sim</button>
                <button type="button" class="btn btn-info" data-dismiss="modal">Não</button>
            </div>
            <div id="outputDeleteAllUser" style = "font-size:11px; color:#cc0000; margin-top:10px" align="center"></div>
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
