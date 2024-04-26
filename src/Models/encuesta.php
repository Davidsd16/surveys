<?php

namespace Lenovo\Encuestas\model;

use Lenovo\Encuestas\model\Database;
use PDO;

class Encuesta extends Database {

    private string $uuid;
    private int $id;

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

    public function save(){

        // Preparar y ejecutar una consulta para insertar una nueva encuesta en la tabla 'polls'
        $query = $this->connect()->prepare("INSERT INTO polls(uuid, title) VALUES(:uuid, :title)");
        $query->execute([
            'uuid' => $this->uuid,
            'title' => $this->title
        ]);
    
        // Preparar y ejecutar una consulta para obtener el ID de la encuesta recién insertada
        $query = $this->connect()->prepare("SELECT * FROM polls WHERE uuid = :uuid");
        $query->execute([
            'uuid' => $this->uuid,
        ]);
    
        // Asignar el ID de la encuesta recién insertada al objeto Encuesta
        $this->id = $query->fetchColumn();
    }

    public function insertOptions(array $options){
        // Iterar sobre cada opción proporcionada y realizar una inserción en la tabla 'options'
        foreach ($options as $option) {
            // Preparar y ejecutar una consulta para insertar una nueva opción en la tabla 'options'
            $query = $this->connect()->prepare("INSERT INTO options (poll_id, title, votes) VALUES(:poll_id, :title, 0)");
            $query->execute([
                'poll_id' => $this->id,
                'title' => $option 
            ]);
        }
    }

    public static function getPolls(){
        // Inicializar un arreglo para almacenar las encuestas recuperadas de la base de datos
        $polls = [];
    
        // Crear una nueva instancia de la clase Database para manejar la conexión a la base de datos
        $db = new Database();
    
        // Ejecutar una consulta SQL para obtener todas las encuestas de la tabla 'polls'
        $query = $db->connect()->query("SELECT * FROM polls");
    
        // Iterar sobre cada fila obtenida de la consulta y crear objetos Encuesta correspondientes
        while ($r = $query->fetch(PDO::FETCH_ASSOC)) {
            // Crear un objeto Encuesta a partir de un arreglo asociativo de datos
            $poll = Encuesta::createFromArray($r);
    
            // Agregar la encuesta al arreglo de encuestas
            array_push($polls, $poll);
        }
    
        // Devolver el arreglo de encuestas
        return $polls;
    }
    
    public static function createFromArray(array $arr){
        // Crear una nueva instancia de la clase Encuesta utilizando los datos proporcionados en el arreglo
        $poll = new Encuesta($arr['title'], false);
    
        // Establecer el UUID de la encuesta utilizando el valor proporcionado en el arreglo
        $poll->setUUID($arr['uuid']);
    
        // Establecer el ID de la encuesta utilizando el valor proporcionado en el arreglo
        $poll->setID($arr['id']);
    
        // Devolver la instancia de Encuesta creada
        return $poll;
    }
    
    public function setUUID($value){
        // Establecer el UUID de la encuesta utilizando el valor proporcionado
        $this->uuid = $value;
    }
    
    public function setID($value){
        // Establecer el ID de la encuesta utilizando el valor proporcionado
        $this->id = $value;
    }
    

}
