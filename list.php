<?php
//session_start();
include_once 'session.php';
require_once('lib/nusoap.php');
$client = new nusoap_client('http://127.0.0.1/wsperpus/server/server.php?wsdl', true);

$err = $client->getError();
if ($err) {
echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
}


$result =json_decode($client->call('readall',array()),true);
//echo $client->response;
//echo $client->request;

if (!empty($result)) {

echo "<h1>List Buku</h1>
<h3>Selamat Datang <b>".$_SESSION['user']."</b></h3><br>
<button><a href='create.php'>Create</a></button>
<button><a href='createpemasukan.php'>Input Pemasukan</a></button>
<button><a href='createpengeluaran.php'>Input Pengeluaran</a></button>
<button><a href='logout.php'>Log Out</a></button>
<table border=1>";
echo "<tr bgcolor='#cccccc'>";
echo "<th>Id Buku</th>";
echo "<th>Judul Buku</th>";
echo "<th>Jumlah Stok</th>";
echo "<th>Lokasi Letak Buku</th>";
echo "<th>Action</th>";
//echo "<th colspan='4′>Action</th>";
echo "</tr>";
foreach ($result as $item) {
echo "<tr>";
echo "<td>".$item['id']."</td>";
echo "<td>".$item['judul']."</td>";
echo "<td>".$item['jumlah']."</td>";
echo "<td>".$item['lokasi']."</td>";
echo "<td><a href='update.php?id=".$item['id']."'>Edit Location</a></td>";
// echo "<td><a href='masuk.php?id=".$item['id']."'>Masuk Buku</a></td>";
// echo "<td><a href='Keluar.php?id=".$item['id']."'>Keluar Buku</a></td>";
//echo "<td><a href='delete.php?id=".$item['id']."'>Delete</a></td>";
echo "</tr>";
}
echo "</table>";

}
?>