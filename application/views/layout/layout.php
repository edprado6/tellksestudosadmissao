
<!-- Partial view -->
<?php $this->load->view('layout/header');?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            
                <p><?php echo $this->session->flashdata('mensagem');?></p>
                               
                <!-- O conteúdo dos métodos é renderizado aqui. -->
                <?php if (isset($conteudo)) { echo $conteudo; } ?>

        </div><!-- /.col-lg-12 -->
    </div><!-- /.row -->
</div><!-- /#page-wrapper -->

<!-- Partial view -->
<?php $this->load->view('layout/footer');
