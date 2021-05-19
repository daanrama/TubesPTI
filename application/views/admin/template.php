<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> <?= $title ?> | Surat Telkom</title>
    <link rel="shortcut icon" href="<?= base_url('assets/dist/img/logo.png') ?>" type="image/x-icon">
    <link rel="icon" href="<?= base_url('assets/dist/img/logo.png') ?>" type="image/x-icon">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?= base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/bower_components/font-awesome/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/bower_components/Ionicons/css/ionicons.min.css') ?>">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/AdminLTE.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/skins/_all-skins.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url().'assets/jquery-ui/jquery-ui.css'?>">
    <style>
        .ui-autocomplete {
            position: absolute;
            z-index: 99999 !important;
            cursor: default;
            padding: 0;
            margin-top: 2px;
            list-style: none;
            background-color: #ffffff;
            border: 1px solid #ccc -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        }

        .ui-autocomplete>li {
            padding: 3px 20px;
        }

        .ui-autocomplete>li.ui-state-focus {
            background-color: #DDD;
        }

        .ui-helper-hidden-accessible {
            display: none;
        }
    </style>

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <script src="<?= base_url('assets/bower_components/jquery/dist/jquery.min.js') ?>"></script>
    <script src="<?php echo base_url().'assets/jquery-ui/jquery-ui.js'?>" type="text/javascript"></script>

</head>

<body class="hold-transition skin-red sidebar-mini">
    <div class="wrapper">

        <header class="main-header">

            <!-- Logo -->
            <a href="<?= base_url('admin') ?>" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>ST</b></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg">
                    <!-- <img src="<?= base_url('assets/dist/img/logo.png') ?>" alt=""> -->
                    <b>Surat Telkom</b>
                </span>
            </a>

            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?= base_url('assets/img/avatar.jpg') ?>" class="user-image" alt="User Image">
                                <span class="hidden-xs"><?= $this->session->userdata('nama_lengkap') ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="<?= base_url('assets/img/avatar.jpg') ?>" class="img-circle" alt="User Image">
                                    <p> <?= $this->session->userdata('nama_lengkap')?></p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?= base_url('auth/ubahpassword') ?>" class="btn btn-default btn-flat">Ubah Password</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?= base_url('auth/logout') ?>" onclick="return confirm('apakah anda yakin?')" class="btn btn-default btn-flat">Logout</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>

            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="<?= base_url('assets/img/avatar.jpg') ?>" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p><?= $this->session->userdata('nama_lengkap') ?></p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Jabatan : <?= $this->session->userdata('instansi')?></a>
                    </div>
                </div>
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="<?= ($title == 'Admin') ? 'active' : '' ?>">
                        <a href="<?= base_url('admin') ?>">
                            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                        </a>
                    </li>
                    <?php if($this->session->userdata('hak_akses')=='user' ): ?>
                    <li class="treeview <?= ($title == 'Kirim' || $title == 'Cek' || $title == 'Admin List' || $title == 'Denda') ? 'active' : '' ?>">
						<a href="#">
							<i class="fa fa-database"></i>
							<span>Surat</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="<?= ($title == 'Kirim') ? 'active' : '' ?>"><a href="<?= base_url('kirim') ?>"><i class="fa fa-circle-o"></i> Kirim</a></li>
							<li class="<?= ($title == 'Cek') ? 'active' : '' ?>"><a href="<?= base_url('cek') ?>"><i class="fa fa-circle-o"></i> Cek Verifikasi</a></li>
						</ul>
	        		</li>
                    <?php elseif($this->session->userdata('hak_akses')=='superuser' ): ?>
                    <li class="<?= ($title == 'Verifikasi') ? 'active' : '' ?>">
                        <a href="<?= base_url('kirim/verif') ?>">
                            <i class="fa fa-file-text-o"></i> <span>Verifikasi</span>
                        </a>
                    </li>
                    <?php else: ?>
                    <li class="<?= ($title == 'Laporan') ? 'active' : '' ?>">
                        <a href="<?= base_url('laporan') ?>">
                            <i class="fa fa-file-text-o"></i> <span>Laporan</span>
                        </a>
                    </li>
                    <li class="<?= ($title == 'Tambah Anggota') ? 'active' : '' ?>">
                    <a href="<?= base_url('admin/list') ?>"><i class="fa fa-circle-o"></i> Kelola Pengguna</a></li>
                    <?php endif; ?>
                    <li>
                        <a href="<?= base_url('auth/logout') ?>" onclick="return confirm('apakah anda yakin?')">
                            <i class="fa fa-sign-out"></i> <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <?= $contents ?>
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 1.0.0
            </div>
            <strong>Copyright &copy; <?= date('Y') ?> <a href="">PT Telkom Akses </a>.</strong> All rights
            reserved.
        </footer>
    </div>

    <script src="<?= base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= base_url('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') ?>"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url('assets/bower_components/fastclick/lib/fastclick.js') ?>"></script>
    <script src="<?= base_url('assets/dist/js/adminlte.min.js') ?>"></script>
    <script src="<?= base_url('assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') ?>"></script>
    <script src="<?= base_url('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') ?>"></script>
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script>
        $(function() {

            setTimeout(() => {
                $('.alert').fadeOut();
            }, 3000);

            $('#dataTable').DataTable({
                "columnDefs": [{
                    "orderable": false,
                    "targets": [-1]
                }],
                responsive: true
            });

            $(".show-password").on('click', function() {
                if ($(this).hasClass('show')) {
                    $('#password').attr("type", "text");
                    $(this).removeClass('show');
                    $(this).addClass('sembunyi');
                    $(this).html('Sembunyikan Password');
                } else {
                    $('#password').attr("type", "password");
                    $(this).removeClass('sembunyi');
                    $(this).addClass('show');
                    $(this).html('Tampil Password');
                }
            });
        })
    </script>
</body>

</html>