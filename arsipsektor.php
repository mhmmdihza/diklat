<?php 
session_start();

 if( !isset($_SESSION['username']) ){
    echo "<script>alert('Login terlebih dahulu!'); window.location='login.php';</script>";
};
$fnama ="";
$ftype="";
$fstatus="";
$ftglpengajuan="";
$ftglpersetujuan="";
if(isset($_GET['nama'])){
    $fnama = $_GET['nama'];
};
if(isset($_GET['type'])){
    $ftype = $_GET['type'];
};
if(isset($_GET['status'])){
    $fstatus = $_GET['status'];
};
if(isset($_GET['tglpengajuan'])){
    $ftglpengajuan = $_GET['tglpengajuan'];
};if(isset($_GET['namasektorpengaju'])){
    $ftglpersetujuan = $_GET['namasektorpengaju'];
};
$filterc = "nama=".$fnama.'&type='.$ftype.'&status='.$fstatus.'&tglpengajuan='.$ftglpengajuan.'&namasektorpengaju='.$ftglpersetujuan;
?>
<!DOCTYPE html>
<html>
<head>
<?php 
    $data_array =  array('nama_barang' => $fnama);
    $stringjs = json_encode($data_array);
    $make_hal = callAPI('POST', 'http://localhost:8080/staff/countpage/'.$_SESSION['sektor'], $stringjs);

?>
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
white-space: nowrap;
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
</style>
</head>
<body>

<div class="header">
  <table style="width:100%">
  <tr>
    <th style="text-align:left;"><img src="logodamkar.jpg" alt="Nature" class="responsive" width="50" height="50"> Data Sarana Dan Prasana<br />Sudin Penaggulangan Kebakaran Dan Penyelamatan Jakarta Barat</th>
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
      <li><i class="fa fa-bars"></i> 
      <a href="#" style="color: #000000;text-decoration:none;" onclick='document.getElementById("demo").innerHTML = "<?php 
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
      "'>
      Perlengkapan Non Operasional</a></li>
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
  if($_SESSION['role']==3){
      $ftglpersetujuan = getSektorName($_SESSION['sektor']);
  }
  
  $make_call;
  $make_call = callAPI('POST', 'http://localhost:8080/staff/list/'.$_GET['page'].'/'.$_SESSION['sektor'], $stringjs);

  $response = json_decode($make_call, true);
  ?>
    <table class='table' id='filter'>
  <tr>
  <form method="post" action="downloadreport.php" class="form">
  <?php if($_SESSION['role']<3){ ?>
  <tr>
  <td style="width:160px"><label for="nama_sektor_asal">Nama Sektor Pengaju</label></td>
  <td>:<input type="text" id="fnama_sektor_asal" name="nama_sektor_asal" value="<?php echo $ftglpersetujuan?>"></td>
  </tr> 
  <?php 
  };
  ?><td style="width:160px"><label for="nama_barang">Nama Barang</label></td>
  <td>:<input type="text" id="fnama_barang" name="nama_barang" value="<?php echo $fnama?>"></td>
  </tr>
    <tr>
  <td><input id="submit-btnreport" type="submit" name="submit" value="download" /></td>
  </tr>
  </form>
  </table><b>Perlengkapan Operasional & Non Operasional</b>
  <?php
  echo "<table class='table' id='customers'><tr><th>ID</th><th>Nama Barang</th><th>Sektor</th><th>Type</th><th>Baik</th><th>Rusak</th><th>Keterangan</th><th>Status</th><th>Alasan ditolak(jika ada)</th><th>Tanggal Pengajuan</th><th>Tanggal Persetujuan/penolakan</th></tr>";
  for($c = 0 ; $c <sizeof($response);$c++){
      echo "<tr>";
      echo "<td>";
      echo $response[$c]['id'];
      echo "</td>";
          echo "<td>";
          echo getNamaBarang($response[$c]['id_jenis'])[0];
          echo "</td>";
          echo "<td>".getSektorName(getNamaBarang($response[$c]['id_jenis'])[1])."</td>";
          if(isset($response[$c]['sektor_dest'])&&!empty($response[$c]['sektor_dest'])){
              echo "<td>Perpindahan ke ".getSektorName($response[$c]['sektor_dest'])."</td>";
          }else{
              echo "<td>Penambahan/Pengurangan</td>";
          }
          echo "<td>".$response[$c]['baik']."</td>";
          echo "<td>".$response[$c]['rusak']."</td>";
          echo "<td>".$response[$c]['reason']."</td>";
          echo "<td>".$response[$c]['status']."</td>";
          echo "<td>".$response[$c]['rejected_reason']."</td>";
          echo "<td>".$response[$c]['created_date']."</td>";
          echo "<td>".$response[$c]['updated_date']."</td>";
          
      
      echo "</tr>";
  }
  echo "</tr>";
  echo "</table>"; 

  $halaman = json_decode($make_hal, true);

  echo "<b>Halaman</b>";
  for ($i=1; $i<=$halaman ; $i++){ ?>
  <a href="/arsipsektor.php?page=<?php echo $i.'&id='.$_GET['id'].'&'.$filterc; ?>"><?php echo $i; ?></a>
 
  <?php } ?>
  </div>
  </div>
  <div class="col-3 col-s-12">
  
  </div>
