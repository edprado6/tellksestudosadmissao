<?php
if (isset($generos) && count($generos) > 0) 
{ ?>
<table class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Gêneros</th>
            <th>Cadastrado em</th>
            <th>Alterado em</th>
            <th>Ações</th>
        </tr>
    
    </thead>
    <tbody>
        <?php
        foreach ($generos as $genero) { ?>
        <tr>
            <td><?php echo $genero->id;?></td>
            <td><?php echo $genero->nome_genero;?></td>
            <td><?php echo formatar_data($genero->data_cadastro);?></td>
            <td><?php echo formatar_data($genero->data_alteracao);?></td>
            <td>
                <a href="<?php echo site_url('generos/editar/' . $genero->id);?>" title="Editar" class="btn btn-xs btn-info"><i class="fa fa-edit"></i> Editar</a>
                <a href="<?php echo site_url('generos/detalhes/' . $genero->id);?>" title="Detalhes" class="btn btn-xs btn-warning"><i class="fa fa-search"></i> Detalhes</a>
                <a href="#" title="Excluir" data-id="<?php echo $genero->id;?>" class="excluir-genero btn btn-xs btn-danger">
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
        Não existem generos cadastrados.
    </div>
<?php }