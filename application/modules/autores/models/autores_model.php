<?php

if (!defined('BASEPATH')) 
{
    exit('No direct script access allowed');
}

class Autores_model extends CI_Model {
    
    var $id;
    var $nome_autor;
    var $excluido;
    var $data_cadastro;
    var $data_alteracao;
    var $data_exclusao;
    
    function cadastrar($post)
    {
        $autor = Autores_model::autor($post, 'cadastrar');
        
        if ($this->db->insert('autores', $autor))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    function editar($post)
    {
        $autor = Autores_model::autor($post, 'editar');
        
        $this->db->where('id', $autor->id);
        
        if ($this->db->update('autores', $autor))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    function listar_autores($limite = 5, $inicio = 0)
    {
        $query = $this->db->select('*')	
                    //->order_by('a.nome_autor asc')
                    ->where('a.excluido', false)
                    ->limit($limite, $inicio)
                    ->get('autores AS a');		
            return $query->result();
    }
    
    function autores_total()
    {
        $this->db->where('excluido', 0);
        return $this->db->count_all_results('autores');
    }
        
    function busca_pelo_id($id)
    {
       $query = $this->db->select('*')	
                    ->where('id', $id)
                    ->get('autores AS a');		
        
        return $query->row(); 
    }
    
    function remover($id)
    {
        $autor = $this->busca_pelo_id($id);
        
        if($autor)
        {
            $autor_remover = Autores_model::autor($autor, 'remover');

            $this->db->where('id', $autor_remover->id);

            if ($this->db->update('autores', $autor_remover))
            {
                return true;
            }
            else
            {
                return false;
            }        
        }
        else
        {
            return false;
        }
    }
    
    function autor($post, $acao)
    {
        $autor = new Autores_model();
               
        if($acao == 'cadastrar')
        {
            $autor->nome_autor = $post['nome_autor'];
            $autor->excluido = 0;
            $autor->data_cadastro = date('Y-m-d H:i:s', time());
            $autor->data_alteracao = date('Y-m-d H:i:s', time());
        }
        else if($acao == 'editar')
        {
            $autor->nome_autor = $post['nome_autor'];
            $autor->id = $post['id'];
            $autor->excluido = 0;
            $autor->data_cadastro = $post['data_cadastro'];
            $autor->data_alteracao = date('Y-m-d H:i:s', time());
        }
        else if ($acao == 'remover') // Remoção lógica
        {
            $autor->id = $post->id;
            $autor->nome_autor = $post->nome_autor;
            $autor->data_cadastro = $post->data_cadastro;
            $autor->data_alteracao = $post->data_alteracao;
            $autor->data_exclusao = date('Y-m-d H:i:s', time());
            $autor->excluido = 1;
        }
        //var_dump($autor);  
        return $autor;
    }
    
    
}
