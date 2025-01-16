<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>AdminLTE 3 | Pace</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/fontawesome-free/css/all.min.css">
        <!-- adminlte-->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/admin/adminlte.min.css">
    </head>
    <body class="hold-transition sidebar-mini pace-primary">
        <!-- Site wrapper -->
        <div class="wrapper">
            <!-- Navbar -->
            <?php $this->load->view("admin/template/header");?>
            <!-- /.navbar -->
            
            <!-- Main Sidebar Container -->
            <?php $this->load->view("admin/template/nav");?>


            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
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
                            <h3 class="card-title">{title}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            {body}
                        </div>
                        <!-- /.card-body -->

                    </div>
                    <!-- /.card -->

                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->
        
        <script src="<?php echo base_url() ?>assets/js/jquery-3.7.1.js"></script>
        
        <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo base_url() ?>assets/js/admin/adminlte.min.js"></script>
        
    </body>
</html>
