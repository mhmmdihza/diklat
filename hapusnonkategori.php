<?php 


session_start();

if( !isset($_SESSION['username']) ){
    echo "<script>alert('Login terlebih dahulu!'); window.location='login.php';</script>";
};
if($_SESSION['role']>1){
    echo "<script>alert('Tidak ada akses!'); window.location='mainmenu.php';</script>";
};
$make_call2 = callAPI('POST', 'http://localhost:8080/nonsubKategori/findbyidkategori/'.$_GET['id'].'/'.$_SESSION['username'], null);
$response2 = json_decode($make_call2, true);
echo "test1".sizeof($response2);

if(sizeof($response2)>0){
    echo "jsondec".$response2;
    echo "<script>alert('Gagal Menghapus Kategori , Harap hapus jenis barang terlebih dahulu!'); window.location='kategoriperlengkapannonoperasional.php?id=1';</script>";
}else{
    echo "test2";
$data_array =  array('id' => $_GET['id'],'password' => '*****');
$make_call = callAPI('POST', 'http://localhost:8080/nonkategori/delete/'.$_SESSION['username'], json_encode($data_array));
$response = json_decode($make_call, true);
echo "<script>alert('Data berhasil dihapus!'); window.location='kategoriperlengkapannonoperasional.php?id=1';</script>";
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