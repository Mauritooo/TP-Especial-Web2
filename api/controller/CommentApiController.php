<?php

require_once 'ApiController.php';
require_once 'API/View/JSONView.php';
require_once './model/ProductModel.php';

class CommentApiController extends ApiController {

    public function __construct() {

        parent::__construct();
        $this->model = new ProductModel();
    }
//--------------------------------------------------------------
    public function getComments($params = []) {
        //RETORNA TODOS LOS COMENTARIOS SI EL PARAMETRO NO ESTA INGRESADO O 
        //RETORNA LOS COMENTARIOS QUE ESTEN VINCULADOS A UN PRODUCTO si el parametro esta.
        if (empty($params)) {
            $comment = $this->model->getAllComments();
            $this->view->response($comment, 200);
        }
        else {
            $id_producto = $params[':ID'];
            $comment = $this->model->getComments($id_producto);
            if ($comment)
                $this->view->response($comment, 200);
            else // si no existe el comentario
                $this->view->response("comment id=$id_producto not found", 404);
        }
    }
//--------------------------------------------------------------
    public function deleteComment($params = []) {
        
        $comment_id = $params[':ID'];   //es necesario??
        $comment = $this->model->getComment($comment_id);//es necesario??

        if ($comment) {
            $this->model->deleteComment($comment_id);
            $this->view->response("Comentario id=$comment_id eliminado con éxito", 200);
        }
        else 
            $this->view->response("Comment id=$comment_id not found", 404);
    }
//--------------------------------------------------------------
    public function addComment($params = []) {
        $body = $this->getData();   //como se usa?

        $comentario = $body->comentario;
        $id_usuario = $body->id_usuario;    //aun no implementado
        $id_producto = $body->id_producto;
        $calificacion = $body->calificacion;

        //inserta la comment y la busca
        $id_Comment = $this->model->addComment($id_usuario, $comentario, $id_producto, $calificacion);
        $comment = $this->model->getComment($id_Comment);

        if ($comment)
            $this->view->response($comment, 200);
        else
            $this->view->response("Error al guardar", 500);
    }
//----------------------------------------------------------------
    public function updateComment($params = []) {
        
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