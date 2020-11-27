<?php 


session_start();

if( !isset($_SESSION['username']) ){
    echo "<script>alert('Login terlebih dahulu!'); window.location='login.php';</script>";
}
if($_SESSION['role']>1){
    echo "<script>alert('Tidak ada akses!'); window.location='mainmenu.php';</script>";
}

$data_array =  array('id' => $_GET['id'],'password' => '*****');
$make_call = callAPI('POST', 'http://localhost:8080/nondetailBarang/delete/'.$_SESSION['username'], json_encode($data_array));
$response = json_decode($make_call, true);
if($response==1){
echo "<script>alert('Data berhasil dihapus!'); window.history.back();</script>";
}else{
    echo "<script>alert('Gagal menghapus detail barang ini , harap kosongkan stok barang tersebut di setiap sektor!'); window.history.back();</script>";
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
    
    curl_close($curl);
    return $result;
}
?>