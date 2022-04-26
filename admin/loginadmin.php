<?php
session_start();
$Name = Trim(stripslashes($_POST['name'])); 
$Pass = Trim(stripslashes($_POST['pass']));

$postData = [
  "username" => $Name,
  "password" => $Pass
];

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => '18.140.7.221:3002/api/auth/admin-login',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => json_encode($postData),
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Authorization: Bearer Token'
  ),
));

$response = curl_exec($curl);

curl_close($curl);

if ($response) {
  $result = json_decode( json_encode($response), true);
  $objResult = json_decode($result);

  $_SESSION["access_token"] = $objResult->data->access_token;
  $statusCode = $objResult->statusCode;

  if ($statusCode == 500) {
    print "<meta http-equiv=\"refresh\" content=\"0;URL=index.php\">";
    echo "<script>alert('server error!');</script>";
  }
  elseif ($statusCode == 200){
    print "<meta http-equiv=\"refresh\" content=\"0;URL=dashboard-admin.php\">";
    echo "<script>alert('login berhasil!');</script>";
  }
  elseif ($statusCode == 401){
    print "<meta http-equiv=\"refresh\" content=\"0;URL=index.php\">";
    echo "<script>alert('password salah!');</script>";
  } else {
    print "<meta http-equiv=\"refresh\" content=\"0;URL=index.php\">";
    echo "<script>alert('login gagal!');</script>";
  }
} else {
  print "<meta http-equiv=\"refresh\" content=\"0;URL=index.php\">";
  echo "<script>alert('login gagal!');</script>";
}
?>
