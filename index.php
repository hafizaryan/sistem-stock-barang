<?php
require 'function.php';
if (!isset($_SESSION['level'])) {
    // Redirect to the login page if the user is not logged in
    header('Location: login.php');
    exit(); // add exit after header to stop execution
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>STOK BARANG</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">TOKO AMARA </a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form method="get" action="stock.php" class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            <div class="input-group">
                <input name="search" class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <?php require 'menu.php'; ?>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <div style="background: url(img/2.jpg) no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;" class="mt-4 p-5 bg-success text-black rounded">
                        <h1>Selamat Datang <?= $_SESSION['level'] ?>!</h1>
                        <p>Semangat kerjanya dan semoga harimu menyenangkan :) </p>
                    </div>
                    <div class="row mt-4">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="h5 mb-2 text-gray-800 text-primary"> Jumlah Stock</div>
                                            <a href="stock.php" style="color: black;">
                                                <div class="h5 mb-0  text-gray-800"></div>
                                                <?php
                                                // Query SQL untuk menjumlahkan kolom 'jumlah' dari tabel 'stock'
                                                $sql = "SELECT SUM(stock) as total_jumlah FROM stock";
                                                $result = $conn->query($sql);
                                                if ($result->num_rows > 0) {
                                                    // Output data dari setiap baris hasil query
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo '<div class="h5 mb-0 text-gray-800">' . $row["total_jumlah"] . '</div>';
                                                    }
                                                } else {
                                                    echo "Tidak ada data di tabel stock.";
                                                } ?>
                                            </a>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-cubes fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <a href="masuk.php" style="color: black; text-decoration: none;">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="h5 mb-2  text-gray-800 text-success"> Barang Masuk</div>

                                                <div class="h5 mb-0  text-gray-800"></div>
                                                <?php
                                                // Query SQL untuk menjumlahkan kolom 'jumlah' dari tabel 'stock'
                                                $sql = "SELECT SUM(qty) as total_jumlah FROM masuk";
                                                $result = $conn->query($sql);
                                                if ($result->num_rows > 0) {
                                                    // Output data dari setiap baris hasil query
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo '<div class="h5 mb-0 text-gray-800">' . $row["total_jumlah"] . '</div>';
                                                    }
                                                } else {
                                                    echo "Tidak ada data di tabel stock.";
                                                } ?>

                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-cubes fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="h5 mb-2  text-gray-800 text-danger"> Barang Keluar</div>
                                            <a href="keluar.php" style="color: black;">
                                                <div class="h5 mb-0  text-gray-800"></div>
                                                <?php
                                                // Query SQL untuk menjumlahkan kolom 'jumlah' dari tabel 'stock'
                                                $sql = "SELECT SUM(qty) as total_jumlah FROM keluar";
                                                $result = $conn->query($sql);
                                                if ($result->num_rows > 0) {
                                                    // Output data dari setiap baris hasil query
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo '<div class="h5 mb-0 text-gray-800">' . $row["total_jumlah"] . '</div>';
                                                    }
                                                } else {
                                                    echo "Tidak ada data di tabel stock.";
                                                } ?>
                                            </a>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-cubes fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2" style="color: black;">
                                            <div class="h5 mb-2  text-gray-800 text-warning"> Pengguna</div>
                                            <a href="keluser.php" style="color: black;">
                                                <div class="h5 mb-0  text-gray-800"></div>
                                                <?php
                                                // Query SQL untuk menjumlahkan kolom 'level' dari tabel 'user'
                                                $sql = "SELECT COUNT(*) as total_users FROM login";
                                                $result = $conn->query($sql);

                                                if ($result->num_rows > 0) {
                                                    // Output data dari setiap baris hasil query
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo '<div class="h5 mb-0 text-gray-800">' . $row["total_users"] . '</div>';
                                                    }
                                                } else {
                                                    echo "Tidak ada data di tabel user.";
                                                }
                                                ?>

                                            </a>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-cubes fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Proyek 2 Gita 2022</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/datatables-demo.js"></script>
</body>

<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Barang</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <form method="post">
                <div class="modal-body">
                    <input type="text" name="namabarang" placeholder="Nama Barang" class="form-control" required>
                    <br>
                    <input type="text" name="keterangan" placeholder="keterangan" class="form-control" required>
                    <br>
                    <input type="num" name="stock" placeholder="Stock" class="form-control" required>
                    <br>
                    <button type="submit" class="btn btn-primary" name="addnewbarang">submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

</html>