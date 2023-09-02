<?php 

    session_start();
    require 'sw-library/sw-config.php';
    $dataUser = $_COOKIE['cook_login'];
    $query = mysqli_query($connection, "SELECT * FROM akun_qr WHERE nama = '$dataUser'");
    $fetch = mysqli_fetch_array($query);


if ($mod ==''){
    header('location:../404');
    echo'kosong';
}else{
    include_once 'sw-mod/sw-header.php';
// if(!isset($_SESSION['user'])){
if(!isset($_COOKIE['cook_login'])){
        // setcookie('COOKIES_MEMBER', '', 0, '/');
        // setcookie('COOKIES_COOKIES', '', 0, '/');
        // // Login tidak ditemukan
        // setcookie("COOKIES_MEMBER", "", time()-$expired_cookie);
        // setcookie("COOKIES_COOKIES", "", time()-$expired_cookie);
        // session_destroy();
        unset($_SESSION["user"]);
        // setcookie('cook_login', $_COOKIE['cook_login'], '-3 year');
        header("location:./");
}else{
  include 'tesScan.php';

  }
  include_once 'sw-mod/sw-footer.php';
} ?>




