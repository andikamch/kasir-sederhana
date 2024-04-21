<?php

include '../koneksi.php';

session_start();
if (!isset($_SESSION['user'])) {
    echo "<script>alert('Mohon login terlebih dahulu')
  location.replace('login.php')</script>";
}

$produks = $conn->query("SELECT * FROM products");

if (isset($_POST['simpan_cust'])) {
    $_SESSION['nama_cust'] = $_POST['nama_cust'];
    $_SESSION['no_order'] = $_POST['no_order'];
    $_SESSION['order_type'] = $_POST['order_type'];
} else {
}

$nomer = $_SESSION['no_order'];
$harga = $conn->query("SELECT * FROM products")->fetch_assoc();

if (isset($_POST['pesan'])) {
    $nama_cust = htmlspecialchars($_SESSION['nama_cust']);
    $no_order = htmlspecialchars($_SESSION['no_order']);
    $user = htmlspecialchars($_SESSION['id_user']);
    $order_type = htmlspecialchars($_SESSION['order_type']);
    $id_produk = $_POST['id_product'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $jumlah = $price * $qty;

    $simpan = $conn->query("INSERT INTO tbl_order VALUES(NULL,'$no_order','$user','$qty','1','0','0',NULL,'$id_produk','$nama_cust','$order_type','$price','$jumlah')");

    if ($simpan > 0) {
        echo "<script>alert('order dibuat')
        location.replace('')</script>";
    }
}

$total = $conn->query("SELECT * FROM tbl_order JOIN products ON tbl_order.id_product = products.id_product WHERE no_order = '$nomer'");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
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
                </ul>
            </div>
        </div>
    </nav>

    <form action="" method="post">
        <div class="row justify-content-center">
            <div class="card mt-5" style="width: 48rem;">
                <div class="card-body">
                    <div class="col-lg-12 ">
                        <div class="d-flex mb-2">
                            <div class="col-lg-2 ">
                                <label for="nama_cust">nama cust:</label>
                            </div>
                            <div class="col-lg-10 me-2">
                                <input type="text" name="nama_cust" id="nama_cust" class="form-control" required>
                            </div>
                        </div>
                        <div class="d-flex mb-2">
                            <div class="col-lg-2 ">
                                <label for="no_order">no order:</label>
                            </div>
                            <div class="col-lg-10 me-2">
                                <input type="text" name="no_order" id="no_order" class="form-control" required>
                            </div>
                        </div>
                        <div class="d-flex mb-2">
                            <div class="col-lg-2 ">
                                <label for="order_type">order type :</label>
                            </div>
                            <div class="col-lg-10 me-2">
                                <select name="order_type" id="order_type" class="form-control">
                                    <option value="">silahkan pilih type</option>
                                    <option value="Dine_In">dine in</option>
                                    <option value="To_Go">to go</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" name="simpan_cust" class="btn btn-primary">Simpan nama cust</button>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </form>

    <div class="container">
        <h4>Nama Pelanggan : <?= $_SESSION['nama_cust'] ?></h4>
        <h4>No order : <?= $_SESSION['no_order'] ?></h4>
        <h4>Type : <?= $_SESSION['order_type'] ?></h4>
    </div>


    <div class="container pt-5">
        <div class="row">
            <h3>Name Product</h3>
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="card-body">
                        <table class=" table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>harga</th>
                                    <th>stock</th>
                                    <th>qty</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($produks as $produk) { ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $produk['name'] ?></td>
                                        <td><?= $produk['price'] ?></td>
                                        <td><?= $produk['stock'] ?></td>
                                        <td>
                                            <form action="" method="post">
                                                <input type="number" name="qty" id="qty" class="form-control" value="0" min="1" required>
                                        </td>
                                        <td class="text-center">
                                            <input type="hidden" name="id_product" value="<?= $produk['id_product'] ?>">
                                            <input type="hidden" name="price" value="<?= $produk['price'] ?>">
                                            <button type="submit" name="pesan" class="btn btn-warning text-white btn-sm">Pesan</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container pt-5">
        <div class="row">\
            <h3>Total Product</h3>
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="card-body">
                        <table class=" table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nomer</th>
                                    <th>Nama Product</th>
                                    <th>QTY.</th>
                                    <th>Price</th>
                                    <th>Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($total as $produk) { ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $produk['no_order'] ?></td>
                                        <td><?php
                                            $id = $produk['id_product'];
                                            $name = $conn->query("SELECT * FROM products WHERE id_product = '$id'")->fetch_assoc();
                                            echo $name['name']; ?></td>
                                        <td><?= $produk['qty'] ?></td>
                                        <td>
                                            <?php $totalprice = $produk['price'] * $produk['qty'];
                                            echo $totalprice;
                                            ?></td>
                                        <td><?= $produk['stock'] ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <form action="" method="post">
            <h4><?php
                if (isset($_SESSION['no_order'])) {
                    $no_order = $_SESSION['no_order'];


                    $query = "SELECT * FROM tbl_order JOIN products ON tbl_order.id_product = products.id_product WHERE no_order = '$no_order'";
                    $result = $conn->query($query);


                    if ($result) {
                        $totalharga = 0;
                        foreach ($result as $bayar) {

                            $totalharga += $bayar['total_harga'];
                        }
                        echo "Total harga pesanan: " . $totalharga;
                    } else {

                        echo "Gagal mengambil total harga pesanan";
                    }
                } else {

                    echo "Nomor pesanan tidak tersedia";
                }
                ?></h4>
            <h4>Price :
                <input class="form-control" type="number" name="bayar" id="bayar">
                <button class="btn btn-primary mt-3" type="submit" name="perhitungan">hitung</button>
        </form>
        </h4>
        <h4>Kembalian :
            <?php
            if (isset($_POST['bayar'])) {
                $price = $_POST['bayar'];
                $total = $totalharga;

                $kembali = $price - $total;
                $_SESSION['kembali'] = $kembali;
                echo "Rp." . number_format($kembali);
            } ?>
        </h4>

        <div class="col-lg-12">
            <?php

            if (isset($_POST['selesai'])) {
                $results = $conn->query("SELECT * FROM tbl_order JOIN products ON tbl_order.id_product = products.id_product WHERE no_order = '$nomer'");

                foreach ($results as $row) {
                    $nomor_order = $_SESSION['no_order'];
                    $price = $row['total_harga'];
                    $kembali = $_SESSION['kembali'];

                    $selesai = $conn->query("UPDATE tbl_order SET bayar = '$price', kembalian = '$kembali' WHERE no_order = '$nomor_order'");

                    if ($selesai > 0) {
                        $newstock = $row['stock'] - $row['qty']; // Perhitungan stock dilakukan di dalam perulangan foreach
                        $id = $row['id_product'];

                        $conn->query("UPDATE products SET stock = '$newstock' WHERE id_product = '$id'");
                    }
                }
            }


            ?>
            <form action="" method="post">
                <button type="submit" name="selesai" class="btn btn-primary w-100">SELESAIKAN PEMBAYARAN</button>
            </form>
        </div>
    </div>




    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>