<?php
// Inicia la sesión para poder manipularla
session_start();

// Destruye la sesión: olvida quién estaba logueado
session_destroy();

// Vuelve al login
header("Location: index.php");
?>