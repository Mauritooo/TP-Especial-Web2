<?php

class ProductModel{

    private $db;

    function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_electrizante;charset=utf8', 'root', '');
    }

    
    function getProducts(){ //retorna solo productos
        $sentencia = $this->db->prepare( "select * from productos");
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
        
    }

    function setProduct($nombre,$descripcion, $precio, $categoria, $imagen){
        $sentencia = $this->db->prepare("INSERT INTO productos(nombre, descripcion, precio, id_categoria,imagen) VALUES(?, ?, ?, ?, ?)");
        $sentencia->execute(array($nombre,$descripcion,$precio, $categoria, $imagen));
    }
    
    function deleteProductoFromDB($id){
        $sentencia = $this->db->prepare("DELETE FROM productos WHERE id_producto=?");
        $sentencia->execute(array($id));
    }

    function getProductFromDB($id){
        $sentencia = $this->db->prepare( "SELECT productos.*, categorias.nombre as categoria FROM productos JOIN
        categorias ON productos.id_categoria = categorias.id_categoria WHERE id_producto=?");
        $sentencia->execute(array($id));
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }
    
    function updateProductFromDB($id, $nombre,$descripcion,$precio, $imagen){
      //ESTO ANDA PERFECTO EL ERROR ESTA MAS ARRIBA
        $sentencia = $this->db->prepare("UPDATE productos SET nombre=?, descripcion=?, precio=?, imagen=? WHERE id_producto=?");
        $sentencia->execute(array($nombre,$descripcion,$precio, $imagen, $id));
    }

    function getProductsWithCategory() { //retorna productos y categorias.
        $query = $this->db->prepare("SELECT productos.*, categorias.nombre as categoria FROM productos JOIN
        categorias ON productos.id_categoria = categorias.id_categoria");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
        }
}