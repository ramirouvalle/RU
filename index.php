<?php
    session_start();
    if(isset($_SESSION['usuario'])){
        header("Location: principal.php");
        exit();
    }
?>
<html>
  <head>
    <title>Ride Universitario</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="css/first.css" rel="stylesheet" type="text/css">
  </head> 
  <body>
    <nav>
        <div id="logo">
            <p><a href="index.php">RideUniversitario</a></p>
        </div>
        <ul id="menu">
          <li><a href="#second">Iniciar sesión</a></li>
          <li><a href="#second">Registrar</a></li>
          <li><a href="#">Acerda de</a></li>
        </ul>
    </nav>  
    <section id="home" data-type="parallax_section" data-speed="10">
        <div id="home-cont">
            <h1>Ride Universitario</h1>
            <h2>Somos una comunidad que brinda a los alumnos de la universidad una plataforma para ofrecer y pedir un ride entre compañeros para ir a la universidad</h2>
        </div>
    </section>
    <section id="first">
        <div class="first-uno">
            <img src="images/ic_ver.png">
            <h1>Busca</h1>
        </div>
        <div class="first-dos">
            <img src="images/ic_solicita.png">
            <h1>Solicita</h1>
        </div>
        <div class="first-tres">
            <img src="images/ic_acuerda.png">
            <h1>Acuerda un lugar y hora</h1>
        </div>
        <div class="first-cuatro">
            <img src="images/ic_llega.png">
            <h1>Llega a tu destino</h1>
        </div>
    </section>
    <section id="second" data-type="parallax_section" data-speed="10">
        <!--<div id="cont">-->
            <div id="login">
                <form method="POST" action="login.php">
                    <h3>Iniciar Sesión</h3>
                    <input type="text" name="user" placeholder="Usuario">
                    <input type="password" name="pass" placeholder="Contraseña">
                    <input type="submit" name="login" value="Ingresar"> 
                </form>
            </div>
            <div id="register">
                <form method="POST" action="registro.php" >
                    <h3>Registrarse</h3>
                    <input type="text" name="matricula" placeholder="Matricula">
                    <input type="text" name="usuario" placeholder="Usuario">
                    <input type="text" name="mail" placeholder="Correo Universitario">
                    <input type="password" name="r-pass" placeholder="Contraseña">
                    <input type="submit" name="registrar" value="Registrar">
                </form>
            </div>
         <!--</div>-->
    </section>
  </body>
</html>
