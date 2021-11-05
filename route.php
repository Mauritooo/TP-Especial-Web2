<?php
require_once "./Controller/ProductController.php";
require_once "./Controller/LoginController.php";
require_once "./Controller/CategoryController.php";


define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT']//define define una CONSTANTE.
        . dirname($_SERVER['PHP_SELF']).'/');


// lee la acción
if (!empty($_GET['accion'])) {
    $accion = $_GET['accion'];
} else {
    $accion = 'home';
}

$params = explode('/', $accion);

$productController = new ProductController();
$loginController = new LoginController();
$categoryController = new CategoryController();

switch ($params[0]) {
    case 'home': 
        $productController->showHome();
        break;
    case 'login': 
        $loginController->login(); 
        break;
    case 'verifyLogin': 
        $loginController->verifyLogin(); 
        break;
    case 'logout': 
        $loginController->logout(); 
        break;            
    //case 'register':
        //$loginController->register(); //usar solo para agregar usuarios
       // break;
    case 'userRegister':
        $loginController->userRegister();
        break;
    case 'createProduct': 
        $productController->createProduct(); 
        break;
    case 'deleteProduct': 
        $productController->deleteProduct($params[1]); 
        break;
    case 'updateProduct': 
        $productController->updateProduct();
            break;
    case 'viewProduct': 
        $productController->viewProduct($params[1]);
        break;
    case 'viewCategory': 
        $categoryController->viewCategory($params[1]);
        break;
    case 'viewCategories': 
        $categoryController->viewCategories();
        break;
    
    default: 
        $productController->pageNotFound('Error 404 - Page Not Found'); 
        break;
}
?>