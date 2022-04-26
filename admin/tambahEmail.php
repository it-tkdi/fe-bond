<?php
  session_start();
  $token = $_SESSION['access_token'];

  $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => '18.140.7.221:3002/api/groups',
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

$response = curl_exec($curl);
curl_close($curl);
if ($response) {
  $dcd = json_decode(json_encode($response), true);
  $dcd2 = json_decode($dcd);
  $statusCode = $dcd2->statusCode;

  if($statusCode == 200) {
    $result = json_decode(json_encode($response), true);
    $obj = json_decode($result);

    $data = $obj->data;
  } elseif($statusCode == 403) {
    echo "";
  } elseif($statusCode == 500) {
    echo "";
  } elseif($statusCode == 404) {
    echo "";
  }
} else {
  echo "Server Error!";
}

?>
<h2>Tambah Email</h2>

<form method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label>Nama Pelanggan</label>
    <input type="text" name="nama" class="form-control" required>
  </div>
  <div class="form-group">
    <label>Email</label>
    <input type="text" name="email" class="form-control" required>
  </div>
  <div class="form-group">
    <label>Group</label>
    <?php if($statusCode == 200) { ?>
      <select name="group" id="group" class="form-control_grup" required>
        <?php foreach($data as $item) { ?>
        <option value="<?php echo $item->id ?>"><?php echo $item->group_name ?></option>
        <?php } ?>
      </select>
    <?php } elseif($statusCode == 404) { ?>
      <select name="group" id="group" class="form-control_grup" required>
        <option disabled><?php echo "Tidak ada grup" ?></option>
      </select>
      <?php echo "<p style=\"color: red\">Tidak ada data grup, silahkan tambah grup dahulu</p>" ?>
    <?php } else { ?>
      <option><?php echo "" ?></option>
    <?php } ?>
  </div>
  <button class="tambah-btn" name="tambah">Simpan</button>
</form>

<?php
if(isset($_POST['tambah'])) {
  $namaPelanggan = $_POST['nama'];
  $email = $_POST['email'];
  $grup = $_POST['group'];

  $postData = [
    "name" => $namaPelanggan,
    "email" => $email,
    "groupId" => $grup
  ];
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => '18.140.7.221:3002/api/emails/add',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => json_encode($postData),
    CURLOPT_HTTPHEADER => array(
      'Authorization: Bearer '.$_SESSION["access_token"],
      'Content-Type: application/json'
    ),
  ));

  $response = curl_exec($curl);

  curl_close($curl);

  if ($response){
    $dcd = json_decode(json_encode($response), true);
    $dcd2 = json_decode($dcd);
    $statusCode = $dcd2->statusCode;

    if($statusCode == 403) {
      print "<meta http-equiv=\"refresh\" content=\"0;URL=index.php\">";
      echo "<script>alert('Invalid token, silahkan login kembali!');</script>";
    } elseif($statusCode == 200 || 201) {
      print "<meta http-equiv=\"refresh\" content=\"0;URL=dashboard-admin.php?halaman=email\">";
      echo "<script>alert('Email berhasil ditambah!');</script>";
    }
  } else{
    print "<meta http-equiv=\"refresh\" content=\"0;URL=dashboard-admin.php?halaman=tambahEmail\">";
    echo "<script>alert('Email gagal ditambah!');</script>";
  }
}
?>
