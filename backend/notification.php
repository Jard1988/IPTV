<?php
error_reporting (E_ALL ^ E_NOTICE ^ E_WARNING);
include('../session.php');
ini_set('max_execution_time', '300'); //300 seconds = 5 minutes
set_time_limit(300);

    $data1 = date("Y-m-d");

    // transforma a data do formato BR para o formato americano, ANO-MES-DIA
    $data1 = implode('-', array_reverse(explode('/', $data1)));
    $d1 = strtotime($data1);

    $sql_notify = "SELECT * FROM users_linhas, users where users.users_id = users_linhas.users_id";
    $result_notify = mysqli_query($db,$sql_notify);

    while ($notify = mysqli_fetch_assoc($result_notify)){
      $data2 = $notify['data_fim'];
      $data2 = implode('-', array_reverse(explode('/', $data2)));

      // converte as datas para o formato timestamp
      $d2 = strtotime($data2);

      // verifica a diferença em segundos entre as duas datas e divide pelo número de segundos que um dia possui
      $dataFinal = ($d2 - $d1) /86400;

      // caso a data 2 seja menor que a data 1, multiplica o resultado por -1
      if($dataFinal < 0){
        $dataFinal *= -1;
        echo "Expirou para <b>". $notify['email'] ."</b><br>";
      }else  {
        if ($dataFinal < 5) {
          echo "<b>". $notify['email'] ."</b> Faltam ". $dataFinal ." dias para expirar a linha: Efectue pagamento.<br>";
        }
      }
    }
  ?>
