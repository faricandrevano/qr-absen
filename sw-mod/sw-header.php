<?php if(empty($connection)){
  header('location:./404');
} else {
  ob_start("minify_html");

  if ($mod== 'registrasi') {
    $title_web = 'Daftar Akun';
  } elseif ($mod == 'login') {
    $title_web = 'Login';
  } elseif ($mod == 'profile') {
    $title_web = 'Profil';
  } elseif ($mod = 'home') {
    $title_web = 'Beranda';
  }
echo'   
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover">
  <title>'.$title_web.'</title>
  <link rel="icon" href="./sw-content/logotels.png">
  <meta name="theme-color" content="#0000">
  <meta name="msapplication-navbutton-color" content="#0000">
  <meta name="apple-mobile-web-app-status-bar-style" content="#0000">


    <!-- Favicons -->
  <link rel="shortcut icon" href="'.$website_url.'/sw-content/logotels.png">
  <link rel="apple-touch-icon" href="'.$website_url.'/sw-content/logotels.png">
  <link rel="apple-touch-icon" sizes="72x72" href="'.$website_url.'/sw-content/logotels.png">
  <link rel="apple-touch-icon" sizes="114x114" href="'.$website_url.'/sw-content/logotels.png">
  
  <meta name="robots" content="index, follow">
  <meta name="description" content="'.$meta_description.'">
  <meta name="keywords" content="'.$meta_keyword.'">
  <meta name="author" content="'.$website_name.'">
  <meta http-equiv="Copyright" content="'.$website_name.'">
  <meta name="copyright" content="'.$website_name.'">
  <meta itemprop="image" content="sw-content/meta-tag.jpg">

  <link rel="stylesheet" href="'.$base_url.'/sw-mod/sw-assets/css/style.css">
  <link rel="stylesheet" href="'.$base_url.'/sw-mod/sw-assets/css/sw-custom.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">';
  if($mod =='history'){
    echo'
  <link rel="stylesheet" href="'.$base_url.'/sw-mod/sw-assets/js/plugins/datepicker/datepicker3.css">
  <link rel="stylesheet" href="'.$base_url.'/sw-mod/sw-assets/js/plugins/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="'.$base_url.'/sw-mod/sw-assets/js/plugins/magnific-popup/magnific-popup.css">';
}

echo'
</head>

<body>
<div class="loading"><div class="spinner-border" role="status"></div></div>
  <!-- loader -->
    <div style="background-color: #0d6efd" id="loader" class = "bg-primary">
        <img src="sw-mod/sw-assets/img/loading2.png" alt="icon" class="loading-icon">
    </div>
    <!-- * loader -->';
// if(isset($_SESSION['user'])){
if(isset($_COOKIE['cook_login'])){
// if (isset($_SESSION['user']) || isset($_COOKIE['cook_login'])){
  echo'
<!-- App Header -->
    <div class="appHeader bg-dark py-4 text-light">
        <div class="left">
            <a href="#" class="headerButton" data-toggle="modal" data-target="#sidebarPanel">
                <ion-icon name="menu-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">
            <img src="'.$base_url.'sw-content/logotels.png" width="50" height="40" alt="logo" class="">
        </div>
            <div class="headerButton" data-toggle="dropdown" id="dropdownMenuLink" aria-haspopup="true">';
              echo'
               <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">';?>
              </div>
            </div>
        </div>
    </div>
<?php
echo'<!-- App Sidebar -->
    <div class="modal fade panelbox panelbox-left" id="sidebarPanel" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <!-- profile box -->
                    <div class="profileBox pt-2 pb-2">
                        <div class="image-wrapper">';
                        if($row_user['photo'] ==''){
                        echo'<img src="'.$base_url.'/sw-content/user_dark.png" alt="image" class="imaged  w36">';
                        }else{
                        echo'<img src="timthumb?src='.$base_url.'sw-content/karyawan/'.$row_user['photo'].'&h=40&w=45" class="imaged  w36">';
                        }
                          echo'
                        </div>
                        <div class="in">
                            <strong>'.ucfirst($row_user['employees_name']).'</strong>
                            <div class="text-muted">'.$row_user['employees_code'].'</div>
                        </div>
                        <a href="#" class="btn btn-link btn-icon sidebar-close" data-dismiss="modal">
                            <ion-icon name="close-outline"></ion-icon>
                        </a>
                    </div>
                    <!-- * profile box -->
              
                    <!-- menu -->
                    <div class="listview-title mt-1">Menu</div>
                    <ul class="listview flush transparent no-line image-listview">
                        <li>
                            <a href="./" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="home-outline"></ion-icon>
                                </div> Home 
                            </a>
                        </li>
                        <li>
                            <a href="./absen" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="calendar-outline"></ion-icon>
                                </div> Histori Absen 
                            </a>
                        </li>
                        <li>
                            <a href="profile" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="person-outline"></ion-icon>
                                </div>
                                    Profil
                            </a>
                        </li>

                        </li>
                        <li>
                            <a href="./logout" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="log-out-outline"></ion-icon>
                                </div>
                                    Keluar
                            </a>
                        </li>

                    </ul>
                    <!-- * menu -->
                </div>
            </div>
        </div>
    </div>
    <!-- * App Sidebar -->';
  }
 }?>