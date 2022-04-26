<?php
session_start();

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => '18.140.7.221:3002/api/events',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_POSTFIELDS => '',
  CURLOPT_HTTPHEADER => array(
    "Authorization: Bearer ".$_SESSION["access_token"]
  ),
));

$response = curl_exec($curl);

curl_close($curl);

if($response) {
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
  }
  else {
    $result = json_decode(json_encode($response), true);
    $obj = json_decode($result);

    $data = $obj->data;
  }
} else {
  echo "<p style=\"color: red; font-weight: bold;\">Server Error!</p>";
}

?>
<h2>Data Events</h2>

<a href="dashboard-admin.php?halaman=tambahEvent" class="tambah-btn">Tambah Event</a>

<table width="90%" border="1" cellpadding="10" cellspacing="2" style="margin-top: 15px;">
    <thead>
        <tr>
        <th>No</th>
        <th>Nama Event</th>
        <th>Tanggal Event</th>
        <th>Foto Event</th>
        <th>Deskripsi Event</th>
        <th>Status Event</th>
        <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php $nomor=1; ?>
    <?php if($statusCode == 200) { ?>
      <?php foreach($data as $item) { ?>
        <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $item->event_name; ?></td>
            <td><?php echo $item->event_date; echo "<br>"; echo "Pukul: "; echo $item->event_time; ?></td>
            <td>
              <img src="data:image/gif;base64,<?php echo $item->base64string; ?>" width="100" height="100">
            </td>
            <td><?php echo substr($item->description,0,40); ?></td>
            <td>
              <?php echo $item->is_active == 1 ? 'Active' : 'Not Active' ?>
            </td>
            <td>
              <?php if($item->is_active == 1) { ?>
              <a
                href="dashboard-admin.php?halaman=hapusEvent&id=<?php echo $item->id; ?>"
                class="hapus-btn"
                onclick="return confirm('Yakin menonaktifkan event?');"
              >Deactivate</a>
              <?php } else { ?>
                <a 
                  href="dashboard-admin.php?halaman=activateEvent&id=<?php echo $item->id; ?>"
                  class="confirm-btn"
                  onclick="return confirm('Aktifkan event kembali?');"
                >Activate</a>
              <?php } ?>
              <a href="dashboard-admin.php?halaman=ubahEvent&id=<?php echo $item->id; ?>" class="ubah-btn">Ubah</a>
            </td>
        </tr>

        <?php $nomor++; ?>
        <?php } ?>
      <?php } elseif($statusCode == 500) { ?>
      <?php echo "<p style=\"color: red; font-weight: bold;\">Server Error</p>" ?>
      <?php } elseif($statusCode == 403) { ?>
      <?php echo "<p style=\"color: red; font-weight: bold;\">Invalid Token, Silahkan Login Kembali</p>" ?>
      <?php } else { ?>
      <?php echo "<p style=\"color: red; font-weight: bold;\">Tidak ada data event</p>"; ?>
      <?php } ?>
    </tbody>
</table>
