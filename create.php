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
// echo '

// <form action="" method="POST">
// <h1>Penambahan Buku Baru</h1>
// <button><a href="list.php">Home</a></button>
// <table border=1>
// <tr><td>Judul</td><td><input type="text" name="judul"></td></tr>
// <tr><td>Lokasi</td><td><input type="text" name="lokasi"></td></tr>
// <tr><td colspan="2" align="center"><input type="submit" name="simpan"></td></tr>
// </table></form>';

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
    <h1 class="judul_hal">Penambahan Buku Baru</h1>

    <label class="label_text" for="judul"><b>Judul</b></label>
    <input type="text" placeholder="Judul" name="judul" required>

    <label class="label_text" for="lokasi"><b>Lokasi</b></label>
    <input type="text" placeholder="Lokasi Buku" name="lokasi" style="text-transform:uppercase" required>

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