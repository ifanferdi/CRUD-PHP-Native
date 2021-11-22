<?php
session_start();

if (isset($_SESSION["login"]) == false) {
    header("Location: login.php");
    exit;
}

require "functions.php";
$books = query("SELECT * FROM books ORDER BY judul ASC");
$keyword = "";

if (isset($_POST['search'])) {
    $keyword = $_POST['keyword'];
    $books = cari($keyword);
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
        <div class="row mt-3 mb-4">
            <div class="col-md-10">
                <h2>Data Buku</h2>
            </div>
            <div class="col-md-2 text-end">
                <a href="logout.php" class="btn btn-outline-danger">Logout</a>
            </div>
        </div>

        <div class="row justify-content-between">
            <div class="col-md-2">
                <a class="btn btn-primary" href="tambah.php" role="button">Tambah Data Buku</a>
            </div>
            <div class="col-md-6">
                <form action="" method="POST">
                    <div class="input-group mb-3 text-end">

                        <input type="text" class="form-control" name="keyword" placeholder="Cari judul buku" aria-label="Cari judul buku" aria-describedby="search" autocomplete="off" value="<?= $keyword; ?>">
                        <button class="btn btn-primary col-md-2 " type="submit" name="search" id="search">Cari</button>
                    </div>
                </form>
            </div>
        </div>

        <table class="table table-bordered mt-1">
            <tr class="table-primary">
                <th>No</th>
                <th>Gambar</th>
                <th>Judul</th>
                <th>No ISBN</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
            <?php $i = 1; ?>
            <?php foreach ($books as $book) : ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td><img src="img/<?= $book["gambar"]; ?>" alt="<?= $book["judul"]; ?>" width="80px"></td>
                    <td><?= $book["judul"]; ?></td>
                    <td><?= $book["noisbn"]; ?></td>
                    <td><?= $book["penulis"]; ?></td>
                    <td><?= $book["penerbit"]; ?></td>
                    <td><?= rupiah($book['harga']); ?></td>
                    <td><?= $book["stok"]; ?> pcs</td>
                    <td>
                        <a href="ubah.php?id=<?= $book['id']; ?>">Ubah</a> |
                        <a href="hapus.php?id=<?= $book['id']; ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        </table>
    </div>
</body>
<script src="/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</html>