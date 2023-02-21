<?php
	include('../session.php');
?>

<script>
function alterarDescricao() {
  var x = document.getElementById("organizador_id").value;
	$.ajax({
		url: "./backend/getDescricao.php?id="+x,
		type: "get",
		datatype: "html",
		contenttype: 'application/html; charset=utf-8',
		async: true,
	success : function(response) {
		document.getElementById("descricao").innerHTML = response;
	},
	beforeSend: function () {
			$('#loader').show();
	},
	complete: function () {
			$('#loader').hide();
	}
	});
}
</script>

<script type="text/javascript">

$( "#new_event" ).click(function( event ) {
	event.preventDefault();
	var user = document.getElementById("user").value;
	var data = document.getElementById("data").value;
	var hora = document.getElementById("hora").value;
  var descricao = document.getElementById("descricao").value;
	var local = document.getElementById("organizador_id").value;

	$.ajax({
			url: "./backend/new_event.php",
			type: "post",
			data: {
			user: user,
			data: data,
			hora: hora,
			local: local,
			descricao: descricao
	},
	datatype: "html",
	contenttype: 'application/html; charset=utf-8',
	async: true,
	success : function(response) {
			if (response == 1){
			$('#outputNewEvent').html(response);
			}else {
					$('#outputNewEvent').html(response);
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

<!-- LOADER -->
<div id="loader" style="display: none; margin: 0px; padding: 0px; position: fixed; right: 0px; top: 0px; width: 100%; height: 100%; background-color: rgb(102, 102, 102); z-index: 30001; opacity: 0.8;">
		<p style="position: absolute; color: White; top: 50%; left: 45%;">
				Loading, please wait...
				<img src="images/ajax-loader.gif">
		</p>
</div>
<!-- END LOADER -->
<body>
	<div style="display: flex; flex-direction: row; justify-content: center; align-items: center;">
		<div style="width:75%; ">
			<div style="font-size: 25px; text-align: center;"><b>Novo Evento<b><br><br></div>

			<input id="user" style = "display: none; font-size:11px; color:#cc0000; margin-top:10px" value='<?php echo $_SESSION['login_user']; ?>'/>

			<form action = "" method = "post">
				Local:<br>
				<?php
					$sql1 = "SELECT * FROM organizador, users_organizador WHERE organizador.organizador_id = users_organizador.organizador_id and users_organizador.users_id='$users_id'";
				?>
						<select onchange="alterarDescricao()" id="organizador_id" name="cars" class="form-control">
						<option value="">---</option>
				<?php
							foreach (mysqli_query($db, $sql1) as $row) {
									echo '<option value="'. $row['organizador_id'].'">' .  $row['nome_organizador'] . "</option>";
							}
				?>
				</select> <br>
				Data: <input id="data" class="form-control" type = "date" name = "data" class = "box" /><br/>
				Hora: <input id="hora" class="form-control" type = "time" name = "hora" class = "box" /><br/>
				Descrição: <textarea id="descricao" class="form-control" class = "box" rows="8"></textarea><br/>
				<div style="font-size: 25px; text-align: center;"><input href="#" id="new_event" class="btn btn-primary signup" type = "submit" value = " Submit "/></div><br />
			</form>

			<div id="outputNewEvent"style = "font-size:11px; color:#cc0000; margin-top:10px" align="center"></div>
		</div>
	</div>

</body>
