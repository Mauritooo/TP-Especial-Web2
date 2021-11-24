<?php

require_once "./Model/CategoryModel.php";
require_once "./View/CategoryView.php";

class CategoryController{

    private $model;
    private $view;
//------------------------------------------------------------------
    function __construct(){
        $this->model = new CategoryModel();  
        $this->view = new CategoryView();
    }
//------------------------------------------------------------------
    function viewCategory($id){
        //OBTIENE Y MUESTRA TODOS LOS PRODUCTOS DE UNA CATEGORIA
        $categoriaDeProductos = $this->model->getCategoryFromDB($id);
        $this->view->showCategory($categoriaDeProductos);
    }
//------------------------------------------------------------------
    function viewCategories(){
        //OBTIENE Y MUESTRA TODAS LAS CATEGORIAS.
        $categorias = $this->model->getCategories();
        $this->view->showCategories($categorias);
    }
}