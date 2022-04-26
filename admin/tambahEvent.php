<?php
session_start();
?>
<h2>Tambah Event</h2>

<diV class="container">
  <form method="post" enctype="multipart/form-data">

    <div class="form-group">
      <label>Nama Event</label>
      <input type="text" class="form-control" name="nama" required>
    </div>
    <div class="form-group">
      <label>Tanggal Event</label>
      <input type="date" class="form-control" name="tanggal" required>
    </div>
    <div class="form-group">
      <label>Waktu Event</label>
      <input type="text" class="form-control" name="waktu" placeholder="Ex: 20:00 - 23:00" required>
    </div>
    <div class="form-group">
      <label>Foto Event</label>
      <input type="file" class="form-control" name="foto" required>
    </div>
    <div class="form-group">
      <label>Deskripsi Event</label>
      <textarea class="form-control textarea_" name="deskripsi" rows="10" ></textarea>
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
    
    if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png') {
        $postData = [
        'event_name' => Trim(stripslashes($_POST['nama'])),
        'event_date' => Trim(stripslashes($_POST['tanggal'])),
        'event_time' => Trim(stripslashes($_POST['waktu'])),
        'description' => Trim(stripslashes($_POST['deskripsi'])),
        'file' => new CURLFILE($filePath)
      ];
    } else {
      echo "<script>alert('file yang diinput bukan file gambar!');</script>";
    };
    
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => '18.140.7.221:3002/api/events/create',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => $postData,
      CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer ".$_SESSION["access_token"]
      ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png') {
      if ($response){
        $dcd = json_decode(json_encode($response), true);
        $dcd2 = json_decode($dcd);
        $statusCode = $dcd2->statusCode;

        if ($statusCode == 403){
          print "<meta http-equiv=\"refresh\" content=\"0;URL=index.php\">";
          echo "<script>alert('Invalid token, silahkan login kembali!');</script>";
        } elseif($statusCode == 200 || 201) {
          print "<meta http-equiv=\"refresh\" content=\"0;URL=dashboard-admin.php\">";
          echo "<script>alert('Event berhasil ditambah!');</script>";
        } else {
          print "<meta http-equiv=\"refresh\" content=\"0;URL=dashboard-admin.php\">";
          echo "<script>alert('Event gagal ditambah!');</script>";
        }
      } else{
        print "<meta http-equiv=\"refresh\" content=\"0;URL=dashboard-admin.php\">";
        echo "<script>alert('Event gagal ditambah!');</script>";
      }
    } else {
      print "<meta http-equiv=\"refresh\" content=\"0;URL=dashboard-admin.php?halaman=tambahEvent\">";
      echo "<script>alert('kembali ke form');</script>";
    }
    
  }

?>
