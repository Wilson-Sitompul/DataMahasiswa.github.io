<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
// Jika tidak bisa login maka balik ke login.php
if (!isset($_SESSION['login'])) {
    header('location:login.php');
    exit;
}

// Memanggil atau membutuhkan file function.php dan koneksi.php
require 'function.php';
include "koneksi.php";

// Cek apakah tombol simpan sudah ditekan
if (isset($_POST['simpan'])) {
    $nim = $_POST['nim'];
    
    // Cek apakah NIM sudah ada di database
    $query = "SELECT * dari siswa WHERE nim = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$nim]);
    $result = $stmt->fetch();
    
    if ($result) {
        // Jika NIM sudah ada
        echo "<script>
                alert('NIM telah digunakan!');
            </script>";
    } else {
        // Jika NIM belum ada, tambahkan data baru
        if (tambah($_POST) > 0) {
            echo "<script>
                    alert('Data siswa berhasil ditambahkan!');
                    document.location.href = 'index.php';
                </script>";
        } else {
            echo "<script>
                    alert('Data siswa gagal ditambahkan!');
                </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <!-- Bootstrap -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
     <!-- Bootstrap Icons -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
     <!-- Font Google -->
     <link rel="preconnect" href="https://fonts.gstatic.com">
     <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
     <!-- animasi Css Aos -->
     <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
     <!-- My CSS -->
     <link rel="stylesheet" href="css/style.css">

     <title>Tambah Data</title>
</head>

<body background="img/bg/bck.png">
     <!-- Navbar -->
     <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-uppercase">
          <div class="container">
               <a class="navbar-brand" href="index.php">Sistem Admin Data Mahasiswa</a>
               <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
               </button>
               <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                         <li class="nav-item">
                              <a class="nav-link" aria-current="page" href="index.php">Home</a>
                         </li>
                         <li class="nav-item">
                              <a class="nav-link" href="logout.php">Logout</a>
                         </li>
                    </ul>
               </div>
          </div>
     </nav>
     <!-- Close Navbar -->

     <!-- Container -->
     <div class="container">
          <div class="row my-2">
               <div class="col-md text-light">
                    <h3 class="fw-bold text-uppercase">Tambah Data</h3>
               </div>
               <hr>
          </div>
          <div class="row my-2 text-light">
               <div class="col-md">
                    <form action="" method="post" enctype="multipart/form-data">
                         <div class="mb-3">
                              <label for="nim" class="form-label">NIM</label>
                              <input type="number" class="form-control w-50" id="nim" placeholder="Masukkan NIM" min="1"
                                   name="nim" autocomplete="off" required>
                         </div>
                         <div class="mb-3">
                              <label for="nama" class="form-label">Nama</label>
                              <input type="text" class="form-control form-control-md w-50" id="nama"
                                   placeholder="Masukkan Nama" name="nama" autocomplete="off" required>
                         </div>
                         <div class="mb-3">
                              <label for="tmpt_Lahir" class="form-label">Tempat Lahir</label>
                              <input type="text" class="form-control w-50" id="tmpt_Lahir"
                                   placeholder="Masukkan Tempat Lahir" name="tmpt_Lahir" autocomplete="off" required>
                         </div>
                         <div class="mb-3">
                              <label for="tgl_Lahir" class="form-label">Tanggal Lahir</label>
                              <input type="date" class="form-control w-50" id="tgl_Lahir" name="tgl_Lahir"
                                   autocomplete="off" required>
                         </div>
                         <div class="mb-3">
                              <label for="jekel" class="form-label">Jenis Kelamin</label>
                              <label>Jenis Kelamin</label>
                              <div class="form-check">
                                   <input class="form-check-input" type="radio" name="jekel" id="Laki - Laki"
                                        value="Laki - Laki">
                                   <label class="form-check-label" for="Laki - Laki">Laki - Laki</label>
                              </div>
                              <div class="form-check">
                                   <input class="form-check-input" type="radio" name="jekel" id="Perempuan"
                                        value="Perempuan">
                                   <label class="form-check-label" for="Perempuan">Perempuan</label>
                              </div>
                         </div>
                         <div class="mb-3">
                              <label for="jurusan" class="form-label">Jurusan</label>
                              <select class="form-select w-50" id="jurusan" name="jurusan" required>
                              <option disabled selected value>--------------------------------------------Pilih
                              Jurusan--------------------------------------------</option>
                                   <option value="Teknik Mesin">Teknik Mesin</option>
                                   <option value="Teknik Elektronika">Teknik Elektronika</option>
                                   <option value="Teknologi Industri">Teknologi Industri</option>
                              </select>
                         </div>
                         <div class="mb-3">
                              <label for="email" class="form-label">Email</label>
                              <input type="email" class="form-control w-50" id="email" placeholder="Masukkan Email"
                                   name="email" autocomplete="off" required>
                         </div>
                         <div class="mb-3">
                              <label for="telpon" class="form-label">Nomor Telepon</label>
                              <input type="tel" class="form-control w-50" id="telpon"
                                   placeholder="Masukkan Nomor Telepon" name="telpon" autocomplete="off" required>
                         </div>
                         <div class="mb-3">
                              <label for="ayah" class="form-label">Nama Ayah</label>
                              <input type="text" class="form-control w-50" id="ayah" placeholder="Masukkan Nama Ayah"
                                   name="ayah" autocomplete="off" required>
                         </div>
                         <div class="mb-3">
                              <label for="ibu" class="form-label">Nama Ibu</label>
                              <input type="text" class="form-control w-50" id="ibu" placeholder="Masukkan Nama Ibu"
                                   name="ibu" autocomplete="off" required>
                         </div>
                         <div class="mb-3">
                              <label for="nik" class="form-label">NIK</label>
                              <input type="number" class="form-control w-50" id="nik" placeholder="Masukkan NIK" min="1"
                                   name="nik" autocomplete="off" required>
                         </div>
                         <div class="mb-3">
                              <label for="kelas" class="form-label">Kelas</label>
                              <input type="text" class="form-control w-50" id="kelas" placeholder="Masukkan Kelas"
                                   name="kelas" autocomplete="off" required>
                         </div>
                         <div class="mb-3">
                              <label for="tahun_masuk" class="form-label">Tahun Masuk</label>
                              <input type="number" class="form-control w-50" id="tahun_masuk"
                                   placeholder="Masukkan Tahun Masuk" min="1" name="tahun_masuk" autocomplete="off"
                                   required>
                         </div>
                         <div class="mb-3">
                              <label for="gambar" class="form-label">Foto Siswa</label>
                              <input class="form-control w-50" type="file" id="gambar" name="gambar">
                         </div>
                         <div class="mb-3">
                              <label for="alamat" class="form-label">Alamat</label>
                              <textarea class="form-control w-50" id="alamat" rows="5" name="alamat"
                                   placeholder="Masukkan Alamat" autocomplete="off" required></textarea>
                         </div>
                         <a href="index.php" class="btn btn-danger">Kembali</a>
                         <button type="submit" name="simpan" class="btn btn-primary">Simpan Data</button>
                    </form>
               </div>
          </div>
     </div>
     <!-- Close Container -->

     <!-- Optional JavaScript; choose one of the two! -->

     <!-- Option 1: Bootstrap Bundle with Popper -->
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"
          integrity="sha384-KsvtA1q0gDKWPTnD5ZHblGJJK5jyl16gXQq4DyD0f5rxUjIjyyHqZV8zjo0BXihp" crossorigin="anonymous">
     </script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js"
          integrity="sha384-pzjw8f+ua7Kw1TIqU88mLKh8GJuxX2cQI5L+EqQlXQnK0ybgvnP+0bW0R4yJG8Si" crossorigin="anonymous">
     </script>
     <!-- animasi Js Aos -->
     <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
     <script>
          AOS.init();
     </script>
</body>

</html>
