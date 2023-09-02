<?php
// require "sw-library/config.php"; --> DASAR... ERROR MULU
// KONEKIN DISINI AJELAH :
$DB_HOST 	= 'localhost';
$DB_USER 	= 'root'; // User Database
$DB_PASSWD  = ''; // Password Database
$DB_NAME 	= 'tels_absensi'; // Nama database
// -------------- Koneksi Database ------------
@define("DB_HOST", $DB_HOST);
@define("DB_USER", $DB_USER);
@define("DB_PASSWD" , $DB_PASSWD);
@define("DB_NAME", $DB_NAME);
$connection = NEW mysqli( $DB_HOST, $DB_USER, $DB_PASSWD, $DB_NAME );
if ($connection->connect_error){
		echo 'Gagal koneksi ke database';
	} else {
		$query_site  = "SELECT * FROM sw_site LIMIT 1";
		$result_site = $connection->query($query_site);
		$row_site    = $result_site->fetch_assoc();
		extract($row_site);
}

// PROSEDUR SIMPAN DATA ABSENSI
date_default_timezone_set("Asia/Jakarta");
$tgl = date("d-m-Y");
$nama = $_POST["nama"];
$longitude = $_POST["longitude"];
$latitude = $_POST["latitude"];

// queryyyy
$sql = mysqli_query($connection, "SELECT kelas,id FROM akun_qr WHERE nama = '$nama'");
$row = mysqli_fetch_array($sql);
$kelas = $row["kelas"];
$id_user = $row["id"];
// jammm
$jam = date("H") . ":" . date("i") . ":" . date("s");

// Tes Lokasi di dpn masjid pas wastafel - 1!!!
// if (($_POST["longitude"] == 107.0610848 && $_POST["latitude"] == -6.253606) ||

// Lokasi 3 di jalan bolong dpn masjid
// ($_POST["longitude"] == 107.061172 && $_POST["latitude"] == -6.2536292) ||

// Lokasi maps di depan gerbang
// ($_POST["longitude"] == 106.8302336 && $_POST["latitude"] == -6.2488576)
// if ($_POST["proses"] == "Y") {
//     $a = 'SMK Telekomunikasi Telesandi';
// } else {
// 	$a = 'Luar Sekolah';
// }

// $lokasi = $a;

$lokasi = "SMK Telekomunikasi Telesandi";

// CEK STATUS ABSEN SISWA, APAKAH TEPAT WAKTU / TELAT WAKTU
if ($jam >= "05:00" AND $jam <= "07:00"){
	$status = "Tepat Waktu";
} else {
	$status = "Telat";
}

mysqli_query($connection, "INSERT INTO absen_masuk_siswa (id_user,tgl, nama, kelas, jam, lokasi, status) VALUES ('$id_user','$tgl', '$nama', '$kelas', '$jam', '$lokasi', '$status')");
?>