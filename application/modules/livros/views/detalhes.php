<?php
if(isset($livro))
{
    //var_dump($livro);
    echo form_fieldset('Livros');
       
        echo "<div class='row'>";
        echo "<div class='form-group'><div class='col-lg-6'>";
	echo form_label('Id:&nbsp&nbsp');
	echo $livro->id;	
        echo "</div></div></div>";    
    
        echo "<div class='row'>";
        echo "<div class='form-group'><div class='col-lg-6'>";
	echo form_label('Nome do Livro:&nbsp&nbsp');
	echo $livro->nome_livro;	
        echo "</div></div></div>";
        
        echo "<div class='row'>";
        echo "<div class='form-group'><div class='col-lg-6'>";
	echo form_label('Editora:&nbsp&nbsp');
	echo $livro->nome_editora;	
        echo "</div></div></div>";
        
        echo "<div class='row'>";
        echo "<div class='form-group'><div class='col-lg-6'>";
	echo form_label('Gênero:&nbsp&nbsp');
	echo $livro->nome_genero;	
        echo "</div></div></div>";
        
        echo "<div class='row'>";
        echo "<div class='form-group'><div class='col-lg-6'>";
	echo form_label('Edição:&nbsp&nbsp');
	echo $livro->edicao;	
        echo "</div></div></div>";
        
        echo "<div class='row'>";
        echo "<div class='form-group'><div class='col-lg-6'>";
	echo form_label('Quantidade de exemplares:&nbsp&nbsp');
	echo $livro->quantidade_exemplares;	
        echo "</div></div></div>";
        
        echo "<div class='row'>";
        echo "<div class='form-group'><div class='col-lg-6'>";
	echo form_label('Data de cadastro:&nbsp&nbsp');
	echo formatar_data($livro->data_cadastro);	
        echo "</div></div></div>";
        
        echo "<div class='row'>";
        echo "<div class='form-group'><div class='col-lg-6'>";
	echo form_label('Data de alteração:&nbsp&nbsp');
	echo formatar_data($livro->data_alteracao);	
        echo "</div></div></div>";
        
        echo "<div class='row'>";
        echo "<div class='form-group'><div class='col-lg-6'>";
	echo form_label('Autor(es):&nbsp&nbsp');
        
        $contador = count($livro->autores);        
	foreach ($livro->autores as $autor)
        {
            $contador = $contador - 1;
            echo $autor['nome_autor'];
            if($contador > 0) { echo ', '; }
        }        
        echo "</div></div></div>";
        
        
        echo "<br>";
        
        echo "<div class='row'>";
        echo "<div class='form-group'><div class='col-lg-6'>";
        echo "<div align='right'>";
        echo "<a class='btn btn-danger fa fa-step-backward' href='../livros'> &nbsp;&nbsp;Voltar</a>";
        echo "</div></div></div>";   
        
    echo form_fieldset_close();             
    
}