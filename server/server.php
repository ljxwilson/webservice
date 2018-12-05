<?php
require_once('lib/nusoap.php');
$ns = "http://".$_SERVER['HTTP_HOST']."/wsperpus/server/server.php";//setting namespace
$server = new soap_server();
$server->configureWSDL('WEB SERVICE Buku', 'urn:barangServerWSDL'); // configure WSDL file
$server->wsdl->schemaTargetNamespace = $ns; // server namespace
########################Data##############################################################
// Complex Array Keys and Types Data Buku++++++++++++++++++++++++++++++++++++++++++
$server->wsdl->addComplexType("databuku","complexType","struct","all","",
array(
"id_buku"=>array("name"=>"id_buku","type"=>"xsd:int"),
"judul"=>array("name"=>"judul","type"=>"xsd:string"),
"jumlah"=>array("name"=>"jumlah","type"=>"xsd:int"),
"lokasi"=>array("name"=>"lokasi","type"=>"xsd:string")

)
);
// Complex Array Data Buku++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$server->wsdl->addComplexType("barangArray","complexType","array","","SOAP-ENC:Array",
array(),
array(
array(
"ref"=>"SOAP-ENC:arrayType",
"wsdl:arrayType"=>"tns:databuku[]"
)
),
"databuku"
);
// End Complex Type buku++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Complex Array Keys and Types Data pemasukan++++++++++++++++++++++++++++++++++++++++++
$server->wsdl->addComplexType("datamasuk","complexType","struct","all","",
array(
"id_surat jalan"=>array("name"=>"id_surat_jalan","type"=>"xsd:int"),
"id_buku"=>array("name"=>"id_buku","type"=>"xsd:string"),
"id_supplier"=>array("name"=>"id_supplier","type"=>"xsd:int"),
"jumlah"=>array("name"=>"jumlah","type"=>"xsd:string")

)
);
// Complex Array Data pemasukan++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$server->wsdl->addComplexType("masukArray","complexType","array","","SOAP-ENC:Array",
array(),
array(
array(
"ref"=>"SOAP-ENC:arrayType",
"wsdl:arrayType"=>"tns:datamasuk[]"
)
),
"datamasuk"
);
// End Complex Type pemasukan++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Complex Array Keys and Types Data pengeluaran++++++++++++++++++++++++++++++++++++++++++
$server->wsdl->addComplexType("datakeluar","complexType","struct","all","",
array(
"id_surat_keluar"=>array("name"=>"id_surat_keluar","type"=>"xsd:int"),
"id_buku"=>array("name"=>"id_buku","type"=>"xsd:string"),
"id_user"=>array("name"=>"id_user","type"=>"xsd:string"),
"jumlah"=>array("name"=>"jumlah","type"=>"xsd:int")

)
);
// Complex Array Data pemasukan++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$server->wsdl->addComplexType("keluarArray","complexType","array","","SOAP-ENC:Array",
array(),
array(
array(
"ref"=>"SOAP-ENC:arrayType",
"wsdl:arrayType"=>"tns:datakeluar[]"
)
),
"datakeluar"
);
// End Complex Type pengeluaran++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

// Complex Array Keys and Types Data user++++++++++++++++++++++++++++++++++++++++++
$server->wsdl->addComplexType("datalogin","complexType","struct","all","",
array(
"id_user"=>array("name"=>"id_user","type"=>"xsd:string"),
"password"=>array("name"=>"password","type"=>"xsd:string")

)
);
// Complex Array Data user++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$server->wsdl->addComplexType("barangArray","complexType","array","","SOAP-ENC:Array",
array(),
array(
array(
"ref"=>"SOAP-ENC:arrayType",
"wsdl:arrayType"=>"tns:datalogin[]"
)
),
"datalogin"
);
// End Complex Type barang++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

######################################################################################
########################/Register Data Barang######################################################
//Ambil Semua Data Barang
$server->register('readall', // method name
array('input' => 'xsd:String'), // input parameters
array('output' => 'xsd:Array'), // output parameters
$ns, // namespace
"urn:".$ns."/readall", // soapaction
"rpc", // style
"encoded", // use
"Mengambil Semua Data Barang"); // documentation


