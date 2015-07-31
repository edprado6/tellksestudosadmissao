<?php

/**
 * Metodo que configura numero de registro por pagina
 */
function numeroDeRegistrosPorPagina()
{
        return 3;
}

/**
 * Metodo que cria link de paginacao
 */
function criarPaginacao( $_modulo, $_total )
{	
        $ci = &get_instance();
        $ci->load->library('pagination');

        $config['base_url']    = site_url($_modulo.'/index/');
        $config['total_rows']  = $_total;
        $config['per_page']    = numeroDeRegistrosPorPagina();
        $config['uri_segment'] = 3;
        $config['first_link']  = 'Primeira';
        $config['last_link']   = 'Última';
        $config['next_link']   = 'Próxima';
        $config['prev_link']   = 'Anterior';
        //$config['use_page_numbers'] = TRUE;
         
        $ci->pagination->initialize($config);
        return $ci->pagination->create_links();
}

