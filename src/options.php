<?php

require_once 'vendor/autoload.php'; // Incluye el archivo de autocarga de Composer para cargar las clases

use Lenovo\Encuestas\model\Encuesta; // Importa la clase Encuesta del espacio de nombres especificado

// Verifica si se ha enviado el formulario con el título y al menos una opción
if (isset($_POST['title']) && isset($_POST['option'])) {
    $title = $_POST['title'];
    $options = $_POST['option']; 

    // Crea una nueva instancia de la clase Encuesta con el título proporcionado
    $survey = new Encuesta($title);

    // Guarda la encuesta en la base de datos
    $survey->save();

    // Inserta las opciones en la encuesta recién creada
    $survey->insertOptions($options);

    // Redirige al usuario a una página de éxito o a la página principal después de procesar el formulario
    header("Location: home.php"); 
    exit(); // Detiene la ejecución del script después de redirigir para evitar ejecución adicional
} else {
    // Si el título u opciones no están presentes en el formulario, carga la página de inicio
    require 'home.php';
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
