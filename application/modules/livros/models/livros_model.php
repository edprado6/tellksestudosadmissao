<?php

if (!defined('BASEPATH')) 
{
    exit('No direct script access allowed');
}

class Livros_model extends CI_Model {
    
    var $id;
    var $nome_livro;
    var $edicao;
    var $quantidade_exemplares;
    var $excluido;
    var $data_cadastro;
    var $data_alteracao;
    var $data_exclusao;
    var $generos_id;
    var $editoras_id;
    
    function __construct() 
    {
        $this->load->model('livros_autores/livros_autores_model');   
        
        parent::__construct();
    }
    
    
    function cadastrar($post)
    {
        $livro = Livros_model::livro($post, 'cadastrar');
        
        $this->db->insert('livros', $livro);
        $livro_id = $this->db->insert_id();
        
        if($livro_id)
        {
            $autores = $post['autores'];        
            $this->load->model('livros_autores_model');
            $this->livros_autores_model->cadastrar($livro_id, $autores);
            return TRUE;
        }
        else 
        {
             return FALSE;
        }
        
    }
    
    function editar($post)
    {
        var_dump($post);
        $livro = Livros_model::livro($post, 'editar');
        
        $autores = $post['autores'];        
        $this->livros_autores_model->cadastrar($livro->id, $autores);        
        $this->db->where('id', $livro->id);        
        if ($this->db->update('livros', $livro))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    function listar_livros($limite = 5, $inicio = 0)
    {
        $query = $this->db->select('*')	
                    //->order_by('a.nome_livro asc')
                    ->where('a.excluido', false)
                    ->limit($limite, $inicio)
                    ->get('livros AS a');		
            return $query->result();
    }
    
    function livros_total()
    {
        $this->db->where('excluido', 0);
        return $this->db->count_all_results('livros');
    }
        
    function busca_pelo_id($id)
    {
       $query = $this->db->select('*')	
                    ->join('livros_autores AS la', 'l.id = la.livros_id', 'left')
                    ->join('autores AS a', 'a.id = la.autores_id')
                    ->join('editoras AS e', 'e.id = l.editoras_id')
                    ->join('generos AS g', 'g.id = l.generos_id')
                    ->where('l.id', $id)
                    ->get('livros AS l');		
       
       $l = $query->row(); 
       
       $autores = array();
       
       foreach($query->result() as $livro)
       { 
           $autores[] = array(
            'nome_autor' => $livro->nome_autor            
        );            
       }
       
        $livro = array(
            'id' => $l->id,
            'nome_livro' => $l->nome_livro,
            'data_cadastro' => $l->data_cadastro,
            'data_alteracao' => $l->data_cadastro,
            'nome_editora' => $l->nome_editora,
            'nome_genero' => $l->nome_genero,
            'edicao' => $l->edicao,
            'quantidade_exemplares' => $l->quantidade_exemplares,
            'autores' => $autores
        );
        
        $livro = (object) $livro;
        return $livro; 
    }
    
    function remover($id)
    {
        $livro = $this->busca_pelo_id($id);
        
        if($livro)
        {
            $livro_remover = Livros_model::livro($livro, 'remover');

            $this->db->where('id', $livro_remover->id);

            if ($this->db->update('livros', $livro_remover))
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
    
    function livro($post, $acao)
    {
        $livro = new Livros_model();
               
        if($acao == 'cadastrar')
        {
            $livro->nome_livro = $post['nome_livro'];
            $livro->edicao = $post['edicao'];
            $livro->quantidade_exemplares = $post['quantidade_exemplares'];
            $livro->editoras_id = $post['editoras_id'];
            $livro->generos_id = $post['generos_id'];
            $livro->excluido = 0;
            $livro->data_cadastro = date('Y-m-d H:i:s', time());
            $livro->data_alteracao = date('Y-m-d H:i:s', time());
           
        }
        else if($acao == 'editar')
        {
            $livro->id = $post['id'];
            $livro->nome_livro = $post['nome_livro'];
            $livro->edicao = $post['edicao'];
            $livro->quantidade_exemplares = $post['quantidade_exemplares'];
            $livro->editoras_id = $post['editoras_id'];
            $livro->generos_id = $post['generos_id'];
            $livro->excluido = 0;
            $livro->data_cadastro = $post['data_cadastro'];
            $livro->data_alteracao = date('Y-m-d H:i:s', time());
        }
        else if ($acao == 'remover') // Remoção lógica
        {
            $livro->id = $post->id;
            $livro->nome_livro = $post->nome_livro;
            $livro->edicao = $post->edicao;
            $livro->quantidade_exemplares = $post->quantidade_exemplares;
            $livro->editoras_id = $post->editoras_id;
            $livro->generos_id = $post->generos_id;
            $livro->data_cadastro = $post->data_cadastro;
            $livro->data_alteracao = $post->data_alteracao;
            $livro->data_exclusao = date('Y-m-d H:i:s', time());
            $livro->excluido = 1;
        }
        //var_dump($livro);  
        return $livro;
    }
    
    
}
