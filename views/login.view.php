<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css" integrity="sha384-/frq1SRXYH/bSyou/HUp/hib7RVN1TawQYja658FEOodR/FQBKVqT9Ol+Oz3Olq5" crossorigin="anonymous">
    <link rel="stylesheet" href="css/responsive.css">
    <title>Inicar sesión</title>
  </head>
  <body>
    <div class="wrap">
      <main>
        <header class="cont-center">
          <img src="img/login.svg" alt="Welcome" class="login">
          <h1>Bienvenido a ASM</h1>
        </header>
        <form class="login cont-center" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
          <div class="input-group">
            <input type="text" name="usuario" placeholder="Usuario"><i class="fa-solid fa-user"></i>
          </div>

          <div class="input-group">
            <input type="password" name="password" placeholder="Contraseña"><i class="fa-solid fa-lock"></i>
          </div>


          <input type="submit" name="enviar" value="Iniciar sesión">
        </form>

        <?php if (!empty($errores)):?>
          <ul class="errores">
            <?php echo $errores; ?>
          </ul>
        <?php endif; ?>

        <p class="registrarse">
          ¿Aún no tienes una cuenta?
          <a href="sign-in.php">Regístrate</a>
        </p>
      </main>
    </div>
  </body>
</html>
