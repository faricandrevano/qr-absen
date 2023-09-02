<?php session_start();
// Include file gpconfig
require_once'../sw-library/sw-function.php';
include_once '../sw-library/google-config.php';
$expired_cookie = time()+60*60*24*7;
if(isset($_GET['code'])){
	$gclient->authenticate($_GET['code']);
	$_SESSION['token'] = $gclient->getAccessToken();
	header('Location: ' . filter_var($redirect_url, FILTER_SANITIZE_URL));
}

if (isset($_SESSION['token'])) {
	$gclient->setAccessToken($_SESSION['token']);
}

if ($gclient->getAccessToken()) {
	include_once '../sw-library/sw-config.php';
	// Get user profile data from google
	$gpuserprofile 	= $google_oauthv2->userinfo->get();
	$name 			= $gpuserprofile['given_name']." ".$gpuserprofile['family_name']; // Ambil nama dari Akun Google
	$email 			= $gpuserprofile['email']; // Ambil email Akun Google nya
	$created_cookies=  md5($email);
	// Buat query untuk mengecek apakah data user dengan email tersebut sudah ada atau belum
	// Jika ada, ambil id, username, dan nama dari user tersebut
	$query ="SELECT id,employees_email,created_cookies FROM employees WHERE employees_email='$email'";
    $result= $connection->query($query);
    $row_user   = $result->fetch_assoc();

			if(empty($row_user)){
				// Jika User dengan email tersebut belum ada
				// Ambil username dari kata sebelum simbol @ pada email
				//$ex = explode('@', $email); // Pisahkan berdasarkan "@"
				//$username = $ex[0]; // Ambil kata pertama

				// Lakukan insert data user baru tanpa password
				$query = mysqli_query($connection, "SELECT max(employees_code) as kodeTerbesar FROM employees");
				$data = mysqli_fetch_array($query);
				$kode_karyawan = $data['kodeTerbesar'];
				$urutan = (int) substr($kode_karyawan, 3, 3);
				$urutan++;
				$huruf = "P-";
				$kode_karyawan = $huruf . sprintf("%03s", $urutan);
				$employees_code = ''.$kode_karyawan.'-'.$year.'';

				// Posisi
				$query_position="SELECT position_id FROM position order by position_id ASC";
  				$result_position = $connection->query($query_position);
  				$row_position   = $result_position->fetch_assoc();
  				$position_id    = $row_position['position_id'];

  				// Shift
				$query_shift="SELECT shift_id FROM shift order by shift_id ASC";
  				$result_shift = $connection->query($query_shift);
  				$row_shift   = $result_shift->fetch_assoc();
  				$shift_id    = $row_shift['shift_id'];

  				//Building
  				$query_building ="SELECT building_id FROM building order by building_id ASC";
  				$result_building = $connection->query($query_building);
  				$row_building   = $result_building->fetch_assoc();
  				$building_id   = $row_building['building_id'];

				$add ="INSERT INTO employees (employees_code,
		              employees_email,
		              employees_password,
		              employees_name,
		              position_id,
		              shift_id,
		              building_id,
		              photo,
		              created_login,
		              created_cookies) values('$employees_code',
		              '$email',
		              '', /*password kosong*/
		              '$name',
		              '$position_id',
		              '$shift_id', 
		              '$building_id', 
		              '', /*Photo kosong*/
		              '$date $time',
		              '$created_cookies')";
		        $connection->query($add);
				$id = mysqli_insert_id($connection); // Ambil id user yang baru saja di insert
			}else{
				$id 				= $row_user['id'];
				$created_cookies 	= $row_user['created_cookies']; 
			}

		$COOKIES_MEMBER         =  epm_encode($id);
		$COOKIES_COOKIES        =  $created_cookies;
      	setcookie('COOKIES_MEMBER', $COOKIES_MEMBER, $expired_cookie, '/');
      	setcookie('COOKIES_COOKIES', $COOKIES_COOKIES, $expired_cookie, '/');

    	header("location:../");
}else {
	$authUrl = $gclient->createAuthUrl();
	header("location: ".$authUrl);
}
?>
