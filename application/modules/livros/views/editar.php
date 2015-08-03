<?php

    $atributos = array('class' => 'form');
    $label_attr = array('class' => 'control-label');
    $input_class = 'class="form-control"';
    
    echo form_open_multipart('livros/salvar_edicao', $atributos); 
    
    if (isset($livro)) 
    {
        echo form_hidden('id', $livro->id);
        echo form_hidden('data_cadastro', $livro->data_cadastro);   
    }
    
    $nome_livro = (isset($livro->nome_livro)) ? $livro->nome_livro : set_value('nome_livro');
    $edicao = (isset($livro->edicao)) ? $livro->edicao : set_value('edicao');
    $quantidade_exemplares = (isset($livro->quantidade_exemplares)) ? $livro->quantidade_exemplares : set_value('quantidade_exemplares');
    $genero = (isset($livro->generos_id)) ? $livro->generos_id : set_value('genero');
    $editora = (isset($livro->editoras_id)) ? $livro->editoras_id : set_value('editora');
    
    
    echo form_fieldset('Livros');
       
        echo "<div class='row'>";
        echo "<div class='form-group'><div class='col-lg-6'>";
	echo form_label('Nome do Livro', 'nome_livro');
	echo form_input('nome_livro', $nome_livro, ' id="nome_livro" maxlength="45" class="form-control"');
	echo form_error('nome_livro');
        echo "</div></div></div>";
        
        echo "<div class='row'>";
        echo "<div class='form-group'><div class='col-lg-6'>";
        echo form_label('Gênero', 'generos_id', $label_attr);
        echo form_dropdown('generos_id', $generos, $genero, $input_class . ' id="generos_id" maxlength="20"');
        echo form_error('generos_id');
        echo "</div></div></div>";
        
//        echo "<div class='row'>";
//        echo "<div class='form-group'><div class='col-lg-6'>";
//	echo form_label('Editora', 'nome_editora');
//	echo form_input('nome_editora', $nome_editora, ' id="nome_editora" maxlength="45" class="form-control"');
//	echo form_error('nome_editora');
//        echo "</div></div></div>";
       
        echo "<div class='row'>";
        echo "<div class='form-group'><div class='col-lg-6'>";
        echo form_label('Editora', 'editoras_id', $label_attr);
        echo form_dropdown('editoras_id', $editoras, $editora, $input_class . ' id="editoras_id" maxlength="20"');
        echo form_error('editoras_id');
        echo "</div></div></div>";
        
        
        echo "<div class='row'>";
        echo "<div class='form-group'>" . "<div class='col-lg-3'>";
	echo form_label('Edição', 'edicao');
	echo form_input('edicao', $edicao, ' id="edicao" maxlength="45" class="form-control"');
	echo form_error('edicao');
        
        echo form_label('Quantidade de exemplares', 'quantidade_exemplares');
	echo form_input('quantidade_exemplares', $quantidade_exemplares, ' id="quantidade_exemplares" maxlength="10" class="form-control"');
	echo form_error('quantidade_exemplares');
        echo "</div></div></div>";
        
        foreach ($autores as $autor)
        {	
            //$checked = in_array($autor->id, $livro['autores']);
            $checked = 0;
            if(isset($livros_autores))
            {
                $checked = in_array($autor->id, $livros_autores);
            }
            else
            {
                $checked = 0;
            }	
            
            
            $autor_checkbox =  
                form_checkbox('autores[]', $autor->id, $checked, 'id="autor-' . $autor->id . '"');								
                echo '<div class="checkbox">' . form_label($autor_checkbox . $autor->nome_autor, 'autor-' . $autor->id) . '</div>',
                NULL, form_error('autores');
        }
     
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