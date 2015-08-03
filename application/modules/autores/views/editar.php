<?php

    $atributos = array('class' => 'form');
    
    echo form_open_multipart('autores/salvar_edicao', $atributos); 
    
    if (isset($autor)) 
    {
        echo form_hidden('id', $autor->id);
        echo form_hidden('data_cadastro', $autor->data_cadastro);   
    }
    
    $nome_autor = (isset($autor->nome_autor)) ? $autor->nome_autor : set_value('nome_autor');
    
    echo form_fieldset('Autores');
       
        echo "<div class='row'>";
        echo "<div class='form-group'><div class='col-lg-6'>";
	echo form_label('Nome do Autor', 'nome_autor');
	echo form_input('nome_autor', $nome_autor, ' id="nome_autor" maxlength="45" class="form-control"');
	echo form_error('nome_autor');
        echo "</div></div></div>";
        
        echo "<br>";
        
        echo "<div class='row'>";
        echo "<div class='form-group'><div class='col-lg-6'>";
        echo "<div align='right'>";
        echo "<button type='submit' class='btn btn-primary'>";
        echo "<i class='fa fa-save'></i>&nbsp;&nbsp;Salvar</button>";
        echo "</div></div></div>";   
        
    echo form_fieldset_close();
                        
    //echo form_submit('save', 'Salvar');    
    echo form_close();

  