<?php

require_once 'ApiController.php';
require_once 'API/View/ApiView.php';
require_once './model/CommentModel.php';
require_once './controller/LoginController.php';


class CommentApiController extends ApiController {
//------------------------------------------------------------------
    public function __construct() {

        $this->controller = new LoginController();
        
        parent::__construct();
        $this->model = new CommentModel();
        
    }
//--------------------------------------------------------------
    public function getComments($params = []) {
        //LEVANTA TODOS LOS COMENTARIOS CUYO id DE PRODUCTO ES PASADO POR PARAMETRO
        if (empty($params)) {
            $comment = $this->model->getAllComments();
            $this->view->response($comment, 200);
        }
        else {
            $id_producto = $params[':ID'];
            $comment = $this->model->getComments($id_producto);
            if ($comment)
                $this->view->response($comment, 200);
            else 
                $this->view->response("comment id=$id_producto not found", 404);
        }
    }
//--------------------------------------------------------------
    public function deleteComment($params = []) {
        //ELIMINA UN COMENTARIO CUYO id ES PASADO POR PARAMETRO
        $comment_id = $params[':ID'];  
        $comment = $this->model->getComment($comment_id);

        if($this->controller->checkloggedIn()&& $_SESSION['permisoDeAdmin'] == 1){
            
            if ($comment) {
                $this->model->deleteComment($comment_id);
                $this->view->response("Comentario id=$comment_id eliminado con exito", 200);
            }
            else 
                $this->view->response("Comentario id=$comment_id no encontrado", 404);
        }       
        else
            $this->view->response(" Usted no tiene permisos para realizar esta operacion", 403);
        
    }
//--------------------------------------------------------------
    public function addComment() {//FUNCIONA BIEN.
        //AGREGA UN COMENTARIO
        $body = $this->getData();   

        $comentario = $body->comentario;
        $id_producto = $body->id_producto;
        $calificacion = ($body->calificacion);

        if($this->controller->checkloggedIn()){
            //verifica si es un usuario logueado. si no es asi no puede comentar.
            $id_Comment = $this->model->addComment($_SESSION["id_usuario"], $comentario, $id_producto, $calificacion);
            $comment = $this->model->getComment($id_Comment);
            if ($comment)
                $this->view->response($comment, 200);
                
        }else
            $this->view->response("logue su usario para poder comentar",401);
        
    }
//----------------------------------------------------------------
    function message($error){
        //RENDERIZA UN MENSAJE.
        $this->smarty->assign('error',$error);
        $this->smarty->display('templates/message.tpl');
    }
}