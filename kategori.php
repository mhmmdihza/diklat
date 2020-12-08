
<?php 
session_start();

if( !isset($_SESSION['username']) ){
    echo "<script>alert('Login terlebih dahulu!'); window.location='login.php';</script>";
};
    
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
* 
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #339CFF;
  color: white;
}
{
  box-sizing: border-box;
}
[id^=submit-bt] {
  border: 1px solid #0066cc;
  background-color: #0099cc;
  color: #ffffff;
  padding: 5px 10px;
}

[id^=submit-bt] {
  border: 1px solid #0099cc;
  background-color: #00aacc;
  color: #ffffff;
  padding: 5px 10px;
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
/* Button used to open the contact form - fixed at the bottom of the page */
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}

/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 15px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
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
      <li><i class="fa fa-home	"></i> <a href="/mainmenu.php" style="color: #000000;text-decoration:none;">Beranda</a></li>
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
      <li> <i class="fa fa-bars"></i>
      <a href="<?php echo "/checknonop.php?pilihsektor=".$_SESSION['sektor'];?>" 
      style="color: #000000;text-decoration:none;" class="<?php if($_SESSION['role']!=3){echo "disabled";}?>">Perlengkapan Non Operasional</a>
      <a href="#" class="<?php if($_SESSION['role']==3){echo "disabled";}?>" style="color: #000000;text-decoration:none;" onclick='document.getElementById("demo").innerHTML = "<?php 
      echo "<h1>Perlengkapan Non Operasional</h1>";
      echo "<p>";
      
      if($_SESSION['role']==3){
          echo "data data";
      }else{
      echo '<form action=\"checknonop.php\" method=\"post\">Pilih Sektor  <input type=\"submit\" name=\"formSubmit\" value=\"Submit\" /><br \>';
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
      "'>Perlengkapan Non Operasional</a></li>
      
      <li><i class="fa fa-download	"></i> <a href="/arsip.php" style="color: #000000;text-decoration:none;">Arsip</a></li>
      <?php 
          if($_SESSION['role']<2){
              echo '<li><i class="fa fa-tasks	"></i> <a href="/kelola.php" style="color: #000000;text-decoration:none;">Kelola aplikasi</a></li>';
          }
      ?>
    </ul>
  </div>

  <div id ="demo" class="col-6 col-s-9">
  <div class="table-responsive">
	<?php 
	   
	   $arrSektor = explode('@@',$_GET['sektor']); 
	   
	   $make_call2 = callAPI('POST', 'http://localhost:8080/subKategori/findbyidkategori/'.$_GET['id'].'/'.$_SESSION['username'], null);
	   $response2 = json_decode($make_call2, true);
	   
	   $make_callSektor = callAPI('POST', 'http://localhost:8080/sektor/findall/'.$_SESSION['username'], null);
	   $responseSektor = json_decode($make_callSektor, true);
	   
	   
	   
	   
	   for ($i = 0; $i < sizeof($response2); $i++){
	       echo "</p>".$response2[$i]['nama'];
	       echo '<a href="#" onclick="myFunction'.$i.'()" ><i class="fa fa-caret-down"></i></a>';
	       echo '<div id="myDIV'.$i.'" style="display: none;">';
	       $make_call3 = callAPI('POST', 'http://localhost:8080/jenis/findBySubKategori/'.$response2[$i]['id'], json_encode($arrSektor));
	       $response3 = json_decode($make_call3, true);
	       echo "<table class='table' id='customers'><tr><th style='width:200px'>Nama</th>";
	       if($_SESSION['role']!=3){
	           echo "<th>Sektor</th>";
	       }
	       $dropdownSektor = '<label for="selectedSektor">Pilih Sektor</label><select name="selectedSektor" id="selectedSektor">';
	       
	       for ($xy = 0; $xy < sizeof($responseSektor); $xy++){
	           if($responseSektor[$xy]['id']!=$_GET['sektor']){
	           $dropdownSektor=$dropdownSektor.'<option value="'.$responseSektor[$xy]['id'].'">'.$responseSektor[$xy]['namaSektor'].'</option>';
	           }
	       }
	       $dropdownSektor = $dropdownSektor."</select";
           echo "<th>Baik</th><th>Rusak</th>";
           if($_SESSION['role']==3){
               echo "<th>Pindahkan</th>";
               echo "<th>Tambah atau kurangi stok</th>";
           }
           echo "</tr>";
	         for ($x = 0; $x < sizeof($response3); $x++){
	             echo "<tr><td>".$response3[$x]['nama']."</td>";
	             if($_SESSION['role']!=3){
	                 echo "<td>".getSektorName($response3[$x]['sektor'])."</td>";
	             }
                 echo "<td>".$response3[$x]['baik']."</td><td>".$response3[$x]['rusak']."</td>";
                 if($_SESSION['role']!=3){
                     
                 }else{
    	             echo "<td>";
    	             //echo "<td><form action='/pindah.php id='formpindah".$response3[$x]['id']." name='formpindahname".$response3[$x]['id']."''/>";
    	             //'intrange(this.value,0,'.$response3[$x]["baik"].','"baikId'.$response3[$x]['id']."')';
    	             //intrange(this.value,0,'.$response3[$x]["rusak"].',\'rusakId'.$response3[$x]['id'].'\');
                    echo '<input type="number" id="baikId'.$response3[$x]['id'].'" name="baik'.$response3[$x]['id'].'" min="0" max="'.$response3[$x]['baik'].'" placeholder="Baik" onclick="toggleButton(this,\'submit-btnmove'.$response3[$x]['id'].'\');" onkeyup="toggleButton(this,\'submit-btnmove'.$response3[$x]['id'].'\');intrange(this.value,0,'.$response3[$x]["baik"].',\'baikId'.$response3[$x]['id'].'\');"/>';
                    echo '<input type="number" id="rusakId'.$response3[$x]['id'].'" name="rusak'.$response3[$x]['id'].'" min="0" max="'.$response3[$x]['rusak'].'" placeholder="Rusak" onclick="toggleButton(this,\'submit-btnmove'.$response3[$x]['id'].'\');" onkeyup="toggleButton(this,\'submit-btnmove'.$response3[$x]['id'].'\');intrange(this.value,0,'.$response3[$x]["rusak"].',\'rusakId'.$response3[$x]['id'].'\');"/>';
                    echo '<input type="hidden" id="idSource'.$response3[$x]['id'].'" name="idSource'.$response3[$x]['id'].'" value="'.$response3[$x]['id'].'"/>';
                    echo '<input type="hidden" id="namaSource'.$response3[$x]['id'].'" name="namaSource'.$response3[$x]['id'].'" value="'.getSektorName($response3[$x]['sektor']).'"/>';
                    echo '<input type="hidden" id="hiddenid'.$response3[$x]['id'].'" name="idzxc'.$response3[$x]['id'].'" value="'.$response3[$x]['id'].'"/>';
                    $dropdownSektor = str_replace('selectedSektor','sektor'.$response3[$x]['id'],$dropdownSektor);
                    //echo "</form>";
                    echo '<br />';
                    echo $dropdownSektor;
                    echo '>';
                    echo '<br />';
                    echo '<input type="text" id="keterangan'.$response3[$x]['id'].'" name="keterangan'.$response3[$x]['id'].'"  placeholder="Keterangan tambahan"/>';
                    echo '<br />';
                    echo '<input id="submit-btnmove'.$response3[$x]['id'].'" type="submit" name="submit'.$response3[$x]['id'].'" value="Ajukan Pindah" disabled="disabled" onclick="getMove('.$response3[$x]['id'].');" />';
                    echo "</td>";
                    
                    echo "<td>";
                    //echo "<td><form action='/pindah.php id='formpindah".$response3[$x]['id']." name='formpindahname".$response3[$x]['id']."''/>";
                    //'intrange(this.value,0,'.$response3[$x]["baik"].','"baikId'.$response3[$x]['id']."')';
                    //intrange(this.value,0,'.$response3[$x]["rusak"].',\'rusakId'.$response3[$x]['id'].'\');
                    echo '<input type="number" id="baikIdadd'.$response3[$x]['id'].'" name="baikadd'.$response3[$x]['id'].'" placeholder="Baik"  min="-'.$response3[$x]['baik'].'" max="500" onclick="toggleButton(this,\'submit-btnmoveadd'.$response3[$x]['id'].'\');" onkeyup="toggleButton(this,\'submit-btnmoveadd'.$response3[$x]['id'].'\');intrangeadd(this.value,'.$response3[$x]["baik"].',\'baikIdadd'.$response3[$x]['id'].'\');"/>';
                    echo '<input type="number" id="rusakIdadd'.$response3[$x]['id'].'" name="rusakadd'.$response3[$x]['id'].'" placeholder="Rusak"  min="-'.$response3[$x]['rusak'].'" max="500" onclick="toggleButton(this,\'submit-btnmoveadd'.$response3[$x]['id'].'\');" onkeyup="toggleButton(this,\'submit-btnmoveadd'.$response3[$x]['id'].'\');intrangeadd(this.value,'.$response3[$x]["rusak"].',\'rusakIdadd'.$response3[$x]['id'].'\');"/>';
                    echo '<input type="hidden" id="hiddenidadd'.$response3[$x]['id'].'" name="idzxcadd'.$response3[$x]['id'].'" value="'.$response3[$x]['id'].'"/>';
                    //echo "</form>";
                    echo '<br />';
                    echo '<input type="text" id="keteranganadd'.$response3[$x]['id'].'" name="keteranganadd'.$response3[$x]['id'].'"  placeholder="Keterangan tambahan"/>';
                    echo '<br />';
                    echo '<input id="submit-btnmoveadd'.$response3[$x]['id'].'" type="submit" name="submitadd'.$response3[$x]['id'].'" value="Ajukan" disabled="disabled" onclick="getMoveAdd('.$response3[$x]['id'].');" />';
                    echo "</td>";
                    $dropdownSektor = str_replace('sektor'.$response3[$x]['id'],'selectedSektor',$dropdownSektor);
                 }
                echo "</tr>";
	       };echo "</table>"; 
    echo '</div>';
	       echo "</p>";
	       //echo '<input type=\"checkbox\" name=\"form[]\" value=\"'.$response2[$i]['id'].'@@'.$response[$i]['namaSektor'].'\" />'.$response[$i]['namaSektor'].'<br />';
	   }
	?>
	
	</div>
  </div>
  <div class="col-3 col-s-12">
  
  </div>
</div>

<div class="footer">
  <p>Resize the browser window to see how the content respond to the resizing.</p>
</div>

<script>
<?php 
    for ($i = 0; $i < sizeof($response2); $i++){
        echo 'function myFunction'.$i.'() {
  var x = document.getElementById("myDIV'.$i.'");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}';
    };
