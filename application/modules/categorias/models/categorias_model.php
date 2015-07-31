<?php

if (!defined('BASEPATH')) 
{
    exit('No direct script access allowed');
}

class Categorias_model extends CI_Model {
    
    var $id;
    var $nome_categoria;
    var $excluido;
    var $data_cadastro;
    var $data_alteracao;
    var $data_exclusao;
    
    function cadastrar($post)
    {
        $categoria = Categorias_model::categoria($post, 'cadastrar');
        
        if ($this->db->insert('categorias', $categoria))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    function listar_categorias($limite = 5, $inicio = 0)
    {
        $query = $this->db->select("*")	
                    //->order_by("c.nome asc")
                    ->limit($limite, $inicio)
            ->get('categorias AS c');		
            return $query->result();
    }
    
    function categorias_total()
    {
        return $this->db->count_all_results('categorias');
    }
            
    function categoria($post, $acao)
    {
        $categoria = new Categorias_model();
        $categoria->nome_categoria = $post['nome_categoria'];
        
        if($acao == 'cadastrar')
        {
            $categoria->data_cadastro = date('Y-m-d H:i:s', time());
            $categoria->data_alteracao = date('Y-m-d H:i:s', time());
        }
        else if($acao == 'editar')
        {
            $categoria->data_alteracao = date('Y-m-d H:i:s', time());
        }
        else if ($acao == 'remover') // Remoção lógica
        {
            $categoria->data_exclusao = date('Y-m-d H:i:s', time());
            $categoria->excluido = 1;
        }
          
        return $categoria;
    }
    
    
}
