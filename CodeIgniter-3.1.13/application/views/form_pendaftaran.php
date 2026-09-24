<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Lomba Class Meeting</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: sans-serif;
        }

        .card {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            width: 500px;
        }

        h1 {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            text-align: center;
        }

        .form-group {
            margin-bottom: 18px;
        }

        body {
            background-color: #A9D0F9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            border-radius: 20px;
            font-family: sans-serif;
            background-color: #4622EC;
            font-weight: bold;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="text"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #cccccc;
            border-radius: 6px;
            font-size: 14px;
        }

        textarea {
            height: 100px;
        }

        .alert {
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 14px;
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

        .btn-tambah-lomba {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 15px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-size: 13px;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }

        .btn-tambah-lomba:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <div class="card">
        <h1>Pendaftaran Lomba Class Meeting</h1>
        <br>

        <?php if ($this->session->flashdata('success')) { ?>
            <div class="alert alert-success">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php } ?>

        <?php if ($this->session->flashdata('error')) { ?>
            <div class="alert alert-error">
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php } ?>

        <form method="post" action="<?php echo site_url('classmeeting/proses'); ?>">
            <div class="form-group">
                <label for="nama">Nama Perwakilan<span style="color: red">*</span></label>
                <input type="text" id="nama" name="nama" required>
            </div>

            <div class="form-group">
                <label for="kelas">Kelas<span style="color: red">*</span></label>
                <select id="kelas" name="kelas" required>
                    <option value="" disabled selected></option>
                    <option value="X RPL 1">X RPL 1</option>
                    <option value="XI RPL 1">XI RPL 1</option>
                    <option value="XII RPL 1">XII RPL 1</option>
                    <option value="X TKJ 1">X TKJ 1</option>
                    <option value="XI TKJ 1">XI TKJ 1</option>
                    <option value="XII TKJ 1">XII TKJ 1</option>
                    <option value="X DKV 1">X DKV 1</option>
                    <option value="XI DKV 1">XI DKV 1</option>
                    <option value="XII DKV 1">XII DKV 1</option>
                    <option value="X TRANS">X TRANS</option>
                    <option value="XI TRANS">XI TRANS</option>
                    <option value="XII TRANS">XII TRANS</option>
                </select>
            </div>

            <div class="form-group">
                <label for="no_telepon">Nomor HP (perwakilan saja)<span style="color: red">*</span></label>
                <input type="number" id="no_telepon" name="no_telepon" required>
            </div>

            <div class="form-group">
                <label>Pilihan Lomba<span style="color: red">*</span></label><br>

                <?php
                $lomba_baru_id = $this->session->flashdata('lomba_baru_id');
                ?>

                <?php if (!empty($lomba)) { ?>
                    <?php foreach ($lomba as $item) { ?>
                        <input type="radio"
                            id="lomba_<?php echo $item['id']; ?>"
                            name="lomba"
                            value="<?php echo html_escape($item['nama_lomba']); ?>"
                            <?php if ($lomba_baru_id == $item['id']) {
                                echo 'checked';
                            } ?>
                            required>
                        <label for="lomba_<?php echo $item['id']; ?>">
                            <?php echo html_escape($item['nama_lomba']); ?>
                        </label><br>
                    <?php } ?>
                <?php } else { ?>
                    <p style="color: red;">Belum ada pilihan lomba di database.</p>
                <?php } ?>

                <a href="<?php echo site_url('classmeeting/tambah_lomba'); ?>" class="btn-tambah-lomba">
                     Tambah Lomba
                </a>
            </div>

            <div class="form-group">
                <label for="anggota">Nama Anggota<span style="color: red">*</span></label>
                <textarea id="anggota" name="anggota" required></textarea>
            </div>

            <div class="form-group">
                <input type="checkbox" id="setuju" name="setuju" value="setuju" required>
                <label for="setuju">Kami menyatakan bahwa data yang diisi benar dan siap mematuhi seluruh peraturan lomba class meeting.</label>
            </div>

            <button type="submit" name="submit" class="btn-submit">Kirim</button>
        </form>
    </div>
</body>

</html>