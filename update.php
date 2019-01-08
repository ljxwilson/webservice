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
// echo '<form action="" method="POST">
// <h1>Update Lokasi</h1>
// <button><a href="list.php">Home</a></button>
// <table border=1>
// <tr><td>Nama Buku</td><td><input type="text" name="nama" value="'.$item['judul'].'" disabled></td></tr>
// <tr><td>Lokasi Buku</td><td><input type="text" name="lokasi" value="'.$item['lokasi'].'"></td></tr>


// <tr><td colspan="2" align="center"><input type="submit" name="simpan"></td></tr>
// </table></form>';
}

?>


<html>
<head>
	<title>Tambah Buku</title>
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

input[type=text], input[type=password], select {
  width: 79%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

.label_text{
	width: 20%;
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
    <h1 class="judul_hal">Update Lokasi</h1>

    <label class="label_text" for="judul"><b>Judul Buku</b></label>
    <?php
    echo '<input type="text" name="nama" value="'.$item['judul'].'" disabled>';
    ?>

    <label class="label_text" for="lokasi"><b>Lokasi Buku</b></label>
    <?php
    echo '<input type="text" name="lokasi" value="'.$item['lokasi'].'" style="text-transform:uppercase" required>';
    ?>

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