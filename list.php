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

// echo "<h1>List Buku</h1>
// <h3>Selamat Datang <b>".$_SESSION['user']."</b></h3><br>";


}
?>

<html>
<head>
	<title>List Detail Buku</title>
      <link href = "css/bootstrap.min.css" rel = "stylesheet">
<style>
 body {
            padding-top: 40px;
            padding-bottom: 40px;
            background-image:url(images/book.jpg);
            background-repeat: no-repeat;
            background-size: cover;
         }
#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #e6e6e6;}
#customers tr:nth-child(odd){background-color: #ffffff;}

#customers tr:hover {background-color: #808080;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #404040;
  color: white;
}
.btn-group a{
  color: white;
}
.wrap{
  background-color: white;
  padding: 1%;
}

#myInput {
  background-image: url('/css/searchicon.png'); /* Add a search icon to input */
  background-position: 10px 12px; /* Position the search icon */
  background-repeat: no-repeat; /* Do not repeat the icon image */
  width: 100%; /* Full-width */
  font-size: 16px; /* Increase font-size */
  padding: 12px 20px 12px 40px; /* Add some padding */
  border: 1px solid #ddd; /* Add a grey border */
  margin-bottom: 12px; /* Add some space below the input */
}

#myTable {
  border-collapse: collapse; /* Collapse borders */
  width: 100%; /* Full-width */
  border: 1px solid #ddd; /* Add a grey border */
  font-size: 18px; /* Increase font-size */
}

#myTable th, #myTable td {
  text-align: left; /* Left-align text */
  padding: 12px; /* Add padding */
}

#myTable tr {
  /* Add a bottom border to all table rows */
  border-bottom: 1px solid #ddd;
}

#myTable tr.header, #myTable tr:hover {
  /* Add a grey background color to the table header and on hover */
  background-color: #f1f1f1;
}

</style>
</head>
<body>
<div class="container wrap">


<div class="container">
    <h1>List Buku</h1>
    <?php
      echo "<h3>Selamat Datang <b>".$_SESSION['user']."</b></h3><br>";
    ?>
</div>


<div class="">
  <div class="btn-group btn-group-justified">
    <div class="btn-group">
      <a href='create.php'><button type="button" class="btn btn-primary">Create</button></a>
    </div>
    <div class="btn-group">
      <a href='createpemasukan.php'><button type="button" class="btn btn-primary">Input Pemasukan</button></a>
    </div>
    <div class="btn-group">
      <a href='createpengeluaran.php'><button type="button" class="btn btn-primary">Input Pengeluaran</button></a>
    </div>
    <div class="btn-group">
      <a href='logout.php'><button type="button" class="btn btn-danger">Log Out</button></a>
    </div>
  </div>
</div>
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for Book Name.." title="Type in a name">
<table  id="customers">
  <tr>
    <th>Id Buku</th>
    <th>Judul Buku</th>
    <th>Jumlah Stok</th>
    <th>Lokasi Letak Buku</th>
    <th>Action</th>
  </tr>
  
  <?php
  
  	foreach ($result as $item) {
		echo "<tr>";
		echo "<td>".$item['id']."</td>";
		echo "<td>".$item['judul']."</td>";
		echo "<td>".$item['jumlah']."</td>";
		echo "<td style='text-transform:uppercase'>".$item['lokasi']."</td>";
		echo "<td><a href='update.php?id=".$item['id']."'>Edit Location</a></td>";
		// echo "<td><a href='masuk.php?id=".$item['id']."'>Masuk Buku</a></td>";
		// echo "<td><a href='Keluar.php?id=".$item['id']."'>Keluar Buku</a></td>";
		//echo "<td><a href='delete.php?id=".$item['id']."'>Delete</a></td>";
		echo "</tr>";
		}

  ?>
</table>

</div>
<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("customers");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>
</body>
</html>