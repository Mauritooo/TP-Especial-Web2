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
                
                $this->view->showHome();
            }else{
                $this->view->showLogin('Acceso Denegado');
            }
        }
    }
    
    function userRegister(){

        if(!empty($_POST['user']) && !empty($_POST['password'])){
            $user = $_POST['user'];
            $password = $_POST['password'];

            $this->model->setUser($user,password_hash($password, PASSWORD_BCRYPT));
            
            $this->view->showLogin('Usuario Registrado con exito!');
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
        session_start();
        session_destroy();
        $this->view->showLogin('Se ha deslogueado con exito!');
    }
}