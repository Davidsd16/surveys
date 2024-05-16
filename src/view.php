<?php
// Activar la visualización de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use Lenovo\Encuestas\model\Encuesta;

// Inicializar variable $poll
$poll = null;

// Verificar si se ha recibido el parámetro 'id' a través de la URL
if (isset($_GET['id'])) {
    $uuid = $_GET['id'];

    try {
        // Intentar encontrar la encuesta con el UUID proporcionado
        $poll = Encuesta::find($uuid);
    } catch (Exception $e) {
        // Mostrar mensaje de error si no se encuentra la encuesta
        echo 'Error al encontrar la encuesta: ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View</title>
</head>
<body>
    <h1><?php echo $poll->getTitle(); ?> </h1>
    <?php
        $options = $poll->getOptions();
        foreach ($options as $option) {
            
    ?>

        <div class="vote-item">
            <form action="?view=view&id=<?php echo htmlspecialchars($uuid); ?>" method="post">
                <input type="submit" value="vote for <?php echo htmlspecialchars($option['title']); ?>">
            </form>
        </div>
    <?php

        }
    
    ?>

</body>
</html>
