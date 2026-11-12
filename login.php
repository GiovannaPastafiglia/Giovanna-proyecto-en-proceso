<?php

session_start();

require_once "conexion.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

$usuario = trim($_POST["usuario"] ?? "");
$clave = $_POST["clave"] ?? "";

$consulta = $conexion->prepare(
    "SELECT usuario, contraseña FROM inscripiones WHERE usuario = ?"
);

$consulta->execute([$usuario]);

$fila = $consulta->fetch();

if ($fila && password_verify($clave, $fila["contraseña"])) {

    $_SESSION["usuario"] = $fila["usuario"];

    header("Location: panel.php");
    exit;

} else {

    header("Location: index.php?error=1");
    exit;
}

?>