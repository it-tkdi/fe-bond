<?php
session_start();
// GET GROUPS
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
    'Authorization: Bearer '.$_SESSION["access_token"]
  ),
));

$response = curl_exec($curl);

curl_close($curl);
if ($response) {
  $dcd = json_decode(json_encode($response), true);
  $dcd2 = json_decode($dcd);
  $statusCode = $dcd2->statusCode;

  if($statusCode == 404) {
    echo "";
  }
  elseif($statusCode == 403) {
    echo "";
  }
  elseif($statusCode == 500) {
    echo "";
  } else {
      $result = json_decode(json_encode($response), true);
      $obj = json_decode($result);

      $data = $obj->data;
  }
} else {
  echo "Server Error!";
}
?>
<h2>Groups</h2>
<a href="dashboard-admin.php?halaman=tambahGroups" class="tambah-btn">Tambah Group</a>

<table width="50%" border="1" cellpadding="10" cellspacing="1" style="margin-top: 15px; margin-bottom: 15px; text-align: center; font-size: 16px;">
    <thead>
        <tr>
          <th>ID Grup</td>
          <th>Nama Grup</th>
          <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php if($statusCode == 200) { ?>
      <?php foreach($data as $item) { ?>
        <tr>
          <td><?php echo $item->id ?></td>
            <td><?php echo $item->group_name ?></td>
            <td>
                <a href="dashboard-admin.php?halaman=ubahGroups&id=<?php echo $item->id; ?>" class="ubah-btn">Ubah</a>
            </td>
        </tr>
        <?php } ?>
      <?php } elseif($statusCode == 500) { ?>
      <?php echo "<p style=\"color: red; font-weight: bold;\">Server Error</p>" ?>
      <?php } elseif($statusCode == 403) { ?>
      <?php echo "<p style=\"color: red; font-weight: bold;\">Invalid Token, Silahkan Login Kembali</p>" ?>
      <?php } else { ?>
      <?php echo "<p style=\"color: red; font-weight: bold;\">Tidak ada data grup</p>"; ?>
      <?php } ?>
    </tbody>
</table>