<?php
// Model/Tela.php
class Tela {
    private $conn;
    private $table_name = "telas";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllTelas() {
        try {
            $query = "SELECT * FROM " . $this->table_name . " ORDER BY id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            error_log("Error obteniendo telas: " . $e->getMessage());
            return [];
        }
    }

    public function getTelaById($id) {
        try {
            $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            
            $tela = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($tela) {
                error_log("Tela encontrada: " . print_r($tela, true));
            } else {
                error_log("No se encontró tela con ID: " . $id);
            }
            return $tela;
        } catch(PDOException $e) {
            error_log("Error obteniendo tela por ID: " . $e->getMessage());
            return null;
        }
    }
}