<?php
include_once 'session.php';
require_once('lib/nusoap.php');
$client = new nusoap_client('http://127.0.0.1/wsperpus/server/server.php?wsdl', true);

$err = $client->getError();
if ($err) {
echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
}

$result2 = json_decode($client->call('readall',array()),true);

$result3 = json_decode($client->call('readsupp',array()),true);
if (isset($_POST['simpan'])) {
$param = array("id_surat_jalan" => $_POST['id_surat_jalan'],"id_buku" => $_POST['id_buku'],"id_supplier"=> $_POST['id_supplier'],"jumlah"=> $_POST['jumlah']);
$result = json_decode($client->call("createpemasukan", array($param)),true);
if ($result['status'] == 1) {
echo "<script type='text/javascript'>alert('Berhasil Input Pemasukan')</script>";
echo "<script>location.href='list.php';</script>";
}else{
echo "<script type='text/javascript'>alert('Nomor Surat Masuk Sudah Terdaftar')</script>";
}
}
 if (!empty($result2)) {
	 if (!empty($result3)) {
echo '<form action="" method="POST">
<h1>Input Pemasukan Buku</h1>
<button><a href="list.php">Home</a></button>
<table border=1>
<tr><td>Nomor Surat Jalan</td><td><input type="text" name="id_surat_jalan"></td></tr>
<tr><td>ID Buku</td><td>';
echo '<select name="id_buku">';
	foreach($result2 as $item2){
	echo '<option value="'.$item2['id'].'">'.$item2['judul'].'</option>';
	}
	echo '</select></td></tr>
<tr><td>ID Supplier</td><td>';
echo '<select name="id_supplier">';
	foreach($result3 as $item3){
	echo '<option value="'.$item3['id'].'">'.$item3['nama'].'</option>';
	}
	echo '</select></td></tr>
<tr><td>Jumlah</td><td><input type="text" name="jumlah"></td></tr>
<tr><td colspan="2" align="center"><input type="submit" name="simpan"></td></tr>
</table></form>';
	 }
}
?>

