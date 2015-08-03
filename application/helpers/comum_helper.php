<?php

function formatar_data($date, $second = FALSE)
{
    if ($date == '0000-00-00 00:00:00' || $date == '')
    {
        return '';
    }

    $exploded = explode(' ', $date);
    return ($second ? ' - ' : '') . join('/', array_reverse(explode('-', $exploded[0])));
}

function mensagemStatusOperacao($texto, $tipo)
{
    $CI = &get_instance();
    
    if($tipo == 'success')
    {
        $class = "<div class='alert alert-success'>";
    }
    else if ($tipo == 'info')
    {
        $class = "<div class='alert alert-info'>";
    }
    else if ($tipo == 'warning')
    {
        $class = "<div class='alert alert-warning'>";
    }
    else if ($tipo == 'danger')
    {
        $class = "<div class='alert alert-danger'>";
    }
    
    $CI->session->set_flashdata('mensagem', $class . $texto . "</div>");
    //$this->session->set_flashdata('mensagem',"<div class='alert alert-success'>" . $texto . "</div>");
}


