<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Cek Verifikasi Surat
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url('home') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Surat</li>
        <li class="active">Cek Verifikasi</li>
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
                                <th>Judul Surat</th>
                                <th>No. Surat</th>
                                <th>Tanggal</th>
                                <th class="text-center">Catatan</th>
                                <th class="text-center">Status</th>
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
                                    <td><?= $row['note'] ?></td>
                                    <td class="text-center">
                                    <?php if($row['keterangan'] == 'verif'): ?>
                                        <a href="<?= base_url('assets/surat/'.$row['file']); ?>" class="btn btn-sm btn-success">Terverifikasi</a>
                                        <?php elseif($row['keterangan'] == 'tolak'): ?>
                                        <a href="#" class="btn btn-sm btn-danger">Ditolak</a>
                                    <?php else: ?>
                                        <a href="#" class="btn btn-sm btn-success disabled">Menunggu Verifikasi</a>
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
            <form id="form" action="<?= base_url('kartu/userverif') ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
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
            $('#form').attr('action', '<?= base_url('kirim/userverif') ?>');
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
                    $('#no_surat').val(data.no_surat);
                    $('#nama_penerima').val(data.nama_penerima);
                }
            })
        });

    });
</script>