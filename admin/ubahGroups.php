<?php
session_start();
$id = $_GET['id'];
$token = $_SESSION['access_token'];

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => '18.140.7.221:3002/api/groups/'.$id,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer '.$token
  ),
));

$getGrup = curl_exec($curl);

curl_close($curl);
if($getGrup) {
  $result = json_decode(json_encode($getGrup), true);
  $dcd = json_decode($result);

  if($dcd->statusCode == 200) {
    $data = $dcd->data;

    $namagrp = $data->group_name;
  } elseif($dcd->statusCode == 403) {
    echo "Invalid token, silahkan login kembali";
  } else {
    echo "Server error!";
  }
  
} else {
  echo "Server error!";
}
?>

<h2>Ubah Grup</h2>

<form method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label>Nama Group</label>
    <input type="text" name="namaGroup" value="<?php if($dcd->statusCode == 200) { echo $namagrp; } else { echo "";} ?>" class="form-control" required>
  </div>
  <button class="tambah-btn" name="ubah">Simpan</button>
</form>


<?php
if(isset($_POST['ubah'])) {
    $namaGroup = Trim(stripslashes($_POST['namaGroup']));

    $postData = [
        "groupName" => $namaGroup
    ];

    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => '18.140.7.221:3002/api/groups/edit/'.$id,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'PUT',
    CURLOPT_POSTFIELDS => json_encode($postData, true),
    CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer '.$token,
        'Content-Type: application/json'
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    if($response) {
    $dcd = json_decode(json_encode($response), true);
    $dcd2 = json_decode($dcd);
    $statusCode = $dcd2->statusCode;

    if ($statusCode == 403 ){
      print "<meta http-equiv=\"refresh\" content=\"0;URL=index.php\">";
      echo "<script>alert('Invalid token, silahkan login kembali!');</script>";
    } elseif ($statusCode == 200 || 201) {
      print "<meta http-equiv=\"refresh\" content=\"0;URL=dashboard-admin.php?halaman=groups\">";
      echo "<script>alert('Group berhasil diubah!');</script>";
    } else {
      print "<meta http-equiv=\"refresh\" content=\"0;URL=dashboard-admin.php?halaman=groups\">";
      echo "<script>alert('Group gagal diubah!');</script>";
    }
  }
  else{
    print "<meta http-equiv=\"refresh\" content=\"0;URL=dashboard-admin.php?halaman=groups\">";
    echo "<script>alert('Group gagal diubah!');</script>";
  }
}
?>