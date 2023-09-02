<?php error_reporting(0);
date_default_timezone_set('Asia/Jakarta');
$pacth_url	='http://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"].'';
// -------------- Koneksi Database ------------
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

if (!function_exists('base_url')) {
	function base_url($atRoot=FALSE, $atCore=FALSE, $parse=FALSE){
	if (isset($_SERVER['HTTP_HOST'])) {
		$http = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
		$hostname = $_SERVER['HTTP_HOST'];
		$dir = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
		$core = preg_split('@/@', str_replace($_SERVER['DOCUMENT_ROOT'], '', realpath(dirname(__FILE__))), NULL, PREG_SPLIT_NO_EMPTY);
		$core = $core[0];
		$tmplt = $atRoot ? ($atCore ? "%s://%s/%s/" : "%s://%s/") : ($atCore ? "%s://%s/%s/" : "%s://%s%s");
		$end = $atRoot ? ($atCore ? $core : $hostname) : ($atCore ? $core : $dir);
		$base_url = sprintf( $tmplt, $http, $hostname, $end );
	}
	else $base_url = 'http://localhost/';
		if ($parse) {
			$base_url = parse_url($base_url);
			if (isset($base_url['path'])) if ($base_url['path'] == '/') $base_url['path'] = '';
		}
			return $base_url;
		}
}
$base_url = base_url();?>