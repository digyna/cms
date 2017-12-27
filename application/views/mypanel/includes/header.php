<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie ie9" lang="<?php echo current_language_code();?>" class="no-js"> <![endif]-->
<!--[if !(IE)]><!-->
<html lang="<?php echo current_language_code();?>" class="no-js">
<!--<![endif]-->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <base href="<?php echo base_url('assets/');?>" />
    <skin name="<?php echo get_skin();?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   
    <title><?php echo $this->lang->line('module_'.$controller_name) . ' | ' . $this->config->item('company'); ?></title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <!-- end Google Fonts -->
    <?php if ((DEBUG == 'true')) : ?>

    <!-- bower:css -->
    <link rel="stylesheet" href="../bower_components/jquery-ui/themes/base/jquery-ui.css" />
    <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.css" />
    <link rel="stylesheet" href="../bower_components/bootstrap-select/dist/css/bootstrap-select.css" />
    <link rel="stylesheet" href="../bower_components/waves/dist/waves.css" />
    <link rel="stylesheet" href="../bower_components/animate.css/animate.css" />
    <link rel="stylesheet" href="../bower_components/sweetalert/dist/sweetalert.css" />
    <link rel="stylesheet" href="../bower_components/fullcalendar/dist/fullcalendar.css" />
    <link rel="stylesheet" href="../bower_components/bootstrap-table/src/bootstrap-table.css" />
    <!-- endbower -->

    <!-- start css template tags -->
    <link rel="stylesheet" type="text/css" href="../assets/mypanel/src/css/materialize.css"/>
    <link rel="stylesheet" type="text/css" href="../assets/mypanel/src/css/login.css"/>
    <link rel="stylesheet" type="text/css" href="../assets/mypanel/src/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="../assets/mypanel/src/css/themes/all-themes.css"/>
    <!-- end css template tags -->
    <?php else : ?>
    <!-- start mincss template tags -->
    <link rel="stylesheet" type="text/css" href="../assets/mypanel/dist/css/digyna-cms.min.css?rel=35908dacc0"/>
    <!-- end mincss template tags -->
    <?php endif; ?>
    
</head>
<body class="theme-<?php echo get_skin(); ?>">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-<?php echo get_skin(); ?>">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p><?php echo $this->lang->line('common_load');?></p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="<?php echo base_url();?>"><img src="<?php echo base_url('assets/mypanel/img/digyna_white.png');?>" style="width: 135px;" alt="Digyna Logo"/></a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <?php $this->load->view("mypanel/includes/menu"); ?>