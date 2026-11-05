
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

// Conexión a la base de datos (XAMPP)
$host = 'localhost';
$db   = 'login';
$user = 'root';
$pass = '';

try {
    // PDO conecta PHP con la base de datos
    $conexionbd = new PDO(
        "mysql:host=$host;dbname=$db;charset=utf8mb4",
        $user,
        $pass,
        [
            // Si hay error en una consulta, lanza una excepción
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            // Lee cada fila como array asociativo: ['id' => 1, 'usuario' => 'admin']
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
} catch (PDOException $e) {
    // Si falla la conexión, cortamos y mostramos el error
    die("No se pudo conectar a la base de datos: " . $e->getMessage());
}
// En el resto del proyecto usamos la variable $conexionbd
?>
