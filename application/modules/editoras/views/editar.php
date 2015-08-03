<?php

$atributos = array('class' => 'form');
    
    echo form_open_multipart('editoras/salvar_edicao', $atributos); 
    
    if (isset($editora)) 
    {
        echo form_hidden('id', $editora->id);
        echo form_hidden('data_cadastro', $editora->data_cadastro);   
    }
    
    $nome_editora = (isset($editora->nome_editora)) ? $editora->nome_editora : set_value('nome_editora');
    
    echo form_fieldset('Autores');
       
        echo "<div class='row'>";
        echo "<div class='form-group'><div class='col-lg-6'>";
	echo form_label('Nome da Editora', 'nome_editora');
	echo form_input('nome_editora', $nome_editora, ' id="nome_editora" maxlength="45" class="form-control"');
	echo form_error('nome_editora');
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
