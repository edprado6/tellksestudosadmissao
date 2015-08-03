<?php 

if (!defined('BASEPATH')) 
{    
    exit('No direct script access allowed');
}

class Editoras extends MY_Controller {

    
    
    public function __construct() {
        
        parent::__construct();
        
        $this->load->model('editoras_model');
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
 
        $this->data['editoras'] = $this->editoras_model->listar_editoras(numeroDeRegistrosPorPagina(), $pagina);
        $this->data['paginacao'] = criarPaginacao('editoras', $this->editoras_model->editoras_total() );
        
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
        $this->form_validation->set_rules('nome_editora', '<strong>Nome da editora</strong>', 'trim|required');
        
        if ($this->form_validation->run() === FALSE) 
        {
            $this->data['conteudo'] = $this->load->view('cadastrar', $this->data, TRUE);
            $this->load->view('layout/layout', $this->data);
        }
        else
        {
            if($this->editoras_model->cadastrar($this->input->post()))
            {
                mensagemStatusOperacao('Editora cadastrado com sucesso.', 'success');
                redirect('editoras/index');   
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
        $editora = $this->editoras_model->busca_pelo_id($id);
        
        if($editora)
        {
            $this->data['editora'] = $editora;
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
        $this->form_validation->set_rules('nome_editora', '<strong>Nome da editora</strong>', 'trim|required');
        
        if ($this->form_validation->run() === FALSE) 
        {
            $this->data['conteudo'] = $this->load->view('editar', $this->data, TRUE);
            $this->load->view('layout/layout', $this->data);
        }
        else
        {
            if($this->editoras_model->editar($this->input->post()))
            {
                mensagemStatusOperacao('Editora editado com sucesso.', 'success');
                redirect('editoras/index');   
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
        $editora = $this->editoras_model->busca_pelo_id($id);
        
        if($editora)
        {
            $this->data['editora'] = $editora;
            $this->data['conteudo'] = $this->load->view('detalhes', $this->data, TRUE);
            $this->load->view('layout/layout', $this->data);
        }
        else 
        {
            $this->data['mensagem'] = 'Não existe editoras com o id informado.';
            $this->data['conteudo'] = $this->load->view('comum/nada_encontrado', $this->data, TRUE);
            $this->load->view('layout/layout', $this->data); 
        }
    }
    
    public function remover()
    {
        $id = $this->input->get('id');
        if($this->editoras_model->remover($id))
        {
            mensagemStatusOperacao('Editora removido com sucesso.', 'success');
            redirect('editoras/index'); 
        }
        else 
        {
            mensagemStatusOperacao('Um erro ocorreu na execução da solicitação.', 'danger');
            redirect('editoras/index'); 
        }
    }
    
    public function listar_editoras()
    {
        $termo = $this->input->get('q');
        
        $editoras = $this->editoras_model->editoras_por_termo($termo);
			
        if ($editoras)
        {
            $this->_response('ok', array('editoras' => $editoras));
        }
        else
        {
            $this->_response('fail', array('editoras' => $editoras));
        }
        
    }
}