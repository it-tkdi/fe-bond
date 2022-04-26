<?php

$Name = Trim(stripslashes($_POST['Name'])); 
$City = Trim(stripslashes($_POST['City'])); 
$Email = Trim(stripslashes($_POST['Email'])); 
$Message = Trim(stripslashes($_POST['Message'])); 

$postData = [
  "name" => $Name,
  "city" => $City,
  "email" => $Email,
  "message" => $Message
];

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => '18.140.7.221:3001/api/mailer/contact-us',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => json_encode($postData),
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);

// redirect to success page 
if ($response){
  print "<meta http-equiv=\"refresh\" content=\"0;URL=../contact-us.html\">";
  echo '("<script>alert("Email sent!")</script>")';
}
else{
  print "<meta http-equiv=\"refresh\" content=\"0;URL=error.htm\">";
}
?>