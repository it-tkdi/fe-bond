<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => '18.140.7.221:3001/api/mailer/reservation',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "totalPax": 2,
    "specialRequest": "no special request",
    "name": "John Doe",
    "phone": "087638264",
    "email": "crhwrd@gmail.com"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;

// $EmailFrom = "test@gmail.com";
// $EmailTo = "aryoferdinand@gmail.com";
// $Subject = "Testing This one";
// $Name = Trim(stripslashes($_POST['Name'])); 
// $Tel = Trim(stripslashes($_POST['Tel'])); 
// $Email = Trim(stripslashes($_POST['Email'])); 
// $Message = Trim(stripslashes($_POST['Message'])); 

// validation
// $validationOK=true;
// if (!$validationOK) {
//   print "<meta http-equiv=\"refresh\" content=\"0;URL=error.htm\">";
//   exit;
// }

// prepare email body text
// $Body = "";
// $Body .= "Name: ";
// $Body .= $Name;
// $Body .= "\n";
// $Body .= "Tel: ";
// $Body .= $Tel;
// $Body .= "\n";
// $Body .= "Email: ";
// $Body .= $Email;
// $Body .= "\n";
// $Body .= "Message: ";
// $Body .= $Message;
// $Body .= "\n";

// send email 
// $success = mail($EmailTo, $Subject, $Body, "From: <$EmailFrom>");

// redirect to success page 
// if ($success){
//   print "<meta http-equiv=\"refresh\" content=\"0;URL=contactthanks.php\">";
// }
// else{
//   print "<meta http-equiv=\"refresh\" content=\"0;URL=error.htm\">";
// }
?>

<!-- BOND API

POST 54.254.175.162:3001/api/mailer/reservation
{
    "totalPax": 2,
    "specialRequest": "no special request",
    "name": "John Doe",
    "phone": "087638264",
    "email": "johndoe@gmail.com"
}

POST 54.254.175.162:3001/api/mailer/contact-us
{
    "name": "John Doe",
    "city": "London",
    "email": "johndoe@gmail.com",
    "message": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
} -->