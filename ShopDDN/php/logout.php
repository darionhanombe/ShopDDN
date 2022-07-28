<?php
session_start();
unset($_SESSION['admin']);
unset($_SESSION['admin_tipo']);

header("Location:/Administrador.php");
?>