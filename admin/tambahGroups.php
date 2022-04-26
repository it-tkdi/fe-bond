<?php
session_start();
$token = $_SESSION['access_token'];
?>
<h2>Tambah Grup</h2>

<form method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label>Nama Group</label>
    <input type="text" name="namaGrup" class="form-control" required>
  </div>
  <button class="tambah-btn" name="tambah">Simpan</button>
</form>

<?php
if(isset($_POST['tambah'])) {
    $namaGrup = Trim(stripslashes($_POST['namaGrup']));

    $postData = ["groupName" => $namaGrup];

    // ADD GROUP NAME
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => '18.140.7.221:3002/api/groups',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => json_encode($postData, true),
    CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer '.$token,
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
    } elseif ($statusCode == 400) {
      print "<meta http-equiv=\"refresh\" content=\"0;URL=dashboard-admin.php?halaman=tambahGroups\">";
      echo "<script>alert('Group sudah ada!');</script>";
    } 
    elseif($statusCode == 200 || 201) {
      print "<meta http-equiv=\"refresh\" content=\"0;URL=dashboard-admin.php?halaman=groups\">";
      echo "<script>alert('Group berhasil ditambah!');</script>";
    }
  } else{
    print "<meta http-equiv=\"refresh\" content=\"0;URL=dashboard-admin.php?halaman=tambahGroups\">";
    echo "<script>alert('Group gagal ditambah!');</script>";
  }
}
?>