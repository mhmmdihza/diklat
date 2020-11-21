<?php
session_start();

//if (empty($_SESSION['username'])) {
    // The username session key does not exist or it's empty.
  //  header("Location: http://".$_SERVER['HTTP_HOST'].'/tesz/tes.php');
   // exit;
//}

$data_array =  array('username' => $_POST["username"], 'password' => $_POST["password"]);
$make_call = callAPI('POST', 'http://localhost:8080/login/find', json_encode($data_array));
$response = json_decode($make_call, true);
$data     = $response['role'];

header("Location: http://".$_SERVER['HTTP_HOST'].'/mainmenu.php');

$_SESSION["username"] = $response['username'];
$_SESSION["role"] = $response['role'];
$_SESSION["sektor"] = $response['sektor'];


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
        echo "<script>alert('$message'); window.location='/login.php';</script>";
        die('');
    }
    
    curl_close($curl);
    return $result;
}

?>