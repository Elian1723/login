<?php session_start();
if (isset($_SESSION['usuario'])) {
  require 'views/content.view.php';
} else{
  header('Location: login.php');
}

 ?>
