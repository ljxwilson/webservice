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
// echo '<form action="" method="POST">
// <h1>Login</h1>
// <table border=1>
// <tr><td>Username</td><td><input type="text" name="id_user" required></td></tr>
// <tr><td>Password</td><td><input type="text" name="password" required></td></tr>
// <tr><td colspan="2" align="center"><input type="submit" name="simpan"></td></tr>
// </table></form>';
?>

<html lang = "en">
   
   <head>
      <title>Login to Gudang Buku</title>
      <link href = "css/bootstrap.min.css" rel = "stylesheet">
      
      <style>
         body {
            padding-top: 40px;
            padding-bottom: 40px;
            background-image:url(images/book.jpg);
            background-repeat: no-repeat;
            background-size: cover;
         }
         
         .form-signin {
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
            color: #017572;
         }
         /*
         .form-signin .form-signin-heading,
         .form-signin .checkbox {
            margin-bottom: 10px;
         }
         
         .form-signin .checkbox {
            font-weight: normal;
         }*/
         
         .form-signin .form-control {
            position: relative;
            height: auto;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            padding: 10px;
            font-size: 16px;
         }
         
         .form-signin .form-control:focus {
            z-index: 2;
         }
         
         .form-signin input[type="text"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
            border-color:#017572;
         }
         
         .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            border-color:#017572;
         }
         
         h2{
            text-align: center;
            color: #ffffff;
         }
      </style>
      
   </head>
	
   <body>
      
      <h2>Enter Username and Password</h2> 
      <div class = "container form-signin">
         
        <!--  <?php
            $msg = '';
            
            if (isset($_POST['login']) && !empty($_POST['username']) 
               && !empty($_POST['password'])) {
				
               if ($_POST['username'] == 'tutorialspoint' && 
                  $_POST['password'] == '1234') {
                  $_SESSION['valid'] = true;
                  $_SESSION['timeout'] = time();
                  $_SESSION['username'] = 'tutorialspoint';
                  
                  echo 'You have entered valid use name and password';
               }else {
                  $msg = 'Wrong username or password';
               }
            }
         ?> -->
      </div> <!-- /container -->
      
      <div class = "container">
      
         <form class = "form-signin" role = "form" 
            action = "" method = "post">
            <h4 class = "form-signin-heading"><?php echo $msg; ?></h4>
            <input type = "text" class = "form-control" 
               name = "id_user" placeholder = "username" 
               required autofocus></br>
            <input type = "password" class = "form-control"
               name = "password" placeholder = "*****" required>
            <button class = "btn btn-lg btn-primary btn-block" type = "submit" 
               name = "simpan">Login</button>
         </form>
			
         
      </div> 
      
   </body>
</html>