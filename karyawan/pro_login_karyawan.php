<link href="../css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">
<div class="main-w3layouts wrapper">
<?php 

  include_once "../koneksi.php";

  $id = $_POST['id'];
//   $pass = md5($_POST['password']);
  $sql = "SELECT * FROM tb_karyawan WHERE id_karyawan='$id'";
  $login=mysqli_query($koneksi,$sql);
  $ketemu=mysqli_num_rows($login);
  $b=mysqli_fetch_array($login);

  if($ketemu>0){
    session_start();
    $_SESSION['idsi']   = $b['id_karyawan'];
    $_SESSION['usersi'] = $b['username'];
    $_SESSION['namasi'] = $b['nama'];
    $_SESSION['ttlsi']  = $b['tmp_tgl_lahir'];
    $_SESSION['jenkelsi'] = $b['jenkel'];
    $_SESSION['agamasi'] = $b['agama'];
    $_SESSION['alamatsi'] = $b['alamat'];
    $_SESSION['teleponsi'] = $b['no_tel'];
    $_SESSION['jabatansi'] = $b['jabatan'];
    $_SESSION['fotosi'] = $b['foto'];

    $id_karyawan = $_SESSION['idsi'];
    $nama = $_SESSION['namasi'];
    $waktu = date("l, d-m-Y h:i:s a");
    $save = "INSERT INTO tb_absen SET id_karyawan='$id_karyawan', nama='$nama', waktu='$waktu'";
    mysqli_query($koneksi, $save);

    if ($save) {
            echo "<script>alert('Absen Berhasil') 
            window.location.href = 'login_karyawan.php';
            </script>";
    }
    else{
        echo "ID SALAH ATAU TIDAK TERDAFTAR";
    }
        // header("location: index.php?m=awal");
    }

 ?>

