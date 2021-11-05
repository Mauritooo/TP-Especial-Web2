<?php

require_once './libs/smarty-3.1.39/libs/Smarty.class.php';

class ProductView{

    private $smarty;
    
    function __construct(){
        $this->smarty = new Smarty();
    }

    function showProducts($productosConCategoria){
        $this->smarty->assign('titulo','Lista de Productos');
        $this->smarty->assign('productosConCategoria',$productosConCategoria);
        $this->smarty->display('templates/product.tpl');
    }//product
    
    function showProductsABM($productosConCategoria){
        $this->smarty->assign('titulo','Lista de Productos para Administrador');
        $this->smarty->assign('productosConCategoria',$productosConCategoria);
        $this->smarty->display('templates/productABM.tpl');
    }

    function notFound($error){
        $this->smarty->assign('error',$error);
        $this->smarty->display('templates/notFound.tpl');
    }
    function showProduct($producto){
        $this->smarty->assign('producto',$producto);
        $this->smarty->display('templates/productView.tpl');
    }

    function showHomeLocation(){
        header("Location: ".BASE_URL."home");
    }

    function showLoginLocation(){
        header("Location: ".BASE_URL."login");
    }
}