<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
</head>
<style>
        body {
            font-family: sans-serif;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 1500px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .btn-tambah {
            display: inline-block;
            padding: 10px 20px;
            background-color: blue;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
        }


        .btn-edit {
            padding: 5px 10px;
            background-color: #ffc107;
            color: #000;
            border-radius: 3px;
        }

        .btn-edit {
            background-color: #e0a800;
        }

        .btn-hapus {
            padding: 5px 10px;
            background-color: #dc3545;
            color: white;
            border-radius: 3px;
            border: none;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #f8f9fa;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .alert {
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .action-buttons {
            display: flex;
            gap: 5px;
        }

        .no-data {
            text-align: center;
            padding: 20px;
            color: #6c757d;
        }

        .delete-form {
            display: inline;
        }
    </style>
</head>

<body>
        <h1>Data Pendaftaran Lomba Class Meeting</h1>

        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-error"><?php echo $this->session->flashdata('error'); ?></div>
        <?php endif; ?>

        <br>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID</th>
                    <th>Nama Perwakilan</th>
                    <th>Kelas</th>
                    <th>No Telepon</th>
                    <th>Lomba</th>
                    <th>Anggota</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($pendaftar)) {
                    $no = 1;
                    foreach ($pendaftar as $row) {
                ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo html_escape($row['nama']); ?></td>
                            <td><?php echo html_escape($row['kelas']); ?></td>
                            <td><?php echo html_escape($row['no_telepon']); ?></td>
                            <td><?php echo html_escape($row['lomba']); ?></td>
                            <td><?php echo nl2br(html_escape($row['anggota'])); ?></td>

                            <td>
                                   <a href="<?php echo site_url('classmeeting/edit_lomba/' . $row['id']); ?>">Edit</a>
                                    <form class="delete-form" method="post" action="<?php echo site_url('classmeeting/delete/' . $row['id']); ?>"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                        <button type="submit" class="btn-hapus">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="10" class="no-data">Belum ada data pendaftaran.</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>