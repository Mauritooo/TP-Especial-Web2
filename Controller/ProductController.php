<?php

require_once "./Model/ProductModel.php";
require_once "./View/ProductView.php";
require_once "./Controller/LoginController.php";

class ProductController{

    private $model;
    private $view;
    private $controller;

    function __construct()
    {
        $this->model = new ProductModel();  
        $this->view = new ProductView();
        $this->controller = new LoginController();
    }

    function showHome(){

        $logueado = $this->checkLoggedIn();  

        $productosConCategoria = $this->model->getProductsWithCategory();
        if($logueado){
            $this->view->showProductsABM($productosConCategoria,$this->controller->getSession());
        }else{
            $this->view->showProducts($productosConCategoria,$this->controller->getSession());
        }
    }

    function createProduct(){
        if($this->checkLoggedIn()){
            if(!empty($_REQUEST['nombre']) && !empty($_REQUEST['descripcion']) && !empty($_REQUEST['precio']) && !empty($_REQUEST['categoria']) && !empty($_REQUEST['image'])){
                $this->model->setProduct($_REQUEST['nombre'], $_REQUEST['descripcion'], $_REQUEST['precio'], $_REQUEST['categoria'], $_REQUEST['image']);
            }
        }
        $this->view->showHomeLocation();
        
    }

    function showMessage($error = null){
        $this->view->message($error);
    }
    function deleteProduct($id){
        $this->checkLoggedIn();

        $this->model->deleteProductoFromDB($id);
        $this->view->showHomeLocation();
    }

    function updateProduct(){ 
        $this->checkLoggedIn();
    
        $this->model->updateProductFromDB($_POST['id'],$_POST['newName'],$_POST['newDescription'],$_POST['newPrice'],$_POST['newImage']);    
        $this->view->showHomeLocation();
    }

    function viewProduct($id){
        $this->checkLoggedIn();
        $producto = $this->model->getProductFromDB($id);
        //
        $this->view->showProduct($producto);
    }

    function checkLoggedIn(){
        session_start();

        if(!isset($_SESSION["username"])){
            //$this->view->showLoginLocation();
            return false;
        }
        return true;
    }
}