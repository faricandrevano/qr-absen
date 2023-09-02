<?php session_start(); error_reporting(0);
    require_once'../sw-library/sw-config.php'; 
    require_once'../sw-library/sw-function.php';
    include_once'../sw-library/vendor/autoload.php';
if(!isset($_COOKIE['COOKIES_MEMBER']) OR !isset($_COOKIE['COOKIES_COOKIES'])){
    //Kondisi tidak login
}

else{
    require_once'../sw-mod/out/sw-cookies.php';
  //kondisi login
switch (@$_GET['action']){


/* -------  CETAK PDF----------*/
case 'pdf':
$query ="SELECT employees.id,employees.employees_name,employees.position_id,position.position_name,shift.time_in,shift.time_out FROM employees,position,shift WHERE employees.position_id=position.position_id AND employees.shift_id=shift.shift_id AND employees.id='$row_user[id]'";
$result = $connection->query($query);
  if($result->num_rows > 0){
  $row= $result->fetch_assoc();
  $shift_time_in  = $row['time_in'];
	$shift_time_out  = $row['time_out'];
if(isset($_GET['from']) OR isset($_GET['to'])){
      $from = date('Y-m-d', strtotime($_GET['from']));
      $to   = date('Y-m-d', strtotime($_GET['to']));
      $filter ="presence_date BETWEEN '$from' AND '$to'";
  } 
  else{
      $filter ="MONTH(presence_date) ='$month'";
}


    $mpdf = new \Mpdf\Mpdf();
    ob_start();
    
    $mpdf->SetHTMLFooter('
      <table width="100%" style="border-top:solid 1px #333;font-size:11px;">
          <tr>
              <td width="60%" style="text-align:left;">Simpanlah lembar Absensi ini.</td>
              <td width="35%" style="text-align: right;">Dicetak tanggal '.tgl_indo($date).'</td>
          </tr>
      </table>');
echo'<!DOCTYPE html>
<html>
<head>
    <title>Cetak Data Absensi</title>
    <style>
    body{font-family:Arial,Helvetica,sans-serif}.container_box{position:relative}.container_box .row h3{padding:10px 0;line-height:25px;font-size:20px;margin:5px 0 15px;text-transform: uppercase;}.container_box .text-center{text-align:center}.container_box .content_box{position:relative}.container_box .content_box .des_info{margin:20px 0;text-align:right}.container_box h3{
      font-size:30px;}
    table.customTable{width:100%;background-color:#fff;border-collapse:collapse;border-width:1px;border-color:#b3b3b3;border-style:solid;color:#000}table.customTable td,table.customTable th{border-width:1px;border-color:#b3b3b3;border-style:solid;padding:5px;text-align:left}table.customTable thead{background-color:#f6f3f8}.text-center{text-align:center}.badge-danger,a.badge-danger{background:#ff396f!important}.badge-success,a.badge-success{background:#1dcc70!important}.badge-warning,a.badge-warning{background:#ffb400!important;color:#fff}.badge-info,a.badge-info{background:#754aed!important}.badge{font-size:12px;line-height:1em;border-radius:100px;letter-spacing:0;height:22px;min-width:22px;padding:0 6px;display:inline-flex;align-items:center;justify-content:center;font-weight:400;color:#fff}
    </style>
</head>
<body>';
echo'
    <section class="container_box">
      <div class="row">';
      if(isset($_GET['from']) OR isset($_GET['to'])){
         echo'<h3>DATA ABSENSI "'.$employees_name.'" PER TANGGAl '.tanggal_ind($from).' S/D '.tanggal_ind($to).'</h3>';}
        else{
        echo'<h3>DATA ABSENSI "'.$employees_name.'" BULAN '.tanggal_indo($month_en).' '.$year.'</h3>';
        }
        echo'
      <div class="content_box">
        <table class="customTable">
          <thead>
            <tr>
              <th class="text-center">No.</th>
              <th>Tanggal</th>
              <th>Waktu Masuk</th>
              <th>Waktu Pulang</th>
              <th>Status</th>
              <th>Keterangan</th>
            </tr>
          </thead>
        <tbody>';

    $query_absen ="SELECT presence_id,presence_date,picture_in,time_in,picture_out,time_out,present_id, latitude_longtitude_in,information,TIMEDIFF(TIME(time_in),'$shift_time_in') AS selisih,if (time_in>'$shift_time_in','Telat',if(time_in='00:00:00','Tidak Masuk','Tepat Waktu')) AS status, if (time_out<'$shift_time_out','Pulang Cepat','Tepat Waktu') AS status_pulang FROM presence WHERE employees_id='$row_user[id]' AND $filter ORDER BY presence_id ASC";
    $result_absen = $connection->query($query_absen);
    if($result_absen->num_rows > 0){
    while ($row_absen= $result_absen->fetch_assoc()) {
        $query_status ="SELECT present_name FROM  present_status WHERE present_id='$row_absen[present_id]'";
        $result_status = $connection->query($query_status);
        $row_aa= $result_status->fetch_assoc();
        $no++;
        if($row_absen['information']==''){
          $information = '';
        }else{
          $information = '<br>'.$row_absen['information'].'';
        }

        if($row_absen['status']=='Telat'){
          $status_time_in =' <span class="badge badge-danger">'.$row_absen['status'].'</span>';
        }
          elseif ($row_absen['status']=='Tepat Waktu') {
          $status_time_in =' <span class="badge badge-success">'.$row_absen['status'].'</span>';
        }
        else{
          $status_time_in ='';
        }

        if($row_absen['status_pulang']=='Pulang Cepat'){
          $status_pulang='<span class="badge badge-danger">'.$row_absen['status_pulang'].'</span>';
        }
        else{
          $status_pulang='';
        }


       echo'<tr>
              <td class="text-center">'.$no.'</td>
              <td>'.tanggal_indo($row_absen['presence_date'], true).'</td>
              <td>'.$row_absen['time_in'].' '.$status_time_in.'</td>
              <td>'.$row_absen['time_out'].' '.$status_pulang.'</td>
              <td>'.$row_aa['present_name'].'</td>
              <td>'.$row_absen['information'].'</td>
            </tr>';
        }
  
      }else{
        echo'<center><h3>Data tidak ditemukan..!</h3></center>';
      }
      echo'<tbody>
      </table>';

      $query_hadir="SELECT presence_id FROM presence WHERE employees_id='$row_user[id]' AND $filter AND present_id='1' ORDER BY presence_id DESC";
      $hadir= $connection->query($query_hadir);

      $query_sakit="SELECT presence_id FROM presence WHERE employees_id='$row_user[id]' AND $filter AND present_id='2' ORDER BY presence_id";
      $sakit = $connection->query($query_sakit);

      $query_izin="SELECT presence_id FROM presence WHERE employees_id='$row_user[id]' AND $filter AND present_id='3' ORDER BY presence_id";
      $izin = $connection->query($query_izin);

      $query_telat ="SELECT presence_id FROM presence WHERE employees_id='$row_user[id]' AND $filter AND time_in>'$shift_time_in'";
      $telat = $connection->query($query_telat);

      $query_pulang ="SELECT presence_id FROM presence WHERE employees_id='$row_user[id]' AND $filter AND time_out<'$shift_time_out'";
      $pulang = $connection->query($query_pulang);
      echo'
      <p>Hadir : <span class="badge badge-success">'.$hadir->num_rows.'</span></p>
      <p>Telat : <span class="label badge badge-danger">'.$telat->num_rows.'</span></p>
      <p>Pulang Cepat : <span class="badge badge-danger">'.$pulang->num_rows.'</span></p>
      <p>Sakit : <span class="badge badge-warning">'.$sakit->num_rows.'</span></p>
      <p>Izin : <span class="badge badge-info">'.$izin->num_rows.'</span></p>
        </div>
      </div>
    </section>
</body>
</html>';
    $html = ob_get_contents(); 
    ob_end_clean();
    $mpdf->WriteHTML(utf8_encode($html));
    $mpdf->Output("Absensi-$employees_name-$date.pdf" ,'I');

}else{

}

break;
case 'excel':
$query ="SELECT employees.id,employees.employees_name,employees.position_id,position.position_name,shift.time_in,shift.time_out FROM employees,position,shift WHERE employees.position_id=position.position_id AND employees.shift_id=shift.shift_id AND employees.id='$row_user[id]'";
$result = $connection->query($query);

  if($result->num_rows > 0){
  $row= $result->fetch_assoc();
  $shift_time_in  = $row['time_in'];
  $shift_time_out  = $row['time_out'];

  if(isset($_GET['from']) OR isset($_GET['to'])){
        $from = date('Y-m-d', strtotime($_GET['from']));
        $to   = date('Y-m-d', strtotime($_GET['to']));
        $filter ="presence_date BETWEEN '$from' AND '$to'";
    } 
    else{
        $filter ="MONTH(presence_date) ='$month'";
  }

   header("Content-type: application/vnd-ms-excel");
   header("Content-Disposition: attachment; filename=Data-Absensi-$employees_name-$date.xls");

echo'<!DOCTYPE html>
<html>
<head>
    <title>Cetak Data Absensi</title>
    <style>
    body{font-family:Arial,Helvetica,sans-serif}.container_box{position:relative}.container_box .row h3{padding:10px 0;line-height:25px;font-size:20px;margin:5px 0 15px;text-transform: uppercase;}.container_box .text-center{text-align:center}.container_box .content_box{position:relative}.container_box .content_box .des_info{margin:20px 0;text-align:right}.container_box h3{
      font-size:30px;}
      table.customTable{width:100%;background-color:#fff;border-collapse:collapse;border-width:1px;border-color:#b3b3b3;border-style:solid;color:#000}table.customTable td,table.customTable th{border-width:1px;border-color:#b3b3b3;border-style:solid;padding:5px;text-align:left}table.customTable thead{background-color:#f6f3f8}.text-center{text-align:center}.badge-danger,a.badge-danger{background:#ff396f!important}.badge-success,a.badge-success{background:#1dcc70!important}.badge-warning,a.badge-warning{background:#ffb400!important;color:#fff}.badge-info,a.badge-info{background:#754aed!important}.badge{font-size:12px;line-height:1em;border-radius:100px;letter-spacing:0;height:22px;min-width:22px;padding:0 6px;display:inline-flex;align-items:center;justify-content:center;font-weight:400;color:#fff}
    </style>
</head>
<body>';
echo'
    <section class="container_box">
      <div class="row">';
      if(isset($_GET['from']) OR isset($_GET['to'])){
        echo'<h3>DATA ABSENSI "'.$employees_name.'" PER TANGGAl '.tanggal_ind($from).' S/D '.tanggal_ind($to).'</h3>';}
      else{
         echo'<h3>DATA ABSENSI "'.$employees_name.'" BULAN '.tanggal_indo($month_en).' '.$year.'</h3>';
      }
        echo'
      <div class="content_box">
        <table class="customTable">
          <thead>
            <tr>
              <th class="text-center">No.</th>
              <th>Tanggal</th>
              <th>Waktu Masuk</th>
              <th>Waktu Pulang</th>
              <th>Status</th>
              <th>Keterangan</th>
            </tr>
          </thead>
        <tbody>';
        $no=0;
    $query_absen ="SELECT presence_id,presence_date,picture_in,time_in,picture_out,time_out,present_id, latitude_longtitude_in,information,TIMEDIFF(TIME(time_in),'$shift_time_in') AS selisih,if (time_in>'$shift_time_in','Telat',if(time_in='00:00:00','Tidak Masuk','Tepat Waktu')) AS status, if (time_out<'$shift_time_out','Pulang Cepat','Tepat Waktu') AS status_pulang FROM  presence WHERE employees_id='$row_user[id]' AND $filter ORDER BY presence_id ASC";
    $result_absen = $connection->query($query_absen);
    if($result_absen->num_rows > 0){
    while ($row_absen= $result_absen->fetch_assoc()) {
        $query_status ="SELECT present_name FROM  present_status WHERE present_id='$row_absen[present_id]'";
        $result_status = $connection->query($query_status);
        $row_aa= $result_status->fetch_assoc();
        $no++;
        if($row_absen['information']==''){
          $information = '';
        }else{
          $information = '<br>'.$row_absen['information'].'';
        }

        if($row_absen['status']=='Telat'){
          $status_time_in =' <span class="badge badge-danger">'.$row_absen['status'].'</span>';
        }
          elseif ($row_absen['status']=='Tepat Waktu') {
          $status_time_in =' <span class="badge badge-success">'.$row_absen['status'].'</span>';
        }
        else{
          $status_time_in ='';
        }

        if($row_absen['status_pulang']=='Pulang Cepat'){
          $status_pulang='<span class="badge badge-danger">'.$row_absen['status_pulang'].'</span>';
        }
        else{
          $status_pulang='';
        }

        echo'<tr>
              <td class="text-center">'.$no.'</td>
              <td>'.tanggal_indo($row_absen['presence_date'], true).'</td>
              <td>'.$row_absen['time_in'].' '.$status_time_in.'</td>
              <td>'.$row_absen['time_out'].' '. $status_pulang.'</td>
              <td>'.$row_aa['present_name'].'</td>
              <td>'.$information.'</td>
            </tr>';
        }
  
      }else{
        echo'<center><h3>Data tidak ditemukan..!</h3></center>';
      }
      echo'<tbody>
      </table>';
      $query_hadir="SELECT presence_id FROM presence WHERE employees_id='$row_user[id]' AND $filter AND present_id='1' ORDER BY presence_id DESC";
      $hadir= $connection->query($query_hadir);

      $query_sakit="SELECT presence_id FROM presence WHERE employees_id='$row_user[id]' AND $filter AND present_id='2' ORDER BY presence_id";
      $sakit = $connection->query($query_sakit);

      $query_izin="SELECT presence_id FROM presence WHERE employees_id='$row_user[id]' AND $filter AND present_id='3' ORDER BY presence_id";
      $izin = $connection->query($query_izin);

      $query_telat ="SELECT presence_id FROM presence WHERE employees_id='$row_user[id]' AND $filter AND time_in>'$shift_time_in'";
      $telat = $connection->query($query_telat);

      $query_pulang ="SELECT presence_id FROM presence WHERE employees_id='$row_user[id]' AND $filter AND time_out<'$shift_time_out'";
      $pulang = $connection->query($query_pulang);
      echo'
      <p>Hadir : <span class="badge badge-success">'.$hadir->num_rows.'</span></p>
      <p>Telat : <span class="label badge badge-danger">'.$telat->num_rows.'</span></p>
      <p>Pulang Cepat : <span class="badge badge-danger">'.$pulang->num_rows.'</span></p>
      <p>Sakit : <span class="badge badge-warning">'.$sakit->num_rows.'</span></p>
      <p>Izin : <span class="badge badge-info">'.$izin->num_rows.'</span></p>

        </div>
      </div>
    </section>
</body>
</html>';
}else{
  echo'Data tidak ditemukan';
}

  break;
}
}?>