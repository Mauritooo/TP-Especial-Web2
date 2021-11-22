<?php

class JSONView {

    public function response($data, $status) {//(DATOS Y EL CODIGO DE STATUS)
        header("Content-Type: application/json");
        header("HTTP/1.1 " . $status . " " . $this->_requestStatus($status));
        echo json_encode($data);//transforma la data en un json
    }

    private function _requestStatus($code){
      //RETORNA UN MENSAJE SENGUN EL CODIGO DE STATUS QUE RECIBE
        $status = array(
          200 => "OK",
          404 => "Not found",
          500 => "Internal Server Error"
        );
        return ($status[$code])? $status[$code] : $status[500];
      }
  

}