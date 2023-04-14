<?php
  // Mengambil data dari form
  $tanggal = $_POST["tanggal"];
  $produk_id = $_POST["produk_id"];
  $nama_pemesan = $_POST["nama_pemesan"];
  $alamat_pemesan = $_POST["alamat_pemesan"];
  $no_hp = $_POST["no_hp"];
  $email = $_POST["email"];
  $jumlah_pesanan = $_POST["jumlah_pesanan"];
  $deskripsi = $_POST["deskripsi"];

  // Menghubungkan ke database
  $koneksi = mysqli_connect("localhost", "reno22130si", "18290110122130", "db_reno22130si");

  // Memasukkan data pemesanan ke tabel pesanan
  $query = "INSERT INTO pesanan (tanggal, nama_pemesan, alamat_pemesan, no_hp, email, jumlah_pesanan, deskripsi, produk_id) VALUES ('$tanggal', '$nama_pemesan', '$alamat_pemesan', '$no_hp', '$email', $jumlah_pesanan, '$deskripsi', $produk_id)";
  mysqli_query($koneksi, $query);

  // Menutup koneksi database
  mysqli_close($koneksi);

  
?>
<!DOCTYPE html>
<html>
<head>
  <title>Notifikasi Pesanan Berhasil</title>
  <!-- Menggunakan Bootstrap untuk tampilan notifikasi -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    /* Menambahkan inline CSS untuk tampilan notifikasi */
    .notif {
      position: fixed;
      top: 10px;
      right: 10px;
      width: 300px;
      padding: 10px;
      background-color: #4CAF50;
      color: white;
      z-index: 9999;
      opacity: 0;
      transition: opacity 0.5s ease-in-out;
    }

    .notif.show {
      opacity: 1;
    }
  </style>
</head>
<body>

  <!-- Menampilkan notifikasi -->
  <div class="notif" id="notif">
    Pesanan berhasil ditambahkan!
  </div>

  <!-- Script JavaScript untuk menampilkan notifikasi dan redirect -->
  <script>
    // Membuat fungsi untuk menampilkan notifikasi dan redirect ke halaman detail_pesanan.php
    function showNotif() {
      var notif = document.getElementById("notif");
      notif.classList.add("show");

      // Menghilangkan notifikasi setelah 3 detik dan redirect ke halaman detail_pesanan.php
      setTimeout(function() {
        notif.classList.remove("show");
        window.location.href = "detail_pesanan.php";
      }, 3000);
    }

    // Memanggil fungsi showNotif saat halaman dimuat
    window.onload = showNotif;
  </script>

  

</body>
</html>