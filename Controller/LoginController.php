<?php

require_once "./Model/UserModel.php";
require_once "./View/LoginView.php";
require_once "./View/ProductView.php";

class LoginController{

    private $model;
    private $view;
    private $productView;
//------------------------------------------------------------------
    function __construct(){
        $this->model = new UserModel();
        $this->view = new LoginView();
        $this->productView = new ProductView();
    }
//------------------------------------------------------------------
    function register(){
        //LLAMA A LA FUNCION QUE RENDERIZA LA PAGINA DE REGISTRO
        $this->view->showRegister();
    }
//------------------------------------------------------------------
    function login(){
        //LLAMA A LA FUNCION QUE RENDERIZA LA PAGINA DE LOGIN
        $this->view->showLogin();
    }
//------------------------------------------------------------------
    function verifyLogin(){
        //VERIFICA EL LOGUEO DE UN USUARIO REGISTRADO
        if(!empty($_POST['user']) && !empty($_POST['password'])){
            $user = $_POST['user'];
            $password = $_POST['password'];

            $userLog = $this->model->getUser($user);

            if ($userLog && password_verify($password, $userLog->password) ) {
                
                session_start();
                $_SESSION['username'] = $userLog->username;
                $_SESSION['permisoDeAdmin'] = $userLog->admin; //guardo en la sesion si soy admin 
                $_SESSION['id_usuario'] = $userLog->id_usuario;

                $this->view->showHome();
            }else{
                $this->view->showLogin('Acceso Denegado');
            }
        }else{
            $this->view->showLogin('Debe Ingresar sus Datos para Loguearse o Registrarse');
        }
    }
//------------------------------------------------------------------
    function userRegister(){
        //REGISTRA A UN NUEVO USUARIO EN LA DB
        if(!empty($_POST['user']) && !empty($_POST['password'])){
            $user = $_POST['user'];
            $password = $_POST['password'];

            $mensaje = $this->model->setUser($user,password_hash($password, PASSWORD_BCRYPT));

            if($mensaje){
                session_start();
                $_SESSION['username'] = $user;
                $_SESSION['permisoDeAdmin'] = 0;

                $userLog = $this->model->getUser($user);
                $_SESSION['id_usuario'] = $userLog->id_usuario;

                $this->view->message("USUARIO INSERTADO CON EXITO!");
            }else{
                $this->view->message('EL USUARIO YA EXISTE!');
            }
        }else{
                $this->view->message('Debe Ingresar sus Datos');
            }
        }
//------------------------------------------------------------------
    function checkLoggedIn(){
        //VERIFICA QUE LA SESSION ESTE INICIADA.
        session_start();
        if(!isset($_SESSION["username"])){
            return false;
        }
        return true;
    }
//------------------------------------------------------------------
    function checkIsAdmin(){
        //VERIFICA QUE EL USUARIO SEA ADMIN.
        session_start();
        if($_SESSION['permisoDeAdmin'] == '1'){
            return true;
        }else
            return false;
    }
//------------------------------------------------------------------
    function deleteUser($userName){
        //ELIMINA UN USUARIO CUYO id ES PASADO POR PARAMETRO.
        $this->checkLoggedIn();
        $this->model->deleteUserFromDB($userName);
        $this->productView->showHomeLocation();
    }
//------------------------------------------------------------------
    function usersView(){
        //MUESTRA TODOS LOS USUARIOS REGISTRADOS EN EL SISTEMA
        $this->checkLoggedIn();
        $this->view->showUsers($this->model->getUsers());
    }
//------------------------------------------------------------------
    function reasignLevel($user){
        //MODIFICA EL ROL DEL USUARIO EN LA DB (admin o user)
        $this->checkLoggedIn();
        if(isset($_POST['radio'])){
            $this->model->reasignLevelUserFromDB($user, $_POST['radio']);
            $this->productView->showHomeLocation();
        }
    }
//------------------------------------------------------------------
    function logout(){
        if($this->checkLoggedIn()){
        session_destroy();
        $this->view->showLogin('Se ha deslogueado con exito!');
        }else{
            $this->productView->showHomeLocation();
        }
    }
//------------------------------------------------------------------
    function getSession(){
        if(isset($_SESSION["username"]))
            return $_SESSION["username"];
        else
            return "";
    }
//------------------------------------------------------------------
    function getUserBySession(){
        //retorna completo el registro del usuario
        if(isset($_SESSION["username"]))
            return  $this->model->getUser($_SESSION["username"]);
        else
            return null;
    }
}