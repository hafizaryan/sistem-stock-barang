<?php
session_start();
//membuat koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "stokbarang");
if ($conn) {
}

//nambah barang
if (isset($_POST['addnewbarang'])) {
    $namabarang = $_POST['namabarang'];
    $keterangan = $_POST['keterangan'];
    $stock = $_POST['stock'];
    $kadaluwarsa = $_POST['kadaluwarsa'];
    //soal gambar
    $allowed_extension = array('png', 'jpg');
    $nama = $_FILES['file']['name']; //ngambil gambar
    $dot = explode('.', $nama);
    $ekstensi = strtolower(end($dot));
    $ukuran = $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];
    //penamaaan enkripsi
    $image = md5(uniqid($nama, true) . time()) . '.' . $ekstensi;
    if (in_array($ekstensi, $allowed_extension) === true) {
        if ($ukuran < 15000000)
            move_uploaded_file($file_tmp, 'img/' . $image);
    }
    $addtable = mysqli_query($conn, "insert into stock (namabarang, keterangan, stock, image, kadaluwarsa) values('$namabarang', '$keterangan', '$stock', '$image', '$kadaluwarsa')");
    if ($addtable) {
        header('location: stock.php');
    } else {
        echo 'Masih Gagal';
        header('location: stock.php');
    }
}

