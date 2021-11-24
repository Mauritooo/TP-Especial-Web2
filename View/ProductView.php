<?php

require_once './libs/smarty-3.1.39/libs/Smarty.class.php';

class ProductView{

    private $smarty;
//------------------------------------------------------------------
    function __construct(){
        $this->smarty = new Smarty();
    }
//------------------------------------------------------------------
    function showProducts($productosConCategoria,$usuario=""){
        //RENDERIZA TODOS LOS PRODUCTOS.
        $this->smarty->assign('usuario',$usuario);
        $this->smarty->assign('titulo','Lista de Productos');
        $this->smarty->assign('productosConCategoria',$productosConCategoria);
        $this->smarty->display('templates/Products/products.tpl');
    }
//------------------------------------------------------------------
    function showProductsABM($productosConCategoria,$usuario=""){
        //RENDERIZA TODOS LOS PRODUCTOS PERO CON FUNCIONES ESPECIALES PARA EL ADMINISTRADOR
        $this->smarty->assign('usuario',$usuario);
        $this->smarty->assign('titulo','Lista de Productos para Administrador');
        $this->smarty->assign('productosConCategoria',$productosConCategoria);
        $this->smarty->display('templates/Products/productsABM.tpl');
    }
//------------------------------------------------------------------
    function message($error){
        //RENDERIZA UN MENSAJE.
        $this->smarty->assign('error',$error);
        $this->smarty->display('templates/message.tpl');
    }
//------------------------------------------------------------------
    function showProduct($producto, $usuario){
        //RENDERIZA UN PRODUCTO PASADO POR PARAMETRO
        $this->smarty->assign('producto',$producto);
        $this->smarty->assign('usuario',$usuario);
        $this->smarty->display('templates/Products/productView.tpl');
    }
//------------------------------------------------------------------
    public function showHomeLocation(){
        //REDIRIGE A LA PANTALLA DE INICIO
        header("Location: ".BASE_URL."home");
    }
//------------------------------------------------------------------
    function showLoginLocation(){
        //REDIRIGE A LA PANTALLA DEL LOGIN
        header("Location: ".BASE_URL."login");
    }
}