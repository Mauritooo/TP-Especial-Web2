<?php

require_once "./Model/ProductModel.php";
require_once "./View/ProductView.php";

class ProductController{

    private $model;
    private $view;

    function __construct()
    {
        $this->model = new ProductModel();  
        $this->view = new ProductView();
    }

    function showHome(){

        $logueado = $this->checkLoggedIn();  

        $productosConCategoria = $this->model->getProductsWithCategory();
        if($logueado){
            $this->view->showProductsABM($productosConCategoria);
        }else{
            $this->view->showProducts($productosConCategoria);
        }
    }

    function createProduct(){
        $this->checkLoggedIn();
        if(!empty($_REQUEST['nombre']) && !empty($_REQUEST['descripcion']) && !empty($_REQUEST['precio']) && !empty($_REQUEST['categoria']) && !empty($_REQUEST['image'])){
            $this->model->setProduct($_REQUEST['nombre'], $_REQUEST['descripcion'], $_REQUEST['precio'], $_REQUEST['categoria'], $_REQUEST['image']);
        }
        $this->view->showHomeLocation();
        
    }

    function pageNotFound($error = null){
        $this->view->notFound($error);
    }
    function deleteProduct($id){
        $this->checkLoggedIn();

        $this->model->deleteProductoFromDB($id);
        $this->view->showHomeLocation();
    }

    function updateProduct(){ 
        $this->checkLoggedIn();

        $this->model->updateProductFromDB($_POST['newName'],$_POST['newDescription'],$_POST['newPrice'],$_POST['id'],$_POST['newImage']);    
        $this->view->showHomeLocation();
    }

    function viewProduct($id){
        $this->checkLoggedIn();
        
        $producto = $this->model->getProductFromDB($id);
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