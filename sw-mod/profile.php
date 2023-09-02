<?php 

    session_start();
    require 'sw-library/sw-config.php';
    $dataUser = $_COOKIE['cook_login'];
    // $dataUser = $_SESSION['user'];
    $query = mysqli_query($connection, "SELECT * FROM akun_qr WHERE nama = '$dataUser'");
    $fetch = mysqli_fetch_array($query);


if ($mod ==''){
    header('location:../404');
    echo'kosong';
}else{
    include_once 'sw-mod/sw-header.php';
// if(!isset($_SESSION['user'])){
if (!isset($_COOKIE['cook_login'])){
        // setcookie('COOKIES_MEMBER', '', 0, '/');
        // setcookie('COOKIES_COOKIES', '', 0, '/');
        // // Login tidak ditemukan
        // setcookie("COOKIES_MEMBER", "", time()-$expired_cookie);
        // setcookie("COOKIES_COOKIES", "", time()-$expired_cookie);
        // session_destroy();
        unset($_SESSION["user"]);
        setcookie('cook_login', $_COOKIE['cook_login'], '-3 year');
        header("location:./");
}else{
  echo'<!-- App Capsule -->
    <div id="appCapsule" class="container">

        <div class="section">

            <h1 class="text-center mt-3 mb-3">Profil Saya</h1>
            <div class="card">
                <div class="card-body">
                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label for="disabledTextInput" disabled class="fs-1 text-dark" for="text4">NIS Sekolah: </label>
                                <input type="text" id="disabledTextInput" disabled class="form-control bg-dark" value="'.$fetch['nis'].'">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>

                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="fs-1 text-dark" for="email4">Nama : </label>
                                <input type="text" class="form-control bg-dark" disabled id="name" name="employees_name" value="'.$fetch['nama'].'" required>
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>

                        <div class="form-group boxed">
                            <div class="input-wrapper">
                            <label for="disabledTextInput" disabled class="fs-1 text-dark" for="text4">Kelas : </label>
                            <input type="text" id="disabledTextInput" disabled class="form-control bg-dark" value="'.$fetch['kelas'].'">
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                            </div>
                        </div>

                        
                        <hr>
                            <a href="./logout">
                            <button type="" class="btn btn-outline-dark mr-1 btn-lg btn-block  btn-profile"><ion-icon size="small" name="log-out-outline"></ion-icon>Logout</button>
                            </a>

                </div>
            </div>
        </div>
        
    </div>
    <!-- * App Capsule -->
';

  }
  include_once 'sw-mod/sw-footer.php';
} ?>