<?php
error_reporting (E_ALL ^ E_NOTICE);
include('../session.php');

$email = basename($_POST["email"]);
$password = basename($_POST["password"]);
$nome = basename($_POST["nome"]);
$apelido = basename($_POST["apelido"]);
$data_nascimento = basename($_POST["data"]);
$telefone = basename($_POST["phone"]);
$avatar = basename($_POST["avatar"]);
$file = basename($_FILES["fileToUpload"]["name"]);

$target_dir = "../images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if ($file == ""){
  $sql1 = "SELECT * FROM users WHERE email = '$email'";
  $result1 = mysqli_query($db,$sql1);
  $row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);

  // If result matched $myusername and $mypassword, table row must be 1 row

  if($row1 >=1) {
    $sql3 = "UPDATE users SET email = '". $email . "', nome = '". $nome . "', apelido = '". $apelido . "',  telefone = '". $telefone . "', data_nascimento = '". $data_nascimento . "',
     avatar_path = '". $avatar . "'
     WHERE email='". $email."'";
    $result3 = mysqli_query($db, $sql3);
    echo "User Alterado";
  }else {
      echo "Não foi possivel Alterar o User. Tente Novamente.";
  }
} else {
  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
      echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      echo "File is not an image.";
      $uploadOk = 0;
    }
  }

  // Check if file already exists
  if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }

  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }

  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";

        $sql4 = "UPDATE users SET email = '". $email . "', nome = '". $nome . "', apelido = '". $apelido . "',  telefone = '". $telefone . "', data_nascimento = '". $data_nascimento . "',
         avatar_path = 'images/". $file . "'
         WHERE email='". $email."'";
        $result4 = mysqli_query($db, $sql4);
    } else {
      echo "Sorry, there was an error uploading your file.";

    }
  }
}
?>
