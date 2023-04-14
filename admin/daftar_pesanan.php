<!DOCTYPE html>
<html>
<head>
	<title>Daftar Pesanan</title>
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
        table {
            margin-top: 20px;
            margin-bottom: 20px;
        }
        th, td {
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
</head>
<body>
    <div class="container">
        <h1 class="text-center">Daftar Pesanan</h1>
        <?php
        // Koneksi ke database
        $host = "localhost";
     	 $username = "reno22130si";
	$password = "18290110122130";
	$dbname = "db_reno22130si";

        $koneksi = mysqli_connect($host, $username, $password, $dbname);

        if (!$koneksi) {
            die("Koneksi gagal: " . mysqli_connect_error());
        }

        // Query untuk mengambil data pesanan
        $sql = "SELECT p.*, pr.nama as nama_produk, pr.harga_jual as harga_produk, k.nama as kategori_produk FROM pesanan p 
                JOIN produk pr ON p.produk_id = pr.id
                JOIN kategori_produk k ON pr.kategori_produk_id = k.id";
        $result = mysqli_query($koneksi, $sql);

        // Tampilan tabel pesanan dengan Bootstrap
        echo "<table class='table table-bordered'>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nama Pemesan</th>
                    <th>Alamat Pemesan</th>
                    <th>No HP</th>
                    <th>Email</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Deskripsi</th>
                </tr>";

        $no = 1;
        $total = 0;

        while($row = mysqli_fetch_assoc($result)) {
            $harga = $row['harga_produk'];
            $jumlah = $row['jumlah_pesanan'];
            $sub_total = $harga * $jumlah;
            $total += $sub_total;

            echo "<tr>
                    <td>{$no}</td>
                    <td>{$row['tanggal']}</td>
                    <td>{$row['nama_pemesan']}</td>
                    <td>{$row['alamat_pemesan']}</td>
                    <td>{$row['no_hp']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['nama_produk']}</td>
                    <td>Rp. {$harga}</td>
                    <td>{$jumlah}</td>
                    <td>Rp. {$sub_total}</td>
                    <td>{$row['deskripsi']}</td>
                </tr>";
            $no++;
        }

        echo "<tr>
                <td colspan='9'>Total</td>
                <td>Rp. {$total}</td>
                <td></td>
            </tr>";
        echo "</table>";

        // Tutup koneksi database
        mysqli_close($koneksi);
        ?>
    </div>
    <footer>
<footer class="py-2 small">
  <div class="container text-center">
    &copy; 2023 Toko Online by Reno Sudibyo SI16, STT NF Jurusan Sistem Informasi
  </div>
</footer>

    <!-- Load library jQuery dan Bootstrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>


 