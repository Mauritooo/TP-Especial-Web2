<?php

class UserModel{

    private $db;

    function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_electrizante;charset=utf8', 'root', 'root');
    }

    function getUser($user){
        //RETORNA EL USUARIO CUYO username ES IGUAL AL PASADO POR PARAMETRO.
        $query = $this->db->prepare('SELECT * FROM usuarios WHERE username=?');
        $query->execute([$user]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    function setUser($user,$password){
        $usuario = $this->getUser($user);
        if(!$usuario){
            $query = $this->db->prepare('INSERT INTO usuarios( username, password, admin) VALUES (? , ?, ?)');
            $query->execute([$user,$password, 0]);
            return true;
        }else{
            return false;
        }
    }

    function deleteUserFromDB($userName){
        $sentencia = $this->db->prepare('DELETE FROM usuarios WHERE username=?');
        $sentencia->execute(array($userName));
    }

    function getUsers(){
        $superUser = 'mauro'; //ESTE NO SE MUESTRA PORQUE ES EL SUPER USER. password = 123456
        $sentencia = $this->db->prepare('SELECT * FROM usuarios WHERE username != ?');
        $sentencia->execute([$superUser]);
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

    function reasignLevelUserFromDB($user,$nivel){
        $sentencia = $this->db->prepare('UPDATE usuarios SET admin=? WHERE username=?');
        $sentencia->execute(array($nivel, $user));
    }
}