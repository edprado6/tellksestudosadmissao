<?php
if(isset($genero))
{
    echo form_fieldset('Gêneros');
       
        echo "<div class='row'>";
        echo "<div class='form-group'><div class='col-lg-6'>";
	echo form_label('Id:&nbsp&nbsp');
	echo form_label($genero->id);	
        echo "</div></div></div>";    
    
        echo "<div class='row'>";
        echo "<div class='form-group'><div class='col-lg-6'>";
	echo form_label('Nome do Gênero:&nbsp&nbsp');
	echo form_label($genero->nome_genero);	
        echo "</div></div></div>";
        
        echo "<div class='row'>";
        echo "<div class='form-group'><div class='col-lg-6'>";
	echo form_label('Data de cadastro:&nbsp&nbsp');
	echo form_label(formatar_data($genero->data_cadastro));	
        echo "</div></div></div>";
        
        echo "<div class='row'>";
        echo "<div class='form-group'><div class='col-lg-6'>";
	echo form_label('Data de alteração:&nbsp&nbsp');
	echo form_label(formatar_data($genero->data_alteracao));	
        echo "</div></div></div>";
        
        echo "<br>";
        
        echo "<div class='row'>";
        echo "<div class='form-group'><div class='col-lg-6'>";
        echo "<div align='right'>";
        echo "<a class='btn btn-danger fa fa-step-backward' href='../generos'> &nbsp;&nbsp;Voltar</a>";
        echo "</div></div></div>";   
        
    echo form_fieldset_close();             
    
}