<?php

require_once './libs/smarty-3.1.39/libs/Smarty.class.php';

class ProductView{

    private $smarty;
    
    function __construct(){
        $this->smarty = new Smarty();
    }

    function showProducts($productosConCategoria,$usuario=""){
        $this->smarty->assign('usuario',$usuario);
        $this->smarty->assign('titulo','Lista de Productos');
        $this->smarty->assign('productosConCategoria',$productosConCategoria);
        $this->smarty->display('templates/Products/products.tpl');
    }//product
    
    function showProductsABM($productosConCategoria,$usuario=""){
        $this->smarty->assign('usuario',$usuario);
        $this->smarty->assign('titulo','Lista de Productos para Administrador');
        $this->smarty->assign('productosConCategoria',$productosConCategoria);
        $this->smarty->display('templates/Products/productsABM.tpl');
    }

    function message($error){
        $this->smarty->assign('error',$error);
        $this->smarty->display('templates/message.tpl');
    }
    function showProduct($producto, $usuario){
        $this->smarty->assign('producto',$producto);
        $this->smarty->assign('usuario',$usuario);
        $this->smarty->display('templates/Products/productView.tpl');
    }

    public function showHomeLocation(){
        header("Location: ".BASE_URL."home");
    }

    function showLoginLocation(){
        header("Location: ".BASE_URL."login");
    }
}