<?php
session_start(); 
include 'koneksi.php';

if (isset($_POST['simpan'])) {
    // Retrieve form data
    $id_karyawan = $_POST['id_karyawan'];
    $username = $_POST['username'];
    $nama = $_POST['nama'];
    $tmp_tgl_lahir = $_POST['tmp_tgl_lahir'];
    $jenkel = $_POST['jenkel'];
    $agama = $_POST['agama'];
    $alamat = $_POST['alamat'];
    $no_tel = $_POST['no_tel'];
    $jabatan = $_POST['jabatan'];

    // Check if id_karyawan already exists
    $sql = "SELECT * FROM tb_karyawan WHERE id_karyawan = '$id_karyawan'";
    $result = mysqli_query($koneksi, $sql);

    if (mysqli_num_rows($result) > 0) {
        // If the id_karyawan already exists, show alert and redirect
        echo "<script>alert('Data Dengan NIP = $id_karyawan sudah ada')</script>";
        echo "<script>window.location.href = 'datakaryawan.php'</script>";
    } else {
        // Insert the new record
        $query = "INSERT INTO tb_karyawan (id_karyawan, username, nama, tmp_tgl_lahir, jenkel, agama, alamat, no_tel, jabatan) VALUES ('$id_karyawan', '$username', '$nama', '$tmp_tgl_lahir', '$jenkel', '$agama', '$alamat', '$no_tel', '$jabatan')";
        
        if (mysqli_query($koneksi, $query)) {
            // Redirect on success
            header("Location: datakaryawan.php");
            exit();
        } else {
            // Display error message
            echo "Error: " . mysqli_error($koneksi);
        }
    }
} else {
    echo "Form not submitted.";
}
?>
