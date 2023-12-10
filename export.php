<?php
require 'function.php';

if (!isset($_SESSION['level'])) {
    // Redirect to the login page if the user is not logged in
    header('Location: login.php');
    exit(); // add exit after header to stop execution
}
?>

<html>

<head>
    <title>Stock Barang</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
</head>

<body>
    <div class="container">
        <h2>Laporan Stock Barang</h2>
        <h4>(Laporan)</h4>

        <!-- Tombol Generate PDF -->
        <form action="cetak.php" method="post" target="_blank">
            <button type="submit" class="btn btn-secondary" style="margin-left:70px; position: absolute; z-index: 999; margin-top: 8px;">Cetak</button>
        </form>

        <div class="data-tables datatable-dark">
            <?php
            $ambilsemuadatastock = mysqli_query($conn, "select * from stock");
            $dataArray = mysqli_fetch_all($ambilsemuadatastock, MYSQLI_ASSOC);
            ?>

            <table class="table table-bordered" id="mauexport" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Gambar</th>
                        <th>Nama Barang</th>
                        <th>Kadaluwarsa</th>
                        <th>Keterangan</th>
                        <th>Stock</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dataArray as $i => $data) : ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><img src="img/<?= $data['image']; ?>" alt="" width="90px"></td>
                            <td><?= $data['namabarang'] ?></td>
                            <td><?= $data['kadaluwarsa'] ?></td>
                            <td><?= $data['keterangan'] ?></td>
                            <td><?= $data['stock'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#mauexport').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'excel',
                ]
            });
        });
    </script>
</body>

</html>