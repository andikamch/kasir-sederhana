<?php

include 'koneksi.php';

session_start();
if (!isset($_SESSION['user'])) {
    echo "<script>alert('Mohon login terlebih dahulu')
  location.replace('login.php')</script>";
}

$tampil = $conn->query("SELECT * FROM products");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="produk">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="col-md-9">
            <div class="row">
                <?php foreach ($tampil as $show) { ?>
                    <div class="col-md-6 mt-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="header pb-3">
                                    <!-- <img class="w-100" src="assets/<?= $show['thumbnail'] ?>" alt=""> -->
                                    <h6 class="fw-bold"><?= $show['name'] ?></h6>
                                    <span class="text-muted"><?= $show['price'] ?></span><br>
                                    <span class="text-muted"><?= $show['stock'] ?></span><br>

                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-end">
                                    <button class="btn btn-sm text-primary fw-bold">
                                        View Project
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?><br>
            </div>
        </div>
    </div>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>