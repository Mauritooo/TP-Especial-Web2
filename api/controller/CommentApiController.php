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
        //LEVANTA TODOS LOS COMENTARIOS CUYO id DE PRODCUTO ES PASADO POR PARAMETRO
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

        $esAdmin = $this->controller->getUserBySession();

        if ($comment) {
            $this->model->deleteComment($comment_id);
            $this->view->response("Comentario id=$comment_id eliminado con éxito", 200);
        }
        else 
            $this->view->response("Comment id=$comment_id not found", 404);
    }
//--------------------------------------------------------------
    public function addComment() {
        //AGREGA UN COMENTARIO
        $body = $this->getData();   

        $comentario = $body->comentario;
        $id_usuario = $body->id_usuario;  
        $id_producto = $body->id_producto;
        $calificacion = ($body->calificacion);

        $id_Comment = $this->model->addComment($id_usuario, $comentario, $id_producto, $calificacion);
        $comment = $this->model->getComment($id_Comment);

        if ($comment)
            $this->view->response($comment, 200);
        else
            $this->view->response("Error al guardar", 500);
    }
//----------------------------------------------------------------
    public function updateComment($params = []) {
        //FUNCION DE ACTUALIZAR COMENTARIO. {no solicitado en la entrega del TPE}
        $comment_id = $params[':ID'];
        $comment = $this->model->getComment($comment_id);

        if ($comment) {
            $body = $this->getData();
            $id_comentario = $body->comentario; 
            $comentario = $body->comentario;
            
                $this->model->updateComment($id_comentario, $comentario);
                $comment = $this->model->getComment($comment_id);
                $this->view->response($comment, 200);
        }
            else
            $this->view->response("comment id=$comment_id not found", 404);
    }

}