<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Ubah Password
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url('home') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Ubah Password</li>
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
                                <th>#</th>
                                <th>Username</th>
                                <th>Nama Lengkap</th>
                                <th>Jabatan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($admin as $row) : ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $row['username'] ?></td>
                                    <td><?= $row['nama_lengkap'] ?></td>
                                    <td><?php if($row['status'] == 0): ?>Admin
                                        <?php elseif($row['status'] == 1): ?>Super User
                                        <?php else: ?>User
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-warning edit" data-toggle="modal" data-target="#modal-default" data-id="<?= $row['id']; ?>"><i class="fa fa-edit"></i></button>
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
                <h4 class="modal-title">Ubah Password</h4>
            </div>
            <form id="form" action="<?= base_url('admin/add') ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                        <small class="text-warning">*Masukkan Password dengan benar</small>
                    </div>
                    <div class="form-group">
                        <label for="konfir_pass">Konfirmasi Password</label>
                        <input type="password" name="konfir_pass" id="konfir_pass" class="form-control" required>
                        <small class="text-warning">*Ulangi Password dengan benar</small>
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
        $(document).on('click', '.edit', function() {
            let id = $(this).data('id');
            $('.modal-title').html('Ubah Password Pengguna');
            $('#form').attr('action', '<?= base_url('auth/ubah/') ?>' + id);
            $('#username').attr('readonly','required', true);
            $('#password').attr('required', true);
            $('#konfir_pass').attr('required', true);
            $.ajax({
                url: '<?= base_url('auth/getdata/'); ?>'+id,
                method: 'POST',
                dataType: 'JSON',
                data: {id: id },
                success: function(data) {
                    $('#username').val(data.username);
                    $('#password').val('');
                    $('#konfir_pass').val('');
                    $('.text-warning').fadeIn();
                }
            })
        });

    });
</script>