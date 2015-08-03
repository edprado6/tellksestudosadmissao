<?php

if (!defined('BASEPATH')) 
{
    exit('No direct script access allowed');
}

class Editoras_model extends CI_Model {
    
    var $id;
    var $nome_editora;
    var $excluido;
    var $data_cadastro;
    var $data_alteracao;
    var $data_exclusao;
    
    function cadastrar($post)
    {
        $editora = Editoras_model::editora($post, 'cadastrar');
        
        if ($this->db->insert('editoras', $editora))
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
        $editora = Editoras_model::editora($post, 'editar');
        
        $this->db->where('id', $editora->id);
        
        if ($this->db->update('editoras', $editora))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    function listar_editoras($limite = 5, $inicio = 0)
    {
        $query = $this->db->select('*')	
                    //->order_by('a.nome_editora asc')
                    ->where('a.excluido', false)
                    ->limit($limite, $inicio)
                    ->get('editoras AS a');		
            return $query->result();
    }
    
    function editoras_total()
    {
        $this->db->where('excluido', 0);
        return $this->db->count_all_results('editoras');
    }
        
    function busca_pelo_id($id)
    {
       $query = $this->db->select('*')	
                    ->where('id', $id)
                    ->get('editoras AS a');		
        
        return $query->row(); 
    }
    
    function remover($id)
    {
        $editora = $this->busca_pelo_id($id);
        
        if($editora)
        {
            $editora_remover = Editoras_model::editora($editora, 'remover');

            $this->db->where('id', $editora_remover->id);

            if ($this->db->update('editoras', $editora_remover))
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
    
    function editoras_por_termo($termo)
    {
        $query = $this->db->select('a.id', 'a.nome_editora') 
                    ->like('a.nome_editora', $termo)
                    ->where('a.excluido', false)                    
                    ->get('editoras AS a');		
            return $query->result();
    }
    
    function select_editoras()
    {
        $query = $this->db->where('e.excluido', false)  
                          ->get('editoras AS e');
        
		$select = array(
				0 => ' Selecione uma editora'
		);		
		foreach ($query->result() as $editora) {
			$select[$editora->id] = $editora->nome_editora;
		}		
		return $select;
    }
    
    
    function editora($post, $acao)
    {
        $editora = new Editoras_model();
               
        if($acao == 'cadastrar')
        {
            $editora->nome_editora = $post['nome_editora'];
            $editora->excluido = 0;
            $editora->data_cadastro = date('Y-m-d H:i:s', time());
            $editora->data_alteracao = date('Y-m-d H:i:s', time());
        }
        else if($acao == 'editar')
        {
            $editora->nome_editora = $post['nome_editora'];
            $editora->id = $post['id'];
            $editora->excluido = 0;
            $editora->data_cadastro = $post['data_cadastro'];
            $editora->data_alteracao = date('Y-m-d H:i:s', time());
        }
        else if ($acao == 'remover') // Remoção lógica
        {
            $editora->id = $post->id;
            $editora->nome_editora = $post->nome_editora;
            $editora->data_cadastro = $post->data_cadastro;
            $editora->data_alteracao = $post->data_alteracao;
            $editora->data_exclusao = date('Y-m-d H:i:s', time());
            $editora->excluido = 1;
        }
        //var_dump($editora);  
        return $editora;
    }
    
    
}
