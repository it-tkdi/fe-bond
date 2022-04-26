<?php
$id = $_GET['id'];

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => '18.140.7.221:3002/api/events/client/'.$id,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

curl_close($curl);

$result = json_decode(json_encode($response), true);
$obj = json_decode($result);

$data = $obj->data;
$dataImg = $data->base64string;
$dataDeskripsi = $data->description;
$dataTgl = $data->event_date;
$dataName = $data->event_name;
$dataWaktu = $data->event_time;

?>

<!-- <div id="page_content_wrapper" class="hasbg"> -->
    <div class="inner">
        <!-- Begin main content -->
        <div class="inner_wrapper">
            <div class="sidebar_content full_width">
                <div class="sidebar_content">
                    <!-- Begin each blog post -->
                    <div id="post-2814" class="post-2814 events type-events status-publish has-post-thumbnail hentry">
                        <div class="post_wrapper">
                            <div class="post_content_wrapper">
                                <p><img src="data:image/gif;base64,<?php echo $dataImg; ?>" width="800" height="400" alt="" /></p>
                                <blockquote><p><?php echo strtoupper($dataName); ?></p></blockquote>
                                <p>
                                    <?php echo $dataDeskripsi; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- End each blog post -->
                </div>

                <div class="sidebar_wrapper">
                    <div class="sidebar_top"></div>

                    <div class="sidebar">
                        <div class="content" style="text-align: center;">
                            <h2 class="event_title"><?php echo $dataTgl; ?></h2>
                            <div class="event_time"><i class="fa fa-clock-o"></i><?php echo $dataWaktu; ?></div>
                            <hr class="thick" />
                            <br />
                        </div>
                    </div>
                    <br class="clear" />

                    <div class="sidebar_bottom"></div>
                </div>
            </div>
        </div>
        <!-- End main content -->
    </div>

    <br class="clear" />
    <br />
    <br />
<!-- </div> -->