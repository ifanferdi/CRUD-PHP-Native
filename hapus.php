<?php
session_start();

if (isset($_SESSION["login"]) == false) {
    header("Location: login.php");
    exit;
}
require 'functions.php';

$id = $_GET['id'];

if (hapus($id) > 0) {
    echo "
    <script>
    alert('Berhasil menghapus data');
    document.location.href = 'index.php';
    </script>";
} else {
    echo "
    <script>
    alert('Gagal menghapus data');
    document.location.href = 'index.php';
    </script>";
}
