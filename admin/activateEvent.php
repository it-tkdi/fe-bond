<?php
session_start();
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => '18.140.7.221:3002/api/events/activate/'.$_GET['id'],
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'PUT',
    CURLOPT_HTTPHEADER => array(
      'Authorization: Bearer '.$_SESSION['access_token']
    ),
  ));

  $response = curl_exec($curl);

  curl_close($curl);

  if ($response){
    print "<meta http-equiv=\"refresh\" content=\"0;URL=dashboard-admin.php\">";
    echo "<script>alert('Event diaktifkan kembali!');</script>";
  }
  else{
    print "<meta http-equiv=\"refresh\" content=\"0;URL=dashboard-admin.php\">";
    echo "<script>alert('gagal aktifkan event!');</script>";
  }
?>