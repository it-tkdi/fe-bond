<?php 
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => '18.140.7.221:3002/api/events/client',
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
// print_r($response);
if($response) {
    $result = json_decode(json_encode($response), true);
    $obj = json_decode($result);
    $statusCode = $obj->statusCode;

    if($statusCode == 200) {
        $data = $obj->data;
        
        if(empty($data)) {
            echo "<div class=\"isi_\">
            <h1 style=\"margin-top: 50px; text-align: center\">Coming Soon</h1>                        
            </div>";
        } else { 
            echo ""; 
        }
    } elseif($statusCode == 404) { 
        echo "<div class=\"isi_\">
            <h1 style=\"margin-top: 50px; text-align: center\">Coming Soon</h1>                        
            </div>";
    } else {
        echo "<div class=\"isi_\">
            <h1 style=\"margin-top: 50px; text-align: center\">Coming Soon</h1>                        
            </div>";
    }
} else {
    echo "<div class=\"isi_\">
            <h1 style=\"margin-top: 50px; text-align: center\">Coming Soon</h1>                     
            </div>";
}

?>

<div id="portfolio_filter_wrapper" class="gallery four_cols portfolio-content section content clearfix">
    
    <?php foreach($data as $item) { ?>
    <div class="element classic2_cols">
        <div class="one_half gallery2 static filterable gallery_type animated2" data-id="post-2">
            <a data-title="<strong><?php echo $item->event_name; ?></strong>" href="data:image/gif;base64,<?php echo $item->base64string; ?>" class="fancy-gallery">
                <img src="data:image/gif;base64,<?php echo $item->base64string; ?>" alt="" />

                <div class="mask">
                    <div class="mask_circle">
                        <i class="fa fa-expand"></i>
                    </div>
                </div>
            </a>
        </div>
        <br class="clear" />
        <div id="portfolio_desc_2814" class="portfolio_desc portfolio2 filterable">
            <div class="event_date_wrapper">
                <h2 class="event_title"><?php echo $item->event_date; ?></h2>
                <div class="event_title"><?php echo $item->event_name; ?></div>
            </div>
            <hr class="thick" />
            <br />
            <?php echo substr($item->description, 0 , 40); ?> [&hellip;]<br />
            <a class="readmore grid" href="event-bond-jakarta.php?halaman=single-event&id=<?php echo $item->id; ?>">Read More</a>
        </div>
    </div>
    <?php } ?>
</div>
