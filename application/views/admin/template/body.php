<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo APP_NAME  ." | ". APP_DESCRIPTION ?></title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/fontawesome-free/css/all.min.css">
        <!-- adminlte-->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/css/adminlte.min.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/css/custom.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/css/magnific-popup.css">

        <script src="<?php echo base_url() ?>assets/adminlte/jquery/jquery.js"></script>     


    </head>
    <body class="hold-transition sidebar-mini pace-primary">
        <!-- Site wrapper -->
        <div class="wrapper">
          
        	<?php $this->load->view("admin/template/navbar") ?>

        	<?php $this->load->view("admin/template/aside") ?>
            

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                            	<h3>{title}</h3>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#"></a></li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <!--<h3 class="card-title">Bordered Table</h3> -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                    
                            

                            <?php echo (isset($body)) ?  $body : '' ?>

                            <?php (isset($grocery_crud)) ? $this->load->view("admin/template/grocery_crud",["grocery_crud" => $grocery_crud]) : '' ?>
                        </div>
                        <!-- /.card-body -->

                    </div>
                    <!-- /.card -->

                </section>
                <!-- /.content -->
            </div>
           
           	<?php $this->load->view("admin/template/footer") ?>
            <!-- /.content-wrapper -->

            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->
		

        <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>

        <!-- AdminLTE App -->
        <script src="<?php echo base_url() ?>assets/adminlte/js/adminlte.min.js"></script>
        <script src="<?php echo base_url() ?>assets/adminlte/js/main.js"></script>
        <script src="<?php echo base_url() ?>assets/adminlte/js/magnific-popup.js"></script>

		<script src="//cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
        
    </body>
</html>
