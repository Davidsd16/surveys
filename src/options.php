<?php

use Lenovo\Encuestas\model\Encuesta;

require_once 'vendor/autoload.php';


// Verifica si se ha enviado el formulario con el título y al menos una opción
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title']) && isset($_POST['option'])) {
    $title = $_POST['title'];
    $options = $_POST['option'];    

    try {
        // Crea una nueva instancia de la clase Encuesta con el título proporcionado
        $survey = new Encuesta($title);

        // Guarda la encuesta en la base de datos
        $survey->save();

        // Inserta las opciones en la encuesta recién creada
        $survey->insertOptions($options);

        // Redirige al usuario a una página de éxito o a la página principal después de procesar el formulario
        header("Location: ?view=home");
        exit(); // Detiene la ejecución del script después de redirigir para evitar ejecución adicional
    } catch (Exception $e) {
        // Maneja cualquier excepción lanzada durante la creación o el procesamiento de la encuesta
        echo 'Error: ' . $e->getMessage();
    }
} else {
    // Si el título u opciones no están presentes en el formulario, carga la página de inicio
    require 'src/home.php';
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Options</title>
</head>
<body>
    <form action="?view=options" method="POST">
        <h3>Questions</h3>
        <!-- Muestra el título proporcionado en el formulario, si está presente, de forma segura -->
        <input type="hidden" name="title" value="<?php echo isset($_POST['title']) ? htmlspecialchars($_POST['title']) : '' ?>">

        <!-- Campos para ingresar las opciones -->
        <input type="text" name="option[]" id="">
        <input type="text" name="option[]" id="">

        <div class="more-inputs">
            <!-- Espacio para agregar más campos de opción dinámicamente si es necesario -->
        </div>

        <!-- Botón para agregar otra opción (funcionalidad adicional podría ser implementada aquí) -->
        <button id="bAdd">Add another option</button>

        <!-- Botón de envío para crear la encuesta -->
        <input type="submit" value="Crear Encuesta">
    </form>
</body>
</html>
