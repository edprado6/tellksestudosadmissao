<?php
if (isset($livros) && count($livros) > 0) 
{ ?>
<table class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Livros</th>
            <th>Cadastrado em</th>
            <th>Alterado em</th>
            <th>Ações</th>
        </tr>
    
    </thead>
    <tbody>
        <?php
        foreach ($livros as $livro) { ?>
        <tr>
            <td><?php echo $livro->id;?></td>
            <td><?php echo $livro->nome_livro;?></td>
            <td><?php echo formatar_data($livro->data_cadastro);?></td>
            <td><?php echo formatar_data($livro->data_alteracao);?></td>
            <td>
                <a href="<?php echo site_url('livros/editar/' . $livro->id);?>" title="Editar" class="btn btn-xs btn-info"><i class="fa fa-edit"></i> Editar</a>
                <a href="<?php echo site_url('livros/detalhes/' . $livro->id);?>" title="Detalhes" class="btn btn-xs btn-warning"><i class="fa fa-search"></i> Detalhes</a>
                <a href="#" title="Excluir" data-id="<?php echo $livro->id;?>" class="excluir-livro btn btn-xs btn-danger">
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
        Não existem livros cadastradas.
    </div>
<?php }