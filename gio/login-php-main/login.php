<!-- 
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
 -->
<?php
// Inicia la sesión (para guardar al usuario logueado)
session_start();

// Trae la conexión a la base de datos
require "conexion.php";

// Lee los datos que envió el formulario por POST
$usuario = $_POST["usuario"];
$clave   = $_POST["clave"];

// Busca el usuario en la base. El "?" evita inyección SQL
$consulta = $conexionbd->prepare("SELECT * FROM usuarios WHERE usuario = ?");
$consulta->execute([$usuario]);
$fila = $consulta->fetch(); // primera fila encontrada, o false

// Validación: existe el usuario y la contraseña coincide
if ($fila && password_verify($clave, $fila["clave"])) {
    // Guarda quién está logueado y entra al panel
    $_SESSION["usuario"] = $fila["usuario"];
    header("Location: panel.php");
    exit;
}

// Si falló: vuelve al login con ?error=1
header("Location: index.php?error=1");
?>
