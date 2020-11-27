<?php 
session_start();

if( !isset($_SESSION['username']) ){
    echo "<script>alert('Login terlebih dahulu!'); window.location='login.php';</script>";
};
$id = $_GET['id'];
$baik = $_GET['baik'];
$rusak =$_GET['rusak'];
if(empty($baik)){
    $baik = 0;
}
if(empty($rusak)){
    $rusak = 0;
}
$keterangan = $_GET['keterangan'];
$idsource;
$namasource;
$sektor;

foreach ($_POST as $param_name => $param_val) {
    echo "Param: $param_name; Value: $param_val<br />\n";
};
if ($_GET['status']==2){
    echo "Tambah";
    echo "<br />";
    echo "id ".$id;
    echo "<br />";
    echo "baik ".$baik;
    echo "<br />";
    echo "rusak ".$rusak;
    echo "<br />";
    echo "keterangan ".$keterangan;
}else{
    $idsource = $_GET['idsource'];
    $namasource = $_GET['namasource'];
    $sektor = $_GET['sektor'];
    echo "Pindah";
    echo "<br />";
    echo "id ".$id;
    echo "<br />";
    echo "baik ".$baik;
    echo "<br />";
    echo "rusak ".$rusak;
    echo "<br />";
    echo "id source ".$idsource;
    echo "<br />";
    echo "nama source ".$namasource;
    echo "<br />";
    echo "sektor ".$sektor;
    echo "<br />";
    echo "keterangan ".$keterangan;
    
}
$data_array =  array('idJenis' => $id, 'reason' => $keterangan,'baik'=>$baik,'rusak'=>$rusak,'status'=>'Waiting','menu' =>$_GET['menu'],'jenisDest' =>0,'sektorDest'=> $sektor);
 $make_call = callAPI('POST', 'http://localhost:8080/olahstok/save/1/'.$_SESSION['username'], json_encode($data_array));
 $response = json_decode($make_call, true);
 
 if($response){
 echo "<script>alert('Data berhasil ditambahkan!'); window.location='/kategori.php?id=".$_GET['returnid']."&sektor=".$_GET['returnsektor']."';</script>";
 }else{
 echo "<script>alert('Data gagal ditambahkan');</script>";
 };

/* $data_array =  array('id' => $id, '' => "namasektor", 'deskripsi' => "deskripsi");
$make_call = callAPI('POST', 'http://localhost:8080/sektor/save/ame', json_encode($data_array));
$response = json_decode($make_call, true);

if($response){
    echo "<script>alert('Data berhasil ditambahkan!'); window.location='/kelolasektor.php';</script>";
}else{
    echo "<script>alert('Data gagal ditambahkan');</script>";
}; */


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

