<?php

require_once "./Model/UserModel.php";
require_once "./View/LoginView.php";
require_once "./View/ProductView.php";

class LoginController{

    private $model;
    private $view;
    private $productView;

    function __construct()
    {
        $this->model = new UserModel();
        $this->view = new LoginView();
        $this->productView = new ProductView();
    }

    function register(){
        $this->view->showRegister();
    }

    function login(){
        $this->view->showLogin();
    }

    function verifyLogin(){
        if(!empty($_POST['user']) && !empty($_POST['password'])){
            $user = $_POST['user'];
            $password = $_POST['password'];

            $userLog = $this->model->getUser($user);

            if ($userLog && password_verify($password, $userLog->password) ) {
                
                session_start();
                $_SESSION['username'] = $userLog->username;
                $_SESSION['permisoDeAdmin'] = $userLog->admin; //guardo en la sesion si soy admin 

                $this->view->showHome();
            }else{
                $this->view->showLogin('Acceso Denegado');
            }
        }else{
            $this->view->showLogin('Debe Ingresar sus Datos para Loguearse o Registrarse');
        }
    }
    
    function userRegister(){

        if(!empty($_POST['user']) && !empty($_POST['password'])){
            $user = $_POST['user'];
            $password = $_POST['password'];
            //inicio sesion.
            session_start();
            
            $_SESSION['username'] = $user;
            $_SESSION['permisoDeAdmin'] = 0;
            $this->model->setUser($user,password_hash($password, PASSWORD_BCRYPT));
            
            $this->view->showHome();
            }else{
                $this->view->message('Debe Ingresar sus Datos');
            }
        }
    
    function checkLoggedIn(){
        session_start();

        if(!isset($_SESSION["username"])){
            //$this->view->showLoginLocation();
            return false;
        }
        return true;
    }

    function deleteUser($userName){
        $this->checkLoggedIn();
        $this->model->deleteUserFromDB($userName);
        $this->view->showLogin('Se elimino con exito el Usuario!');
        $this->productView->showHomeLocation();
    }

    function usersView(){
        $this->checkLoggedIn();
        $this->view->showUsers($this->model->getUsers());
    }

    function reasignLevel($user){
        $this->checkLoggedIn();
        $this->model->reasignLevelUserFromDB($user, $_POST['levels']);
        $this->view->message('Nivel de Acceso de usuario Modificado con Exito!');
    }

    function logout(){
        if($this->checkLoggedIn()){
        session_destroy();
        $this->view->showLogin('Se ha deslogueado con exito!');
        }else{
            $this->productView->showHomeLocation();
        }

    }
    function getSession(){
        if(isset($_SESSION["username"]))
            return $_SESSION["username"];
        else
            return "";
    }
}