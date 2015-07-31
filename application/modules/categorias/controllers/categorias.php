<?php 

if (!defined('BASEPATH')) 
{    
    exit('No direct script access allowed');
}

class Categorias extends MY_Controller {

    
    
    public function __construct() {
        
        parent::__construct();
        
        $this->load->model('categorias_model');
        //$this->load->library('session');
        //$this->output->enable_profiler(TRUE);
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
 
        $this->data['categorias'] = $this->categorias_model->listar_categorias(numeroDeRegistrosPorPagina(), $pagina);
        $this->data['paginacao'] = criarPaginacao('categorias', $this->categorias_model->categorias_total() );
        
        $this->data['conteudo'] = $this->load->view('index', $this->data, TRUE);
        $this->load->view('layout/layout', $this->data);
    }
    
    public function cadastrar()
    {
        $this->data['conteudo'] = $this->load->view('cadastrar', $this->data, TRUE);
        $this->load->view('layout/layout', $this->data);  
    }
    
    public function salvar_cadatro()
    {
        if($this->categorias_model->cadastrar($this->input->post()))
        {
            $this->session->set_flashdata('sucesso','Categoria cadastrada com sucesso.');
            redirect('categorias/index');   
        }
        else 
        {
            $this->data['conteudo'] = $this->load->view('cadastrar', $this->data, TRUE);
            $this->load->view('layout/layout', $this->data);
        }
        
    }
    
    public function editar($id)
    {
        $this->data['conteudo'] = $this->load->view('editar', $this->data, TRUE);
        $this->load->view('layout/layout', $this->data); 
    }
    
    public function salvar_edicao()
    {
        $this->load->view('layout/layout', $this->data);
    }
    
    public function detalhes($id)
    {
        $this->data['conteudo'] = $this->load->view('detalhes', $this->data, TRUE);
        $this->load->view('layout/layout', $this->data);
    }
    
    public function remover($id)
    {
        $this->load->view('layout/layout', $this->data);
    }
}