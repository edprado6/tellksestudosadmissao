<?php
if(isset($autor))
{
    echo form_fieldset('Autores');
       
        echo "<div class='row'>";
        echo "<div class='form-group'><div class='col-lg-6'>";
	echo form_label('Id:&nbsp&nbsp');
	echo form_label($autor->id);	
        echo "</div></div></div>";    
    
        echo "<div class='row'>";
        echo "<div class='form-group'><div class='col-lg-6'>";
	echo form_label('Nome do Autor:&nbsp&nbsp');
	echo form_label($autor->nome_autor);	
        echo "</div></div></div>";
        
        echo "<div class='row'>";
        echo "<div class='form-group'><div class='col-lg-6'>";
	echo form_label('Data de cadastro:&nbsp&nbsp');
	echo form_label(formatar_data($autor->data_cadastro));	
        echo "</div></div></div>";
        
        echo "<div class='row'>";
        echo "<div class='form-group'><div class='col-lg-6'>";
	echo form_label('Data de alteração:&nbsp&nbsp');
	echo form_label(formatar_data($autor->data_alteracao));	
        echo "</div></div></div>";
        
        echo "<br>";
        
        echo "<div class='row'>";
        echo "<div class='form-group'><div class='col-lg-6'>";
        echo "<div align='right'>";
        echo "<a class='btn btn-danger fa fa-step-backward' href='../autores'> &nbsp;&nbsp;Voltar</a>";
        echo "</div></div></div>";   
        
    echo form_fieldset_close();             
    
}