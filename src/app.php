<?php


if (isset($_GET['view'])) {
    // Obtener el valor del parámetro 'view' de la URL
    $view = $_GET['view'];

    // Construir la ruta al archivo PHP correspondiente dentro del directorio 'src'
    $filePath = 'src/' . $view . '.php';

    // Verificar si el archivo PHP existe en la ruta especificada
    if (file_exists($filePath)) {
        // Si el archivo existe, incluirlo en el script actual
        require $filePath;
    } else {
        // Si el archivo no existe, mostrar un mensaje de error
        echo "Error: Archivo no encontrado";
    }
} else {
    // Si el parámetro 'view' no está presente en la URL, cargar el archivo 'home.php' por defecto
    require 'src/home.php';
}

