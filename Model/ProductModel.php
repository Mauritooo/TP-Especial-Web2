<?php

class ProductModel{

    private $db;

    function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_electrizante;charset=utf8', 'root', '');
    }

    
    function getProducts(){ //retorna solo productos
        $sentencia = $this->db->prepare( "select * from productos");
        $sentencia->execute();
        $productos = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $productos;
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
        $producto = $sentencia->fetch(PDO::FETCH_OBJ);
        return $producto;
    }
    
    function updateProductFromDB($nombre,$descripcion,$precio,$id, $imagen){
        $sentencia = $this->db->prepare("UPDATE productos SET nombre=?, descripcion=?, precio=?, imagen=? WHERE id_producto=?");
        $sentencia->execute(array($nombre,$descripcion,$precio,$id, $imagen));
    }

    function getProductsWithCategory() { //retorna productos y categorias.
        $query = $this->db->prepare("SELECT productos.*, categorias.nombre as categoria FROM productos JOIN
        categorias ON productos.id_categoria = categorias.id_categoria");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
        }
}