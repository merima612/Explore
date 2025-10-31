<?php
require_once(__DIR__ . "/../../config.php");

class BaseDao {
   protected $table;
   protected $id_column;
   protected $connection;

   public function __construct($table, $id_column) {
       $this->table = $table;
       $this->id_column = $id_column;
       $this->connection = Database::connect();
   }

   public function getAll() {
       $stmt = $this->connection->prepare("SELECT * FROM " . $this->table);
       $stmt->execute();
       return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }

   public function getById($id) {
       $stmt = $this->connection->prepare("SELECT * FROM " . $this->table . " WHERE " . $this->id_column . " = :id");
       $stmt->bindParam(':id', $id);
       $stmt->execute();
       return $stmt->fetch(PDO::FETCH_ASSOC);
   }

   public function insert($data) {
       $columns = implode(", ", array_keys($data));
       $placeholders = ":" . implode(", :", array_keys($data));
       $sql = "INSERT INTO " . $this->table . " ($columns) VALUES ($placeholders)";
       $stmt = $this->connection->prepare($sql);
       $stmt->execute($data);
       return $this->connection->lastInsertId();
   }

   public function update($id, $data) {
       $fields = "";
       foreach ($data as $key => $value) {
           $fields .= "$key = :$key, ";
       }
       $fields = rtrim($fields, ", ");
       $sql = "UPDATE " . $this->table . " SET $fields WHERE " . $this->id_column . " = :id";
       $stmt = $this->connection->prepare($sql);
       $data['id'] = $id;
       return $stmt->execute($data);
   }

   public function delete($id) {
       $stmt = $this->connection->prepare("DELETE FROM " . $this->table . " WHERE " . $this->id_column . " = :id");
       $stmt->bindParam(':id', $id);
       return $stmt->execute();
   }
}
?>
