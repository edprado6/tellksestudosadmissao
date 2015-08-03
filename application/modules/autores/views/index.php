<?php
if (isset($autores) && count($autores) > 0) 
{ ?>
<table class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Autores</th>
            <th>Cadastrado em</th>
            <th>Alterado em</th>
            <th>Ações</th>
        </tr>
    
    </thead>
    <tbody>
        <?php
        foreach ($autores as $autor) { ?>
        <tr>
            <td><?php echo $autor->id;?></td>
            <td><?php echo $autor->nome_autor;?></td>
            <td><?php echo formatar_data($autor->data_cadastro);?></td>
            <td><?php echo formatar_data($autor->data_alteracao);?></td>
            <td>
                <a href="<?php echo site_url('autores/editar/' . $autor->id);?>" title="Editar" class="btn btn-xs btn-info"><i class="fa fa-edit"></i> Editar</a>
                <a href="<?php echo site_url('autores/detalhes/' . $autor->id);?>" title="Detalhes" class="btn btn-xs btn-warning"><i class="fa fa-search"></i> Detalhes</a>
                <a href="#" title="Excluir" data-id="<?php echo $autor->id;?>" class="excluir-autor btn btn-xs btn-danger">
                    <i class="fa fa-times"></i> Excluir</a> 
            </td>
            <?php }?>
        </tr>    
    </tbody>
</table>
<?php
echo $paginacao;

$this->load->view('comum/modal');
} 

 else {?>
    <div class="alert alert-warning">
        Não existem autores cadastrados.
    </div>
<?php }

