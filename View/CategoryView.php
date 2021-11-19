<?php

require_once './libs/smarty-3.1.39/libs/Smarty.class.php';

class CategoryView{

    private $smarty;
    
    function __construct(){
        $this->smarty = new Smarty();
    }

    function showCategory($categoriaDeProductos){
        //muestra todos los productos de una categoria pasada por parametro el cual es un arreglo
        $this->smarty->assign('titulo', 'Productos de la Categoria');
        $this->smarty->assign('categoria',$categoriaDeProductos);
        //var_dump($categoriaDeProductos);
        $this->smarty->display('templates/Categories/categoryView.tpl');//
    }

    function showCategories($categorias){
        //muestra todos los productos de una categoria pasada por parametro
        $this->smarty->assign('titulo', 'Lista de Categorias');
        $this->smarty->assign('categorias',$categorias);
        $this->smarty->display('templates/Categories/categories.tpl');
    }

}