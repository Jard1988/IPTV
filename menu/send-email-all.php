<?php
error_reporting (E_ALL ^ E_NOTICE);
include('../session.php');

?>

<form action="" style="width: 80%; margin-left:5%;">
  <div class="form-group">
    <label for="exampleFormControlInput1">Email</label>
    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Mensagem</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
  <div class="form-group" style="text-align: center;">
    <button type="button" class="btn btn-primary">Close</button>
  </div>
</form>
