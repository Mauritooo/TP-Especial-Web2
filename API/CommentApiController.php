<?php

require_once 'ApiController.php';
require_once './model/ProductModel.php';

class TaskApiController extends ApiController {

    public function __construct() {

        parent::__construct();
        $this->model = new ProductModel();
    }

    public function getComments($params = []) {

        if (empty($params)) {
            $comment = $this->model->getComments();
            $this->view->response($comment, 200);
        }
        else {
            $comment_id = $params[':ID'];
            $comment = $this->model->getComment($comment_id);
            if ($comment)
                $this->view->response($comment, 200);
            else // si no existe el comentario
                $this->view->response("comment id=$comment_id not found", 404);
        }
    }

    public function deleteComment($params = []) {
        
        $comment_id = $params[':ID'];
        $comment = $this->model->getComment($comment_id);

        if ($comment) {
            $this->model->deleteComment($comment_id);
            $this->view->response("Comentario id=$comment_id eliminado con éxito", 200);
        }
        else 
            $this->view->response("Comment id=$comment_id not found", 404);
    }

    public function saveComment($params = []) {
        $body = $this->getData();
        $titulo = $body->titulo;
        $descripcion = $body->descripcion;
        
        //inserta la comment y la busca
        $idComment = $this->model->saveComment($titulo, $descripcion);
        $comment = $this->model->getComment($idComment);

        if ($comment)
            $this->view->response($comment, 200);
        else
            $this->view->response("Error al guardar", 500);
    }
/*
    public function editComment($params = []) {
        $comment_id = $params[':ID'];
        $comment = $this->model->getComment($comment_id);

        if ($comment) {
            $body = $this->getData();
            $finalizada = $body->finalizada;
            if ($finalizada == 1) {
                $this->model->endTask($comment_id);
                $comment = $this->model->getComment($comment_id);
                $this->view->response($comment, 200);
            }
        } else
            $this->view->response("comment id=$comment_id not found", 404);
    }
*/
}