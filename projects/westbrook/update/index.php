<?php
$url = "https://evening-shore-05569.herokuapp.com/update";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($curl);
curl_close($curl);

echo "Done";
//header("Location: /projects/westbrook");
?>
