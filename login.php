<?php
session_start();
require "functions.php";

if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE id = '$id'");
    $data = mysqli_fetch_assoc($result);

    if ($key == hash('sha256', $data['username'])) {
        $_SESSION["login"] = true;
    }
}


if (isset($_SESSION["login"]) == true) {
    header("Location: index.php");
    exit;
}


if (isset($_POST['submit'])) {
    global $conn;
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

    if (mysqli_num_rows($result) == 1) {

        $data = mysqli_fetch_assoc($result);

        if (password_verify($password, $data['password'])) {

            //set session
            $_SESSION["login"] = true;

            //set remember me
            if (isset($_POST['remember'])) {

                setcookie('id', $data['id'], time() + (60 * 60));
                setcookie('key', hash('sha256', $data['username']), time() + (60 * 60));
            }

            header("Location: index.php");
        } else {
            $error['password'] = true;
        }
    } else {
        $error['username'] = true;
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
    <title>Login</title>
</head>

<body class="bg-primary ">
    <div class="col-lg-6 mx-auto">
        <div class="card text-center rounded-3 shadow-lg my-5">
            <div class="card-body">
                <div class="p-5">
                    <form action="" method="post">
                        <h1 class="h4 fw-normal mb-4">Login!</h1>
                        <hr class="mb-4">
                        <?php if (isset($error['username'])) : ?>
                            <div class="alert alert-danger text-start" role="alert">
                                Username tidak terdaftar
                            </div>
                        <?php endif; ?>
                        <?php if (isset($error['password'])) : ?>
                            <div class="alert alert-danger text-start" role="alert">
                                Password tidak cocok
                            </div>
                        <?php endif; ?>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-pill" name="username" id="username" placeholder="Username">
                            <label for="username">Username</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control rounded-pill" name="password" id="password" placeholder="Password">
                            <label for="password">Password</label>
                        </div>
                        <div class="form-check mb-3 text-start ms-2">
                            <input class="form-check-input" type="checkbox" value="" name="remember" id="remember">
                            <label class="form-check-label" for="remember">
                                Remember Me
                            </label>
                        </div>
                        <button type="submit" name="submit" class="form-control btn btn-primary rounded-pill mb-2 p-2">Login</button>
                        <hr class="mb-4">
                        <a class="small text-decoration-none" href="registrasi.php">Regsitrasi Akun</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</html>