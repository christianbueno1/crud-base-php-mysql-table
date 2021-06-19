<?php

require_once 'database.php';

class Product {
    private $conn;

    // Constructor
    public function __construct(){
      $database = new Database();
      $db = $database->dbConnection();
      $this->conn = $db;
    }


    // Execute queries SQL
    public function runQuery($sql){
      $stmt = $this->conn->prepare($sql);
      return $stmt;
    }

    // Insert
    public function insert($product, $price, $attribute){
      try{
        $stmt = $this->conn->prepare("INSERT INTO product (product, price, attribute) VALUES(:product, :price, :attribute)");
        $stmt->bindparam(":product", $product);
        $stmt->bindparam(":price", $price);
        $stmt->bindparam(":attribute", $attribute);
        $stmt->execute();
        return $stmt;
      }catch(PDOException $e){
        echo $e->getMessage();
      }
    }


    // Update
    public function update($product, $price, $attribute, $id){
        try{
          $stmt = $this->conn->prepare("UPDATE product SET product = :product, price = :price, attribute = :attribute WHERE id = :id");
          $stmt->bindparam(":product", $product);
          $stmt->bindparam(":price", $price);
          $stmt->bindparam(":attribute", $attribute);
          $stmt->bindparam(":id", $id);
          $stmt->execute();
          return $stmt;
        }catch(PDOException $e){
          echo $e->getMessage();
        }
    }

    // Delete
    public function delete($id){
        try{
            $stmt = $this->conn->prepare("DELETE FROM product WHERE id = :id");
            $stmt->bindparam($id);
            return $stmt;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }


    // Redirect URL method
    public function redirect($url){
        header("Location: $url");
    }

}
?>