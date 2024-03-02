<?php

class CommentModel{

    private $db;

    function __construct(){
        $this->db = new PDO('mysql:host='.$servername.';'.'dbname='.$database.';charset=utf8', $username, $password);    }
//--------------------------------------------------------------
    function getComments($id_producto = ""){ 
        //retorna los comentarios con un id_producto 
        $sentencia = $this->db->prepare("SELECT comentarios.*, productos.*,usuarios.username
        FROM comentarios 
        LEFT JOIN productos ON (productos.id_producto = comentarios.id_producto) 
        LEFT JOIN usuarios ON (usuarios.id_usuario = comentarios.id_usuario) 
        WHERE comentarios.id_producto = ?");
        
        $sentencia->execute(array($id_producto));
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }
//--------------------------------------------------------------
    function getAllComments(){ 
        //retorna todos los comentarios de la tabla CSR
            $sentencia = $this->db->prepare("SELECT comentarios.*, productos.*,usuarios.username 
            FROM comentarios 
            LEFT JOIN productos ON (productos.id_producto = comentarios.id_producto) 
            LEFT JOIN usuarios ON (usuarios.id_usuario = comentarios.id_usuario)");
            
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
        
    }
//--------------------------------------------------------------
    function getComment($id_comentario){
        //RETORNA UN COMENTARIO CUYO id SE PASA UN PARAMETRO
        $sentencia = $this->db->prepare("SELECT * FROM comentarios WHERE id_comentario = ?");
        $sentencia->execute(array($id_comentario));
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }
//--------------------------------------------------------------
    function deleteComment($id_comentario){
        //ELIMINA UN COMENTARIO CUYO id SE PASA UN PARAMETRO
        $sentencia = $this->db->prepare("DELETE FROM comentarios WHERE id_comentario = ?");
        $sentencia->execute(array($id_comentario));
    }
//--------------------------------------------------------------
    function updateComment($comentario, $id_comentario){
        //ACTUALIZA UN COMENTARIO CUYO id SE PASA UN PARAMETRO
        $sentencia = $this->db->prepare("UPDATE FROM comentarios SET comentario = ? WHERE id_comentario = ?");
        $sentencia->execute(array($comentario, $id_comentario));
    }
//--------------------------------------------------------------
    function addComment($id_usuario, $comentario, $id_producto, $calificacion){
        var_dump($id_usuario, $comentario, $id_producto, $calificacion);
        $sentencia = $this->db->prepare("INSERT INTO comentarios(id_producto, comentario, calificacion, id_usuario) VALUES(?, ?, ?, ?)");
        return $sentencia->execute(array($id_producto, $comentario, $calificacion, $id_usuario));
    }
}