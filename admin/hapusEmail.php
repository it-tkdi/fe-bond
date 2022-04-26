<?php
session_start();

$token = $_SESSION['access_token'];
$id = $_GET['id'];

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => '18.140.7.221:3002/api/emails/deactivate/'.$id,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'PUT',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer '.$token
  ),
));

$response = curl_exec($curl);

curl_close($curl);

if ($response){
    print "<meta http-equiv=\"refresh\" content=\"0;URL=dashboard-admin.php?halaman=email\">";
    echo "<script>alert('Email berhasil dihapus!');</script>";
}
else{
    print "<meta http-equiv=\"refresh\" content=\"0;URL=dashboard-admin.php?halaman=email\">";
    echo "<script>alert('gagal hapus!');</script>";
}
?>