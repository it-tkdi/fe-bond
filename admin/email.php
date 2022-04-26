<?php
session_start();

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => '18.140.7.221:3002/api/emails',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
      "Authorization: Bearer ".$_SESSION["access_token"]
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
  }
  elseif($statusCode == 403) {
    echo "";
  }
  elseif($statusCode == 500) {
    echo "";
  } else {
    echo "";
  }
} else {
  echo "Server Error!";
}

?>
<h2>Data Email</h2>

<a href="dashboard-admin.php?halaman=tambahEmail" class="tambah-btn">Tambah Email</a>
<a href="dashboard-admin.php?halaman=tambahEmailExcel" class="tambah-btn">Upload file excel</a>
<a href="dashboard-admin.php?halaman=blastEmail" class="info-btn">Blast Email</a>
<a href="dashboard-admin.php?halaman=blastByGroup" class="info-btn">Blast Email by Group</a>


<table width="90%" border="1" cellpadding="10" cellspacing="2" style="margin-top: 15px; margin-bottom: 15px">
    <thead>
        <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Group</th>
        <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php $nomor=1; ?>
    <?php if($statusCode == 200) { ?>
      <?php foreach($data as $item) { ?>
        <tr>
            <td><?php echo $nomor ?></td>
            <td><?php echo $item->name ?></td>
            <td><?php echo $item->email ?></td>
            <td><?php echo $item->group_name ?></td>
            <td>
                <a href="dashboard-admin.php?halaman=hapusEmail&id=<?php echo $item->id; ?>" class="hapus-btn">Hapus</a>
                <a href="dashboard-admin.php?halaman=ubahEmail&id=<?php echo $item->id; ?>" class="ubah-btn">Ubah</a>
            </td>
        </tr>
        <?php $nomor++; ?>
        <?php } ?>
      <?php } elseif($statusCode == 500) { ?>
      <?php echo "<p style=\"color: red; font-weight: bold;\">Server Error</p>" ?>
      <?php } elseif($statusCode == 403) { ?>
      <?php echo "<p style=\"color: red; font-weight: bold;\">Invalid Token, Silahkan Login Kembali</p>" ?>
      <?php } else { ?>
      <?php echo "<p style=\"color: red; font-weight: bold;\">Tidak ada data email</p>"; ?>
      <?php } ?>
    </tbody>
</table>
