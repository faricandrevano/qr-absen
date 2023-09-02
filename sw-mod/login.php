<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
<?php
session_start();
require "sw-library/sw-config.php";

if (isset($_POST["login"]))
{
    $nis = mysqli_real_escape_string($connection, isset($_POST["nis"]) ? $_POST["nis"] : "");
    $password = mysqli_real_escape_string($connection, isset($_POST["password"]) ? $_POST["password"] : "");
    // $pw_hash = mysqli_real_escape_string($connection, isset($_POST["password"]) ? password_verify($password, $pw_hash): "");

    if (!empty($nis) || !empty($password)) {
        $cek = mysqli_query($connection, "SELECT * FROM akun_qr WHERE nis = '$nis'");
        $data = mysqli_fetch_array($cek);
        $jml=mysqli_num_rows($cek);
        if ($jml > 0) {
            if(password_verify($password, $data['pw_hash'])) {
                // $_SESSION['full_name']=$data['full_name'];
                // $_SESSION['user_autentification']="valid";
                setcookie('cook_login', $data["nama"], time()+99*99*99*99);
                header("Location: ./");
             }else{
                echo '<script>alert("Password salah!"); window.location = "";</script>';
             }
        } else {
            echo '<script>alert("Nis salah!"); window.location = "";</script>';
        }

    }

    // CEK APAKAH USER ADA DI DATABASE
    // $cek = mysqli_query($connection, "SELECT * FROM akun_siswa WHERE nis = '$nis' && pw_hash = '$password'");
    // $hsl = mysqli_fetch_array($cek);

    // if (!($hsl)){
    //     echo '<script>alert("MAAF, NIS / PASSWORD ANDA SALAH. SILAHKAN ULANGI LAGI !"); window.location = "";</script>';
    // } else {

    //     // $_SESSION["user"] = $hsl["nama"];
    //     // setcookie('id', $hsl["id"], time()+99*99*99*99);
    //     setcookie('cook_login', $hsl["nama"], time()+99*99*99*99);
    //     header("Location: ./");

    // }

}


?>

<?php 
if ($mod ==''){
    header('location:../404');
    echo'kosong';
}else{
    include_once 'sw-mod/sw-header.php';
if(!isset($_COOKIE['COOKIES_MEMBER'])){

$query = mysqli_query($connection, "SELECT max( employees_code) as kodeTerbesar FROM employees");
$data = mysqli_fetch_array($query);
$kode_karyawan = $data['kodeTerbesar'];
$urutan = (int) substr($kode_karyawan, 3, 3);
$urutan++;
$huruf = "OM";
$kode_karyawan = $huruf . sprintf("%03s", $urutan);

 echo'
 
 <!-- App Capsule -->
    <div id="appCapsule">

        <div class="section text-center">
            <h1>Login Absen</h1>
            <img src="./sw-content/logotels.png" alt="" width="100" >
        </div>
        
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="section mb-5 p-2">

                <form method="post">
                    <div class="card">
                        <div class="card-body pb-1">
                            <div class="form-group basic">
                                <div class="input-wrapper">
                                    <label class="fs-1 text-dark" for="email1">NIS</label>
                                    <input type="number" class="form-control" id="nis" name="nis" placeholder="Masukkan NIS Anda">
                                    <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                                </div>
                            </div>
            
                            <div class="form-group basic">
                                <div class="input-wrapper">
                                    <label class="fs-1 text-dark" for="password1">PASSWORD</label>
                                    <input type="password" class="form-control form-password" id="password" name="password" placeholder="Masukkan Password" maxlength="6" required>
                                    <input type="checkbox" class="form-checkbox"> Lihat Password
                                </div>
                            </div>

                            <div class="my-3">
                                <button name="login" type="submit" class="btn btn-dark btn-block btn-lg">
                                <ion-icon name="log-in-outline"></ion-icon> Login</button>

                            <a href="registrasi" class="btn btn-outline-dark mt-2 btn-block btn-lg">
                            <ion-icon name="log-out-outline"></ion-icon> Daftar Akun</a>
                            </div>
                        </div>
                    </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- * App Capsule -->';}
  else{
    header('location:./');
  }

  include_once 'sw-mod/sw-footer.php';
} ?>
<script type="text/javascript">
	$(document).ready(function(){		
		$('.form-checkbox').click(function(){
			if($(this).is(':checked')){
				$('.form-password').attr('type','text');
			}else{
				$('.form-password').attr('type','password');
			}
		})
	});
</script>