//Ambil Semua Data kategori buku
$server->register('create',
array('input' => 'xsd:Array'),
array('output' => 'xsd:Array'),
$ns,
"urn:".$ns."/create",
"rpc",
"encoded",
"TAMBAH BUKU"
);

$server->register('createpemasukan',
array('input' => 'xsd:Array'),
array('output' => 'xsd:Array'),
$ns,
"urn:".$ns."/createpemasukan",
"rpc",
"encoded",
"Insert Data Pemasukan"
);

$server->register('updatelokasi',
array('input' => 'xsd:Array'),
array('output' => 'xsd:Array'),
$ns,
"urn:".$ns."/updatelokasi",
"rpc",
"encoded",
"Update LOKASI BUKU"
);

$server->register('readbyid',
array('input' => 'xsd:Array'),
array('output' => 'xsd:Array'),
$ns,
"urn:".$ns."/readbyid",
"rpc",
"encoded",
"Mengambil Data BUKU by id"
);

$server->register('readsupp',
array('input' => 'xsd:Array'),
array('output' => 'xsd:Array'),
$ns,
"urn:".$ns."/readsupp",
"rpc",
"encoded",
"Mengambil Data SUPPLIER"
);

$server->register('readusr',
array('input' => 'xsd:Array'),
array('output' => 'xsd:Array'),
$ns,
"urn:".$ns."/readusr",
"rpc",
"encoded",
"Mengambil Data USER"
);

$server->register('createpengeluaran',
array('input' => 'xsd:Array'),
array('output' => 'xsd:Array'),
$ns,
"urn:".$ns."/createpengeluaran",
"rpc",
"encoded",
"INPUT PENGELUARAN"
);

$server->register('login',
array('input' => 'xsd:Array'),
array('output' => 'xsd:Array'),
$ns,
"urn:".$ns."/login",
"rpc",
"encoded",
"LOGIN VERIFIKASI"
);

$server->register('session',
array('input' => 'xsd:Array'),
array('output' => 'xsd:Array'),
$ns,
"urn:".$ns."/session",
"rpc",
"encoded",
"Mengambil Data VALIDASI SESSION"
);

