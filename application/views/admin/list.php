<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Kelola Pengguna
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url('home') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tambah Pengguna</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <?= $this->session->flashdata('message'); ?>
            <button id="addBuku" class="btn btn-outline" data-toggle="modal" data-target="#modal-default">+ Tambah Data</button>
            <div class="box" style="margin-top: 10px;">
                <div class="box-body">
                    <table id="dataTable" class="table display responsive nowrap" style="width:100%">
                        <thead class="bg-red">
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Nama Lengkap</th>
                                <th>Jabatan</th>
                                <th>Role</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $id = $this->session->userdata('username');
                                $i = 1;
                            foreach ($admin as $row) : ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $row['username'] ?></td>
                                    <td><?= $row['nama_lengkap'] ?></td>
                                    <td><?= $row['instansi'] ?></td>
                                    <td><?php if($row['status'] == 0): ?>Admin
                                        <?php elseif($row['status'] == 1): ?>Super User
                                        <?php else: ?>User
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-warning edit" data-toggle="modal" data-target="#modal-default" data-id="<?= $row['id']; ?>"><i class="fa fa-edit"></i></button>
                                        <?php if($row['username'] == $id): ?>
                                        <a href="#" class="btn btn-sm btn-danger disabled"><i class="fa fa-trash"></i></a>
                                        <?php else: ?>
                                        <a href="<?= base_url('admin/delete/' . $row['id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('apakah anda yakin?')"><i class="fa fa-trash"></i></a>
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
                <h4 class="modal-title">Tambah Pengguna</h4>
            </div>
            <form id="form" action="<?= base_url('admin/add') ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="instansi">Jabatan</label>
                        <input type="text" name="instansi" id="instansi" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                        <small class="text-warning">*Kosongkan jika tidak ingin mengubah password</small>
                    </div>
                    <div class="form-group">
                        <label for="konfir_pass">Konfirmasi Password</label>
                        <input type="password" name="konfir_pass" id="konfir_pass" class="form-control" required>
                        <small class="text-warning">*Kosongkan jika tidak ingin mengubah password</small>
                    </div>
                    <div class="form-group">
                        <label for="status">Role</label>
                        <select id="status" name="status" class="form-control">
                        <option value="2">User</option>
                        <option value="1">Super User</option>
                        <option value="0">Admin</option>
                        </select>
                        <small class="text-warning">*Pastikan Role Pengguna telah benar</small>
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
        $('#addBuku').on('click', function() {
            $('.modal-title').html('Tambah Pengguna');
            $('#form').attr('action', '<?= base_url('admin/add') ?>');
            $('#username').attr('readonly', false);
            $('#password').attr('required', true);
            $('#konfir_pass').attr('required', true);
            $('#username').val('');
            $('#nama_lengkap').val('');
            $('#instansi').val('');
            $('#password').val('');
            $('#konfir_pass').val('');
            $('#status').val('');
            $('.text-warning').fadeOut();
        });

        $(document).on('click', '.edit', function() {
            let id = $(this).data('id');
            $('.modal-title').html('Edit Data Pengguna');
            $('#form').attr('action', '<?= base_url('admin/update/') ?>' + id);
            $('#username').attr('readonly', true);
            $('#password').attr('required', false);
            $('#konfir_pass').attr('required', false);
            $.ajax({
                url: '<?= base_url('admin/getdata/'); ?>'+id,
                method: 'POST',
                dataType: 'JSON',
                data: {id: id },
                success: function(data) {
                    $('#username').val(data.username);
                    $('#nama_lengkap').val(data.nama_lengkap);
                    $('#instansi').val(data.instansi);
                    $('#password').val('');
                    $('#konfir_pass').val('');
                    $('#status').val(data.status);
                    $('.text-warning').fadeIn();
                }
            })
        });

    });
</script>