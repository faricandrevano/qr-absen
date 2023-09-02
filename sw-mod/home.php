<?php
    session_start();
    require 'sw-library/sw-config.php';

    // if (isset($_COOKIE['id']) && isset($_COOKIE['cook_login'])) {
    //     $id = $_COOKIE['id'];
    //     $cook_login = $_COOKIE['cook_login'];

    //     $result = mysqli_query($connection, "SELECT nama FROM akun_siswa WHERE id = $id");
    //     $kue_result = mysqli_fetch_assoc($result);

    //     if($cook_login === hash('sha256', $kue_result['nama'])) {
    //         $dataUser = $_SESSION['user'];
    //     }
    // }

    // $dataUser = $_SESSION['user'];
    $dataUser = $_COOKIE['cook_login'];
    $query = mysqli_query($connection, "SELECT * FROM akun_qr WHERE nama = '$dataUser'");
    $fetch = mysqli_fetch_array($query);

if ($mod ==''){
    header('location:../404');
    echo'kosong';
}else{
    include 'sw-header.php';
    // if (!isset($_SESSION['user'])){
    if (!isset($_COOKIE['cook_login'])){
        include 'login.php';
        // if (!isset($_SESSION["user"]) ) {
        // }
    }
else{

  echo'<!-- App Capsule -->
    <div id="appCapsule">
        <!-- Wallet Card -->
        <div class="section bg-dark pt-1">
            <div class="row justify-content-center">
            <div class="col-lg-8 col-12">
            <div class="wallet-card mt-3 mb-5">
                    <!-- Balance -->
                <div class="balance">
                    <div class="left">
                        <span class="title"> Selamat '.$salam.'</span>
                        <h1 class="overflow-hidden">'.ucfirst($fetch['nama']).'</h1>
                    </div>
                </div>

                <!-- <center class ="mb-1 p-0">
                    <span class = "text-danger">
                        * Klik Vote Design Expo dulu !!!
                    </span>
                </center>
                -->
                
                <!-- * Balance -->
                <!-- Wallet Footer -->
              

                <!--
                    <div class="item">
                        <a href="./absent">
                            <div class="icon-wrapper bg-primary">
                                <ion-icon name="camera-outline"></ion-icon>
                            </div>
                            <strong>Absen</strong>
                        </a>
                    </div>
                    -->

                   ';
                //    $tgl = date("d-m-Y H:i");
                   date_default_timezone_set("Asia/Jakarta");
                   $tgl = date("d-m-Y");
                   $nama = $_COOKIE["cook_login"];
                //    $nama = $_COOKIE["cook_login"];
                   $sql = mysqli_query($connection, "SELECT * FROM absen_masuk_siswa WHERE tgl = '$tgl' AND nama = '" . $nama . "'");
                   $row = mysqli_fetch_array($sql);
                   
                   if(!$row){

                    $cekVote = mysqli_query($connection, "SELECT * FROM akun_qr WHERE nama = '" . $nama . "'");
                    $rowVote = mysqli_fetch_array($cekVote);
                
                    

                        echo '

                              <div class="d-flex justify-content-center">
                                <a href="absendonk" class="btn btn-dark btn-lg w-25 mb-1">Scan Absen</a>
                              </div>
                        ';

                    }


                   echo '
                    

                <!-- * Wallet Footer -->
                </div>
            </div>
        </div>
        <!-- Wallet Card -->
            </div>


            </body>';

    if ($row){
    echo '        
    <!-- Label Absensi Hari ini -->
    <div class="section mb-4 mt-4">
        <div class="card">
            <div class="card-body pb-1">
                <div class="row justify-content-center">
                        <img src="sw-content/checklist.png" class="img-fluid" width="150" height="150" alt="" srcset="">
                </div>
                <h1 class="text-center my-3 fs-2">Anda Sudah Scan Absen</h1>
                '; 
                // if ($row['status'] == "Telat") {
                //     echo '<h1 class="text-center text-danger">Anda Terlambat</h1>';
                // } else {
                //     echo '<h1 class="text-center text-success">Anda Tepat Waktu</h1>';
                // }
        
                echo '<div class="form-group basic">
                    <div class="input-wrapper">
                        <label class="label" for="email1">NIS</label>
                        <input type="text" value = '.ucfirst($fetch['nis']).' class="form-control" id="email" name="email" disabled>
                        <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                    </div>
                </div>

                <div class="form-group basic">
                    <div class="input-wrapper">
                        <label class="label" for="password1">Nama</label>
                        <input type="text" value = "'.ucfirst($fetch['nama']).'" class="form-control" disabled> 
                        <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                    </div>
                </div>
                <div class="form-group basic">
                    <div class="input-wrapper">
                        <label class="label" for="password1">Kelas</label>
                        <input type="text" value= "'.ucfirst($fetch['kelas']).'" class="form-control" id="password" name="password" disabled>
                        <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                    </div>
                </div>
                <div class="form-group basic">
                    <div class="input-wrapper">
                        <label class="label" for="password1">Jam</label>
                        <input type="text" value="' . $row["jam"] . '" class="form-control" id="password" name="password" disabled>
                        <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                    </div>
                </div>
                <div class="form-group basic">
                    <div class="input-wrapper">
                        <label class="label" for="password1">Lokasi</label>
                        <input type="text" value="' . $row["lokasi"] . '" class="form-control" id="password" name="password" disabled>
                        <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                    </div>
                </div>
                <div class="form-group basic">
                    <div class="input-wrapper">
                        <label class="label" for="password1">Status Kehadiran</label>
                        <input type="text" value="' . $row["status"] . '" class="form-control" id="password" name="password" disabled>
                        <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
    </div>';

    }

    }

  include_once 'sw-footer.php';

}