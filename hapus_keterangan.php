<?php
error_reporting(0); 
require_once("koneksi.php");
session_start();

if (!isset($_SESSION['username'])) {
    header("location: index.php");
    exit(); // Ensure script execution stops after redirection
} else {
    $username = $_SESSION['username'];  
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete_id'])) {
        $delete_id = $_POST['delete_id'];
        
        $delete_query = "DELETE FROM tb_keterangan WHERE id = '$delete_id'";
        $delete_result = mysqli_query($koneksi, $delete_query);

        if ($delete_result) {
            header("Location: data_keterangan.php");
            exit();
        } else {
            echo "<script>alert('Failed to delete data.');</script>";
        }
    } else {
        $id_karyawan = $_POST['id_karyawan'];
        $keterangan = $_POST['keterangan'];
        $alasan = $_POST['alasan'];
        $waktu = date("l, d-m-Y h:i:s a");

        $sql = "INSERT INTO tb_keterangan (id_karyawan, keterangan, alasan, waktu) VALUES ('$id_karyawan', '$keterangan', '$alasan', '$waktu')";
        $result = mysqli_query($koneksi, $sql);

        if ($result) {
            echo "
            <script>
                function displayPopup(message) {
                    var popup = document.createElement('div');
                    popup.classList.add('popup');
                    var messageElement = document.createElement('p');
                    messageElement.innerHTML = message;
                    popup.appendChild(messageElement);
                    document.body.appendChild(popup);
                    setTimeout(function() {
                        popup.remove();
                    }, 3000);
                }
                displayPopup('Data successfully saved!<br>$id_karyawan<br>$keterangan<br>$alasan<br>$waktu');
            </script>";
        } else {
            echo "
            <script>
                function displayPopup(message) {
                    var popup = document.createElement('div');
                    popup.classList.add('popup');
                    var messageElement = document.createElement('p');
                    messageElement.innerHTML = message;
                    popup.appendChild(messageElement);
                    document.body.appendChild(popup);
                    setTimeout(function() {
                        popup.remove();
                    }, 3000);
                }
                displayPopup('Failed to save data.');
            </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Your existing head content -->
</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- Your existing HTML content -->
    </div>

    <!-- Your existing JavaScript imports -->

    <script>
        // Your existing JavaScript code
    </script>

    <!-- End document -->
</body>

</html>
