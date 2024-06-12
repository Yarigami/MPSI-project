<?php 
// $koneksi = mysqli_connect("localhost", "root", "", "karyawansi");
$koneksi = mysqli_connect("localhost", "root", "", "mpsi_uas");

if (mysqli_connect_errno()) {
	echo "koneksi gagal " . mysql_connect_error();
}
 ?>