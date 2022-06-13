<?php session_start();
if (isset($_SESSION['usuario'])) {
  header('Location: index.php');
}

$errores = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $usuario = filter_var(strtolower($_POST['usuario']));
  $password = $_POST['password'];
  $password = hash('sha512', $password);

  if (empty($usuario or empty($password))) {
    $errores .= '<li><i class="fa-solid fa-circle-exclamation"></i>Por favor rellena todos campos</li>';
  } else{
    try {
      $conexion = new PDO('mysql:host=127.0.0.1;dbname=login', 'root', '');
    } catch (PDOException $e){
      echo "Error: " . $e->getMessage();
    }

    $statement = $conexion->prepare('SELECT * FROM usuarios WHERE usuario = :usuario AND pass = :password');
    $statement->execute(array(':usuario' => $usuario, ':password' => $password));
    $resultado = $statement->fetch();

    if ($resultado != false) {
      $_SESSION['usuario'] = $usuario;
      header('Location: index.php');
    }else {
      $errores .= '<li><i class="fa-solid fa-circle-exclamation"></i>Datos incorrectos</li>';
    }
  }
}

require "views/login.view.php";
 ?>
