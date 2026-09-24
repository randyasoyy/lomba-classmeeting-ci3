<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Lomba Baru</title>
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
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            width: 450px;
        }

        h1 {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            text-align: center;
            margin-bottom: 20px;
            font-size: 20px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-size: 14px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #cccccc;
            border-radius: 6px;
            font-size: 14px;
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            border-radius: 20px;
            background-color: #28a745;
            font-weight: bold;
            color: white;
            border: none;
            cursor: pointer;
            margin-bottom: 10px;
        }

        .btn-submit:hover {
            background-color: #218838;
        }

        .btn-cancel {
            width: 100%;
            padding: 12px;
            border-radius: 20px;
            background-color: #dc3545;
            font-weight: bold;
            color: white;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-cancel:hover {
            background-color: #c82333;
        }

        .alert {
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
    </style>
</head>

<body>
    <div class="card">
        <h1>Tambah Lomba Baru</h1>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger">
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>

        <form method="post" action="<?php echo site_url('classmeeting/simpan_lomba'); ?>">
            <div class="form-group">
                <label for="nama_lomba">Nama Lomba <span style="color:red">*</span></label>
                <input type="text" id="nama_lomba" name="nama_lomba"
                    placeholder="Contoh: Lomba Catur" required autofocus>
            </div>

            <button type="submit" class="btn-submit">Simpan Lomba</button>
        </form>

        <a href="<?php echo site_url('classmeeting'); ?>" class="btn-cancel">Batal</a>
    </div>
</body>

</html>