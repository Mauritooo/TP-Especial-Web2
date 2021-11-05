<?php

class UserModel{

    private $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_electrizante;charset=utf8', 'root', '');
    }

    function getUser($user){
        $query = $this->db->prepare('SELECT * FROM usuario WHERE username = ?');
        $query->execute([$user]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    function setUser($user,$password){
        $query = $this->db->prepare('INSERT INTO usuario( username, password) VALUES (? , ?)');
        $query->execute([$user,$password]);
    }
}