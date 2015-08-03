<?php

if (!defined('BASEPATH')) 
{    
    exit('No direct script access allowed');
}

class MY_Controller extends MX_Controller {

    var $data;
    
    function __construct() {
        parent::__construct();

        $this->data['nome_sistema'] = "TELLKS";     
    }
    
    
    function _response($status, $arr = array()) {
        
        $response = array('result' => $status);
        if (is_array($arr)) {
            $response = array_merge($response, $arr);
        } else { // assume que é uma mensagem
            $response['message'] = $arr;
        }

        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($response));
    }
}