</div>

<div class="footer">
  <p>Resize the browser window to see how the content respond to the resizing.</p>
</div>

<script>
function filterzz(){
	var x = document.getElementById('fnama_barang').value;
	window.location.href = 'arsipsektor.php?id=<?php echo $_GET['id'].'&page='.$_GET['page'].'&nama='?>'+x;
}
</script>
<script>
;(function($){
    $.fn.extend({
        donetyping: function(callback,timeout){
            timeout = timeout || 1e3; // 1 second default timeout
            var timeoutReference,
                doneTyping = function(el){
                    if (!timeoutReference) return;
                    timeoutReference = null;
                    callback.call(el);
                };
            return this.each(function(i,el){
                var $el = $(el);
                // Chrome Fix (Use keyup over keypress to detect backspace)
                // thank you @palerdot
                $el.is(':input') && $el.on('keyup keypress paste',function(e){
                    // This catches the backspace button in chrome, but also prevents
                    // the event from triggering too preemptively. Without this line,
                    // using tab/shift+tab will make the focused element fire the callback.
                    if (e.type=='keyup' && e.keyCode!=8) return;
                    
                    // Check if timeout has been set. If it has, "reset" the clock and
                    // start over again.
                    if (timeoutReference) clearTimeout(timeoutReference);
                    timeoutReference = setTimeout(function(){
                        // if we made it here, our timeout has elapsed. Fire the
                        // callback
                        doneTyping(el);
                    }, timeout);
                }).on('blur',function(){
                    // If we can, fire the event since we're leaving the field
                    doneTyping(el);
                });
            });
        }
    });
})(jQuery);

$('#fnama_barang').donetyping(function(){
  window.location.replace('arsipsektor.php?id=olah_stok&page=<?php echo $_GET['page']."&nama="?>'+$('#fnama_barang').val()+'&status='+$('#fstatus').val()+'&namasektorpengaju='+$('#fnama_sektor_asal').val()+'&tglpengajuan='+$('#fcreated_date').val());
});
$('#fnama_sektor_asal').donetyping(function(){
  window.location.replace('arsipsektor.php?id=olah_stok&page=<?php echo $_GET['page']."&nama="?>'+$('#fnama_barang').val()+'&status='+$('#fstatus').val()+'&namasektorpengaju='+$('#fnama_sektor_asal').val()+'&tglpengajuan='+$('#fcreated_date').val());
});
$('#fstatus').change(function(){
  window.location.replace('arsipsektor.php?id=olah_stok&page=<?php echo $_GET['page']."&nama="?>'+$('#fnama_barang').val()+'&status='+$('#fstatus').val()+'&namasektorpengaju='+$('#fnama_sektor_asal').val()+'&tglpengajuan='+$('#fcreated_date').val());
});
$('#fcreated_date').change(function(){
  window.location.replace('arsipsektor.php?id=olah_stok&page=<?php echo $_GET['page']."&nama="?>'+$('#fnama_barang').val()+'&status='+$('#fstatus').val()+'&namasektorpengaju='+$('#fnama_sektor_asal').val()+'&tglpengajuan='+$('#fcreated_date').val());
});
</script>
</body>
</html>
<?php 
function getNamaBarang($id){
    $make_call3 = callAPI('POST', 'http://localhost:8080/jenis/find', '{"id":"'.$id.'"}');
    $response3 = json_decode($make_call3, true);
    if(!isset($response3['nama'])){
        return getNamaBarang2($id);
    }
    return array($response3['nama'],$response3['sektor']);
};
function getNamaBarang2($id){
    $make_call3 = callAPI('POST', 'http://localhost:8080/nonjenis/find', '{"id":"'.$id.'"}');
    $response3 = json_decode($make_call3, true);
    
    return array($response3['nama'],$response3['sektor']);
};
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
};
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