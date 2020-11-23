
<?php 
session_start();

/* if( !isset($_SESSION['username']) ){
    die( "<a href="."http://".$_SERVER['HTTP_HOST'].'/login_form/login.php'.">Login required</a>" );
    
    header("Location: http://".$_SERVER['HTTP_HOST'].'/login_form/login.php');
} */
$isEdit = false;
$dataEdit;
if(isset($_GET['id'])||!empty($_GET['id'])){
    $isEdit = true;
    $data_arrayEdit =  array(
        "id" => $_GET['id']
    );
    $make_callGetData = callAPI('POST', 'http://localhost:8080/detailBarang/find', json_encode($data_arrayEdit ));
    $dataEdit = json_decode($make_callGetData, true);
    
}


?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
* {
  box-sizing: border-box;
}

.row::after {
  content: "";
  clear: both;
  display: table;
}

[class*="col-"] {
  float: left;
  padding: 15px;
}

html {
  font-family: "Lucida Sans", sans-serif;
}

.header {
  background-color: #339CFF     ;
  color: #000000;
  padding: 10px;
}
.header2 {
  background-color: #E12525     ;
  color: #000000;
  padding: 5px;
}

.menu ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
}

.menu li {
  padding: 8px;
  margin-bottom: 7px;
  background-color: #33b5e5;
  color: #ffffff;
  box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
}

.menu li:hover {
  background-color: #0099cc;
}

.aside {
  background-color: #33b5e5;
  padding: 15px;
  color: #ffffff;
  text-align: center;
  font-size: 14px;
  box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
}

.footer {
  background-color: #0099cc;
  color: #ffffff;
  text-align: center;
  font-size: 12px;
  padding: 15px;
}

/* For mobile phones: */
[class*="col-"] {
  width: 100%;
}
.Fields {
   display: flex;
   flex-wrap: wrap;
   padding: 20px;
   justify-content: space-around;
}
.Fields div {
   margin-right: 10px;
}
label {
   margin: 15px;
}
.formContainer {
   margin: 10px;
   background-color: #efffc9;
   padding: 5px 20px 15px 20px;
   border: 1px solid rgb(191, 246, 250);
   border-radius: 3px;
}
input[type="text"] {
   display: inline-block;
   width: 100%;
   margin-bottom: 20px;
   padding: 12px;
   border: 1px solid #ccc;
   border-radius: 3px;
}
label {
   margin-left: 20px;
   display: block;
}
.icon-formContainer {
   margin-bottom: 20px;
   padding: 7px 0;
   font-size: 24px;
}
.checkout {
   background-color: #4caf50;
   color: white;
   padding: 12px;
   margin: 10px 0;
   border: none;
   width: 100%;
   border-radius: 3px;
   cursor: pointer;
   font-size: 17px;
}
.checkout:hover {
   background-color: #45a049;
}
span.price {
   float: right;
   color: grey;
}
@media (max-width: 657px) {
   .Fields {
      flex-direction: column-reverse;
   }
}

