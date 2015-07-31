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
    
    public function get_offset($page, $show) {
        return ($page - 1) * $show;
    }

    public function get_show_number() {
        return ($this->input->get('show')) ? $this->input->get('show') : 5;
    }
}