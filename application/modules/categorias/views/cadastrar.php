<a href="<?php echo site_url('categorias/index');?>" title="Voltar">Voltar</a>
<?php

    $attributes = array('class' => 'form');
    
    echo form_open_multipart('categorias/salvar_cadatro', $attributes); 
    
    $nome_categoria = (isset($categoria->nome_categoria)) ? $categoria->nome_categoria : set_value('nome_categoria');
    
    echo form_fieldset('Categoria');
       
	echo form_label('Categoria', 'nome_categoria');
	echo form_input('nome_categoria', $nome_categoria, ' id="nome_categoria" maxlength="100"');
	echo form_error('nome_categoria');
    
    echo form_fieldset_close();
    echo '<br><br>';
    
    echo form_submit('save', 'Salvar');    
    echo form_close();