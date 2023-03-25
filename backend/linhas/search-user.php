<?php
	include('../../session.php');

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($db,$_POST['email']);

		if ($email == ""){
				echo "<p style='color:red;'>Digite um email... </p>";
						} else {

			$sql="SELECT *, users.nome AS n, permissions.nome as n1 FROM users,permissions where email='". $email."' && valid=1 && users.permission_id = permissions.permissions_id";
		  $result_users = mysqli_query($db,$sql);
			$res = mysqli_fetch_assoc($result_users );

						echo '  <table id="myTable" class="table" id="myTable" style="width: 100%;">
						      <thead>
						          <tr>
												<th scope="col" onclick="sortTable(0)" >#</th>
						            <th scope="col" onclick="sortTable(1)">Email</th>
						            <th scope="col" onclick="sortTable(2)">Nome</th>
						            <th scope="col" onclick="sortTable(3)">Apelido</th>
												<th scope="col" onclick="sortTable(4)">Telefone</th>
						            <th scope="col" onclick="sortTable(5)">Nascimento</th>
	                      <th scope="col"  onclick="sortTable(6)">Permissão</th>
						          </tr>
						      </thead>
						      <tbody>
						  <tr>
							<td scope="row"> <input type="checkbox" class="emp_checkbox" data-emp-id="'. $res['email'].'"></td>
              <td scope="row" class="email'. $res['users_id'].'" value="'. $res['email'].'"> '. $res['email'].' </td>
              <td scope="row" class="nome'. $res['users_id'].'" > '. $res['n'].' </td>
              <td scope="row" class="apelido'. $res['users_id'].'" > '. $res['apelido'].' </td>
              <td scope="row" class="telefone'. $res['users_id'].'" > '. $res['telefone'].' </td>
              <td scope="row" class="nascimento'. $res['users_id'].'"> '. $res['data_nascimento'].' </td>
              <td scope="row" class=""> '. $res['n1'].' </td>
              <td scope="row" style="visibility:hidden;" class="permission'. $res['users_id'].'"> '. $res['permission_id'].' </td>
							<td scope="row"></td>';
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
