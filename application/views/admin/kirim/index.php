<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Kirim Surat
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url('home') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Surat</li>
        <li class="active">Kirim</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <?= $this->session->flashdata('message'); ?>
            <button id="addKirim" class="btn btn-outline" data-toggle="modal" data-target="#modal-default">+ Tambah Data Kirim Surat</button>
            <div class="box" style="margin-top: 10px;">
                <div class="box-body">
                    <table id="dataTable" class="table display responsive nowrap" style="width:100%">
                        <thead class="bg-red">
                            <tr>
                                <th>No</th>
                                <th>Judul Surat</th>
                                <th>No. Surat</th>
                                <th>Tanggal</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($kirim as $row) : ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $row['judul_surat'] ?></td>
                                    <td><?= $row['no_surat'] ?></td>
                                    <td><?= $row['verifikasi'] ?></td>
                                    <td class="text-center">
                                    <?php if($row['keterangan'] == null): ?>    
                                        <button class="btn btn-sm btn-warning edit" data-toggle="modal" data-target="#modal-default" data-id="<?= $row['id']; ?>"><i class="fa fa-edit"></i></button>
                                    <?php else: ?>
                                         <button class="btn btn-sm btn-warning edit disabled"><i class="fa fa-edit"></i></button>
                                    <?php endif; ?>
                                    
                                    <?php if($row['keterangan'] != 'verif'): ?> 
                                        <a href="<?= base_url('kirim/hapus/' . $row['id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('apakah anda yakin?')"><i class="fa fa-trash"></i></a>
                                    <?php else: ?>
                                         <button class="btn btn-sm btn-danger disabled"><i class="fa fa-trash"></i></button>
                                    <?php endif; ?>
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

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Kirim Surat</h4>
            </div>
            <form id="form" action="<?= base_url('kirim/kirimsurat') ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="judul_surat">Judul Surat</label>
                        <input type="text" name="judul_surat" id="judul_surat" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="no_surat">No Surat</label>
                        <input type="text" name="no_surat" id="no_surat" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_penerima">Kepada</label>
                        <input type="text" name="nama_penerima" id="nama_penerima" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="file">File Surat</label>
                        <input type="file" name="file" id="file" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="verifikasi">Tanggal Dibuat</label>
                        <input type="date" name="verifikasi" id="verifikasi" class="form-control" value="<?= date('Y-m-d') ?>" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
    $(document).ready(function() {
        $('#addKirim').on('click', function() {
            $('.modal-title').html('Tambah Kirim Surat');
            $('#form').attr('action', '<?= base_url('kirim/kirimsurat') ?>');
            $('#judul_surat').val('');
            $('#no_surat').val('');
            $('#nama_penerima').val('');
            $('#file').val('');
            $('#file').attr('required', true);
        });

        $(document).on('click', '.edit', function() {
            let id = $(this).data('id');
            $('.modal-title').html('Edit Surat');
            $('#form').attr('action', '<?= base_url('kirim/update/') ?>' + id);
            $('#no_surat').val('');
            $('#file').val('');
            $('#file').attr('required', false);
            $.ajax({
                url: '<?= base_url('kirim/getdata/'); ?>'+id,
                method: 'POST',
                dataType: 'JSON',
                data: {id: id },
                success: function(data) {
                    $('#judul_surat').val(data.judul_surat);
                    $('#no_surat').val(data.no_surat);
                    $('#nama_penerima').val(data.nama_penerima);
                }
            })
        });

    });
</script>