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
<h2>Blast Email by Group</h2>

<div class="container">
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Subject</label>
            <input type="text" class="form-control" name="subject" required>
        </div>
        <div class="form-group">
            <label>Foto</label>
            <input type="file" class="form-control" name="foto" required>
        </div>
        <div class="form-group">
            <label>Message Email</label>
            <textarea class="form-control textarea_" name="body" rows="10" ></textarea>
        </div>

        <table width="72%" border="1" cellpadding="10" cellspacing="2" style="margin-top: 15px; margin-bottom: 15px">
          <thead>
            <tr>
              <th>Nama Grup</th>
              <th>Pilih</th>
            </tr>
          </thead>
          <tbody>
            <?php if($statusCode == 200) { ?>
              <?php foreach($data as $item) { ?>
            <tr>
              <td><?php echo $item->group_name ?></td>
              <td>
                <input type="checkbox" name="grup[]" class="single_select" value="<?php echo $item->id; ?>" />
              </td>
            </tr>
              <?php } ?>
            <?php } elseif($statusCode == 404) { ?>
              <?php echo "<p style=\"color: red; font-weight: bold;\">Tidak ada data grup, silahkan tambah grup dahulu</p>" ?>
            <?php } else { ?>
              <?php echo "<p style=\"color: red; font-weight: bold;\">Server error</p>" ?>
            <?php } ?>
          </tbody>
        </table>
                
        <?php if($statusCode == 200) { ?>
        <input type="submit" name="submit" value="Send Email" class="tambah-btn" />
        <?php } else { ?>
        <input disabled value="Send Email" class="dis-btn" />
        <?php } ?>
    </form>
</div>

<?php
function sendEmail() {
    $subject = Trim(stripslashes($_POST['subject']));
    $body = Trim(stripslashes($_POST['body']));
    $fotoTmp = $_FILES['foto']['tmp_name'];
    $grup = $_POST['grup'];

    $varData = new CURLFILE($fotoTmp);
    
    $filePathTmp = str_replace("\\", "/", $varData->name);
    $filePath = str_replace("\\", "/", $filePathTmp);
    
    $dataGrup = implode(",", $grup);
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => '18.140.7.221:3002/api/emails/send-email',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => array(
        'subject' => $subject,
        'body' => $body,
        'to' => $dataGrup,
        'imageFile'=> new CURLFILE($filePath),
    ),
    CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer ".$_SESSION["access_token"],
        "Content-Type: multipart/form-data"
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
        echo "<script>alert('Email berhasil dikirim!');</script>";
        }
    } else {
        print "<meta http-equiv=\"refresh\" content=\"0;URL=dashboard-admin.php?halaman=blastByGroup\">";
        echo "<script>alert('Email gagal dikirim!');</script>";
    }
}

if(isset($_POST['submit'])) {
    sendEmail();
}
?>