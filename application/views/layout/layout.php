
<!-- Partial view -->
<?php $this->load->view('layout/header');

    // Mensagens diversas exibidas. 
    if (isset($message)) {
    $class = (isset($message['type'])) ? 'alert alert-' . $message['type'] : 'alert alert-info';
    echo '<p class="' . $class . '">' . $message['message'] . '</p>';
    
} ?>

<div class="row">
    
    <div class="col-md-12">        
        
        <!-- O conteúdo dos métodos é renderizado aqui. -->
    	<?php if (isset($conteudo)) { echo $conteudo; } ?>
        
    </div>
    
</div><!-- .row -->

<!-- Partial view -->
<?php $this->load->view('layout/footer');
