<?php 
if ($mod ==''){
    header('location:../404');
    echo'kosong';
}else{
    include_once 'sw-mod/sw-header.php';
    require_once'./sw-library/phpqrcode/qrlib.php'; 
if(!isset($_COOKIE['COOKIES_MEMBER'])){
            setcookie('COOKIES_MEMBER', '', 0, '/');
            setcookie('COOKIES_COOKIES', '', 0, '/');
            // Login tidak ditemukan
            setcookie("COOKIES_MEMBER", "", time()-$expired_cookie);
            setcookie("COOKIES_COOKIES", "", time()-$expired_cookie);
            session_destroy();
            header("location:./");
    }else{

      $codeContents = $row_user['employees_code'];
      $tempdir = './sw-content/employees-code-qr/';
      #parameter inputan
      $isi_teks = $codeContents;
      $namafile = ''.$row_user['employees_code'].'.jpg';
      if(file_exists('./sw-content/employees-code-qr/'.$namafile.'')){
          $namafile = ''.$row_user['employees_code'].'.jpg';
        }else{
          $quality = 'L'; //ada 4 pilihan, L (Low), M(Medium), Q(Good), H(High)
          $ukuran = 5; //batasan 1 paling kecil, 10 paling besar
          $padding = 1;
          QRCode::png($isi_teks,$tempdir.$namafile,$quality,$ukuran,$padding);
        }

  echo'
  <!-- App Capsule -->
    <div id="appCapsule">
        <!-- Wallet Card -->
        <div class="section wallet-card-section pt-1 mb-4">
            <div class="wallet-card">
                <div class="text-center">
                    <!-- * ID Card -->
                    <div class="id-card">
                        <div class="body-id-card text-center" id="divToPrint">
                            <div class="avatar">';
                                if($row_user['photo'] ==''){
                                    echo'<img src="'.$base_url.'sw-content/avatar.jpg" alt="image" class="imaged w100 rounded">';
                                    }else{
                                    echo'
                                    <img src="timthumb?src='.$base_url.'sw-content/karyawan/'.$row_user['photo'].'&h=100&w=105" alt="'.$row_user['employees_name'].'" class="imaged w100 rounded">';}
                            echo'
                            </div>
                            <h3>'.$row_user['employees_name'].'</h3>
                            <p>'.$row_user['employees_code'].'</p>
                            <div class="barcode">
                                <img class="img-responsive text-center" src="'.$tempdir.''.$namafile.'" alt="QR CODE">
                            </div>
                            <p>'.$row_user['employees_code'].'</p>
                        </div>
                    </div>';?>
                    <hr>
                    <a href="#" class="btn btn-primary btn-lg btn-Convert-Html2Image"><ion-icon name="save-outline"></ion-icon> Siampan ID Card</a>
                    <div id="previewImage" class="d-none"></div>
                </div>
            </div>
        </div>
        <!-- Wallet Card --> 
    </div>
    <!-- * App Capsule -->
    <?php
  }
  include_once 'sw-mod/sw-footer.php';
} ?>