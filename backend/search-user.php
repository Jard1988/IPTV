<?php
	include('../session.php');

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($db,$_POST['email']);

		if ($email == ""){
			$sql="SELECT * FROM users";
		  $result_users = mysqli_query($db,$sql);

						echo '  <table id="myTable" class="table" id="myTable" style="width: 90%;">
						      <thead>
						          <tr>
						            <th scope="col"><input type="checkbox" id="select_all"></th>
						            <th scope="col" onclick="sortTable(0)" >#</th>
						            <th scope="col" onclick="sortTable(1)">Email</th>
						            <th scope="col" onclick="sortTable(2)">Nome</th>
						            <th scope="col" onclick="sortTable(3)">Apelido</th>
												<th scope="col" onclick="sortTable(4)">Telefone</th>
						            <th scope="col" onclick="sortTable(5)">Nascimento</th>
						            <th scope="col" onclick="sortTable(6)">APD</th>
						            <th scope="col" onclick="sortTable(7)">Facebook</th>
						            <th scope="col" onclick="sortTable(8)">Instagram</th>
						            <th scope="col" onclick="sortTable(9)">Permissão</th>
						            <th scope="col" onclick="">Ativo</th>
						          </tr>
						      </thead>
						      <tbody>';
							while ($table_geral = mysqli_fetch_assoc($result_users)){
						   echo '<tr>
						    <td scope="row"> <input type="checkbox" class="emp_checkbox" data-emp-id="'. $table_geral['email'].'"></td>
						    <td scope="row"> '. $table_geral['users_id'].' </td>
						    <td scope="row" class="email'. $table_geral['users_id'].'" value="'. $table_geral['email'].'"> '. $table_geral['email'].' </td>
						    <td scope="row" class="nome'. $table_geral['users_id'].'" > '. $table_geral['nome'].' </td>
						    <td scope="row" class="apelido'. $table_geral['users_id'].'" > '. $table_geral['apelido'].' </td>
								<td scope="row" class="telefone'. $table_geral['users_id'].'" > '. $table_geral['telefone'].' </td>
						    <td scope="row" class="nascimento'. $table_geral['users_id'].'"> '. $table_geral['data_nascimento'].' </td>
						    <td scope="row" class="apd'. $table_geral['users_id'].'"> '. $table_geral['apd'].' </td>
						    <td scope="row" class="facebook'. $table_geral['users_id'].'"> '. $table_geral['facebook'].' </td>
						    <td scope="row" class="instagram'. $table_geral['users_id'].'"> '. $table_geral['instagram'].' </td>
						    <td scope="row" class="permission'. $table_geral['users_id'].'"> '. $table_geral['permission_id'].' </td>';

								if ($table_geral['valid'] == 0){
						    echo '<td scope="row"> <button class="reminderModal btn btn-warning " data-id="'. $table_geral['email'].'" data-toggle="modal" data-target="#reminderModal">
						      <i class="fa fa-exclamation" aria-hidden="true"></i>
						    </button></td>';
							} else echo '<td scope="row"></td>';
						   echo '<td scope="row"> <button class="editModal btn btn-success" data-id="'. $table_geral['users_id'].'" data-toggle="modal" data-target="#editModal">
						      <i class="fa fa-pencil" aria-hidden="true"></i>
						    </button></td>
						    <td scope="row"> <button class="deleteModal btn btn-danger" data-id="'. $table_geral['users_id'].'" data-toggle="modal" data-target="#deleteModal">
						      <i class="fa fa-trash-o" aria-hidden="true"></i>
						    </button></td>
						    </tr>';
								}
						    echo '</tbody>
						  </table>';
		} else {
			$sql="SELECT * FROM users where email='". $email."';";
		  $result_users = mysqli_query($db,$sql);
			$res = mysqli_fetch_assoc($result_users );

						echo '  <table id="myTable" class="table" id="myTable" style="width: 80%;">
						      <thead>
						          <tr>
						            <th scope="col"><input type="checkbox" id="select_all"></th>
												<th scope="col" onclick="sortTable(0)" >#</th>
						            <th scope="col" onclick="sortTable(1)">Email</th>
						            <th scope="col" onclick="sortTable(2)">Nome</th>
						            <th scope="col" onclick="sortTable(3)">Apelido</th>
												<th scope="col" onclick="sortTable(4)">Telefone</th>
						            <th scope="col" onclick="sortTable(5)">Nascimento</th>
						            <th scope="col" onclick="sortTable(6)">APD</th>
						            <th scope="col" onclick="sortTable(7)">Facebook</th>
						            <th scope="col" onclick="sortTable(8)">Instagram</th>
						            <th scope="col" onclick="sortTable(9)">Permissão</th>
						            <th scope="col" onclick="">Ativo</th>
						          </tr>
						      </thead>
						      <tbody>
						  <tr>
							<td scope="row"> <input type="checkbox" class="emp_checkbox" data-emp-id="'. $res['email'].'"></td>
							<td scope="row"> '. $res['users_id'].' </td>
							<td scope="row" class="email'. $res['users_id'].'" value="'. $res['email'].'"> '. $res['email'].' </td>
							<td scope="row" class="nome'. $res['users_id'].'" > '. $res['nome'].' </td>
							<td scope="row" class="apelido'. $res['users_id'].'" > '. $res['apelido'].' </td>
							<td scope="row" class="telefone'. $res['users_id'].'" > '. $res['telefone'].' </td>
							<td scope="row" class="nascimento'. $res['users_id'].'"> '. $res['data_nascimento'].' </td>
							<td scope="row" class="apd'. $res['users_id'].'"> '. $res['apd'].' </td>
							<td scope="row" class="facebook'. $res['users_id'].'"> '. $res['facebook'].' </td>
							<td scope="row" class="instagram'. $res['users_id'].'"> '. $res['instagram'].' </td>
							<td scope="row" class="permission'. $res['users_id'].'"> '. $res['permission_id'].' </td>';
							if ($res['valid'] == 0){
							echo '<td scope="row"> <button class="reminderModal btn btn-warning " data-id="'. $res['email'].'" data-toggle="modal" data-target="#reminderModal">
								<i class="fa fa-exclamation" aria-hidden="true"></i>
							</button></td>';
						} else echo '<td scope="row"></td>';
						echo '<td scope="row"> <button class="editModal btn btn-success" data-id="'. $res['users_id'].'" data-toggle="modal" data-target="#editModal">
							 <i class="fa fa-pencil" aria-hidden="true"></i>
						 </button></td>
						 <td scope="row"> <button class="deleteModal btn btn-danger" data-id="'. $res['users_id'].'" data-toggle="modal" data-target="#deleteModal">
							 <i class="fa fa-trash-o" aria-hidden="true"></i>
						 </button></td>
						 </tr>';
						 echo '</tbody>
						</table>';
		}

	}
?>
