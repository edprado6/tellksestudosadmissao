
<a href="<?php echo site_url('produtos/index');?>" title="Voltar">Voltar</a>
<?php


    $attributes = array('class' => 'form');
    $nome_produto = (isset($produto['nome_produto'])) ? $produto['nome_produto'] : set_value('nome_produto');

    echo form_open_multipart('produto/salvar', $attributes); 
    

    echo form_fieldset('Produto');
    
   
	echo form_label('Nome', 'nome_produto');
	echo form_input('nome_produto', $nome_produto, ' id="nome_produto" maxlength="100"');
	echo form_error('nome_produto');
    
    echo form_fieldset_close();
    echo '<br><br>';
//        foreach ($categorias as $categoria)
//        {	
//            $checked = in_array($categoria->id_categoria, $produto['categorias']);
//            $categoria_checkbox =  
//                form_checkbox('categorias[]', $categoria->id_categoria, $checked, 'id="categoria-' . $categoria->id_categoria . '"');								
//                echo '<div class="checkbox">' . form_label($categoria_checkbox . $categoria->nome_categoria, 'categoria-' . $categoria->id_categoria) . '</div>',
//                NULL, form_error('categorias');
//        }
    echo '<br><br>';    
    echo form_submit('save', 'Salvar');    
    echo form_close();

