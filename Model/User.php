<?php
class User {
    private $conn;
    private $table_name = "usuarios";

    public $id;
    public $nombre;
    public $apellido;
    public $celular;
    public $usuario;
    public $password;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function register() {
        $query = "INSERT INTO " . $this->table_name . 
                " (nombre, apellido, celular, usuario, password) VALUES
                (:nombre, :apellido, :celular, :usuario, :password)";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":apellido", $this->apellido);
        $stmt->bindParam(":celular", $this->celular);
        $stmt->bindParam(":usuario", $this->usuario);
        $stmt->bindParam(":password", password_hash($this->password, PASSWORD_DEFAULT));
        
        return $stmt->execute();
    }

    public function login($usuario, $password) {
        $query = "SELECT id, password FROM " . $this->table_name . 
                " WHERE usuario = :usuario";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":usuario", $usuario);
        $stmt->execute();
        
        if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if(password_verify($password, $row['password'])) {
                return $row['id'];
            }
        }
        return false;
    }
}