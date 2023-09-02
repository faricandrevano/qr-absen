<?php
session_start();
require "sw-library/sw-config.php";

$nama = $_COOKIE["cook_login"];

$tombol = isset($_POST["tombol"]) ? $_POST["tombol"] : "";

mysqli_query($connection, "UPDATE akun_siswa SET status_vote = 'Y' WHERE nama = '" . $nama . "'");
?>