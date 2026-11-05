<!-- /*
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
*/ -->
<?php
// Inicia la sesión
session_start();

// Guardia: si no hay sesión, no puede entrar
if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-primary">
        <div class="container">
            <span class="navbar-brand mb-0 h1">Mi Panel</span>
            <!-- Va a logout.php, que cierra la sesión -->
            <a href="logout.php" class="btn btn-light btn-sm">Salir</a>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <!-- Muestra el nombre del usuario guardado en la sesión -->
                <h1 class="h4">Bienvenido, <?php echo $_SESSION["usuario"]; ?> 👋</h1>
                <p class="mb-0 text-secondary">Entraste correctamente. Esta página solo es visible cuando estás logueado.</p>

                <hr>

                <!-- Botón que abre la guía de ejercicios en HTML -->
                <a href="guia.html" class="btn btn-primary">📖 Ver guía de ejercicios</a>
            </div>
        </div>
    </div>

</body>
</html>
