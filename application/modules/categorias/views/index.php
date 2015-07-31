<table class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Categoria</th>
            <th>Cadastrado em</th>
            <th>Alterado em</th>
            <th>Ações</th>
        </tr>
    
    </thead>
    <tbody>
        <?php
        foreach ($categorias as $categoria) { ?>
        <tr>
            <td><?php echo $categoria->id;?></td>
            <td><?php echo $categoria->nome_categoria;?></td>
            <td><?php echo formatar_data($categoria->data_cadastro);?></td>
            <td><?php echo formatar_data($categoria->data_alteracao);?></td>
            <td>
                <a href="<?php echo site_url('categorias/editar/' . $categoria->id);?>" title="Editar" class="btn btn-xs btn-info"><i class="fa fa-edit"></i> Editar</a>
                <a href="<?php echo site_url('categorias/detalhes/' . $categoria->id);?>" title="Detalhes" class="btn btn-xs btn-warning"><i class="fa fa-search"></i> Detalhes</a>
                <a href="#" title="Excluir" class="btn btn-xs btn-danger"><i class="fa fa-times"></i> Excluir</a> 
            </td>
            <?php }?>
        </tr>    
    </tbody>
</table>
<?php
//var_dump($total);
//$param = array();
//$pagination = pagination($page_method, $page, $show_number, $total, $param);
//echo $this->pagination->create_links();
echo $paginacao;



