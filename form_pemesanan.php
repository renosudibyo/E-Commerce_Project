<!DOCTYPE html>
<html>
  <head>
    <title>Form Pemesanan Produk</title>
    <!-- Menambahkan Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
      <h1>Form Pemesanan Produk</h1>
      <form method="POST" action="proses_pemesanan.php">
      <div class="form-group">
          <label for="tanggal">Tanggal:</label>
          <input type="date" id="tanggal" name="tanggal" min="2023-01-01" max="2023-12-31" class="form-control">
        </div>
        <div class="form-group">
          <label for="produk_id">Produk:</label>
          <select id="produk_id" name="produk_id" class="form-control">
            <?php
              // Mengambil daftar produk dari database
              $koneksi = mysqli_connect("localhost", "reno22130si", "18290110122130", "db_reno22130si");
              $query = "SELECT * FROM produk";
              $hasil = mysqli_query($koneksi, $query);

              // Menampilkan daftar produk dalam dropdown
              while ($row = mysqli_fetch_assoc($hasil)) {
                echo "<option value=\"" . $row["id"] . "\">" . $row["nama"] . "</option>";
              }

              // Menutup koneksi database
              mysqli_close($koneksi);
            ?>
          </select>
        </div>

        <div class="form-group">
          <label for="nama_pemesan">Nama Pemesan:</label>
          <input type="text" id="nama_pemesan" name="nama_pemesan" class="form-control">
        </div>

        <div class="form-group">
          <label for="alamat_pemesan">Alamat Pemesan:</label>
          <input type="text" id="alamat_pemesan" name="alamat_pemesan" class="form-control">
        </div>

        <div class="form-group">
          <label for="no_hp">No. HP:</label>
          <input type="text" id="no_hp" name="no_hp" class="form-control">
        </div>

        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" class="form-control">
        </div>

        <div class="form-group">
          <label for="jumlah_pesanan">Jumlah Pesanan:</label>
          <input type="number" id="jumlah_pesanan" name="jumlah_pesanan" class="form-control">
        </div>

        <div class="form-group">
          <label for="deskripsi">Deskripsi:</label>
          <textarea id="deskripsi" name="deskripsi" class="form-control"></textarea>
        </div>

        <input type="submit" value="Pesan" class="btn btn-primary">
      </form>
    </div>
    </body>
    <footer>
<footer class="py-2 small">
  <div class="container text-center">
    &copy; 2023 Toko Online by Reno Sudibyo SI16, STT NF Jurusan Sistem Informasi
  </div>
</footer>
</html>