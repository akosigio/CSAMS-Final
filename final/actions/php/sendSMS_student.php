<?php 
$ch = curl_init(); 

$message = $_POST["message"];
$number = $_POST["number"];
$parameters = array(
         'apikey' => '8909a576264c7d8a2203ac9b163bfb11', 
         'number' => $number,
         'message' => $message, 
         'sendername' => 'SEMAPHORE'
         );
curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages' );
curl_setopt( $ch, CURLOPT_POST, 1 );
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

//Send the parameters set above with the request
curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );

$result = curl_exec($ch);
print_r($result);
if (curl_errno($ch)) {
   $error_msg = curl_error($ch);
   print_r($error_msg);
}
curl_close($ch);
?>