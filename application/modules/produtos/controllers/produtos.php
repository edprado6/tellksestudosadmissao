<?php 

if (!defined('BASEPATH')) 
{    
    exit('No direct script access allowed');
}

class Produtos extends MY_Controller {

    
    
    public function __construct() {
        
        parent::__construct();
        
        $this->load->model('produtos_model');

        $this->output->enable_profiler(TRUE);
    }

    /**
     * Exibe todos produtos.
     * 
     * @param int $page
     */
    public function index($page = 1) 
    {
       
//        $show = $this->get_show_number();
//        $offset = $this->get_offset($page, $show);
//        $prepend = ($page > 1) ? ' - Página ' . $page : '';
//
//        $this->data['page'] = $page;
//        $this->data['page_title'] = 'Permissões' . $prepend;
//        $this->data['sub_page_title'] = 'Listar';       
//        
//        /**
//         * Parâmetros do filtro.
//         */
//        $modulo = ($this->input->get('modulo')) ? $this->input->get('modulo') : false;
//        //$controller = ($this->input->get('controller')) ? $this->input->get('controller') : false;
//        $this->data['modulo'] = $modulo;
//        //$this->data['controller'] = $controller;
//        
//        $this->data['controllers'] = $this->permissao_model->select_controllers();
//        $this->data['modulos'] = $this->modulo_model->select_modulos();
//        $this->data['todas_permissoes'] = $this->permissao_model->get_paged($modulo, /*$controller, */$show, $offset);
//        $this->data['total'] = $this->permissao_model->get_total($modulo/*, $controller*/);
//        $this->data['previous_page'] = ($page > 1) ? $page - 1 : 0;
//        $this->data['next_page'] = ($this->data['total'] - $offset > $show) ? $page + 1 : 0;
//        $this->data['show_number'] = $show;
        $p = new Produtos_model();
        $p->nome_produto = "Teste";
        $p->data_alteracao = "31/07/2015";
        $p->data_cadastro = "31/07/2015";
        
        $this->data['p'] = $p;
        
        $this->data['texto'] = "Texto para ser exibido em teste de view.";
        $this->data['conteudo'] = $this->load->view('index', $this->data, TRUE);
        $this->load->view('layout/layout', $this->data);
    }

}