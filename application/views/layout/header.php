<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <title><?php if(isset($nome_sistema )) {echo $nome_sistema; }?></title>
    
    
    <?php //echo link_tag('assets/css/custom.css'); ?>
         
    <?php echo link_tag('assets/bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>
    <?php echo link_tag('assets/bower_components/metisMenu/dist/metisMenu.min.css'); ?>
    <?php echo link_tag('assets/dist/css/timeline.css'); ?>
    <?php echo link_tag('assets/dist/css/sb-admin-2.css'); ?>
    <?php echo link_tag('assets/bower_components/morrisjs/morris.css'); ?>
    <?php echo link_tag('assets/bower_components/font-awesome/css/font-awesome.min.css'); ?>
    
    
</head>
<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html"><?php if(isset($nome_sistema )) {echo $nome_sistema; }?></a>
            </div><!-- /.navbar-header -->


            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="#"><i class="fa fa-book"></i> Produtos<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="../produtos"><i class="fa fa-list "></i> Listar</a>
                                </li>
                                <li>
                                    <a href="../produtos/cadastrar"><i class="fa  fa-plus"></i> Adicionar</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="#"><i class="fa  fa-user"></i> Categorias<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="../categorias"><i class="fa fa-list "></i> Listar</a>
                                </li>
                                <li>
                                    <a href="../categorias/cadastrar"><i class="fa  fa-plus"></i> Adicionar</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>                        

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>        
    </div>    
