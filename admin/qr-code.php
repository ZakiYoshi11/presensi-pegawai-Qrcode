<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location:index.php");
}
 
// menghubungkan config.php dimana telah terhubung dengan database
include 'config.php';

$conn = $connect;

// mengambil data dari tabel data_pegawai
$jumlah_info_waktu_presensi = mysqli_query($conn,"SELECT * FROM info_waktu_presensi");
 
// menghitung jumlah dari tabel data_pegawai
$jumlah_info_presensi = mysqli_num_rows($jumlah_info_waktu_presensi);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Presensi Puskesmas Bangko Barat |</title>
    <!--bootstrap css-->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet" />

    <!-- navigasi css-->
    <link rel="stylesheet" href="navbar.css" />

    <!-- text style -->
    <link rel="stylesheet" href="text-style.css">

    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya&family=Cormorant+Garamond&family=Eczar&family=
    Gentium+Plus&family=Libre+Baskerville&family=Libre+Franklin&family=Proza+Libre&family=Rubik&family=Taviraj&family=
    Trirong&family=Work+Sans&display=swap" rel="stylesheet">

<body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-nav-green">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <h4>Puskesmas Bangko Barat </h4>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link text-dark" aria-current="page" href="dashboard.php">Halaman Utama</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="Data-pegawai.php">Data Pegawai</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="data-presensi.php">Data Presensi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="data-jabatan.php"> Tambah Jabatan</a>
                    </li>
                    <li class="nav-item">
                        <b><a class="nav-link active text-dark" href="qr-code.php"> Atur Jam Kerja</a> </b>
                    </li>
                </ul>
                <!-- Form Logout -->
                <form class="d-flex">
                    <a href="logout.php" class="btn btn-danger">Keluar <i class="fas fa-sign-out-alt"></i></a>
                </form>
            </div>
        </div>
    </nav>
    <main>
        <br>
        <div class="container mt-5">
            <h1 class="text-center">Atur Jam kerja Hari Ini</h1>
            <div class="card mx-auto" style="width: 50%;">
                <div class="card-body">
                    <form action="jam-kerja.php" method="POST">
                        <div class="form-group">
                            <label for="jam_masuk">Jam Masuk</label>
                            <input type="time" class="form-control" id="jam_masuk" name="jam_masuk" required>
                        </div>
                        <div class="form-group">
                            <label for="jam_pulang">Jam Pulang</label>
                            <input type="time" class="form-control" id="jam_pulang" name="jam_pulang" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_presensi">Tanggal Presensi</label>
                            <input type="date" class="form-control" id="tanggal_presensi" name="tanggal_presensi"
                                required>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary" name="submit">ATUR</button>
                    </form>
                    <br>
                    
                    </div>
            </div>
        </div>
    </main>
    <!-- Membuat CRUD dengan menggunakan tabel data_pegawai -->
    <main class="container-xxl">
        <div class=" p-3 rounded">
            <div class="container" style="margin-top: 20px">
                <div class="row">
                    <div class="col-md-12 p-4 rounded">
                        <div class="card">
                            <!-- Button Untuk melakukan penambahan data pegawai -->
                            <div class="card-body">
                                <!-- menampilkan jumlah data pada tabel data_pegawai -->
                                <div class="card-header" style="margin-left: -10px;">
                                    <p> Jumlah Data:
                                        <b><?php echo $jumlah_info_presensi; ?></b>
                                    </p>
                                    <div class="table-responsive-xxl">
                                        <!-- membuat table dan menampilkan data dari tabel data_pegawai -->
                                        <table class="table table-bordered" id="myTable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">NO.</th>
                                                    <th scope="col">INFO JAM MASUK</th>
                                                    <th scope="col">INFO JAM PULANG</th>
                                                    <th scope="col">INFO TANGGAL PRESENSI</th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <hr>
                                                <form class="form-inline my-2 my-lg-0" role="search" method="post"
                                                    action="">
                                                    <input class="form-control mr-sm-2" type="search"
                                                        placeholder="Search" aria-label="Search" name="search">
                                                        <br>
                                                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit"
                                                        name="submit">Search</button>
                                                </form>
                                                <hr>
                                                <!-- proses pengambilan 
                                                data dari tabel data_pegawai -->
                                                <?php 
                                                    include('config.php');
                                                    
                                                        if(isset($_POST['submit'])){
                                                            $search = $_POST['search'];
                                                            $query = mysqli_query($connect, "SELECT * FROM info_waktu_presensi WHERE info_jam_masuk LIKE '%$search%' 
                                                            OR info_jam_pulang LIKE '%$search%' OR info_Tanggal_presensi LIKE '%$search%'");
                                                        } else {
                                                            $query = mysqli_query($connect,"SELECT * FROM info_waktu_presensi");
                                                        }
                                                        $no = 1;
                                                        while($row = mysqli_fetch_array($query)){
                                                    ?>
                                                <tr>
                                                    <td><?php echo $no++ ?></td>
                                                    <td><?php echo $row['info_jam_masuk']; ?></td>
                                                    <td><?php echo $row['info_jam_pulang']; ?></td>
                                                    <td><?php echo $row['info_Tanggal_presensi']; ?></td>
                                                    <!-- Button untuk melakukan proses Edit dan hapus data -->
                                                    <td class="text-center">
                                                        <a href="delete-info-presensi.php?id=<?php echo $row['id_info_presensi'] ?>"
                                                            class="btn btn-sm btn-danger ">HAPUS</a>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>

    <!--jquery dan js bootstrap-->
    <script src="bootstrap/js/jquery-3.5.1.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>

</body>

</html>