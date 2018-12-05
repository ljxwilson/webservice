<?php
session_start();

require_once('lib/nusoap.php');
$client = new nusoap_client('http://127.0.0.1/wsperpus/server/server.php?wsdl', true);

$err = $client->getError();
if ($err) {
echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
}

$param = array("id_user" => $_SESSION['user']);
$result = json_decode($client->call("session", array($param)),true);

if ($result['status'] == 0) {
//echo 'Sukses login';

header('location:index.php');
exit();

//echo 'Gagal login';
}



?>