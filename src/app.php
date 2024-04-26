<?php

// Verificar si el parámetro 'view' está presente en la URL
if (isset($_GET['view'])) {
    // Si 'view' está presente, asignar su valor a la variable $view
    $view = $_GET['view'];

    // Incluir el archivo correspondiente según el valor de 'view' proporcionado en la URL
    require 'src/' . $view . '.php';
} else {
    // Si 'view' no está presente en la URL, cargar el archivo 'home.php' por defecto
    require 'src/home.php';
}
