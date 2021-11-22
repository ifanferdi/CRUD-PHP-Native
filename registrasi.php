<?php
session_start();

if (isset($_SESSION["login"]) == true) {
    header("Location: index.php");
    exit;
}
require "functions.php";

if (isset($_POST["register"])) {
    if (register($_POST) > 0) {
        echo "
        <script>
        alert('Pendaftaran berhasil');
        document.location.href = 'login.php';
        </script>";
    } else {
        echo mysqli_error($conn);
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
    <title>Registrasi</title>
</head>

<body class="bg-primary ">
    <div class="col-lg-6 mx-auto">
        <div class="card text-center rounded-3 shadow-lg my-5">
            <div class="card-body">
                <div class="p-5">
                    <form action="" method="POST">
                        <h1 class="h4 fw-normal mb-4">Registrasi Akun</h1>
                        <hr class="mb-4">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-pill" name="username" id="username" placeholder="Username">
                            <label for="username">Username</label>
                        </div>
                        <div class="row">
                            <div class="form-floating mb-3 col-lg-6">
                                <input type="password" class="form-control rounded-pill" name="password" id="password" placeholder="Password">
                                <label for="password" class="ps-4">Password</label>
                            </div>
                            <div class="form-floating mb-3 col-lg-6">
                                <input type="password" class="form-control rounded-pill" name="password2" id="password2" placeholder="Ulangi Password">
                                <label for="password2" class="ps-4">Ulangi Password</label>
                            </div>
                        </div>

                        <button type="submit" name="register" class="form-control btn btn-primary rounded-pill mb-2 p-2">Registrasi</button>
                        <hr class="mb-4">
                        <a class="small text-decoration-none" href="login.php">Sudah punya akun?</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</html>