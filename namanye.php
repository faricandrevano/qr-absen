<?php
require "sw-library/sw-config.php";
$nisnye = $_POST["nisnye"];

$sql = mysqli_query($connection, "SELECT * FROM siswa WHERE nis = '$nisnye'");
$gb = mysqli_fetch_array($sql);
?>
<input type="text" name="nama" id="nama" class="form-control" value="<?= $gb["nama"] ?>" disabled>
<input type="hidden" name="nama" value="<?= $gb["nama"] ?>">