//nambah barang masuk
if (isset($_POST['addbarangmasuk'])) {
    $barangnya = $_POST['barangnya'];
    $keterangan = $_POST['keterangan'];
    $qty = $_POST['qty'];
    $penerima = $_POST['penerima'];
    // cek qty minus
    if ($qty <= 0) {
        echo "<script>alert('qty tidak valid.');document.location='/stokbarang/masuk.php'</script>";
        //header('location: masuk.php');
        return false;
    }
    $cekstocksekarang = mysqli_query($conn, "select * from stock where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);
    $stocksekarang = $ambildatanya['stock'];
    $tambahkanstocksekarangdenganquantity = $stocksekarang + $qty;
    $addtomasuk = mysqli_query($conn, "insert into masuk (idbarang, keterangan, qty, penerima) values('$barangnya','$keterangan', '$qty','$penerima')");
    $updatestockmasuk = mysqli_query($conn, "update stock set stock='$tambahkanstocksekarangdenganquantity'where idbarang='$barangnya'");
    if ($addtomasuk && $updatestockmasuk) {
        header('location: masuk.php');
    } else {
        echo 'Masih Gagal';
        header('location: masuk.php');
    }
}

//nambah barang keluar
if (isset($_POST['addbarangkeluar'])) {
    $barangnya = $_POST['barangnya'];
    $keterangan = $_POST['keterangan'];
    $qty = $_POST['qty'];
    $penerima = $_POST['penerima'];
    $cekstocksekarang = mysqli_query($conn, "select * from stock where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);
    $stocksekarang = $ambildatanya['stock'];
    if ($stocksekarang >= $qty) {
        //kalo cukup
        $tambahkanstocksekarangdenganquantity = $stocksekarang - $qty;
        $addtokeluar = mysqli_query($conn, "insert into keluar (idbarang, keterangan, qty, penerima) values('$barangnya','$keterangan', '$qty','$penerima')");
        $updatestockmasuk = mysqli_query($conn, "update stock set stock='$tambahkanstocksekarangdenganquantity'where idbarang='$barangnya'");
    } else {
        //kalau  barang cukup
        echo '
        <script>
            alert("Stock saat ini tidak mencukupi")
            window.location.href="keluar.php";
        </script>
        
        ';
    }
}

// update barang
if (isset($_POST['updatebarang'])) {
    $idb = $_POST['idbarang'];
    $namabarang = $_POST['namabarang'];
    $stock = $_POST['stock'];
    $kadaluwarsa = $_POST['kadaluwarsa'];
    $keterangan = $_POST['keterangan'];

    // Get the old image name
    $gambarlama = htmlspecialchars($_POST["gambarlama"]);

    // Check if a new image is selected
    if ($_FILES['file']['error'] === 4) {
        $image = $gambarlama; // Use the old image name
    } else {
        // Handle image upload
        $allowed_extensions = array('png', 'jpg');
        $nama = $_FILES['file']['name'];
        $dot = explode('.', $nama);
        $ekstensi = strtolower(end($dot));

        if (in_array($ekstensi, $allowed_extensions) && $_FILES['file']['size'] < 15000000) {
            // Generate a unique name for the image
            $image = md5(uniqid($nama, true) . time()) . '.' . $ekstensi;

            // Move the uploaded file to the destination directory
            move_uploaded_file($_FILES['file']['tmp_name'], 'img/' . $image);
        } else {
            // Handle invalid file type or size
            echo 'Invalid file type or size.';
            exit;
        }
    }

    // Update the database
    $update = mysqli_query($conn, "UPDATE stock SET namabarang='$namabarang', stock='$stock', image='$image', kadaluwarsa='$kadaluwarsa', keterangan='$keterangan' WHERE idbarang='$idb'");

    if ($update) {
        header('location: stock.php');
    } else {
        echo 'Failed to update.';
        header('location: stock.php');
    }
}

//hapus info barang
if (isset($_POST['hapusbarang'])) {
    $idb = $_POST['idbarang'];
    $hapus = mysqli_query($conn, "delete from stock where idbarang='$idb'");
    if ($hapus) {
        header('location: stock.php');
    } else {
        echo 'Masih Gagal';
        header('location: stock.php');
    }
}

//ubah (barang masuk) 
if (isset($_POST['updatebarangmasuk'])) {
    $idb = $_POST['idbarang'];
    $idm = $_POST['idmasuk'];
    $namabarang = $_POST['namabarang'];
    $keterangan = $_POST['keterangan'];
    $qty = $_POST['qty'];
    $lihatstock = mysqli_query($conn, "select * from stock where idbarang='$idb'");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stocksekarang = $stocknya['stock'];
    $qtysekarang = mysqli_query($conn, "select * from masuk where idmasuk='$idm'");
    $qtynya = mysqli_fetch_array($qtysekarang);
    $qtysekarang = $qtynya['qty'];
    $tambahstock = $stocksekarang + ($qty - $qtysekarang);
    $nambahinstock = mysqli_query($conn, "update stock set namabarang='$namabarang', keterangan='$keterangan', stock='$tambahstock' where idbarang='$idb'");
    $updatenya = mysqli_query($conn, "update masuk set qty='$qty' where idmasuk='$idm'");
    if ($nambahinstock && $updatenya) {
        header('location:masuk.php');
    } else {
        echo 'Gagal';
        header('location:masuk.php');
    }
}

//hapus barang masuk
if (isset($_POST['hapusbarangmasuk'])) {
    $idb = $_POST['idbarang'];
    $idm = $_POST['idmasuk'];
    $qty = $_POST['qty'];
    $getdatastock = mysqli_query($conn, "select * from stock where idbarang='$idb'");
    $data = mysqli_fetch_array($getdatastock);
    $stock = $data['stock'];
    $selisih = $stock - $qty;
    $hapusdata = mysqli_query($conn, "delete from masuk where idmasuk='$idm'");
    if ($hapusdata) {
        header('location: masuk.php');
    } else {
        echo 'Masih Gagal';
        header('location: masuk.php');
    }
}

//ubah (barang keluar) 
if (isset($_POST['updatebarangkeluar'])) {
    $idb = $_POST['idbarang'];
    $idk = $_POST['idkeluar'];
    $namabarang = $_POST['namabarang'];
    $keterangan = $_POST['keterangan'];
    $qty = $_POST['qty'];
    $lihatstock = mysqli_query($conn, "select * from stock where idbarang='$idb'");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stocksekarang = $stocknya['stock'];
    $qtysekarang = mysqli_query($conn, "select * from keluar where idkeluar='$idk'");
    $qtynya = mysqli_fetch_array($qtysekarang);
    $qtysekarang = $qtynya['qty'];
    $tambahstock = $stocksekarang + ($qtysekarang - $qty);
    $nambahinstock = mysqli_query($conn, "update stock set stock='$tambahstock' where idbarang='$idb'");
    $updatenya = mysqli_query($conn, "update keluar set  keterangan='$keterangan', qty='$qty' where idkeluar='$idk'");
    if ($nambahinstock && $updatenya) {
        header('location:keluar.php');
    } else {
        echo 'Gagal';
        header('location:keluar.php');
    }
}

//hapus keluar     
if (isset($_POST['hapusbarangkeluar'])) {
    $idb = $_POST['idbarang'];
    $idk = $_POST['idkeluar'];
    $namabarang = $_POST['namabarang'];
    $keterangan = $_POST['keterangan'];
    $qty = $_POST['qty'];
    $getdatastock = mysqli_query($conn, "select * from stock where idbarang='$idb'");
    $data = mysqli_fetch_array($getdatastock);
    $stock = $data['stock'];
    $selisih = $stock - $qty;
    $hapusdata = mysqli_query($conn, "delete from keluar where idkeluar='$idk'");
    if ($hapusdata) {
        header('location: keluar.php');
    } else {
        header('location: keluar.php');
    }
}

//nambah po
if (isset($_POST['addpo'])) {
    $idbarang = $_POST['idbarang'];
    $kode_transaksi = $_POST['kode_transaksi'];
    $keterangan = $_POST['keterangan'];
    $qty = $_POST['qty'];
    $status = $_POST['status'];
    $penerima = $_POST['penerima'];
    $Supplier = $_POST['Supplier'];
    $addtopo = mysqli_query($conn, "insert into po (idbarang, kode_transaksi, keterangan, qty, status, penerima, Supplier) values('$idbarang','$kode_transaksi','$keterangan', '$qty','$status','$penerima','$Supplier')");
    if ($addtopo) {
        header('location: PO.php');
    } else {
        echo 'Masih Gagal';
        header('location: PO.php');
    }
}

//tambah
if (isset($_POST['adduser'])) {
    $em = $_POST['email'];
    $password = $_POST['password'];
    $level = $_POST['level'];
    $queryinsert = mysqli_query($conn, "insert into login (email, password, level) values ('$em','$password','$level')");
    if ($queryinsert) {
        //jika berhasil
        header('location: keluser.php');
    } else {
        //gagal
        header('location:keluser.php');
    }
}

//update
if (isset($_POST['updateuser'])) {
    $emailbaru = $_POST['emailadmin'];
    $passwordbaru = $_POST['passwordbaru'];
    $level = $_POST['level'];
    $idnya = $_POST['id'];
    $queryupdate = mysqli_query($conn, "update login set email='$emailbaru', password='$passwordbaru', level='$level' where iduser='$idnya'");
    if ($queryupdate) {
        //jika berhasil
        header('location: keluser.php');
    } else {
        //gagal
        header('location:keluser.php');
    }
}

//hapus
if (isset($_POST['hapususer'])) {
    $id = $_POST['id'];
    $querydelete = mysqli_query($conn, " delete from login where iduser='$id' ");
    if ($queryinsert) {
        //jika berhasil
        header('location: keluser.php');
    } else {
        //gagal
        header('location:keluser.php');
    }
}

//approve
if (isset($_POST['approve'])) {
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];
    $status = $_POST['status'];
    $idpo = $_POST['idpo'];
    $idb = $_POST['idbarang'];
    $checkStock = mysqli_query($conn, "select * from stock where idbarang='$idb'");
    $current_stock = mysqli_fetch_array($checkStock);
    $stocksekarang = $current_stock['stock'];
    $final_stock = $stocksekarang + $qty;
    $updatepo = mysqli_query($conn, "update po set penerima='$penerima',qty='$qty',Status='$status' where idpo='$idpo'");
    if ($updatepo && $updatestockmasuk) {
        header('location: PO.php');
    } else {
        echo 'Masih Gagal';
        header('location: PO.php');
    }
}

//hapus
if (isset($_POST['hapuspo'])) {
    $idpo = $_POST['idpo'];
    $querydelete = mysqli_query($conn, " delete from po where idpo='$idpo' ");
    if ($querydelete) {
        //jika berhasil
        header('location: PO.php');
    } else {
        //gagal
        header('location: PO.php');
    }
}
