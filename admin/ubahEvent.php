<?php
session_start();
$id = $_GET['id'];
$token = $_SESSION['access_token'];

$ch = curl_init();

curl_setopt_array($ch, array(
  CURLOPT_URL => '54.169.130.70:3002/api/events/'.$id,
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

$getEvent = curl_exec($ch);
curl_close($ch);

if($getEvent) {
  $dcd = json_decode(json_encode($getEvent),true);
  $dcdEvent = json_decode($dcd);

  if($dcdEvent->statusCode == 403) {
    echo "Invalid token, silahkan login Kembali";
  } elseif ($dcdEvent->statusCode == 200) {
    $dataEvent = $dcdEvent->data;

    $dataName = $dataEvent->event_name; 
    $dataTgl = $dataEvent->event_date;
    $dataDeskripsi = $dataEvent->description;
    $dataImg = $dataEvent->filename;
    $dataWaktu = $dataEvent->event_time;
  } else {
    echo "Server error!";
  }
} else {
  echo "Server error!";
}

?>
<h2>Ubah Event</h2>

<diV class="container">
  <form method="post" enctype="multipart/form-data">

    <div class="form-group">
      <label>Nama Event</label>
      <input type="text" class="form-control" name="nama" value="<?php if($dcdEvent->statusCode == 200) { echo $dataName; } else { echo "";} ?>" required>
    </div>
    <div class="form-group">
        <label>Tanggal Event</label>
        <input type="date" class="form-control" name="tanggal" value="<?php if($dcdEvent->statusCode == 200) { echo $dataTgl; } else { echo "";} ?>" required>
    </div>
    <div class="form-group">
      <label>Waktu Event</label>
      <input type="text" class="form-control" name="waktu" value="<?php if($dcdEvent->statusCode == 200) { echo $dataWaktu; } else { echo "";} ?>" required>
    </div>
    <div class="form-group">
      <label>Foto Event</label>
      <input type="file" class="form-control" name="foto" value="<?php  if($dcdEvent->statusCode == 200) { echo $dataImg; } else { echo "";} ?>" required>
    </div>
    <div class="form-group">
      <label>Deskripsi Event</label>
      <textarea class="form-control" name="deskripsi" rows="10" cols="50" required><?php  if($dcdEvent->statusCode == 200) { echo $dataDeskripsi; } else { echo "";} ?></textarea>
    </div>
    <button class="tambah-btn" name="save">Simpan</button>
  </form>
</div>

<?php

if(isset($_POST['save'])) {
    $fotoTmp = $_FILES['foto']['tmp_name'];
    $fotoType = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    $fotoName = $_FILES['foto']['name'];

    $ext = strtolower($fotoType);

    $varData = new CURLFILE($fotoTmp);

    $filePathTmp = str_replace("\\", "/", $varData->name);
    $filePath = str_replace("\\", "/", $filePathTmp);

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => '54.169.130.70:3002/api/events/edit/'.$id,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'PUT',
      CURLOPT_POSTFIELDS => array(
        'event_name' => Trim(stripslashes($_POST['nama'])),
        'event_date' => Trim(stripslashes($_POST['tanggal'])),
        'event_time' => Trim(stripslashes($_POST['waktu'])),
        'description' => Trim(stripslashes($_POST['deskripsi'])),
        'file' => new CURLFILE($filePath)
      ),
      CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer '.$_SESSION["access_token"],
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    
    if($response) {
      $dcd = json_decode(json_encode($response), true);
      $dcd2 = json_decode($dcd);
      $statusCode = $dcd2->statusCode;

      if ($statusCode == 403){
        print "<meta http-equiv=\"refresh\" content=\"0;URL=index.php\">";
        echo "<script>alert('Invalid token, silahkan login kembali!');</script>";
      } elseif($statusCode == 200 || 201) {
        print "<meta http-equiv=\"refresh\" content=\"0;URL=dashboard-admin.php\">";
        echo "<script>alert('Event berhasil diubah!');</script>";
      } else {
        print "<meta http-equiv=\"refresh\" content=\"0;URL=dashboard-admin.php\">";
        echo "<script>alert('Event gagal diubah!');</script>";
      }
      
    } else {
        print "<meta http-equiv=\"refresh\" content=\"0;URL=dashboard-admin.php\">";
        echo "<script>alert('Event gagal diubah!');</script>";
      }
}

?>