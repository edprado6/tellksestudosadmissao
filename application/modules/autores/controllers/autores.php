<?php 

if (!defined('BASEPATH')) 
{    
    exit('No direct script access allowed');
}

class Autores extends MY_Controller {

    
    
    public function __construct() {
        
        parent::__construct();
        
        $this->load->model('autores_model');
        //$this->load->library('session');
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
        
        $this->data['autores'] = $this->autores_model->listar_autores(numeroDeRegistrosPorPagina(), $pagina);
        $this->data['paginacao'] = criarPaginacao('autores', $this->autores_model->autores_total() );
        
        $this->data['conteudo'] = $this->load->view('index', $this->data, TRUE);
        $this->load->view('layout/layout', $this->data);
    }
    
    public function cadastrar()
    {
        $this->data['conteudo'] = $this->load->view('cadastrar', $this->data, TRUE);
        $this->load->view('layout/layout', $this->data);  
    }
    
    public function salvar_cadastro()
    {
        $this->form_validation->set_rules('nome_autor', '<strong>Nome do autor</strong>', 'trim|required');
        
        if ($this->form_validation->run() === FALSE) 
        {
            $this->data['conteudo'] = $this->load->view('cadastrar', $this->data, TRUE);
            $this->load->view('layout/layout', $this->data);
        }
        else
        {
            if($this->autores_model->cadastrar($this->input->post()))
            {
                mensagemStatusOperacao('Autor cadastrado com sucesso.', 'success');
                redirect('autores/index');   
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
        $autor = $this->autores_model->busca_pelo_id($id);
        
        if($autor)
        {
            $this->data['autor'] = $autor;
            $this->data['conteudo'] = $this->load->view('editar', $this->data, TRUE);
            $this->load->view('layout/layout', $this->data); 
        }
        else 
        {
            $this->data['mensagem'] = 'Não existe autor com o id informado.';
            $this->data['conteudo'] = $this->load->view('comum/nada_encontrado', $this->data, TRUE);
            $this->load->view('layout/layout', $this->data); 
        }
        
    }
    
    public function salvar_edicao()
    {
        $this->form_validation->set_rules('nome_autor', '<strong>Nome do autor</strong>', 'trim|required');
        
        if ($this->form_validation->run() === FALSE) 
        {
            $this->data['conteudo'] = $this->load->view('editar', $this->data, TRUE);
            $this->load->view('layout/layout', $this->data);
        }
        else
        {
            if($this->autores_model->editar($this->input->post()))
            {
                mensagemStatusOperacao('Autor editado com sucesso.', 'success');
                redirect('autores/index');   
            }
            else 
            {
                mensagemStatusOperacao('Um erro ocorreu na execução da solicitação.', 'danger');
                $this->data['conteudo'] = $this->load->view('editar', $this->data, TRUE);
                $this->load->view('layout/layout', $this->data);
            }
        }
    }
    
    public function detalhes($id)
    {       
        $autor = $this->autores_model->busca_pelo_id($id);
        
        if($autor)
        {
            $this->data['autor'] = $autor;
            $this->data['conteudo'] = $this->load->view('detalhes', $this->data, TRUE);
            $this->load->view('layout/layout', $this->data);
        }
        else 
        {
            $this->data['mensagem'] = 'Não existe autor com o id informado.';
            $this->data['conteudo'] = $this->load->view('comum/nada_encontrado', $this->data, TRUE);
            $this->load->view('layout/layout', $this->data); 
        }
    }
    
    public function remover()
    {
        $id = $this->input->get('id');
        if($this->autores_model->remover($id))
        {
            mensagemStatusOperacao('Autor removido com sucesso.', 'success');
            redirect('autores/index'); 
        }
        else 
        {
            mensagemStatusOperacao('Um erro ocorreu na execução da solicitação.', 'danger');
            redirect('autores/index'); 
        }

}
}