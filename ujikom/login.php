<?php

include 'koneksi.php';
session_start();


if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $simpan = $conn->query("SELECT * FROM user WHERE username = '$username' AND password = '$password'")->fetch_assoc();



    if ($simpan > 0) {
        $_SESSION['user'] = $simpan;
        $_SESSION['id_user'] = $simpan['id_users'];

        echo '<script>alert("mantap")
        location.replace("index.php"); </script>';
    }
}





?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <title>Login</title>
</head>

<body>
    <div class="container pt-5">
        <div class="row justify-content-center pt-5">
            <div class="col-lg-5">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="text-center">login rek</h3>
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control form-control-lg" id="username" name="username" placeholder="Masukan Nama Anda" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Masukan password Anda" required>
                            </div>
                            <button class="btn btn-primary btn-lg w-100" type="submit" name="submit">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>