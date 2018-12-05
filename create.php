<?php
include_once 'session.php';
require_once('lib/nusoap.php');
$client = new nusoap_client('http://127.0.0.1/wsperpus/server/server.php?wsdl', true);

$err = $client->getError();
if ($err) {
echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
}

if (isset($_POST['simpan'])) {
$param = array("judul" => $_POST['judul'],"lokasi" => $_POST['lokasi']);
$result = json_decode($client->call("create", array($param)),true);
if ($result['status'] == 1) {
echo "<script type='text/javascript'>alert('Berhasil menyimpan data')</script>";
echo "<script>location.href='list.php';</script>";

exit();
}else{
echo "<script type='text/javascript'>alert('Nama Buku Sudah Terdaftar')</script>";
}
}
echo '

<form action="" method="POST">
<h1>Penambahan Buku Baru</h1>
<button><a href="list.php">Home</a></button>
<table border=1>
<tr><td>Judul</td><td><input type="text" name="judul"></td></tr>
<tr><td>Lokasi</td><td><input type="text" name="lokasi"></td></tr>
<tr><td colspan="2" align="center"><input type="submit" name="simpan"></td></tr>
</table></form>';

?>