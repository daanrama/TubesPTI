<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Verifikasi Surat
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url('home') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
     
        <li class="active">Verifikasi</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <?= $this->session->flashdata('message'); ?>
             <div class="box" style="margin-top: 10px;">
                <div class="box-body">
                    <table id="dataTable" class="table display responsive nowrap" style="width:100%">
                        <thead class="bg-red">
                            <tr>
                                <th>No</th>
                                <th>Pengirim</th>
                                <th>Judul Surat</th>
                                <th>No. Surat</th>
                                <th>Tanggal</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($verifikasi as $row) : ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $row['nama_pengirim'] ?></td>
                                    <td><?= $row['judul_surat'] ?></td>
                                    <td><?= $row['no_surat'] ?></td>
                                    <td><?= $row['verifikasi'] ?></td>
                                    <td class="text-center">
                                    <button class="btn btn-sm btn-warning verif" data-id="<?= $row['id'] ?>" data-toggle="modal" data-target="#modal-verif">Detail</button>                               
                                </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
<div class="modal fade" id="modal-verif">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Verifikasi Surat</h4>
        </div>
        <form id="form-verif" action="" method="POST" role="form">
            <div class="modal-body">
                <div class="form-group">
                    <label for="nama_pengirim2">Pengirim</label>
                    <input type="text" class="form-control" id="nama_pengirim2" name="nama_pengirim2" readonly required>
                </div>
                <div class="form-group">
                    <label for="judul_surat2">Judul Surat</label>
                    <input type="text" class="form-control" id="judul_surat2" name="judul_surat2" readonly required>
                </div>
                <div class="form-group">
                    <label for="no_surat2">No Surat</label>
                    <input type="text" class="form-control" id="no_surat2" name="no_surat2" readonly required>
                </div>
                <div class="form-group">
                    <label for="nama_siswa2">Tanggal Kirim</label>
                    <input type="text" class="form-control" id="verifikasi2" name="verifikasi2" readonly required>
                </div>
                <div class="form-group">
                    <label for="file2">File</label><br>
                    <a href="<?= base_url('assets/surat/'.$row['file']); ?>">Download</a>
                    <br>
                    <input type="hidden" class="form-control" id="file2" name="file2" readonly required>
                </div>
                <div class="form-group">
                    <label for="alamat2">Catatan</label>
                    <input type="text" class="form-control" id="note" name="note" required>
                </div>
                <div class="form-group">
                    <label for="diverifikasi">Tanggal Verifikasi</label>
                    <input type="date" class="form-control" id="diverifikasi" value="<?= date('Y-m-d') ?>" name="diverifikasi" required>
                    <small class="text-warning">
                        *Pastikan file telah benar.
                    </small>
                </div>
                <div class="form-group">
                        <input type="radio" id="keterangan" name="keterangan" value="verif"> Verifikasi
                        <input type="radio" id="keterangan" name="keterangan" value="tolak"> Tolak
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
$(document).ready(function(){
    $(document).on('click', '.verif', function(){
        let id = $(this).data('id');
        $('#form-verif').attr('action', "<?php echo site_url('kirim/verifikasi/');?>"+id);
        $.ajax({
            url: "<?php echo site_url('kirim/getdata/');?>"+id,
            method:'GET',
            dataType:'JSON',
            data: {id: id},
            success: function(res){
                $("#nama_pengirim2").val(res.nama_pengirim);
                $("#judul_surat2").val(res.judul_surat);
                $("#no_surat2").val(res.no_surat);
                $("#verifikasi2").val(res.verifikasi);
                $("#file2").val(res.file);
            }
        })
    });
})

</script>