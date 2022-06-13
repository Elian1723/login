<?php session_start();

if (isset($_SESSION['usuario'])) {
  header('Location: index.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $usuario = filter_var(strtolower($_POST['usuario']),FILTER_SANITIZE_STRING);
  $password = $_POST['password'];
  $password2 = $_POST['password2'];
  $errores = '';

  if (empty($usuario) or empty($password) or empty($password2)) {
    $errores .= '<li><i class="fa-solid fa-circle-exclamation"></i>Por favor rellena todos los campos</li>';
  } else{
    try {
      $conexion = new PDO('mysql:host=127.0.0.1;dbname=login', 'root', '');
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }

    $statement = $conexion->prepare('SELECT * FROM usuarios WHERE usuario = :usuario LIMIT 1');
    $statement->execute(array(':usuario' => $usuario));
    $resultado = $statement->fetch();

    if ($resultado != false) {
      $errores .= '<li><i class="fa-solid fa-circle-exclamation"></i>El nombre de usuario ya existe</li>';
    }

    if ($password != $password2) {
      $errores .= '<li><i class="fa-solid fa-circle-exclamation"></i>Las contraseñas no coinciden</li>';
    } else{
      $password = hash('sha512', $password);
      $password2 = hash('sha512', $password2);
    }
  }

  if ($errores == '') {
    $statement = $conexion->prepare('INSERT INTO usuarios(id, usuario, pass) VALUES(null, :usuario, :pass)');
    $statement->execute(array(':usuario' => $usuario, 'pass'=>$password));
    header('Location: login.php');
  }
}



require 'views/sign-in.view.php';
 ?>
