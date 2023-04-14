<!DOCTYPE html>
<html>
<head>
	<title>Daftar Produk</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<style type="text/css">
		.product-card {
			margin: 10px;
			border: 1px solid #ddd;
			padding: 10px;
			border-radius: 5px;
		}
		.product-card:hover {
			border-color: #007bff;
		}
		.product-card img {
			max-width: 100%;
			height: auto;
		}
        body {
			margin: 0;
			padding: 0;
			font-family: Arial, sans-serif;
		}
		.sidebar {
			position: fixed;
			width: 200px;
			height: 100%;
			background-color: #333;
			padding: 20px;
			box-sizing: border-box;
		}
		.sidebar ul {
			list-style: none;
			margin: 0;
			padding: 0;
		}
		.sidebar li {
			margin: 10px 0;
		}
		.sidebar a {
			display: block;
			color: #fff;
			text-decoration: none;
			padding: 10px;
			border-radius: 5px;
		}
		.sidebar a:hover {
			background-color: #555;
		}
		.main {
			margin-left: 200px;
			padding: 20px;
			box-sizing: border-box;
		}
		.treeview ul {
			list-style: none;
			margin: 0;
			padding: 0;
			display: none;
		}
		.treeview ul li {
			padding-left: 10px;
		}
		.treeview .caret {
			display: inline-block;
			width: 0;
			height: 0;
			margin-left: 4px;
			vertical-align: middle;
			border-top: 4px solid;
			border-right: 4px solid transparent;
			border-left: 4px solid transparent;
		}
		.treeview .open > a .caret {
			transform: rotate(90deg);
		}
		.treeview-menu {
			display: none;
		}
		.treeview.open > .treeview-menu {
			display: block;
		}
		footer {
			position: fixed;
			left: 0;
			bottom: 0;
			width: 100%;
			background-color: #f5f5f5;
			color: #666666;
			text-align: center;
			font-size: 12px;
			padding: 10px;
		}
        
	</style>
</head>
<body>
<div class="sidebar">
  <ul>
    <li><a href="../index.php">Daftar Produk</a></li>
    <li><a href="../detail_produk.php">Detail Produk</a></li>
    <li><a href="../form_pemesanan.php">Form Pemesanan</a></li>
    <li><a href="../detail_pesanan.php">Detail Pesanan</a></li>
    <li class="treeview">
      <a href="#">ADMIN <span class="caret"></span></a>
      <ul class="treeview-menu">
        <li><a href="daftar_produk.php">Daftar Produk</a></li>
        <li><a href="daftar_kategori_produk.php">Daftar Kategori Produk</a></li>
        <li><a href="daftar_pesanan.php">Daftar Pesanan</a></li>
      </ul>
    </li>
  </ul>
</div>

<script>
  // Script JavaScript untuk mengaktifkan navigasi dropdown treeview submenu pada menu ADMIN
  var treeview = document.getElementsByClassName("treeview");
  for (var i = 0; i < treeview.length; i++) {
    treeview[i].addEventListener("click", function() {
      this.classList.toggle("open");
    });
  }
</script>
<?php
// Koneksi database
$host = "localhost";
$user = "reno22130si";
$password = "18290110122130";
$dbname = "db_reno22130si";
$koneksi = mysqli_connect($host, $user, $password, $dbname);

