<?php

if (!defined('BASEPATH')) 
{
    exit('No direct script access allowed');
}

class Generos_model extends CI_Model {
    
    var $id;
    var $nome_genero;
    var $excluido;
    var $data_cadastro;
    var $data_alteracao;
    var $data_exclusao;
    
    function cadastrar($post)
    {
        $genero = Generos_model::genero($post, 'cadastrar');
        
        if ($this->db->insert('generos', $genero))
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
        $genero = Generos_model::genero($post, 'editar');
        
        $this->db->where('id', $genero->id);
        
        if ($this->db->update('generos', $genero))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    function listar_generos($limite = 5, $inicio = 0)
    {
        $query = $this->db->select('*')	
                    //->order_by('a.nome_genero asc')
                    ->where('a.excluido', false)
                    ->limit($limite, $inicio)
                    ->get('generos AS a');		
            return $query->result();
    }
    
    function generos_total()
    {
        $this->db->where('excluido', 0);
        return $this->db->count_all_results('generos');
    }
        
    function busca_pelo_id($id)
    {
       $query = $this->db->select('*')	
                    ->where('id', $id)
                    ->get('generos AS a');		
        
        return $query->row(); 
    }
    
    function remover($id)
    {
        $genero = $this->busca_pelo_id($id);
        
        if($genero)
        {
            $genero_remover = Generos_model::genero($genero, 'remover');

            $this->db->where('id', $genero_remover->id);

            if ($this->db->update('generos', $genero_remover))
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
    
    function select_generos()
    {
        $query = $this->db->where('g.excluido', false) 
                          ->get('generos AS g');
		
                $select = array(
				0 => ' Selecione um gênero'
		);		
		foreach ($query->result() as $genero) {
			$select[$genero->id] = $genero->nome_genero;
		}		
		return $select;
    }

    
    function genero($post, $acao)
    {
        $genero = new Generos_model();
               
        if($acao == 'cadastrar')
        {
            $genero->nome_genero = $post['nome_genero'];
            $genero->excluido = 0;
            $genero->data_cadastro = date('Y-m-d H:i:s', time());
            $genero->data_alteracao = date('Y-m-d H:i:s', time());
        }
        else if($acao == 'editar')
        {
            $genero->nome_genero = $post['nome_genero'];
            $genero->id = $post['id'];
            $genero->excluido = 0;
            $genero->data_cadastro = $post['data_cadastro'];
            $genero->data_alteracao = date('Y-m-d H:i:s', time());
        }
        else if ($acao == 'remover') // Remoção lógica
        {
            $genero->id = $post->id;
            $genero->nome_genero = $post->nome_genero;
            $genero->data_cadastro = $post->data_cadastro;
            $genero->data_alteracao = $post->data_alteracao;
            $genero->data_exclusao = date('Y-m-d H:i:s', time());
            $genero->excluido = 1;
        }
        //var_dump($genero);  
        return $genero;
    }
    
    
}
