<?php
  
  include('config.php');

$conn = $connect;
$id = $_GET['id'];
  
$query = "SELECT data_pegawai.id_pegawai, data_pegawai.nama_pegawai, data_pegawai.jenis_kelamin,
data_pegawai.id_jabatan, jabatan_pegawai.nama_jabatan, data_pegawai.no_hp, data_pegawai.alamat,
data_pegawai.username, data_pegawai.email, data_pegawai.password FROM data_pegawai
JOIN jabatan_pegawai ON data_pegawai.id_jabatan = jabatan_pegawai.id_jabatan WHERE data_pegawai.id_pegawai = '$id'";


  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);
  ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Presensi Puskesmas Bangko Barat</title>

    <!--bootstrap css-->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet" />

    <!-- navigasi css-->
    <link rel="stylesheet" href="navbar.css" />

    <!-- Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- text style -->
    <link rel="stylesheet" href="text-style.css">

    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya&family=Cormorant+Garamond&family=Eczar&family=
    Gentium+Plus&family=Libre+Baskerville&family=Libre+Franklin&family=Proza+Libre&family=Rubik&family=Taviraj&family=
    Trirong&family=Work+Sans&display=swap" rel="stylesheet">

</head>

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
                        <a class="nav-link active text-dark" aria-current="page" href="dashboard.php">Halaman Utama</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="presensi-pegawai.php">Presensi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="info_profil.php">Info Presensi</a>
                    </li>
                </ul>
                <a href="edit-profil.php" class="btn btn-primary m-2">
                    <i class="fas fa-user-edit"></i>Profil
                </a>
                <!-- Form Logout -->
                <form class="d-flex">
                    <a href="logout.php" class="btn btn-danger">Keluar <i class="fas fa-sign-out-alt"></i></a>
                </form>
            </div>
        </div>
    </nav>

    <!-- Membuat CRUD dengan menggunakan tabel data_pegawai -->
    <main class="container-xxl">
        <div class="container" style="margin-top: 80px">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header text-center">
                            <h1>EDIT PROFILE </h1>
                        </div>
                        <div class="card-body">
                            <!-- Form input data pegawai -->
                            <form action="edit-profil-todb.php" method="POST">
                                <div class="form-group">
                                    <label>Kode Pegawai</label>
                                    <input type="text" name="id_pegawai" placeholder="NIK" class="form-control"
                                        value="<?php echo $row['id_pegawai'] ?>" readonly>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text" name="nama_pegawai" placeholder="Masukkan Nama Pegawai"
                                        class="form-control" value="<?php echo $row['nama_pegawai'] ?>">
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <br>
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin"
                                        value="Laki-laki"
                                        <?php if ($row['jenis_kelamin'] == 'Laki-laki') echo 'checked'; ?>>
                                    <label class="form-check-label" for="jenis_kelamin">
                                        Laki-Laki
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin"
                                        value="Perempuan"
                                        <?php if ($row['jenis_kelamin'] == 'Perempuan') echo 'checked'; ?>>
                                    <label class="form-check-label" for="jenis_kelamin">
                                        Perempuan
                                    </label>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label>Nomor Handphone</label>
                                    <input type="tel" name="no_hp" placeholder="Masukkan No Hp" class="form-control"
                                        value="<?php echo $row['no_hp'] ?>">
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea class="form-control" name="alamat" placeholder="Masukkan Alamat Pegawai"
                                        rows="4"><?php echo $row['alamat'] ?></textarea>
                                </div>
                                <hr>
                                <div class="form-group text-center">
                                    <h3> <b>AKUN</b></h3>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="username" placeholder="Masukkan Username"
                                        class="form-control" value="<?php echo $row['username'] ?>">
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label>email</label>
                                    <input type="email" name="email" placeholder="Masukkan Email" class="form-control"
                                        value="<?php echo $row['email'] ?>">
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label>Password Baru</label>
                                    <input type="password" name="password" placeholder="Masukkan Password"
                                        class="form-control" value="<?php echo $row['password']?>">
                                </div>
                                <hr>

                                <!-- Button-->
                                <div class="container">

                                    <!-- Button Left -->
                                    <div class="text-end mb-3">
                                        <button type="submit" class="btn btn-success" name="submit">EDIT</button>
                                    </div>
                                </div>
                            </form>
                            <div class="text-start" style="margin-top: -50px;">
                                        <button type="submit" class="btn btn-danger" name="submit"><a
                                                class="text-light nav-link" href="edit-profil.php">BACK</a></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="bootstrap/js/bootstrap.bundle.js">
    </script>
</body>

</html>