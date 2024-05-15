<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Home</h1>
    
    <?php
    // Importa la clase Encuesta desde el espacio de nombres correcto
    use Lenovo\Encuestas\Model\Encuesta;

    // Incluye el archivo que define la clase Encuesta si no lo has hecho previamente
    require_once 'vendor/autoload.php';

    // Obtiene las encuestas utilizando el método estático getPolls
    $polls = Encuesta::getPolls();

    // Itera sobre las encuestas y muestra sus títulos
    foreach ($polls as $poll) {
        echo "<div><a href='?view=view&id={$poll->getUUID()}'>{$poll->getTitle()}</a></div>"; // Corrige el método getTitle()
    }
    ?>
</body>
</html>
