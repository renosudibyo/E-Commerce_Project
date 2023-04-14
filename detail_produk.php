<!DOCTYPE html>
<html lang="en">
<head>
<title>Detail Produk</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<style type="text/css">
		body {
			margin: 0;
			padding: 0;
			font-family: Arial, sans-serif;
		}
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
    <li><a href="index.php">Daftar Produk</a></li>
    <li><a href="detail_produk.php">Detail Produk</a></li>
    <li><a href="form_pemesanan.php">Form Pemesanan</a></li>
    <li><a href="detail_pesanan.php">Detail Pesanan</a></li>
    <li class="treeview">
      <a href="#">ADMIN <span class="caret"></span></a>
      <ul class="treeview-menu">
      <li><a href="admin/daftar_produk.php">Daftar Produk</a></li>
        <li><a href="admin/daftar_kategori_produk.php">Daftar Kategori Produk</a></li>
        <li><a href="admin/daftar_pesanan.php">Daftar Pesanan</a></li>
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
</body>

</head>
<body>
  <div class="container">
    <h2>Detail Produk</h2>
    <?php
      // connect to the database
      $conn = mysqli_connect("localhost", "reno22130si", "18290110122130", "db_reno22130si");
      // check connection
      if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      }
      // select data from table produk and join table kategori_produk
      $sql = "SELECT produk.*, kategori_produk.nama AS kategori_nama FROM produk JOIN kategori_produk ON produk.kategori_produk_id = kategori_produk.id";
      $result = mysqli_query($conn, $sql);
      // check if there are any records in the database
      if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
          ?>
          <div class="card">
            <div class="card-header">
              <?php echo $row['nama']; ?>
            </div>
            <div class="card-body">
              <h5 class="card-title"><?php echo $row['kategori_nama']; ?></h5>
              <p class="card-text"><?php echo $row['deskripsi']; ?></p>
              <p class="card-text">Harga: Rp <?php echo number_format($row['harga_jual'], 0, ',', '.'); ?></p>
              <p class="card-text">Stok: <?php echo $row['stok']; ?></p>
            </div>
          </div>
          <?php
        }
      } else {
        echo "Tidak ada produk yang ditemukan";
      }
      // close database connection
      mysqli_close($conn);
    ?>
  </div>
  <!-- Load Bootstrap JavaScript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<footer>
<footer class="py-2 small">
  <div class="container text-center">
    &copy; 2023 Toko Online by Reno Sudibyo SI16, STT NF Jurusan Sistem Informasi
  </div>
</footer>
</html>

