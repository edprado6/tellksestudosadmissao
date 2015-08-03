<?php

/**
 * Metodo que configura numero de registro por pagina
 */
function numeroDeRegistrosPorPagina()
{
        return 5;
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
        //$config['display_pages'] = FALSE; 
        
        // Inserindo css.
        $config['full_tag_open'] = '<div id="dataTables-example_paginate" class="dataTables_paginate paging_simple_numbers"><ul class="pagination">';
        $config['full_tag_close'] = '</ul></div>';
        
        $config['first_link'] = '&laquo; Primeira';
        $config['first_tag_open'] = '<li class="paginate_button">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Última &raquo;';
        $config['last_tag_open'] = '<li class="paginate_button">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = 'Próxima &rarr;';
        $config['next_tag_open'] = '<li class="paginate_button">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&larr; Anterior';
        $config['prev_tag_open'] = '<li class="paginate_button">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="paginate_button active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>'; 
                
        $ci->pagination->initialize($config);
        return $ci->pagination->create_links();
}

