<?php
include_once('../helper/import.php');

function callAPI($method, $url, $data, $isAuth = false){
   $curl = curl_init();
   switch ($method){
      case "POST":
         curl_setopt($curl, CURLOPT_POST, 1);
         if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         break;
      case "PUT":
         curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
         if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
         break;
      default:
         if ($data)
            $url = sprintf("%s?%s", $url, http_build_query($data));
   }

   // OPTIONS:
   curl_setopt($curl, CURLOPT_URL, $url);
   curl_setopt($ch, CURLOPT_TIMEOUT, 0);
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
   if ($isAuth) {
      curl_setopt($curl, CURLOPT_HTTPHEADER, array(
         'Authorization: f5a6158a5bc8cd601edd661e087d72d7',
         'Content-Type: application/json',
      ));
   }

   // EXECUTE:
   $result = curl_exec($curl);
   $curl_errno = curl_errno($curl);
   $curl_error = curl_error($curl);
   if ($curl_errno > 0) {
      die("Connection Failure : ($curl_errno) $curl_error\n");
   } 
   curl_close($curl);

   $response = json_decode($result);
   $resultData = new stdClass();
   if ($response->code == 200) {
      $resultData->success = true;
      $resultData->data = $response->data;
   } else {
      $resultData->success = false;
      $resultData->data = $response->data;
   }
   return $resultData;
 }
?>