// Cek apakah tombol submit sudah ditekan atau belum
if(isset($_POST["submit"])) {
    // Ambil data dari form
    $kode = $_POST["kode"];
    $nama = $_POST["nama"];
    $harga_jual = $_POST["harga_jual"];
    $harga_beli = $_POST["harga_beli"];
    $stok = $_POST["stok"];
    $min_stok = $_POST["min_stok"];
    $deskripsi = $_POST["deskripsi"];
    $kategori_produk_id = $_POST["kategori_produk_id"];

    // Jika tombol submit bernilai "Tambah Produk"
    if($_POST["submit"] == "Tambah Produk") {
        // Query untuk menambahkan data produk ke database
        $query = "INSERT INTO produk (kode, nama, harga_jual, harga_beli, stok, min_stok, deskripsi, kategori_produk_id) 
                  VALUES ('$kode', '$nama', $harga_jual, $harga_beli, $stok, $min_stok, '$deskripsi', $kategori_produk_id)";
        mysqli_query($koneksi, $query);
    }
    // Jika tombol submit bernilai "Update Produk"
    else if($_POST["submit"] == "Update Produk") {
        // Ambil data produk yang akan diupdate dari database
        $id = $_POST["id"];
        $query = "SELECT * FROM produk WHERE id=$id";
        $result = mysqli_query($koneksi, $query);
        $produk = mysqli_fetch_assoc($result);

        // Update data produk dengan data yang baru
        $query = "UPDATE produk SET kode='$kode', nama='$nama', harga_jual=$harga_jual, harga_beli=$harga_beli, stok=$stok, min_stok=$min_stok, deskripsi='$deskripsi', kategori_produk_id=$kategori_produk_id WHERE id=$id";
        mysqli_query($koneksi, $query);
    }
}

// Jika tombol delete ditekan
if(isset($_POST["delete"])) {
    // Hapus data produk dari database
    $id = $_POST["id"];
    $query = "DELETE FROM produk WHERE id=$id";
    mysqli_query($koneksi, $query);
}

// Query untuk mengambil seluruh data produk dari database
$query = "SELECT p.id, p.kode, p.nama, p.harga_jual, p.harga_beli, p.stok, p.min_stok, p.deskripsi, k.nama AS kategori_produk 
          FROM produk p JOIN kategori_produk k ON p.kategori_produk_id = k.id";
$result = mysqli_query($koneksi, $query);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Produk</title>
    <!-- Tambahkan link ke file bootstrap.css -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        /* Tambahkan CSS untuk mengatur tata letak */
        body {
            display: flex;
            height: 100vh;
        }
        form {
            max-width: 500px;
        }
        
        
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Daftar Produk</h1>
        <table class="table table-striped">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Harga Jual</th>
                <th>Harga Beli</th>
                <th>Stok</th>
                <th>Min Stok</th>
                <th>Deskripsi</th>
                <th>Kategori Produk</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $row["kode"] ?></td>
                <td><?= $row["nama"] ?></td>
                <td><?= $row["harga_jual"] ?></td>
                <td><?= $row["harga_beli"] ?></td>
                <td><?= $row["stok"] ?></td>
                <td><?= $row["min_stok"] ?></td>
                <td><?= $row["deskripsi"] ?></td>
                <td><?= $row["kategori_produk"] ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="id" value="<?= $row["id"] ?>">
                        <input type="submit" name="delete" class="btn btn-danger" value="Hapus Produk">
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Produk</title>
</head>
<body>
    <h1>Tambah Produk</h1>
    <form method="POST" action="">
        <label>Kode Produk:</label><br>
        <input type="text" name="kode"><br>
        <label>Nama Produk:</label><br>
        <input type="text" name="nama"><br>
        <label>Harga Jual:</label><br>
        <input type="number" name="harga_jual"><br>
        <label>Harga Beli:</label><br>
        <input type="number" name="harga_beli"><br>
        <label>Stok:</label><br>
        <input type="number" name="stok"><br>
        <label>Minimal Stok:</label><br>
        <input type="number" name="min_stok"><br>
        <label>Deskripsi:</label><br>
        <textarea name="deskripsi"></textarea><br>
        <label>Kategori Produk:</label><br>
        <select name="kategori_produk_id">
            <?php
            // Query untuk mengambil seluruh data kategori produk dari database
            $query = "SELECT * FROM kategori_produk";
            $result_kategori = mysqli_query($koneksi, $query);

            // Loop untuk menampilkan pilihan kategori produk
            while($kategori = mysqli_fetch_assoc($result_kategori)) {
                echo "<option value='".$kategori['id']."'>".$kategori['nama']."</option>";
            }
            ?>
        </select><br><br>
        <input type="submit" name="submit" value="Tambah Produk">
    </form>
    <br>
</body>
<footer>
<footer class="py-2 small">
  <div class="container text-center">
    &copy; 2023 Toko Online by Reno Sudibyo SI16, STT NF Jurusan Sistem Informasi
  </div>
</footer>
</html>

