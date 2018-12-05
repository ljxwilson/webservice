<?php
include_once 'session.php';
require_once('lib/nusoap.php');
$client = new nusoap_client('http://127.0.0.1/wsperpus/server/server.php?wsdl', true);

$err = $client->getError();
if ($err) {
echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
}

$id = $_GET['id'];
$param = array('id'=>$id);
$result = json_decode($client->call('readbyid',array($param)),true);
 if(isset($_POST['simpan'])){
$stoklama = $client->call('readbyid',array($param));

 }
if (isset($_POST['simpan'])) {
$param = array('id_buku'=>$id,'lokasi'=>$_POST['lokasi']);
$result = json_decode($client->call('updatelokasi',array($param)),true);
if ($result['status'] == 1) {
echo "<script type='text/javascript'>alert('Update Lokasi Buku)</script>";
echo "<script>location.href='list.php';</script>";
}else{
echo "<script type='text/javascript'>alert('Gagal Update Lokasi')</script>";
}

///////
$id = $_GET['id'];
$param = array('id'=>$id);
$result = json_decode($client->call('readbyid',array($param)),true);
}

foreach ($result as $item) {
echo '<form action="" method="POST">
<h1>Update Lokasi</h1>
<button><a href="list.php">Home</a></button>
<table border=1>
<tr><td>Nama Buku</td><td><input type="text" name="nama" value="'.$item['judul'].'" disabled></td></tr>
<tr><td>Lokasi Buku</td><td><input type="text" name="lokasi" value="'.$item['lokasi'].'"></td></tr>


<tr><td colspan="2" align="center"><input type="submit" name="simpan"></td></tr>
</table></form>';
}

?>