<?php

require_once "./Model/ProductModel.php";
require_once "./View/ProductView.php";
require_once "./Controller/LoginController.php";

class ProductController{

    private $model;
    private $view;
    private $controller;
//------------------------------------------------------------------
    function __construct(){
        $this->model = new ProductModel();  
        $this->view = new ProductView();
        $this->controller = new LoginController();
    }
//------------------------------------------------------------------
    function showHome(){
        //MUESTRA LA PAGINA PRINCIPAL SEGUN EL ROL DEL USUARIO REGISTRADO
        $logueado = $this->controller->checkLoggedIn();  
        $productosConCategoria = $this->model->getProductsWithCategory();
        $usuario = $this->controller->getUserBySession();
        if($logueado){
            $this->view->showProductsABM($productosConCategoria,$usuario);
        }else{
            $this->view->showProducts($productosConCategoria,$usuario);
        }
    }
//------------------------------------------------------------------
    function createProduct(){
        //LEVANTA LOS DATOS QUE SERAN USADOS PARA AGREGAR UN PRODUCTO Y LOS ENVIA A LA DB.
        if($this->controller->checkLoggedIn()){
            if(!empty($_REQUEST['nombre']) && !empty($_REQUEST['descripcion']) && !empty($_REQUEST['precio']) && !empty($_REQUEST['categoria']) || !empty($_REQUEST['image'])){
                if(isset($_REQUEST['image']))
                    $this->model->setProduct($_REQUEST['nombre'], $_REQUEST['descripcion'], $_REQUEST['precio'], $_REQUEST['categoria'], $_REQUEST['image']);
                else
                $this->model->setProduct($_REQUEST['nombre'], $_REQUEST['descripcion'], $_REQUEST['precio'], $_REQUEST['categoria'], "");
            }
        }
        $this->view->showHomeLocation();
        
    }
//------------------------------------------------------------------
    function showMessage($error = null){
        //MUESTRA UN MENSAJE PASADO POR PARAMETRO
        $this->view->message($error);
    }
//------------------------------------------------------------------
    function deleteProduct($id){
        //ELIMINAR UN PRODUCTO CUYO id ES PASADO POR PARAMETRO.
        $this->controller->checkLoggedIn();

        $this->model->deleteProductoFromDB($id);
        $this->view->showHomeLocation();
    }
//------------------------------------------------------------------
    function updateProduct(){ 
        //ACTUALIZAR EL VALOR DE UN PRODUCTO
        $this->controller->checkLoggedIn();
    
        $this->model->updateProductFromDB($_POST['id'],$_POST['newName'],$_POST['newDescription'],$_POST['newPrice'],$_POST['newImage']);    
        $this->view->showHomeLocation();
    }
//------------------------------------------------------------------
    function viewProduct($id){
        //MUESTRA UN PRODUCTO CUYO id ES PASADO POR PARAMETRO
        $this->controller->checkLoggedIn();
        $producto = $this->model->getProductFromDB($id);
        $usuario = $this->controller->getUserBySession();
        if($producto)
            $this->view->showProduct($producto,$usuario);
        else
            $this->view->message('NO EXISTE EL PRODUCTO!');
    }

}