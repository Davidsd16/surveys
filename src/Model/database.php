<?php

namespace Lenovo\Encuestas\model;

use PDO;
use PDOException;

class Database{

    private $host;
    private $db;
    private $user;
    private $password;
    private $charset;

    // Constructor que inicializa los parámetros de conexión
    public function __construct()
    {
        $this->host = 'localhost';
        $this->db = 'surveys';
        $this->user = 'root';
        $this->password = 'divad';
        $this->charset = 'utf8mb4';
    }

    // Método para establecer la conexión a la base de datos
    function connect()
    {
        try {
            // Crear la cadena de conexión usando los parámetros configurados
            $connection = "mysql:host=" . $this->host . ";dbname=" . $this->db . ";charset=" . $this->charset;

            // Opciones de configuración para PDO
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            // Crear una instancia de PDO y retornarla
            $pdo = new PDO($connection, $this->user, $this->password, $options);
            return $pdo;
        } catch (PDOException $e) {
            // Manejar errores de conexión
            print_r('Error connection: ' . $e->getMessage());
        }
    }
}