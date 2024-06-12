<?php
session_start();
error_reporting(0);
include 'koneksi.php';

// Proses input
if (isset($_POST['ubahdata'])) {
    $id_karyawan = $_POST['id_karyawan'];
    $username = $_POST['username'];
    $nama = $_POST['nama'];
    $tmp_tgl_lahir = $_POST['tmp_tgl_lahir'];
    $jenkel = $_POST['jenkel'];
    $agama = $_POST['agama'];
    $alamat = $_POST['alamat'];
    $no_tel = $_POST['no_tel'];
    $jabatan = $_POST['jabatan'];

    $update_fields = [
        "username='$username'",
        "nama='$nama'",
        "tmp_tgl_lahir='$tmp_tgl_lahir'",
        "jenkel='$jenkel'",
        "agama='$agama'",
        "alamat='$alamat'",
        "no_tel='$no_tel'",
        "jabatan='$jabatan'"
    ];

    // Check if the password is provided
    if (!empty($_POST['password'])) {
        $password = md5($_POST['password']);
        $update_fields[] = "password='$password'";
    }

    // Check if the user wants to change the photo
    if (isset($_POST['ubahfoto']) && $_FILES['inpfoto']['name']) {
        $foto = $_FILES['inpfoto']['name'];
        $tmp = $_FILES['inpfoto']['tmp_name'];
        $fotobaru = date('dmYHis').$foto;
        $path = "images/".$fotobaru;

        if (move_uploaded_file($tmp, $path)) {
            // Get current photo
            $sql = "SELECT foto FROM tb_karyawan WHERE id_karyawan = '$id_karyawan'";
            $query = mysqli_query($koneksi, $sql);
            $hapus_f = mysqli_fetch_array($query);

            // Delete old photo
            $file = "images/".$hapus_f['foto'];
            unlink($file);

            // Add new photo to the update fields
            $update_fields[] = "foto='$fotobaru'";
        } else {
            echo "Maaf, Gambar gagal untuk diupload.";
            echo "<br><a href='datakaryawan.php'>Kembali Ke data karyawan</a>";
            exit();
        }
    }

    // Update the record
    $update_query = "UPDATE tb_karyawan SET ".implode(', ', $update_fields)." WHERE id_karyawan='$id_karyawan'";
    $ubah = mysqli_query($koneksi, $update_query);

    if ($ubah) {
        echo "<script>alert('Ubah Data Dengan ID Karyawan = $id_karyawan Berhasil')</script>";
        echo "<script>window.location.href = 'datakaryawan.php'</script>";
    } else {
        echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
        echo "<br><a href='edit_karyawan.php?id_karyawan=$id_karyawan'>Kembali Ke Form!</a>";
    }
}
?>
