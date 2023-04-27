<?php
error_reporting (E_ALL ^ E_NOTICE);
include('../../session.php');
?>
<div class="logo">
   <h1><a>Editar Website</a></h1>
</div><br>

<ul class="nav nav-tabs nav-justified">
  <li class="active"><a data-toggle="tab" href="#geral">Geral</a></li>
  <li><a data-toggle="tab" href="#db">Base de Dados</a></li>
  <li><a data-toggle="tab" href="#email">Email</a></li>
</ul>

<div class="tab-content">
  <div id="geral" class="tab-pane fade in active">
    <h3>Geral</h3>
    <p>Some content.</p>
  </div>
  <div id="db" class="tab-pane fade">
    <h3>Base de Dados</h3>
    <p>Some content in menu 1.</p>
  </div>
  <div id="email" class="tab-pane fade">
    <h3>Email</h3>
    <p>Some content in menu 2.</p>
  </div>
</div>