@media only screen and (min-width: 600px) {
  /* For tablets: */
  .col-s-1 {width: 8.33%;}
  .col-s-2 {width: 16.66%;}
  .col-s-3 {width: 25%;}
  .col-s-4 {width: 33.33%;}
  .col-s-5 {width: 41.66%;}
  .col-s-6 {width: 50%;}
  .col-s-7 {width: 58.33%;}
  .col-s-8 {width: 66.66%;}
  .col-s-9 {width: 75%;}
  .col-s-10 {width: 83.33%;}
  .col-s-11 {width: 91.66%;}
  .col-s-12 {width: 100%;}
}
@media only screen and (min-width: 768px) {
  /* For desktop: */
  .col-1 {width: 8.33%;}
  .col-2 {width: 16.66%;}
  .col-3 {width: 25%;}
  .col-4 {width: 33.33%;}
  .col-5 {width: 41.66%;}
  .col-6 {width: 50%;}
  .col-7 {width: 58.33%;}
  .col-8 {width: 66.66%;}
  .col-9 {width: 75%;}
  .col-10 {width: 83.33%;}
  .col-11 {width: 91.66%;}
  .col-12 {width: 100%;}
}
select {
   display: inline-block;
   width: 100%;
   margin-bottom: 20px;
   padding: 12px;
   border: 1px solid #ccc;
   border-radius: 3px;
}
.responsive {
  width: 5%;
  height: auto;
}
a.disabled {
  pointer-events: none;
  cursor: default;
  overflow:hidden;
  display: none;
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div class="header">
  <table style="width:100%">
  <tr>
    <th style="text-align:left;"><img src="logodamkar.jpg" alt="Nature" class="responsive" width="50" height="50"> Data Sarana Dan Prasana</th>
    <th style="text-align:right;">Selamat Datang <?php echo $_SESSION['username'];?> <a href="/logout.php" style="color: #000000;text-decoration:none;"><i class="fa fa-sign-out"></i>Keluar</a></th> 
  </tr>
</table>
</div>
<div class="header2"></div>

<div class="row">
  <div class="col-3 col-s-3 menu">
    <ul>
      <li> <i class="fa fa-bars"></i>
      <a href="<?php echo "/checkop.php?pilihsektor=".$_SESSION['sektor'];?>" 
      style="color: #000000;text-decoration:none;" class="<?php if($_SESSION['role']!=3){echo "disabled";}?>">Perlengkapan Operasional</a>
      <a href="#" class="<?php if($_SESSION['role']==3){echo "disabled";}?>" style="color: #000000;text-decoration:none;" onclick='document.getElementById("demo").innerHTML = "<?php 
      echo "<h1>Perlengkapan Operasional</h1>";
      echo "<p>";
      
      if($_SESSION['role']==3){
          echo "data data";
      }else{
      echo '<form action=\"checkop.php\" method=\"post\">Pilih Sektor  <input type=\"submit\" name=\"formSubmit\" value=\"Submit\" /><br \>';
      $make_call = callAPI('POST', 'http://localhost:8080/sektor/findall/'.$_SESSION['username'], null);
      $response = json_decode($make_call, true);
      
       for ($i = 0; $i < sizeof($response); $i++){
           echo '<input type=\"checkbox\" name=\"form[]\" value=\"'.$response[$i]['id'].'@@'.$response[$i]['namaSektor'].'\" />'.$response[$i]['namaSektor'].'<br />';
       }
      echo ''; 
      echo '</form>';
      }
      
      echo "</p>";
      ?>
      "'>Perlengkapan Operasional</a></li>
      <li><i class="fa fa-bars"></i> 
      <a href="#" style="color: #000000;text-decoration:none;" onclick='document.getElementById("demo").innerHTML = "<?php 
      echo "<h1>Perlengkapan Non Operasional</h1>";
      echo "<p>";
      
      if($_SESSION['role']==3){
          echo "data data";
      }else{
      echo '<form action=\"checkop.php\" method=\"post\">Pilih Sektor  <input type=\"submit\" name=\"formSubmit\" value=\"Submit\" /><br \>';
      $make_call = callAPI('POST', 'http://localhost:8080/sektor/findall/'.$_SESSION['username'], null);
      $response = json_decode($make_call, true);
      
       for ($i = 0; $i < sizeof($response); $i++){
           echo '<input type=\"checkbox\" name=\"form[]\" value=\"'.$response[$i]['id'].'@@'.$response[$i]['namaSektor'].'\" />'.$response[$i]['namaSektor'].'<br />';
       }
      echo ''; 
      echo '</form>';
      }
      echo "</p>";
      ?>
      "'>
      Perlengkapan Non Operasional</a></li>
      <li><i class="fa fa-download	"></i> <a href="#" style="color: #000000;text-decoration:none;">Arsip</a></li>
      <?php 
          if($_SESSION['role']<2){
              echo '<li><i class="fa fa-tasks	"></i> <a href="/kelola.php" style="color: #000000;text-decoration:none;">Kelola aplikasi</a></li>';
          }
      ?>
    </ul>
  </div>

  <div id ="demo" class="col-6 col-s-9">
	<br />
	<h3>Kelola Detail Barang Untuk Kategori <?php echo $_GET['namakategori'] ?></h3>
	<h4>Jenis Barang <?php echo $_GET['jenisbarang'] ?></h4>
	<form action="detailbarangadd.php?idkategori=<?php echo $_GET['idmenu']?>&namakategori=<?php echo $_GET['namakategori']?>" method="post">
		<?php 
		  if($isEdit){
		  }
		  else{
		  }
		  echo '<input type="hidden" name="id_sub_kategori" value="'.$_GET['idkategori'].'">';
		?>	
		<table>
			<tr>
				<td>Nama Detail Barang</td>
				<td><input type="text" name="nama" required <?php if($isEdit){
				    echo 'readonly="readonly" style="background: #dddddd"; value="'.$dataEdit['id'].'"';
				}?>></td>					
			</tr>				
			</tr>
				<td></td>
				<td><button type="submit">Simpan</button></td>					
			</tr>				
		</table>
	</form>
	
  
  </div>
  <div class="col-3 col-s-12">
  
  </div>
</div>

<div class="footer">
  <p>Resize the browser window to see how the content respond to the resizing.</p>
</div>

<script>
    function goBack() {
      window.history.back();
    }
    </script>
</body>
</html>
<?php 
function getSektorName($idStr){
    if($idStr!=0){
    $data_array =  array(
        "id" => $idStr
    );
    $make_callSektor = callAPI('POST', 'http://localhost:8080/sektor/find', json_encode($data_array));
    $responseSektor = json_decode($make_callSektor, true);
    $sektorzxc=$responseSektor['namaSektor'];
    return $sektorzxc;
    }else return "Superuser";
}

function callAPI($method, $url, $data){
    $curl = curl_init();
    switch ($method){
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);
            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
        case "PUT":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }
    // OPTIONS:
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Key: 111111111111111111111',
        'Content-Type: application/json',
    ));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    // EXECUTE:
    $result = curl_exec($curl);
    if(!$result){
        $message = "Password atau username salah";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo "<a href=\"javascript:history.go(-1)\">kembali ke halaman login</a>";
        die('');
    }
    
    curl_close($curl);
    return $result;
}
?>