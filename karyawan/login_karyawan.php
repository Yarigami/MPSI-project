<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> 
addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); 
function hideURLbar(){ window.scrollTo(0,1); } 
</script>
<!-- Custom Theme files -->
<link href="../css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- //Custom Theme files -->
<!-- web font -->
<link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">
<!-- //web font -->
</head>
<style>
  .popup {
    position: fixed;
    top: 50%;
    left: 50%;
    text-align: center;
    transform: translate(-50%, -50%);
    background-color: rgba(0, 0, 0, 0.8);
    color: white;
    padding: 20px;
    border-radius: 5px;
    z-index: 9999;
}

</style>
<body>
  <!-- main -->
  <div class="main-w3layouts wrapper">
    <h1>Login Karyawan</h1>
    <div class="main-agileinfo">
      <div class="agileits-top">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
          <input class="text" type="password" name="id" placeholder="User ID" required="">
          <div class="wthree-text">
            <label class="anim">
            </label>
            <div class="clear"> </div>
          </div>
          <input type="submit" value="Login">
        </form>
        
        <?php 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          include_once "../koneksi.php";

          $id = $_POST['id'];
          $sql = "SELECT * FROM tb_karyawan WHERE id_karyawan='$id'";
          $login = mysqli_query($koneksi, $sql);
          $ketemu = mysqli_num_rows($login);
          $b = mysqli_fetch_array($login);

          if ($ketemu > 0) {
              session_start();
              $_SESSION['idsi'] = $b['id_karyawan'];
              $_SESSION['usersi'] = $b['username'];
              $_SESSION['namasi'] = $b['nama'];
              $_SESSION['ttlsi'] = $b['tmp_tgl_lahir'];
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
                echo "
                <script>
                    // Function to display success message in a popup
                    function displaySuccessPopup() {
                        var popup = document.createElement('div');
                        popup.classList.add('popup');
                        var message = document.createElement('p');
                        message.innerHTML = 'ABSEN BERHASIL!!!<br>$nama<br>$waktu';
                        popup.appendChild(message);
                        document.body.appendChild(popup);
                        setTimeout(function() {
                            popup.remove();
                            window.location.href = 'login_karyawan.php'; // Redirect to another page after popup close
                        }, 3000); // Adjust the time (in milliseconds) the popup remains visible
                    }
                    displaySuccessPopup();
                </script>";
            } 
            else {
              echo "
              <script>
                  // Function to display failure message in a popup
                  function displayFailurePopup() {
                      var popup = document.createElement('div');
                      popup.classList.add('popup');
                      var message = document.createElement('p');
                      message.textContent = 'ID SALAH ATAU TIDAK TERDAFTAR';
                      popup.appendChild(message);
                      document.body.appendChild(popup);
                      setTimeout(function() {
                          popup.remove();
                      }, 3000); // Adjust the time (in milliseconds) the popup remains visible
                  }
                  displayFailurePopup();
              </script>";
          }
          } 
          else {
            echo "
            <script>
                // Function to display failure message in a popup
                function displayFailurePopup() {
                    var popup = document.createElement('div');
                    popup.classList.add('popup');
                    var message = document.createElement('p');
                    message.textContent = 'ID SALAH ATAU TIDAK TERDAFTAR';
                    popup.appendChild(message);
                    document.body.appendChild(popup);
                    setTimeout(function() {
                        popup.remove();
                    }, 3000); // Adjust the time (in milliseconds) the popup remains visible
                }
                displayFailurePopup();
            </script>";
        }
        }
        ?>
      </div>
    </div>
  </div>
</body>
</html>
