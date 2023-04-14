<!DOCTYPE html>
<html>
<head>
  <title>Detail Pesanan</title>
  <!-- Menggunakan Bootstrap untuk tampilan tabel -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
    <h2>Detail Pesanan</h2>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Tanggal</th>
          <th>Nama Pemesan</th>
          <th>Alamat Pemesan</th>
          <th>No. HP</th>
          <th>Email</th>
          <th>Jumlah Pesanan</th>
          <th>Deskripsi</th>
        </tr>
      </thead>
      <tbody>
        <?php
          // Menghubungkan ke database
          $koneksi = mysqli_connect("localhost", "reno22130si", "18290110122130", "db_reno22130si");

          // Mengambil data pesanan terakhir dari tabel pesanan
            $query = "SELECT * FROM pesanan WHERE id=(SELECT MAX(id) FROM pesanan)";
            $hasil = mysqli_query($koneksi, $query);
            $data = mysqli_fetch_array($hasil);

          // Eksekusi query
          $result = mysqli_query($koneksi, $query);

          // Looping untuk menampilkan data pesanan dalam bentuk tabel
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["tanggal"] . "</td>";
            echo "<td>" . $row["nama_pemesan"] . "</td>";
            echo "<td>" . $row["alamat_pemesan"] . "</td>";
            echo "<td>" . $row["no_hp"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["jumlah_pesanan"] . "</td>";
            echo "<td>" . $row["deskripsi"] . "</td>";
            echo "</tr>";
          }

          // Menutup koneksi database
          mysqli_close($koneksi);
        ?>
      </tbody>
    </table>
  </div>
</body>
<footer>
<footer class="py-2 small">
  <div class="container text-center">
    &copy; 2023 Toko Online by Reno Sudibyo SI16, STT NF Jurusan Sistem Informasi
  </div>
</footer>
</html>
