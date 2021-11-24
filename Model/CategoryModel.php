<?php

class CategoryModel{

    private $db;
//------------------------------------------------------------------
    function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_electrizante;charset=utf8', 'root', '');
    }
//------------------------------------------------------------------
    function getCategories(){
        //RETORNA DE LA DB TODAS LAS CATEGORIAS EXISTENTES. 
        $sentencia = $this->db->prepare( "SELECT * FROM categorias");
        $sentencia->execute();
        $categorias = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $categorias;
    }
//------------------------------------------------------------------
    function getCategoryFromDB($id){
        //RETORNA TODOS LOS PRODUCTOS QUE CONTIENE UNA CATEGORIA
        $sentencia = $this->db->prepare( "SELECT *,precio,descripcion,  productos.nombre as producto FROM categorias  JOIN 
        productos ON categorias.id_categoria = productos.id_categoria WHERE categorias.id_categoria=?");
        $sentencia->execute(array($id));
        $categoriaDeProductos = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $categoriaDeProductos;
    }
}