function create($param) {
$server = "localhost";
$username = "root";
$password = "";
$database = "db_gudang";

$con = new mysqli($server,$username,$password,$database);
if($con->connect_error){
die("Koneksi gagal: ".$con->connect_error);
}
$r = $con->query("INSERT INTO buku (judul,lokasi)
VALUES('$param[judul]','$param[lokasi]')");
if($r === true){
$s = 1;
}else{
$s = 0;
}
$return_value = array('status'=>$s);
return json_encode($return_value);
}

function login($param){
$server = "localhost";
$username = "root" ;
$password = "";
$database = "db_gudang";
$con = new mysqli($server,$username,$password,$database);
if($con->connect_error){
die("Koneksi gagal: ".$con->connect_error);
}
$r = $con->query("select * from user where id_user='$param[id_user]' and password='$param[password]'");
$b=$r->fetch_assoc();
if(!empty($b)){
$s = 1;
}else{
$s = 0;
}
$return_value = array('status'=>$s);
return json_encode($return_value);
}

function session($param){
$server = "localhost";
$username = "root" ;
$password = "";
$database = "db_gudang";
$con = new mysqli($server,$username,$password,$database);
if($con->connect_error){
die("Koneksi gagal: ".$con->connect_error);
}
$r = $con->query("select * from user where id_user='$param[id_user]'");
$b=$r->fetch_assoc();
if(!empty($b)){
$s = 1;
}else{
$s = 0;
}
$return_value = array('status'=>$s);
return json_encode($return_value);
}

function createpemasukan($param) {
$server = "localhost";
$username = "root" ;
$password = "";
$database = "db_gudang";

$con = new mysqli($server,$username,$password,$database);
if($con->connect_error){
die("Koneksi gagal: ".$con->connect_error);
}
$r = $con->query("INSERT INTO pemasukan (id_surat_jalan,id_buku,id_supplier,tanggal,jumlah)
VALUES('$param[id_surat_jalan]','$param[id_buku]','$param[id_supplier]',now(),'$param[jumlah]')");
if($r === true){
$s = 1;
}else{
$s = 0;
}
$return_value = array('status'=>$s);
return json_encode($return_value);
}

function createpengeluaran($param) {
$server = "localhost";
$username = "root" ;
$password = "" ;
$database = "db_gudang";

$con = new mysqli($server,$username,$password,$database);
if($con->connect_error){
die("Koneksi gagal: ".$con->connect_error);
}
$r = $con->query("INSERT INTO pengeluaran (id_surat_keluar,id_buku,id_user,tanggal,jumlah)
VALUES('$param[id_surat_keluar]','$param[id_buku]','$param[id_user]',now(),'$param[jumlah]')");
if($r === true){
$s = 1;
}else{
$s = 0;
}
$return_value = array('status'=>$s);
return json_encode($return_value);
}

function readall() {

$server = "localhost";
$username = "root" ;
$password = "" ;
$database = "db_gudang";
 
$con = new mysqli($server,$username,$password,$database);
if($con->connect_error){
 die("Koneksi gagal: ".$con->connect_error);
}
$r = $con->query("SELECT * FROM buku order by judul asc");
while($value= $r->fetch_assoc())
 {
$return_value[] = array(
 'id'=> $value['id_buku'],
 'judul'=> $value['judul'],
 'jumlah'=> $value['jumlah'],
 'lokasi'=> $value['lokasi']
 );
 }
 return json_encode($return_value);
}

function readsupp() {

$server = "localhost";
$username = "root" ;
$password = "" ;
$database = "db_gudang";
 
$con = new mysqli($server,$username,$password,$database);
if($con->connect_error){
 die("Koneksi gagal: ".$con->connect_error);
}
$r = $con->query("SELECT * FROM supplier");
while($value= $r->fetch_assoc())
 {
$return_value[] = array(
 'id'=> $value['id_supplier'],
 'nama'=> $value['nama'] 

 );
 }
 return json_encode($return_value);
}

function readusr() {

$server = "localhost";
$username = "root" ;
$password = "" ;
$database = "db_gudang";
 
$con = new mysqli($server,$username,$password,$database);
if($con->connect_error){
 die("Koneksi gagal: ".$con->connect_error);
}
$r = $con->query("SELECT * FROM user");
while($value= $r->fetch_assoc())
 {
$return_value[] = array(
 'id'=> $value['id_user'],
 'nama'=> $value['name'] 

 );
 }
 return json_encode($return_value);
}


function readbyid($param) {
$server = "localhost";
$username = "root" ;
$password = "" ;
$database = "db_gudang";

$con = new mysqli($server,$username,$password,$database);
if($con->connect_error){
die("Koneksi gagal: ".$con->connect_error);
}
$r = $con->query("SELECT * FROM buku WHERE id_buku = '$param[id]'");
while($value= $r->fetch_assoc()){
$return_value[] = array(
'id'=> $value['id_buku'],
'judul'=> $value['judul'],
'jumlah'=> $value['jumlah'],
'lokasi'=> $value['lokasi']

);
}
return json_encode($return_value);
}

function updatelokasi($param) {
$server = "localhost";
$username = "root" ;
$password = "" ;
$database = "db_gudang";

$con = new mysqli($server,$username,$password,$database);
if($con->connect_error){
die("Koneksi gagal: ".$con->connect_error);
}
$r = $con->query("UPDATE buku SET lokasi='$param[lokasi]' where id_buku='$param[id_buku]'");
if($r === true){
$s = 1;
}else{
$s = 0;
}
$return_value = array('status'=>$s);
return json_encode($return_value);
}

/////////////////////////
//$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service(file_get_contents("php://input"));
?>