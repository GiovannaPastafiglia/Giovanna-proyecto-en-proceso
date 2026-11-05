<?php

// Trae la conexión a la base ($conexionbd) desde el archivo central
require "conexion.php";

// Dos variables vacías: si no las inicializo, PHP avisa "undefined variable" al mostrarlas
$error = "";
$exito = "";

// Solo procesamos el alta si el formulario se envió por POST.
// Si alguien abre la página con GET, baja directo al HTML y muestra el formulario vacío.
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Leemos lo que escribió el usuario. trim() saca espacios de los costados
    $usuario = trim($_POST["usuario"]);
    $clave   = $_POST["clave"];
    $clave2  = $_POST["clave2"];

    // Validación 1: ningún campo puede quedar vacío
    if ($usuario === "" || $clave === "" || $clave2 === "") {
        $error = "Completá todos los campos.";

    // Validación 2: las dos contraseñas deben ser idénticas
    } elseif ($clave !== $clave2) {
        $error = "Las contraseñas no coinciden.";

    // Validación 3: largo mínimo de la contraseña
    } elseif (strlen($clave) < 8) {
        $error = "La contraseña debe tener al menos 8 caracteres.";

    } else {
        // ¿Ya existe ese nombre de usuario? El "?" es un marcador:
        // el valor real viaja aparte y así se evita la inyección SQL
        $busca = $conexionbd->prepare("SELECT id FROM usuarios WHERE usuario = ?");
        $busca->execute([$usuario]);

        // fetch() devuelve la fila si la encontró, o false si no existe
        if ($busca->fetch()) {
            $error = "Ese usuario ya está registrado.";
        } else {
            // Convierte la contraseña en un hash irreversible.
            // En la base NUNCA se guarda la contraseña en texto plano.
            $hash = password_hash($clave, PASSWORD_DEFAULT);

            // INSERT con dos marcadores: los valores van en un array aparte
            $alta = $conexionbd->prepare("INSERT INTO usuarios (usuario, clave) VALUES (?, ?)");
            $alta->execute([$usuario, $hash]);

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

            <?php if ($error !== "") { ?>
                <!-- Rojo: algo falló, mostramos el motivo guardado en $error -->
                <div class="alert alert-danger py-2 text-center"><?php echo $error; ?></div>
            <?php } ?>

            <?php if ($exito !== "") { ?>
                <!-- Verde: se creó bien, ofrecemos el enlace para iniciar sesión -->
                <div class="alert alert-success py-2 text-center">
                    <?php echo $exito; ?><br>
                    <a href="index.php">Iniciar sesión</a>
                </div>
            <?php } ?>

            <!-- Sin "action" el formulario se envía a esta misma página (crear_usuario.php).
                Los "name" de los campos son las claves que leemos arriba con $_POST. -->
            <form method="POST">
                <div class="mb-3">
                    <label for="usuario" class="form-label">Usuario</label>
                    <input type="text" name="usuario" id="usuario" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="clave" class="form-label">Contraseña</label>
                    <input type="password" name="clave" id="clave" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="clave2" class="form-label">Repetir contraseña</label>
                    <input type="password" name="clave2" id="clave2" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Crear</button>
            </form>

            <!-- Enlace simple para volver: es un <a> porque navega, no envía datos -->
            <hr>
            <a href="index.php" class="btn btn-outline-secondary w-100">Volver al inicio</a>
        </div>
    </div>

</body>
</html>