<?php 
session_start();

if( !isset($_SESSION['username']) ){
    echo "<script>alert('Login terlebih dahulu!'); window.location='login.php';</script>";
}
if($_SESSION['role']>1){
    echo "<script>alert('Tidak ada akses!'); window.location='mainmenu.php';</script>";
};

$data_array =  array('id' => $_POST["id"], 'idKategori' => $_POST["idkategori"], 'nama' => $_POST["nama"]);
$make_call = callAPI('POST', 'http://localhost:8080/nonsubKategori/save/'.$_SESSION['username'], json_encode($data_array));
$response = json_decode($make_call, true);

if($response){
    echo "<script>alert('Data berhasil ditambahkan!'); window.location='/kelolanonkategori.php?id=".$_GET['idkategori']."&nama=".$_GET['namakategori']."';</script>";
}else{
    echo "<script>alert('Data gagal ditambahkan');</script>";
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

