<?php

    $atributos = array('class' => 'form');
    
    echo form_open_multipart('generos/salvar_cadastro', $atributos); 
    
    $nome_genero = (isset($genero->nome_genero)) ? $genero->nome_genero : set_value('nome_genero');
    
    echo form_fieldset('Gêneros');
       
        echo "<div class='row'>";
        echo "<div class='form-group'><div class='col-lg-6'>";
	echo form_label('Nome do Gênero', 'nome_genero');
	echo form_input('nome_genero', $nome_genero, ' id="nome_genero" maxlength="45" class="form-control"');
	echo form_error('nome_genero');
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