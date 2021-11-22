<?php
session_start();

if (isset($_SESSION["login"]) == false) {
    header("Location: login.php");
    exit;
}
require 'functions.php';

if (isset($_POST["submit"])) {

    if (tambah($_POST) > 0) {
        echo "
        <script>
        alert('Berhasil menyimpan data');
        document.location.href = 'index.php';
        </script>";
    } else {
        echo "
        <script>
        alert('Gagal menyimpan data');
        document.location.href = 'index.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Pendataan Buku</title>
</head>

<body>

    <div class="container">
        <h2 class="mt-3">Tambah Data Buku</h2>

        <div class="col-md-6 mt-3">

            <form action="" method="post" class="row g-3 needs-validation" enctype="multipart/form-data" novalidate>
                <div class="col-md-12">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control" name="judul" id="judul" placeholder="Masukkan Judul" required>
                </div>
                <div class="col-md-12">
                    <label for="noisbn" class="form-label">No ISBN</label>
                    <input type="text" class="form-control" name="noisbn" id="noisbn" placeholder="Masukkan No ISBN" required>
                </div>
                <div class="col-md-12">
                    <label for="penulis" class="form-label">Penulis</label>
                    <input type="text" class="form-control" name="penulis" id="penulis" placeholder="Masukkan Penulis" required>
                </div>
                <div class="col-md-12">
                    <label for="penerbit" class="form-label">Penerbit</label>
                    <input type="text" class="form-control" name="penerbit" id="penerbit" placeholder="Masukkan Penerbit" required>
                </div>
                <div class="col-md-12">
                    <label for="harga" class="form-label">Harga</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">Rp.</span>
                        <input type="text" class="form-control" name="harga" id="harga" placeholder="Masukkan Harga" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="stok" class="form-label">Stok</label>
                    <input type="text" class="form-control" name="stok" id="stok" placeholder="Masukkan Stok" required>
                </div>
                <div class="col-md-12">
                    <label for="gambar" class="form-label">Gambar</label>
                    <input type="file" class="form-control" name="gambar" id="gambar" required>
                </div>
                <div class="col-md-4 mb-5">
                    <button type="submit" class="btn btn-primary me-2" name="submit">Simpan</button>
                    <a href="index.php" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>

</body>
<script src="/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>

</html>