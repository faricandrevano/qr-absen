<?php
    session_start();
    require 'sw-library/sw-config.php';
    $dataUser = $_COOKIE['cook_login'];
    $query = mysqli_query($connection, "SELECT * FROM akun_qr WHERE nama = '$dataUser'");
    $result = $query->fetch_assoc();
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
    echo'
<section class="content-header">
    <ol class="breadcrumb">
      <li class="active">Data Absensi Siswa</li>
    </ol>
</section>';
echo'
<section class="content">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Data Absensi Siswa</b></h3>
';
          
echo '
        </div>
        <div class="box-body">
          <div class="table-responsive">
            <table id="swdatatable" class="table table-bordered">
            <thead>
            <tr>
              <th style="width: 10px">No</th>
              <th>Tgl. Absen</th>
              <th>Nama</th>
              <th>Kelas</th>
              <th>Jam</th>
              <th>Status</th>
              <th>Lokasi</th>
            </tr>
            </thead>
            <tbody>';
            $query = "SELECT * FROM absen_masuk_siswa WHERE id_user = '$result[id]' ORDER BY id DESC";
            $resultkelas = $connection->query($query);
            if($resultkelas->num_rows > 0){
            $no=0;
            while ($row= $resultkelas->fetch_assoc()) {
              $no++;
              echo'
              <tr>
                <td class="text-center">'.$no.'</td>
                <td>'.$row['tgl'].'</td>
                <td>'.$row['nama'].'</td>
                <td>'.$row['kelas'].'</td>
                <td>'.$row['jam'].'</td>
                <td>'.$row['status'].'</td>
                <td>'.$row['lokasi'].'</td>
                
              </tr>';}}
            echo'
            </tbody>
          </table>
          </div>
        </div>
    </div>
  </div> 
</section>
 ';
}
include_once 'sw-mod/sw-footer.php';

}?>