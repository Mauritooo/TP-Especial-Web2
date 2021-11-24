<?php

require_once 'API/View/ApiView.php';

abstract class ApiController {

    protected $model;
    protected $view;

    private $raw_data;
//------------------------------------------------------------------
    public function __construct() {
        $this->view = new ApiView();
        $this->raw_data = file_get_contents("php://input"); //agarra el body en RAW
    }
//------------------------------------------------------------------
    protected function getData() {
        //LEVANTA EL STRING PASADO EN EL BODY CUANDO LLAMO A LA Api.
        return json_decode($this->raw_data);    //convierte el String recibido a JSON
    }
}