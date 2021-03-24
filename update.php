<!DOCTYPE html>
<html>
<head>
    <title>Form Update Produk</title>
    <!-- Load file CSS Bootstrap offline -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

</head>
<body>
<div class="container">
    <?php

    //Include file koneksi, untuk koneksikan ke database
    include "koneksi.php";

    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    //Cek apakah ada nilai yang dikirim menggunakan methos GET dengan nama
    if (isset($_GET['nama_produk'])) {
        $nama_produk=input($_GET["nama_produk"]);

        $sql="select * from produk where nama_produk='{$nama_produk}'";
        $hasil=mysqli_query($kon,$sql);
        $data = mysqli_fetch_assoc($hasil);
    }

    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nama_produk=htmlspecialchars($_POST["nama_produk"]);

        $keterangan=input($_POST["keterangan"]);
        $harga=input($_POST["harga"]);
        $jumlah=input($_POST["jumlah"]);

        //Query update data pada tabel produk
        $sql="update produk set
			keterangan='$keterangan',
			harga='$harga',
			jumlah='$jumlah'
			where nama_produk='{$nama_produk}'";

        //Mengeksekusi atau menjalankan query diatas
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:index.php");
        }
        else {
            echo "<div class='alert alert-danger'> Data Gagal diupdate.</div>";

        }

    }

    ?>
    <h2>Update Data</h2>


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="form-group">
            <label>Nama Produk</label>
            <input type="text" name="nama_produk" class="form-control" value="<?php echo $data['nama_produk']; ?>" placeholder="Masukan nama produk" required />

        </div>
        <div class="form-group">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control" rows="5" placeholder="Masukan keterangan" required><?php echo $data['keterangan']; ?></textarea>

        </div>
        <div class="form-group">
            <label>Harga</label>
            <input type="harga" name="harga" class="form-control" value="<?php echo $data['harga']; ?>" placeholder="Masukan harga" required/>
        </div>
        <div class="form-group">
            <label>Jumlah</label>
            <input type="text" name="jumlah" class="form-control" value="<?php echo $data['jumlah']; ?>" placeholder="Masukan jumlah" required/>
        </div>

        <input type="hidden" name="nama_produk" value="<?php echo $data['nama_produk']; ?>" />

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>
