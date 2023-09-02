<select name="nis" id="nis" class="form-control" required>
   <option selected disabled>--- SILAHKAN PILIH ---</option>
<?php
require "sw-library/sw-config.php";
$kelasnyaa = $_POST["kelasnyaa"];

$sql = mysqli_query($connection, "SELECT * FROM siswa WHERE id_kelas = '$kelasnyaa'");

while ($gb = mysqli_fetch_array($sql))
{
?>
   <option value="<?= $gb["nis"] ?>"><?= $gb["nis"] ?></option>
<?php } ?>
</select>