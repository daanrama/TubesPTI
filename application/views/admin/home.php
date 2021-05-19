<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Info boxes -->
    <div class="row">
        <?php if($this->session->userdata('hak_akses')=='user'): ?>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-book"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Surat<br>Terkirim</span>
                    <span class="info-box-number"><?= $jml_surat ?></span>
                    <a href="<?= base_url('kirim') ?>">lihat selengkapnya ></a>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <?php endif; ?>
                <?php if($this->session->userdata('hak_akses')=='superuser'): ?>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-book"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Surat<br>Masuk</span>
                    <span class="info-box-number"><?= $masuk ?></span>
                    <a href="<?= base_url('kirim/verif') ?>">lihat selengkapnya ></a>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <?php endif; ?>
        <!-- /.col -->
        
                <?php if($this->session->userdata('hak_akses')=='admin' ): ?>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-user"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Jumlah<br>Pengguna</span>
                    <span class="info-box-number"><?= $jumlah ?></span>
                    <a href="<?= base_url('/admin/list') ?>">lihat selengkapnya ></a>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <?php endif; ?>
        
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-book"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Surat<br>Terverifikasi</span>
                    <span class="info-box-number"><?= $verif ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-book"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Surat<br>Ditolak</span>
                    <span class="info-box-number"><?= $tolak ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        
        
    </div>
	<?php if($this->session->userdata('hak_akses')=='admin'|| 'superuser'): ?>
    <!-- /.row -->
    <h3>Pengumuman</h3>
    <p>
        Mohon Setiap Pengguna melakukan pengiriman surat dengan benar.<br>
        Terimakasih.
    </p>
    <div class="row ">
       	<div class="col-xs-12">
       	</div>
    </div>
	<?php endif; ?>									
</section>
<!-- /.content -->

<!-- /.modal -->