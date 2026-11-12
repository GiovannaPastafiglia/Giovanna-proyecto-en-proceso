
<?php
require_once "conexion.php";

$error = "";
$exito = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $usuario = trim($_POST["usuario"]);
    $mail = trim($_POST["mail"]);
    $clave = $_POST["clave"];
    $clave2 = $_POST["clave2"];

    if ($usuario === "" || $mail === "" || $clave === "" || $clave2 === "") {
        $error = "Completá todos los campos.";

    } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $error = "Ingresá un correo válido.";

    } elseif ($clave !== $clave2) {
        $error = "Las contraseñas no coinciden.";

    } elseif (strlen($clave) < 8) {
        $error = "La contraseña debe tener al menos 8 caracteres.";

    } else {

        $busca = $conexion->prepare(
            "SELECT id FROM inscripiones WHERE usuario = ?"
        );
        $busca->execute([$usuario]);

        if ($busca->fetch()) {
            $error = "Ese usuario ya está registrado.";

        } else {

            $hash = password_hash($clave, PASSWORD_DEFAULT);

            $alta = $conexion->prepare(
                "INSERT INTO inscripiones (usuario, contraseña, mail)
                VALUES (?, ?, ?)"
            );

            $alta->execute([$usuario, $hash, $mail]);

            $exito = "Usuario creado correctamente.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex justify-content-center align-items-center min-vh-100">

<div class="card shadow-sm" style="width: 350px;">
    <div class="card-body p-4">

        <h1 class="h4 text-center mb-4">Crear usuario</h1>

        <?php if ($error !== ""): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <?php if ($exito !== ""): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($exito) ?>
                <br>
                <a href="index.php">Iniciar sesión</a>
            </div>
        <?php endif; ?>

        <form method="POST">

            <div class="mb-3">
                <label class="form-label">Usuario</label>
                <input type="text" name="usuario" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Correo electrónico</label>
                <input type="email" name="mail" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" name="clave" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Repetir contraseña</label>
                <input type="password" name="clave2" class="form-control" required>
            </div>

            <a href="registro.php">
            <button type="button" class="btn-crear">Crear cuenta</button>
            </a>

        </form>

        <hr>

        <a href="index.php" class="btn btn-outline-secondary w-100">
            Volver al inicio
        </a>

    </div>
</div>

</body>
</html>
