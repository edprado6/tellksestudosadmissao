<?php 

if (!defined('BASEPATH')) 
{    
    exit('No direct script access allowed');
}

class Livros extends MY_Controller {
   
    
    public function __construct() {
        
        parent::__construct();
        
        $this->load->model('livros_model');
        $this->load->model('autores/autores_model');
        $this->load->model('editoras/editoras_model');
        $this->load->model('generos/generos_model');     
        
        $this->output->enable_profiler(TRUE);
    }

    /**
     * Exibe todas categorias.
     * 
     * @param int $pagina
     */
    public function index() 
    {
        $this->load->helper('paginacao_helper');    
        $pagina = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
 
        $this->data['livros'] = $this->livros_model->listar_livros(numeroDeRegistrosPorPagina(), $pagina);
        $this->data['paginacao'] = criarPaginacao('livros', $this->livros_model->livros_total() );
        
        $this->data['conteudo'] = $this->load->view('index', $this->data, TRUE);
        $this->load->view('layout/layout', $this->data);
    }
    
    public function cadastrar()
    {
        $this->data['generos'] = $this->generos_model->select_generos();
        $this->data['editoras'] = $this->editoras_model->select_editoras();
        $this->data['autores'] = $this->autores_model->listar_autores();
        $this->data['conteudo'] = $this->load->view('cadastrar', $this->data, TRUE);
        $this->load->view('layout/layout', $this->data);  
    }
    
    public function salvar_cadastro()
    {
        $this->form_validation->set_rules('nome_livro', '<strong>Nome do livro</strong>', 'trim|required');
        $this->form_validation->set_rules('generos_id', '<strong>Gênero</strong>', 'trim|required|is_natural_no_zero');
        //var_dump($this->input->post());        
        if ($this->form_validation->run() === FALSE) 
        {
            $this->data['generos'] = $this->generos_model->select_generos();
            $this->data['editoras'] = $this->editoras_model->select_editoras();
            $this->data['autores'] = $this->autores_model->listar_autores();
            $this->data['conteudo'] = $this->load->view('cadastrar', $this->data, TRUE);
            $this->load->view('layout/layout', $this->data);
        }
        else
        {
            if($this->livros_model->cadastrar($this->input->post()))
            {
                mensagemStatusOperacao('Livro cadastrado com sucesso.', 'success');
                redirect('livros/index');   
            }
            else 
            {
                mensagemStatusOperacao('Um erro ocorreu na execução da solicitação.', 'danger');
                $this->data['conteudo'] = $this->load->view('cadastrar', $this->data, TRUE);
                $this->load->view('layout/layout', $this->data);
            }
        }
    }
    
    public function editar($id)
    {
        $livro = $this->livros_model->busca_pelo_id($id);
        
        if($livro)
        {
            $this->data['generos'] = $this->generos_model->select_generos();
            $this->data['editoras'] = $this->editoras_model->select_editoras();
            $this->data['autores'] = $this->autores_model->listar_autores();
            $this->data['livros_autores'] = $this->livros_autores_model->autores_dos_livros($id);
            $this->data['livro'] = $livro;
            $this->data['conteudo'] = $this->load->view('editar', $this->data, TRUE);
            $this->load->view('layout/layout', $this->data); 
        }
        else 
        {
            $this->data['mensagem'] = 'Não existe gênero com o id informado.';
            $this->data['conteudo'] = $this->load->view('comum/nada_encontrado', $this->data, TRUE);
            $this->load->view('layout/layout', $this->data); 
        }
        
    }
    
    public function salvar_edicao()
    {
        //var_dump($this->input->post());
        $this->form_validation->set_rules('nome_livro', '<strong>Nome do livro</strong>', 'trim|required');
        
        if ($this->form_validation->run() === FALSE) 
        {
            $this->data['generos'] = $this->generos_model->select_generos();
            $this->data['editoras'] = $this->editoras_model->select_editoras();
            $this->data['autores'] = $this->autores_model->listar_autores();
            $this->data['livros_autores'] = $this->livros_autores_model->autores_dos_livros($id);
            $this->data['conteudo'] = $this->load->view('editar', $this->data, TRUE);
            $this->load->view('layout/layout', $this->data);
        }
        else
        {
            if($this->livros_model->editar($this->input->post()))
            {
                mensagemStatusOperacao('Livro editado com sucesso.', 'success');
                redirect('livros/index');   
            }
            else 
            {
                $this->data['generos'] = $this->generos_model->select_generos();
            $this->data['editoras'] = $this->editoras_model->select_editoras();
            $this->data['autores'] = $this->autores_model->listar_autores();
            $this->data['livros_autores'] = $this->livros_autores_model->autores_dos_livros($id);
                mensagemStatusOperacao('Um erro ocorreu na execução da solicitação.', 'danger');
                $this->data['conteudo'] = $this->load->view('editar', $this->data, TRUE);
                $this->load->view('layout/layout', $this->data);
            }
        }
    }
    
    public function detalhes($id)
    {       
        $livro = $this->livros_model->busca_pelo_id($id);
        
        if($livro)
        {
            $this->data['livro'] = $livro;
            $this->data['conteudo'] = $this->load->view('detalhes', $this->data, TRUE);
            $this->load->view('layout/layout', $this->data);
        }
        else 
        {
            $this->data['mensagem'] = 'Não existe livros com o id informado.';
            $this->data['conteudo'] = $this->load->view('comum/nada_encontrado', $this->data, TRUE);
            $this->load->view('layout/layout', $this->data); 
        }
    }
    
    public function remover()
    {
        $id = $this->input->get('id');
        if($this->livros_model->remover($id))
        {
            mensagemStatusOperacao('Livro removido com sucesso.', 'success');
            redirect('livros/index'); 
        }
        else 
        {
            mensagemStatusOperacao('Um erro ocorreu na execução da solicitação.', 'danger');
            redirect('livros/index'); 
        }

}
}