<!DOCTYPE html>
<html>
<head>
    <title>Laporan Transaksi</title>
    <style>
        #customers {
          font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
          border-collapse: collapse;
          width: 100%;
        }

        #customers td, #customers th {
          border: 1px solid black;
          padding: 8px;
        }

        #customers tr:hover {background-color: #ddd;}

        #customers th {
          padding-top: 12px;
          padding-bottom: 12px;
          text-align: left;
          background-color: #ddd;
          color: black;
        }
    </style>
</head>
<body>
    <center><h3><?= $judul_laporan ?></h3></center>
    <table width="100%" id="customers">
        <thead>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Nama Pengirim</th>
                <th>Judul Surat</th>
                <th>Tgl Pembuatan</th>
                <th>Tgl Verifikasi</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($transaksi as $trx) : ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $trx['username'] ?></td>
                    <td><?= $trx['nama_lengkap'] ?></td>
                    <td><?= $trx['judul_surat'] ?></td>
                    <td><?= $trx['verifikasi'] ?></td>
                    <td><?= $trx['diverifikasi'] ?></td>
                    <td>
                        <?php if($trx['keterangan'] == 'verif'): ?>Verifikasi
                        <?php elseif($trx['keterangan'] == 'tolak'): ?>Ditolak
                        <?php else: ?>Menunggu Verifikasi
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>