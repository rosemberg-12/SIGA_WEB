<?php
 session_start();
  unset($_SESSION["usuario"]);
  unset($_SESSION["tipo_usuario"]);
  session_destroy();
  header("Location: index.php");
  exit;
?>