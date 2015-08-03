<?php

if (!defined('BASEPATH')) 
{
    exit('No direct script access allowed');
}

class Livros_autores_model extends CI_Model {
    
    var $livros_id;
    var $autores_id;
    
    function __construct() 
    {
        parent::__construct();
    }
    
    /**
     * Retorna um array contendo IDs de todas as permissões de um grupo.
     * 
     * @param type $livro_id
     * @return type
     */
    function autores_dos_livros($livro_id)
    {
        $query = $this->db->where('livros_id', $livro_id)->get('livros_autores');
		
        $autores = array();

        foreach ($query->result() as $autor)
        {
            $autores[] = $autor->autores_id;
        }

        return $autores;        
    }
    
    function cadastrar($livros_id, $autores)
    {		
        $query = $this->db->select('a.id')
                    ->join('livros_autores AS la', 'a.id = la.autores_id')							
                    ->where('la.livros_id', $livros_id)
                    ->get('autores AS a');

		$result = $query->result();
		
            if ($result)
            {				
                foreach ($result as $autor)
                {
                    $id = $autor->id;
                    $this->delete($livros_id, $id);
                }
            }
		
		return $this->_inserir_autores($livros_id, $autores);
	}
	
	function _inserir_autores($livros_id, $autores)
	{
            $count = count($autores);
            $data = array();
            if ($autores && $count > 0)
            {
                foreach ($autores as $autor)
                {		
                        $data[] = array(
                                        'livros_id' => $livros_id,
                                        'autores_id' => $autor
                        );
                }

                return $this->db->insert_batch('livros_autores', $data);
            }
                
		return TRUE;
	}
		
	function delete($livros_id, $autores_id)
	{
            $data = array(
                'livros_id' => $livros_id,
                'autores_id' => $autores_id
            );
		
            return $this->db->delete('livros_autores', $data);
	}
    
}