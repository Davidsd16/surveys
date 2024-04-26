<?php

namespace Lenovo\Encuestas\model;

use Lenovo\Encuestas\model\Database;
use PDO;

class Encuesta extends Database {

    private string $uuid;
    
    /**
     * Constructor de la clase Encuesta.
     * 
     * @param string $title Título de la encuesta.
     * @param bool $createUUID Indica si se debe crear un UUID único para la encuesta.
     */
    public function __construct(private string $title, $createUUID = true)
    {
        // Llama al constructor de la clase Database para establecer la conexión a la base de datos.
        parent::__construct();

        // Genera un UUID único para la encuesta si $createUUID es true.
        if ($createUUID) {
            $this->uuid = uniqid();
        }
        // Se asigna un UUID único a la encuesta.
        $this->uuid = uniqid();
    }
}
