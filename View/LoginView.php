<?php

require_once './libs/smarty-3.1.39/libs/Smarty.class.php';

class LoginView{

    private $smarty;
//------------------------------------------------------------------
    function __construct(){
        $this->smarty = new Smarty();
    }
//------------------------------------------------------------------
    function showLogin($error = ""){ 
        //RENDERIZA LA PANTALLA DE LOGUEO
        $this->smarty->assign('titulo',"Log in");
        $this->smarty->assign('error', $error);
        $this->smarty->display('templates/login.tpl');
    }
//------------------------------------------------------------------
    function showHome(){
        //RETORNA A LA PANTALLA DEL HOME
        header("Location: ".BASE_URL."home");
    }
//------------------------------------------------------------------
    function showRegister($error = ''){
        //RENDERIZA LA PANTALLA DE REGISTRO
        $this->smarty->assign('titulo',"Register");
        $this->smarty->assign('error', $error);
        $this->smarty->display('templates/register.tpl');
    }
//------------------------------------------------------------------
    function showUsers($users){
        //RENDERIZA LA LISTA DE LOS USUARIOS PASADOS POR PARAMETRO
        $this->smarty->assign('titulo','Lista de Usuarios Registrados');
        $this->smarty->assign('myUser',$_SESSION['permisoDeAdmin']);
        $this->smarty->assign('users',$users);
        $this->smarty->display('templates/usersView.tpl');
    }
//------------------------------------------------------------------
    function message($error){
        //RENDERIZA UN MENSAJE PASADO POR PARAMETRO
        $this->smarty->assign('error',$error);
        $this->smarty->display('templates/message.tpl');
    }
}