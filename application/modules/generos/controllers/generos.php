<?php 

if (!defined('BASEPATH')) 
{    
    exit('No direct script access allowed');
}

class Generos extends MY_Controller {

    
    
    public function __construct() {
        
        parent::__construct();
        
        $this->load->model('generos_model');
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
 
        $this->data['generos'] = $this->generos_model->listar_generos(numeroDeRegistrosPorPagina(), $pagina);
        $this->data['paginacao'] = criarPaginacao('generos', $this->generos_model->generos_total() );
        
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
        $this->form_validation->set_rules('nome_genero', '<strong>Nome do gênero</strong>', 'trim|required');
        
        if ($this->form_validation->run() === FALSE) 
        {
            $this->data['conteudo'] = $this->load->view('cadastrar', $this->data, TRUE);
            $this->load->view('layout/layout', $this->data);
        }
        else
        {
            if($this->generos_model->cadastrar($this->input->post()))
            {
                mensagemStatusOperacao('Gênero cadastrado com sucesso.', 'success');
                redirect('generos/index');   
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
        $genero = $this->generos_model->busca_pelo_id($id);
        
        if($genero)
        {
            $this->data['genero'] = $genero;
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
        $this->form_validation->set_rules('nome_genero', '<strong>Nome do gênero</strong>', 'trim|required');
        
        if ($this->form_validation->run() === FALSE) 
        {
            $this->data['conteudo'] = $this->load->view('editar', $this->data, TRUE);
            $this->load->view('layout/layout', $this->data);
        }
        else
        {
            if($this->generos_model->editar($this->input->post()))
            {
                mensagemStatusOperacao('Gênero editado com sucesso.', 'success');
                redirect('generos/index');   
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
        $genero = $this->generos_model->busca_pelo_id($id);
        
        if($genero)
        {
            $this->data['genero'] = $genero;
            $this->data['conteudo'] = $this->load->view('detalhes', $this->data, TRUE);
            $this->load->view('layout/layout', $this->data);
        }
        else 
        {
            $this->data['mensagem'] = 'Não existe generos com o id informado.';
            $this->data['conteudo'] = $this->load->view('comum/nada_encontrado', $this->data, TRUE);
            $this->load->view('layout/layout', $this->data); 
        }
    }
    
    public function remover()
    {
        $id = $this->input->get('id');
        if($this->generos_model->remover($id))
        {
            mensagemStatusOperacao('Gênero removido com sucesso.', 'success');
            redirect('generos/index'); 
        }
        else 
        {
            mensagemStatusOperacao('Um erro ocorreu na execução da solicitação.', 'danger');
            redirect('generos/index'); 
        }

}
}