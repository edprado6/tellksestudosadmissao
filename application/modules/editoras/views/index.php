<?php
if (isset($editoras) && count($editoras) > 0) 
{ ?>
<table class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Editora</th>
            <th>Cadastrado em</th>
            <th>Alterado em</th>
            <th>Ações</th>
        </tr>
    
    </thead>
    <tbody>
        <?php
        foreach ($editoras as $editora) { ?>
        <tr>
            <td><?php echo $editora->id;?></td>
            <td><?php echo $editora->nome_editora;?></td>
            <td><?php echo formatar_data($editora->data_cadastro);?></td>
            <td><?php echo formatar_data($editora->data_alteracao);?></td>
            <td>
                <a href="<?php echo site_url('editoras/editar/' . $editora->id);?>" title="Editar" class="btn btn-xs btn-info"><i class="fa fa-edit"></i> Editar</a>
                <a href="<?php echo site_url('editoras/detalhes/' . $editora->id);?>" title="Detalhes" class="btn btn-xs btn-warning"><i class="fa fa-search"></i> Detalhes</a>
                <a href="#" title="Excluir" data-id="<?php echo $editora->id;?>" class="excluir-editora btn btn-xs btn-danger">
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
        Não existem editoras cadastradas.
    </div>
<?php }