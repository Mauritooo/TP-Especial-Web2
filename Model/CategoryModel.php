<?php

class CategoryModel{

    private $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_electrizante;charset=utf8', 'root', '');
    }

    
    function getCategories(){ //retorna solo categorias
        $sentencia = $this->db->prepare( "SELECT * FROM categorias");
        $sentencia->execute();
        $categorias = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $categorias;
    }

    
    function getCategoryFromDB($id){
        $sentencia = $this->db->prepare( "SELECT *,precio,descripcion,  productos.nombre as producto FROM categorias  JOIN 
        productos ON categorias.id_categoria = productos.id_categoria WHERE categorias.id_categoria=?");
        //$sentencia = $this->db->prepare( "SELECT * FROM categorias WHERE id_producto=?");
        
        $sentencia->execute(array($id));
        $categoriaDeProductos = $sentencia->fetchAll(PDO::FETCH_OBJ);
        //var_dump($categoriaDeProductos);
        return $categoriaDeProductos;
    }
}