?>
function toggleButton(ref,bttnID){
    document.getElementById(bttnID).disabled= ((ref.value !== ref.defaultValue) ? false : true);
};
function intrange(value, min, max, name) {
    if(value < min || value > max)
    {
        document.getElementById(name).value = "0";
        alert("Total Pindah Melebehi Stok!");
    }
};
function intrangeadd(value, min, name) {
    if(value < min*-1 && value<0)
    {
        document.getElementById(name).value = "0";
        alert("Stok yang ingin dikurangi terlalu banyak dibanding stok saat ini!");
    }
};
function getMove(id){
	var zz = "returnid=<?php echo $_GET['id']?>&returnsektor=<?php echo $_GET['sektor']?>&";
	var x = "?menu=1&"+zz+"id="+document.getElementById("hiddenid"+id).value;
	x = x+"&status=1";
	x = x+"&baik="+document.getElementById("baikId"+id).value;
	x = x+"&rusak="+document.getElementById("rusakId"+id).value;
	x = x+"&idsource="+document.getElementById("idSource"+id).value;
	x = x+"&namasource="+document.getElementById("namaSource"+id).value;
	x = x+"&keterangan="+document.getElementById("keterangan"+id).value;
	x = x+"&sektor="+document.getElementById("sektor"+id).value;
	window.location.href = "/pindah.php"+x;
};
function getMoveAdd(id){
	var zz = "returnid=<?php echo $_GET['id']?>&returnsektor=<?php echo $_GET['sektor']?>&";
	var x = "?menu=1&"+zz+"id="+document.getElementById("hiddenidadd"+id).value;
	x = x+"&status=2";
	x = x+"&baik="+document.getElementById("baikIdadd"+id).value;
	x = x+"&rusak="+document.getElementById("rusakIdadd"+id).value;
	x = x+"&keterangan="+document.getElementById("keteranganadd"+id).value;
	window.location.href = "/pindah.php"+x;
};
</script>
</body>
</html>
<?php 
function getSektorName($idStr){
    $data_array =  array(
        "id" => $idStr
    );
    $make_callSektor = callAPI('POST', 'http://localhost:8080/sektor/find', json_encode($data_array));
    $responseSektor = json_decode($make_callSektor, true);
    $sektorzxc=$responseSektor['namaSektor'];
    return $sektorzxc;
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