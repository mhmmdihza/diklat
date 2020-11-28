<?php

require_once(__DIR__ . '/vendor/autoload.php');

session_start();

if( !isset($_SESSION['username']) ){
    echo "<script>alert('Login terlebih dahulu!'); window.location='login.php';</script>";
};
$fnama ="";
$fstatus="";
$ftglpengajuan="";
$namasektorpengaju="";
if(isset($_POST['nama_barang'])){
    $fnama = $_GET['nama_barang'];
};
if(isset($_POST['status'])){
    $fstatus = $_POST['status'];
};
if(isset($_POST['created_date'])){
    $ftglpengajuan = $_POST['created_date'];
};if(isset($_POST['nama_sektor_asal'])){
    $namasektorpengaju = $_POST['nama_sektor_asal'];
};


$data_array =  array('nama_barang' => $fnama,'status' => $fstatus ,'created_date' =>$ftglpengajuan, 'nama_sektor_asal'=>$namasektorpengaju);
$stringjs = json_encode($data_array);

$make_hal = callAPI('POST', 'http://localhost:8080/menu/countpage/olah_stok', $stringjs);
$make_hal2 = callAPI('POST', 'http://localhost:8080/menu/countpage/nonolah_stok', $stringjs);

$spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();
$spreadsheet->getProperties();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', 'ID');
$sheet->setCellValue('B1', 'Nama Barang');
$sheet->setCellValue('C1', 'Sektor');
$sheet->setCellValue('D1', 'Type');
$sheet->setCellValue('E1', 'Baik');
$sheet->setCellValue('F1', 'Rusak');
$sheet->setCellValue('G1', 'Keterangan');
$sheet->setCellValue('H1', 'Status');
$sheet->setCellValue('I1', 'Alasan Ditolak');
$sheet->setCellValue('J1', 'Tanggal Pengajuan');
$sheet->setCellValue('K1', 'Tanggal Persetujuan');

$xy=2;
for($i = 1 ; $i<=$make_hal;$i++){
$make_call1 = callAPI('POST', 'http://localhost:8080/menu/list/olah_stok/'.$i, $stringjs);
$response1 = json_decode($make_call1, true);
	for($c = 0 ; $c <sizeof($response1);$c++){
		$sheet->setCellValue('A'.$xy, $response1[$c]['id']);
$sheet->setCellValue('B'.$xy, getNamaBarang($response1[$c]['id_jenis'])[0]);
$sheet->setCellValue('C'.$xy, getSektorName(getNamaBarang($response1[$c]['id_jenis'])[1]));
if(isset($response1[$c]['sektor_dest'])&&!empty($response1[$c]['sektor_dest'])){
    $sheet->setCellValue('D'.$xy, "Perpindahan ke ".getSektorName($response1[$c]['sektor_dest']));
}else{
    $sheet->setCellValue('D'.$xy, 'Penambahan/Pengurangan');
}

$sheet->setCellValue('E'.$xy, $response1[$c]['baik']);
$sheet->setCellValue('F'.$xy, $response1[$c]['rusak']);
$sheet->setCellValue('G'.$xy, $response1[$c]['reason']);
$sheet->setCellValue('H'.$xy, $response1[$c]['status']);
$sheet->setCellValue('I'.$xy, $response1[$c]['rejected_reason']);
$sheet->setCellValue('J'.$xy, $response1[$c]['created_date']);
$sheet->setCellValue('K'.$xy, $$response1[$c]['updated_date']);
$xy++;
	}
}
for($i = 1 ; $i<=$make_hal;$i++){
    $make_call2 = callAPI('POST', 'http://localhost:8080/menu/list/nonolah_stok/'.$i, $stringjs);
    $response2 = json_decode($make_call2, true);
    for($c = 0 ; $c <sizeof($response2);$c++){
        $sheet->setCellValue('A'.$xy, $response2[$c]['id']);
        $sheet->setCellValue('B'.$xy, getNamaBarang2($response2[$c]['id_jenis'])[0]);
        $sheet->setCellValue('C'.$xy, getSektorName(getNamaBarang2($response2[$c]['id_jenis'])[1]));
        if(isset($response2[$c]['sektor_dest'])&&!empty($response2[$c]['sektor_dest'])){
            $sheet->setCellValue('D'.$xy, "Perpindahan ke ".getSektorName($response2[$c]['sektor_dest']));
        }else{
            $sheet->setCellValue('D'.$xy, 'Penambahan/Pengurangan');
        }
        
        $sheet->setCellValue('E'.$xy, $response2[$c]['baik']);
        $sheet->setCellValue('F'.$xy, $response2[$c]['rusak']);
        $sheet->setCellValue('G'.$xy, $response2[$c]['reason']);
        $sheet->setCellValue('H'.$xy, $response2[$c]['status']);
        $sheet->setCellValue('I'.$xy, $response2[$c]['rejected_reason']);
        $sheet->setCellValue('J'.$xy, $response2[$c]['created_date']);
        $sheet->setCellValue('K'.$xy, $$response2[$c]['updated_date']);
        $xy++;
    }
};

$writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
$writer->save('report.xlsx');

$zipName = 'report.xlsx';
header('Content-type: application/xlsx'); //this could be a different header
header('Content-Disposition: attachment; filename="'.$zipName.'"');

ignore_user_abort(true);

$context = stream_context_create();
$file = fopen($zipName, 'rb', FALSE, $context);
while(!feof($file))
{
    echo stream_get_contents($file, 2014);
}
fclose($file);
flush();
if (file_exists($zipName)) {
    unlink( $zipName );
}

function getNamaBarang($id){
    $make_call3 = callAPI('POST', 'http://localhost:8080/jenis/find', '{"id":"'.$id.'"}');
    $response3 = json_decode($make_call3, true);
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
