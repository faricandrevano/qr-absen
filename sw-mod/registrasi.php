<?php
require "sw-library/sw-config.php";

if (isset($_POST["register"]))
{
    // PROSEDUR REGISTER USER
    date_default_timezone_set("Asia/Jakarta");
    $tgl = date("d/m/Y H:i");
    $kelas = isset($_POST["kelas"]) ? $_POST["kelas"] : "";
    $nis = isset($_POST["nis"]) ? $_POST["nis"] : "";
    $nama = isset($_POST["nama"]) ? $_POST["nama"] : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";
    $pw_hash = isset($_POST["password"]) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : "";

    // CEK APAKAH DATA KOSONG
    if (empty($kelas) or empty($nis) or empty($nama) or empty($password) or empty($pw_hash)){  
        echo '<script>alert("MAAF, SILAHKAN ISI DATA TERLEBIH DAHULU !"); window.location = "";</script>';
    } else {

        // CEK & VALIDASI DATA
        $cek = mysqli_query($connection, "SELECT * FROM akun_qr WHERE nis = '$nis' AND nama = '$nama'");
        $hsl = mysqli_fetch_array($cek);

        if ($hsl > 0){
            echo '<script>alert("MAAF, NIS / NAMA TERSEBUT TELAH ADA. SILAHKAN ISI YANG LAIN !"); window.location = "";</script>';
        } else {
            $query = mysqli_query($connection,"SELECT kelas FROM kelas WHERE id = '$kelas' ");
            $row = mysqli_fetch_array($query);
            mysqli_query($connection, "INSERT INTO akun_qr (tgl, nis, nama, kelas, password, pw_hash) VALUES ('$tgl', '$nis', '$nama', '$row[kelas]', '$password', '$pw_hash')");

            echo '<script>alert("REGISTRASI BERHASIL !"); window.location = "./";</script>';

        }

    }

}

?>


<?php 
if ($mod ==''){
    header('location:../404');
    echo'kosong';
}else{
    include_once 'sw-mod/sw-header.php';
if(!isset($_COOKIE['COOKIES_MEMBER']) OR !isset($_COOKIE['COOKIES_COOKIES'])){
 echo'
 <!-- App Capsule -->
    <div id="appCapsule" style="margin-top: -40px">
        <div class="section text-center">
            <h1>Daftar Akun</h1>
            <img src="./sw-content/logotels.png" alt="" width="80" >
        </div>
        
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="section mb-5 p-2">
                <form method="post">
                    <div class="card">
                        <div class="card-body pb-1">

                        <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="fs-1 text-dark fw-bold">KELAS</label>
                            <div class="">
                                <label class="text-danger fw-bold">*(Isi Kelas Terlebih Dahulu)</label>
                            </div>
                            <select name="kelas" id="kelas" class="form-control" required>
                                <option selected disabled>--- SILAHKAN PILIH ---</option>
                                ';
                                $query = "SELECT  id, kelas FROM kelas";
                                $result = $connection->query($query);
                                while ($row = $result->fetch_assoc()) {
                                echo '
                                <option value="' . $row['id'] . '">' . $row['kelas'] . '</option>';
                                };
                            echo'
                            </select>
                        </div>
                        </div>

                            <div class="form-group basic">
                                <div class="input-wrapper">
                                    <label class="fs-1 text-dark">NIS</label>
                                    <!--
                                    <input type="text" class="form-control" id="nis" name="nis" required>
                                    <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                                    -->
                                    <select name="nis" id="nis" class="form-control" required>
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group basic">
                                <div class="input-wrapper">
                                    <label class="text-dark fs-1">NAMA LENGKAP</label>
                                        <!-- <input type="text" class="form-control" id="nama" name="nama" required disabled> -->
                                        <span id="nama"></span>
                                    <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                                </div>
                            </div>
            
                            <div class="form-group basic">
                                <div class="input-wrapper">
                                    <label class="fs-1 text-dark" for="password1">PASSWORD</label>
                                    <div class="">
                                        <label class="text-danger fw-bold">*(Buat password dengan huruf atau angka!! MAX 6 karakter)</label>
                                    </div>
                                    <input type="password" class="form-control form-password" id="password" name="password" placeholder="Masukkan Password" maxlength="6" required>
                                    <input type="checkbox" class="form-checkbox"> Lihat Password
                                </div>
                            </div>
                                    <br>
                            
                            <div class="mb-2">
                                <button name="register" type="submit" class="btn btn-dark btn-block">Daftar Akun</button>
                                <div class = "mt-2">
                                    <a href=./>Sudah punya akun ? Login disini</a>
                                </div>
                            </div>
                        </div>
                    </div>


                </form>
            </div>
            </div>
        </div>

    </div>
    
    <!-- * App Capsule -->';
    include 'pw_show.js';                               
    }
  else{

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