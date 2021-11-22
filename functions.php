<?php
$conn = mysqli_connect('localhost', 'root', '', 'belajar_php');

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function rupiah($harga)
{
    $format_rupiah = "Rp. " . number_format($harga, 2, ',', '.');
    return $format_rupiah;
}

function tambah($data)
{
    global $conn;
    $judul = htmlspecialchars($data['judul']);
    $noisbn = htmlspecialchars($data['noisbn']);
    $penulis = htmlspecialchars($data['penulis']);
    $penerbit = htmlspecialchars($data['penerbit']);
    $harga = htmlspecialchars($data['harga']);
    $stok = htmlspecialchars($data['stok']);

    $gambar = upload();
    if ($gambar == false) {
        return false;
    }

    $query = "INSERT INTO books VALUES 
    (
        '', '$judul', '$noisbn', '$penulis', '$penerbit', '$harga', '$stok', '$gambar'
    )";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload()
{
    $namaFile = $_FILES['gambar']['name'];
    $sizeFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    if ($error == 4) {
        echo "
            <script>
                alert('Mohon pilih gambar buku');
            </script>";
        return false;
    }

    $typeGambar = ['jpg', 'jpeg', 'png'];
    $splitGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($splitGambar));

    if (in_array($ekstensiGambar, $typeGambar) == false) {
        echo "
            <script>
                alert('Mohon pilih type file gambar');
            </script>";
        return false;
    }

    if ($sizeFile > 15000000) {
        echo "
            <script>
                alert('Mohon pilih gambar dengan ukuran dibawah 15 mb');
            </script>";
        return false;
    }

    $namaFileBaru = uniqid() . '.' . $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}

function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM books WHERE id=$id");
    return mysqli_affected_rows($conn);
}

function ubah($data)
{
    global $conn;
    $id = htmlspecialchars($data['id']);
    $judul = htmlspecialchars($data['judul']);
    $noisbn = htmlspecialchars($data['noisbn']);
    $penulis = htmlspecialchars($data['penulis']);
    $penerbit = htmlspecialchars($data['penerbit']);
    $harga = htmlspecialchars($data['harga']);
    $stok = htmlspecialchars($data['stok']);

    $gambar = '';
    $gambarLama = htmlspecialchars($data['gambarLama']);

    if ($_FILES['gambar']['error'] == 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    $query = "UPDATE books SET
                judul = '$judul', 
                noisbn = '$noisbn', 
                penulis = '$penulis', 
                penerbit = '$penerbit', 
                harga = '$harga', 
                stok = '$stok', 
                gambar = '$gambar' 
                WHERE id = $id";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function cari($keyword)
{
    $query = "SELECT * FROM books 
                WHERE 
                    judul LIKE '%$keyword%' OR 
                    noisbn LIKE '%$keyword%' OR 
                    penulis LIKE '%$keyword%' OR 
                    penerbit LIKE '%$keyword%'";
    return query($query);
}

function register($data)
{
    global $conn;
    $username = strtolower(stripslashes($data['username']));
    $password = mysqli_real_escape_string($conn, $data['password']);
    $password2 = mysqli_real_escape_string($conn, $data['password2']);

    $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
        alert('Username telah digunakan');
        </script>";
        return false;
    }

    if ($password != $password2) {
        echo "<script>
        alert('Password tidak cocok');
        </script>";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users VALUES ('', '$username', '$password')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function login($data)
{
    global $conn;
    $username = $data['username'];
    $password = $data['password'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            header("Location: index.php");
        } else {
            $error['password'] = true;
        }
    } else {
        $error['username'] = true;
    }
}
