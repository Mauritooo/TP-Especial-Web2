<?php

class UserModel{

    private $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_electrizante;charset=utf8', 'root', '');
    }

    function getUser($user){
        $query = $this->db->prepare('SELECT * FROM usuarios WHERE username=?');
        $query->execute([$user]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    function setUser($user,$password){
        $query = $this->db->prepare('INSERT INTO usuarios( username, password, admin) VALUES (? , ?, ?)');
        $query->execute([$user,$password, 0]);
    }

    function deleteUserFromDB($userName){
        $sentencia = $this->db->prepare('DELETE FROM usuarios WHERE username=?');
        $sentencia->execute(array($userName));
    }

    function getUsers(){
        $superUser = 'mauro';
        $sentencia = $this->db->prepare('SELECT * FROM usuarios WHERE username != ?');
        $sentencia->execute([$superUser]);
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

    function reasignLevelUserFromDB($user,$nivel){
        $sentencia = $this->db->prepare('UPDATE usuarios SET admin=? WHERE username=?');
        $sentencia->execute(array($nivel, $user));
    }
}