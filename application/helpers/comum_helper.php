<?php

function formatar_data($date, $second = FALSE)
{
	if ($date == '0000-00-00 00:00:00' || $date == '')
	{
		return '';
	}
	
	$exploded = explode(' ', $date);
	return ($second ? ' - ' : '') . join('/', array_reverse(explode('-', $exploded[0])));
}

function simple_pagination($page_method, $previous_page, $next_page, $show_number, $param = '')
{
	echo '<ul class="pager">';
	if ($previous_page > 0)
	{
		echo '<li class="previous">';
		echo anchor(($page_method . '/' . $previous_page . '/' . $show_number) . $param, 'Anteriores');
		echo '</li>';
	}
	if ($next_page > 1)
	{
		echo '<li class="next">';
		echo anchor(ci_site_url($page_method . '/' . $next_page . '/' . $show_number) . $param, 'Próximos');
		echo '</li>';
	}
	echo '</ul>';
}

function pagination($page_method, $page, $show_number, $total, $param = array(), $pagination_class = 'pull-right')
{
	$return = '';
	
	$offset = ($page - 1) * $show_number;
	$previous_page = ($page > 1) ? $page - 1 : 0;
	$next_page = ($total - $offset > $show_number) ? $page + 1 : 0;
	
	$start = $page == 1 ? 1 : $page * $show_number - $show_number + 1;
	
	$finish = $page < $next_page ? $page * $show_number : $total;
	
	$return .= '<div class="pagination-wrapper">';
	$return .= '<p class="pull-left pagination-p">Mostrando <b>' . $start . '</b> - <b>' . $finish . '</b> de <b>' . $total . '</b></p>';
	
	if ($previous_page != 0 || $next_page != 0)
	{
		$param_string = '?show=' . $show_number;
		
		if (!empty($param))
		{
			foreach ($param as $key => $item)
			{
				$param_string .= '&amp;' . $key . '=' . $item;
			}
		}	
		
		
		$number_pages = ceil($total / $show_number);		
		
		$i = 1;
		
		$return .= '<ul class="pagination';
		
		if ($pagination_class != '')
		{
			$return .= ' ' . $pagination_class;
		}
		$return .= '">';
		
		if ($previous_page > 0)
		{
			$return .= '<li>';
			$return .= anchor(site_url($page_method . '/' . $previous_page) . $param_string, '&laquo; Anteriores');
			$return .= '</li>';
		}
		else
		{
			$return .= '<li class="disabled"><span>&laquo; Anteriores</span></li>';
		}
		
		$current_page = $page;
		
		if ($number_pages > 10)
		{
			if ($current_page > 6)
			{
				if ($current_page + 4 < $number_pages)
				{
					$number_pages = $current_page + 4;
					$i = $number_pages - 9;
				}
				else
				{
					$i = $number_pages - 9;
				}
			}
			else
			{
				$number_pages = 10;
				$i = 1;
			}
		}
		
		//log_message('debug', 'number_pages: ' . $number_pages . ' - current_page: ' . $current_page . ' - $i: ' . $i);
		
		for ($i; $i <= $number_pages; $i++)
		{
			if ($i == $previous_page + 1 || $i == $next_page - 1)
			{
				$return .= '<li class="active"><span>' . $i . ' <span class="sr-only">(atual)</span></span></li>';
			}
			else
			{
				$return .= '<li>';
				$return .= anchor(site_url($page_method . '/' . $i) . $param_string, $i);
				$return .= '</li>';
			}
		
		}
		
		if ($next_page > 1)
		{
			$return .= '<li>';
			$return .= anchor(site_url($page_method . '/' . $next_page) . $param_string, 'Próximos &raquo;');
			$return .= '</li>';
		}
		else
		{
			$return .= '<li class="disabled"><span>Próximos &raquo;</span></li>';
		}
		$return .= '</ul>';
		
	}
	$return .= '</div><div class="clearfix"></div>';
	
	return $return;
}
