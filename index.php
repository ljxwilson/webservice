<?php
session_start();
if(!empty($_SESSION['user'])){
header('location:list.php');
exit();}
require_once('lib/nusoap.php');
$client = new nusoap_client('http://127.0.0.1/wsperpus/server/server.php?wsdl', true);

$err = $client->getError();
if ($err) {
echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
}
if (isset($_POST['simpan'])) {
	$users=$_POST['id_user'];
$param = array("id_user" => $_POST['id_user'],"password" => $_POST['password']);
$result = json_decode($client->call("login", array($param)),true);
if ($result['status'] == 1) {
//echo 'Sukses login';

$_SESSION['user']=$users;
header('location:list.php');
exit();
}else{
echo "<script type='text/javascript'>alert('Periksa Kembali Username dan Password')</script>";
}
}
echo '<form action="" method="POST">
<h1>Login</h1>
<table border=1>
<tr><td>Username</td><td><input type="text" name="id_user" required></td></tr>
<tr><td>Password</td><td><input type="text" name="password" required></td></tr>
<tr><td colspan="2" align="center"><input type="submit" name="simpan"></td></tr>
</table></form>';
?>