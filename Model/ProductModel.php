<?php

class ProductModel{

    private $db;
//------------------------------------------------------------------
    function __construct(){
        $this->db = new PDO('mysql:host='.Config::$servername.';'.'dbname='.Config::$database.';charset=utf8', Config::$username, Config::$password);
    }
//------------------------------------------------------------------
    function getProducts(){ 
        //RETORNA TODOS LOS PRODUCTOS.
        $sentencia = $this->db->prepare( "SELECT * FROM productos");
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }
//------------------------------------------------------------------
    function setProduct($nombre,$descripcion, $precio, $categoria, $imagen=""){
        //INGRESA UN PRODUCTO EN LA BASE DE DATOS
        $sentencia = $this->db->prepare("INSERT INTO productos(nombre, descripcion, precio, id_categoria,imagen) VALUES(?, ?, ?, ?, ?)");
        $sentencia->execute(array($nombre,$descripcion,$precio, $categoria, $imagen));
    }
//------------------------------------------------------------------
    function deleteProductoFromDB($id){
        //ELIMINA UN PRODUCTO EN LA BASE DE DATOS
        $sentencia = $this->db->prepare("DELETE FROM productos WHERE id_producto=?");
        $sentencia->execute(array($id));
    }
//------------------------------------------------------------------
    function getProductFromDB($id){
        //OBTIENE UN PRODUCTO POR SU id DE LA BASE DE DATOS
        $sentencia = $this->db->prepare( "SELECT productos.*, categorias.nombre as categoria FROM productos JOIN
        categorias ON productos.id_categoria = categorias.id_categoria WHERE id_producto=?");
        $sentencia->execute(array($id));
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }
//------------------------------------------------------------------
    function updateProductFromDB($id, $nombre,$descripcion,$precio, $imagen){
        //ACTUALIZA LOS DATOS DE UN PRODUCTO EN LA BASE DE DATOS
        $sentencia = $this->db->prepare("UPDATE productos SET nombre=?, descripcion=?, precio=?, imagen=? WHERE id_producto=?");
        $sentencia->execute(array($nombre,$descripcion,$precio, $imagen, $id));
    }
//------------------------------------------------------------------
    function getProductsWithCategory(){
        //RETORNA TODOS LOS PRODUCTOS CON SU RESPECTIVA CATEGORIA
        $query = $this->db->prepare("SELECT productos.*, categorias.nombre as categoria FROM productos JOIN
        categorias ON productos.id_categoria = categorias.id_categoria");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
        }
}
