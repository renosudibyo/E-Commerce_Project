<?php
$host = "localhost";
$user = "reno22130si";
$password = "18290110122130";
$dbname = "db_reno22130si";

// Membuat koneksi ke database
$conn = new mysqli($host, $user, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Menambah data kategori produk
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    $id = $_POST["id"];

    if($id){
        $sql = "UPDATE kategori_produk SET nama='$nama' WHERE id='$id'";
    }else{
        $sql = "INSERT INTO kategori_produk (nama) VALUES ('$nama')";
    }

    if ($conn->query($sql) === TRUE) {
        echo "<meta http-equiv='refresh' content='0'>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Menghapus data kategori produk
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $sql = "DELETE FROM kategori_produk WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: tes_kategori.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}


// Menampilkan data kategori produk
$sql = "SELECT * FROM kategori_produk";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
  <title>Detail Pesanan</title>
  <!-- Menggunakan Bootstrap untuk tampilan tabel -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
        form {
             max-width: 500px;
            margin: auto;
            text-align: center;
        }

        table {
             max-width: 800px;
            margin: auto;
            }
        h2 {
            margin: auto;
            text-align: center;
        }
        h1 {
            margin: auto;
            text-align: center;
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
</body>
<body>
    <h1>Daftar Kategori Produk</h1>

    <!-- Form untuk menambah atau mengedit data kategori produk -->
    <form method="POST" action="">
    <input type="hidden" name="id" id="id" value="">
    <div class="form-group">
        <label for="nama">Nama Kategori Produk:</label>
        <input type="text" name="nama" id="nama" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    </form>

    <br>

    <!-- Tabel untuk menampilkan data kategori produk -->
    <table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Kategori Produk</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["nama"] . "</td>";
                echo "<td>";
                echo "<button class='btn btn-primary' onclick='edit(\"" . $row["id"] . "\",\"" . $row["nama"] . "\")'>Edit</button>";
                echo "<button class='btn btn-danger' onclick='hapus(\"" . $row["id"] . "\")'>Hapus</button>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>0 results</td></tr>";
        }
        ?>
    </tbody>
</table>
    <?php
    // Menutup koneksi database
    $conn->close();
    ?>

    <script>
        function edit(id, nama) {
            document.getElementById("id").value = id;
            document.getElementById("nama").value = nama;
                    document.getElementById("form-tambah").style.display = "none";
        document.getElementById("form-edit").style.display = "block";
    }

    function hapus(id) {
    if (confirm("Apakah Anda yakin ingin menghapus kategori ini?")) {
        window.location.href = "tes_kategori.php?delete=" + id;
    }
}

</script>

<!-- Form untuk menambah data kategori produk -->
<div id="form-tambah">
    <h2>Tambah Kategori Produk</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label for="nama">Nama Kategori Produk:</label>
            <input type="text" name="nama" id="nama" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
</div>

<!-- Form untuk edit data kategori produk -->
<div id="form-edit" style="display: none;">
    <h2>Edit Kategori Produk</h2>
    <form method="POST" action="update_kategori.php">
        <input type="hidden" name="id" id="id">
        <div class="form-group">
            <label for="nama">Nama Kategori Produk:</label>
            <input type="text" name="nama" id="nama" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
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
