<?php
error_reporting (E_ALL ^ E_NOTICE ^ E_WARNING);
include('../session.php');
ini_set('max_execution_time', '300'); //300 seconds = 5 minutes
set_time_limit(300);
$id = mysqli_real_escape_string($db,$_POST['id']);

function execPrint($command) {
    $result = array();
    exec($command, $result);
    print("<pre>");
    foreach ($result as $line) {
        print($line . "\n");
    }
    print("</pre>");
}
?>

<script type="text/javascript">
  $('.btn-danger').click(function() {
      location.href = "home.php";
  });
</script>

<div class="logo">
   <h1><a href="home.php">Log de Atualização</a></h1>
</div><br>

<?php
$url = M3U;

//IMPORTANTE ESTA LINHAS NO SERVER NAO UTILIZA iptv
$destination_folder = "../" . RAIZ_CAMINHO;

$sql = "SELECT * FROM users WHERE users_id = '$id' and permission_id >= '3'";

$result = mysqli_query($db,$sql);
$count = mysqli_num_rows($result);
if ($count >= 1){
 // execPrint("git remote add dest https://github.com/Jard1988/IPTV.git");
  $sql="SELECT * FROM linhas";
  $result_lines = mysqli_query($db,$sql);

    while ($table_lines = mysqli_fetch_assoc($result_lines)){

        $newfname = $destination_folder .$table_lines['nome_linha']. ".m3u"; //set your file ext

        $file = fopen ($url, "rb");

        if (!$file) {
          exit("<b>Falha ao abrir o arquivo. Verifique o seu Caminho M3U nas definições do seu Site</b>");
        }else {
        // Use unlink() function to delete a file
        if (!unlink($newfname)) {
          echo ("Ficheiro <b> ". $table_lines['nome_linha'] . " </b> não existe. Criado a ". date("d/m/Y") ." ás ". date("h:i:sa") ." por ".$users_email."<br>");

            $newf = fopen ($newfname, "w"); // to overwrite existing file
            if ( $newf == false)
              die('Não foi possível criar o arquivo.');
            if ($newf)
            while(!feof($file)) {
              fwrite($newf, fread($file, 1024 * 8 ), 1024 * 8 );
            }

          if ($file) {
            fclose($file);
          }

          if ($newf) {
            fclose($newf);
          }
          echo ("Linha: <b>" . $table_lines['nome_linha'] . "</b> Atualizado a ". date("d/m/Y") ." ás ". date("h:i:sa") ." por ". $users_email ." <br>");
          // execPrint("git add ../Listas/" . $table_lines['nome_linha'] . ".m3u");
          // execPrint("git commit -m 'teste'");
          // execPrint("git push dest");
          // execPrint("git status");
          // execPrint("git pull dest origin");
        }
        else {
           // execPrint("git remote add dest https://github.com/Jard1988/IPTV.git");
            $file = fopen ($url, "rb");

            if ($file) {
              $newf = fopen ($newfname, "w"); // to overwrite existing file
              if ( $newf == false)
                die('Não foi possível criar o arquivo.');
              if ($newf)
              while(!feof($file)) {
                fwrite($newf, fread($file, 1024 * 8 ), 1024 * 8 );

              }
            }

            if ($file) {
              fclose($file);
            }

            if ($newf) {
              fclose($newf);
            }
            echo ("<b>" . $table_lines['nome_linha'] . "</b> Atualizado a ". date("d/m/Y") ." ás ". date("h:i:sa") ." por " . $users_email. "<br>");
// echo "COMANDO: git add ../Listas/" . $table_lines['nome_linha'] . ".m3u";
//             execPrint("git add ../Listas/" . $table_lines['nome_linha'] . ".m3u");
//             execPrint("git commit -m 'teste1'");
//             execPrint("git push dest");
//             execPrint("git status");
//             execPrint("git pull dest origin");
          }
    }
  }
}else {

  $sql="SELECT * FROM linhas, users_linhas where users_linhas.linhas_id = linhas.linhas_id && users_linhas.users_id =  " . $id;

  $result_lines = mysqli_query($db,$sql);

    while ($table_lines = mysqli_fetch_assoc($result_lines)){

        $newfname = $destination_folder .$table_lines['nome_linha']. ".m3u"; //set your file ext

        // Use unlink() function to delete a file
        if (!unlink($newfname)) {
          echo ("Ficheiro <b> ". $table_lines['nome_linha'] . " </b> não existe. Criado a ". date("d/m/Y") ." ás ". date("h:i:sa") ." por ".$users_email."<br>");

          $file = fopen ($url, "rb");

          if ($file) {
            $newf = fopen ($newfname, "w"); // to overwrite existing file
            if ( $newf == false)
              die('Não foi possível criar o arquivo.');

            if ($newf)
            while(!feof($file)) {
              fwrite($newf, fread($file, 1024 * 8 ), 1024 * 8 );
            }
          }

          if ($file) {
            fclose($file);
          }

          if ($newf) {
            fclose($newf);
          }
          echo ("<b>" . $table_lines['nome_linha'] . "</b> Atualizado a ". date("d/m/Y") ." ás ". date("h:i:sa") ." por ". $users_email ." <br>");

        }
        else {
            $file = fopen ($url, "rb");

            if ($file) {
              $newf = fopen ($newfname, "w"); // to overwrite existing file
              if ( $newf == false)
                die('Não foi possível criar o arquivo.');

              if ($newf)
              while(!feof($file)) {
                fwrite($newf, fread($file, 1024 * 8 ), 1024 * 8 );

              }
            }

            if ($file) {
              fclose($file);
            }

            if ($newf) {
              fclose($newf);
            }
            echo ("<b>" . $table_lines['nome_linha'] . "</b> Atualizado a ". date("d/m/Y") ." ás ". date("h:i:sa") ." por " . $users_email. "<br>");
        }
    }
}

  ?>
  <br><button class="btn btn-danger">Voltar</button><br>
