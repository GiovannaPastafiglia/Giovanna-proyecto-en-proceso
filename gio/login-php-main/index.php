
<?php
/*
  Copyright (C) 2026, Mauro Bobyk.

  This program is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 3 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program.  If not, see <https://gnu.org>.
*/

// Inicia la sesión para saber si el usuario ya está logueado
session_start();

// Si ya hay sesión, no mostramos el login: va directo al panel
if (isset($_SESSION["usuario"])) {
    header("Location: panel.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">

    <div class="card shadow-sm" style="width: 350px;">
        <div class="card-body p-4">
            <h1 class="h4 text-center mb-4">Iniciar sesión</h1>

            <?php if (isset($_GET["error"])) { ?>
                <!-- Aviso: vino de login.php con ?error=1 (usuario/clave incorrectos) -->
                <div class="alert alert-danger py-2 text-center">
                    Usuario o contraseña incorrectos
                </div>
            <?php } ?>

            <!-- method="POST": los datos viajan ocultos y se leen en login.php con $_POST -->
            <form action="login.php" method="POST">
                <div class="mb-3">
                    <label for="usuario" class="form-label">Usuario</label>
                    <!-- name="usuario" debe coincidir con $_POST["usuario"] en login.php -->
                    <input type="text" name="usuario" id="usuario" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="clave" class="form-label">Contraseña</label>
                    <input type="password" name="clave" id="clave" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Entrar</button>
            </form>

            <!-- Botón para dar de alta un usuario nuevo.
                 Usamos <a> y no <button> porque navega a otra página:
                 <a> sirve para navegar, <button> para enviar formularios. -->
            <hr>
            <a href="crear_usuario.php" class="btn btn-outline-secondary w-100">Crear usuario</a>
        </div>
    </div>

</body>
</html>
