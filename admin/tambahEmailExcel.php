<?php
session_start();
$token = $_SESSION["access_token"];
?>
<h2>Upload File</h2>
<a href="dashboard-admin.php?halaman=download" class="info-btn">Download Template</a>

<diV class="container">
  <form method="post" enctype="multipart/form-data">

    <div class="form-group">
      <label>File Excel</label>
      <input type="file" class="form-control" name="files" required>
    </div>

    <button class="tambah-btn" name="submit">Submit</button>
  </form>

</div>

<?php
if (isset($_POST['submit'])) {
    $fileTmp = $_FILES['files']['tmp_name'];
    $varData = new CURLFILE($fileTmp);

    $filePathTmp = str_replace("\\", "/", $varData->name);
    $filePath = str_replace("\\", "/", $filePathTmp);

    // print_r($filePath);die;
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => '18.140.7.221:3002/api/emails/add-bulk',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => array('excel_file'=> new CURLFILE($filePath)),
    CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer '.$token
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
      } elseif ($statusCode == 200 || 201) {
        print "<meta http-equiv=\"refresh\" content=\"0;URL=dashboard-admin.php?halaman=email\">";
        echo "<script>alert('Email berhasil ditambahkan!');</script>";
      }
    }
    else{
      print "<meta http-equiv=\"refresh\" content=\"0;URL=dashboard-admin.php?halaman=tambahEmailExcel\">";
      echo "<script>alert('Email gagal ditambah!');</script>";
    }
}
?>