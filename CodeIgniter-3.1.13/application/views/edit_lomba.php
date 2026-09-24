<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Lomba Pendaftaran</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: sans-serif;
        }

        body {
            background-color: #A9D0F9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .card {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            width: 500px;
        }

        h1 {
            font-family: Verdana;
            text-align: center;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            border-radius: 20px;
            background-color: #4622EC;
            font-weight: bold;
            color: white;
            border: none;
            margin-bottom: 10px;
        }

        .btn-cancel {
            width: 100%;
            padding: 12px;
            border-radius: 20px;
            background-color: #dc3545;
            font-weight: bold;
            color: white;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        .info-box {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            border-left: 4px solid #4622EC;
        }

        .info-box p {
            margin: 6px 0;
            font-size: 14px;
            color: #333;
        }

        .info-box strong {
            color: #4622EC;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="card">
        <h1>Edit Lomba Pendaftaran</h1>
        <br>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
        <?php endif; ?>

        <div class="info-box">
            <p><strong>Nama Perwakilan:</strong> <?php echo html_escape($pendaftar['nama']); ?></p>
            <p><strong>Kelas:</strong> <?php echo html_escape($pendaftar['kelas']); ?></p>
            <p><strong>Lomba Saat Ini:</strong> <?php echo html_escape($pendaftar['lomba']); ?></p>
        </div>

        <form method="post" action="<?php echo site_url('classmeeting/update_lomba'); ?>">
            <input type="hidden" name="id" value="<?php echo $pendaftar['id']; ?>">

            <div class="form-group">
                <label for="nama_lomba">Pilih Lomba Baru <span style="color:red">*</span></label>
                <select id="nama_lomba" name="nama_lomba" required>
                    <option value="" disabled></option>
                    <?php foreach ($lomba as $item): ?>
                        <option value="<?php echo html_escape($item['nama_lomba']); ?>"
                            <?php echo ($pendaftar['lomba'] == $item['nama_lomba']) ? 'selected' : ''; ?>>
                            <?php echo html_escape($item['nama_lomba']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn-submit">Update Lomba</button>
        </form>

        <a href="<?php echo site_url('classmeeting/output'); ?>" class="btn-cancel">Batal</a>
    </div>
</body>

</html>