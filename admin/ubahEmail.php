<?php
session_start();
$id = $_GET['id'];
$token = $_SESSION['access_token'];
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => '18.140.7.221:3002/api/emails/'.$id,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer '.$token,
  ),
));

$getEmail = curl_exec($curl);
curl_close($curl);
if($getEmail) {
  $result = json_decode(json_encode($getEmail), true);
  $dcd = json_decode($result);

  if($dcd->statusCode == 200) {
    $data = $dcd->data;

    $namaplg = $data->name;
    $emailplg = $data->email;
    $grupplg = $data->group;

  } elseif($dcd->statusCode == 403) {
    echo "Invalid token, silahkan login kembali";
  } else {
    echo "Server error!";
  }
  
} else {
  echo "Server error!";
}


?>
<h2>Ubah Email</h2>

<form method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label>Nama Pelanggan</label>
    <input type="text" name="nama" value="<?php if($dcd->statusCode == 200) { echo $namaplg; } else { echo "";} ?>" class="form-control" required>
  </div>
  <div class="form-group">
    <label>Email</label>
    <input type="text" name="email" value="<?php if($dcd->statusCode == 200) {  echo $emailplg; } else { echo "";} ?>" class="form-control" required>
  </div>
  <div class="form-group">
    <label>Group</label>
    <input type="text" name="grup" value="<?php  if($dcd->statusCode == 200) { echo $grupplg; } else { echo "";} ?>" class="form-control" required>
  </div>
  <button class="tambah-btn" name="ubah">Simpan</button>
</form>

<?php
  if(isset($_POST['ubah'])) {
    $namaPelanggan = $_POST['nama'];
    $email = $_POST['email'];
    $grup = $_POST['grup'];

    $postData = [
    "name" => $namaPelanggan,
    "email" => $email,
    "group" => $grup
  ];

  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => '18.140.7.221:3002/api/emails/edit/'.$_GET['id'],
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'PUT',
    CURLOPT_POSTFIELDS => json_encode($postData),
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
      print "<meta http-equiv=\"refresh\" content=\"0;URL=dashboard-admin.php?halaman=email\">";
      echo "<script>alert('Email berhasil diubah!');</script>";
    } else {
      print "<meta http-equiv=\"refresh\" content=\"0;URL=dashboard-admin.php?halaman=email\">";
      echo "<script>alert('Event gagal diubah!');</script>";
    }
  }
  else{
    print "<meta http-equiv=\"refresh\" content=\"0;URL=dashboard-admin.php?halaman=email\">";
    echo "<script>alert('Email gagal diubah!');</script>";
  }
  }
?>