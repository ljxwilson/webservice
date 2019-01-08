<?php
include_once 'session.php';
require_once('lib/nusoap.php');
$client = new nusoap_client('http://127.0.0.1/wsperpus/server/server.php?wsdl', true);

$err = $client->getError();
if ($err) {
echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
}

$result2 = json_decode($client->call('readall',array()),true);



$result3 = json_decode($client->call('readusr',array()),true);
if (isset($_POST['simpan'], $_POST['id_surat_keluar'])) {
	
$idbuku = $_POST['id_buku'];
$parambuku = array('id'=>$idbuku);
$resultbuku = json_decode($client->call('readbyid',array($parambuku)),true);
foreach ($resultbuku as $hasil) {
$stoklama=$hasil['jumlah'];
$sisabuku=$stoklama-$_POST['jumlah'];
}
if($sisabuku<0){
echo "<script type='text/javascript'>alert('Stok Buku Tidak Cukup')</script>";
}else{ 
$param = array("id_surat_keluar" => $_POST['id_surat_keluar'],"id_buku" => $_POST['id_buku'],"id_user"=> $_POST['id_user'],"jumlah"=> $_POST['jumlah']);
$result = json_decode($client->call("createpengeluaran", array($param)),true);
if ($result['status'] == 1) {
echo "<script type='text/javascript'>alert('Berhasil Input Pengeluaran')</script>";
echo "<script>location.href='list.php';</script>";
}else{
echo "<script type='text/javascript'>alert('Nomor Surat Keluar Sudah Terdaftar')</script>";
}
}}
 if (!empty($result2)) {
	 if (!empty($result3)) {
// echo '<form action="" method="POST">
// <h1>Input Pengeluaran Buku</h1>
// <button><a href="list.php">Home</a></button>
// <table border=1>
// <tr><td>Nomor Surat Jalan</td><td><input type="text" name="id_surat_keluar"></td></tr>
// <tr><td>ID Buku</td><td>';
// echo '<select name="id_buku">';
// 	foreach($result2 as $item2){
// 	echo '<option value="'.$item2['id'].'">'.$item2['judul'].'</option>';
// 	}
// 	echo '</select></td></tr>
// <tr><td>ID User</td><td>';
// echo '<select name="id_user">';
// 	foreach($result3 as $item3){
// 	echo '<option value="'.$item3['id'].'">'.$item3['nama'].'</option>';
// 	}
// 	echo '</select></td></tr>
// <tr><td>Jumlah</td><td><input type="text" name="jumlah"></td></tr>
// <tr><td colspan="2" align="center"><input type="submit" name="simpan"></td></tr>
// </table></form>';
	 }
}
?>

<html>
<head>
	<title>Pengeluaran Buku</title>
     <link href = "css/bootstrap.min.css" rel = "stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body, html {
  height: 100%;
  font-family: Arial, Helvetica, sans-serif;
}

* {
  box-sizing: border-box;
}

body {
  /* The image used */
  background-image:url(images/book.jpg);

  min-height: 380px;

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;
}

/* Add styles to the form container */
.container {
  margin: 0 auto;
  max-width: 500px;
  padding: 16px;
  background-color: white;
}

/* Full-width input fields */
input[type=text], input[type=password],input[type=number], select {
  width: 64%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus,input[type=number]:focus {
  background-color: #ddd;
  outline: none;
}

.label_text{
	width: 35%;
}

/* Set a style for the submit button */
.btn {
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 49%;
  display: inline-block;
}

.btn:hover {
  opacity: 1;
}
.judul_hal{
	text-align: center;
}
.button_cancel a{
	color: white;
}
.form_box{
	margin-top: 10%;
}
</style>
</head>
<body>
<div class="form_box">
  <form action="" method="POST" class="container">
    <h1 class="judul_hal">Input Pengeluaran Buku</h1>

    <label class="label_text" for="id_surat_jalan"><b>Nomor Surat Jalan</b></label>
    <input type="number" placeholder="Nomor Surat Jalan" name="id_surat_keluar" required>

    <label class="label_text" for="id_buku"><b>ID Buku</b></label>
    <select name="id_buku">
	  <?php

		foreach($result2 as $item2){
		echo '<option value="'.$item2['id'].'">'.$item2['judul'].'</option>';
		}
		echo '</select>'

	  ?>
	</select>

	<label class="label_text" for="id_user"><b>ID User</b></label>
    <select name="id_user">
	  <?php

		foreach($result3 as $item3){
		echo '<option value="'.$item3['id'].'">'.$item3['nama'].'</option>';
		}
		echo '</select>'

	  ?>
	</select>

    <label class="label_text" for="jumlah"><b>Jumlah</b></label>
    <input type="number" placeholder="Jumlah" name="jumlah" min="0" required>

    <div>
    	<!-- <button type="submit" class="btn" name="simpan">Simpan</button>
    	<button type="submit" class="btn" name="simpan">Simpan</button> -->
  		<button type="submit" name="simpan" class="btn btn-lg btn-primary">Simpan</button>
  		<a href="list.php"><button type="button" class="button_cancel btn btn-lg btn-danger">Cancel</button></a>
    </div>
  </form>
</div>

</body>
</html>
