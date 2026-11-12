
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Inicio de Sesión</title>
</head>

<body>

<div>
    <h1>Iniciar Sesión</h1>
    <p class="subtitulo">Completar los campos solicitados</p>

    <form action="login.php" method="POST" id="ejercicioForm">

        <fieldset>

            <div class="control-group">
                <label for="usuario">Usuario*</label>
                <input type="text" id="usuario" name="usuario"
                    placeholder="Usuario" required>
            </div>

            <div class="control-group">
                <label for="password">Contraseña*</label>
                <input type="password" id="password" name="clave"
                    placeholder="Contraseña" required>
            </div>

        </fieldset>

        <div class="botones-container">

            <button type="submit" class="btn-guardar">
                Iniciar Sesión
            </button>

            <a href="registro.php">
                <button type="button" class="btn-crear">
                    Crear cuenta
                </button>
            </a>

            <button type="reset" class="btn-reset">
                Borrar
            </button>

        </div>

    </form>
</div>

</body>
</html>
