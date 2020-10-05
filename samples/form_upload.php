<?php
$upload = [
    'data' => [
        'Your Name' => "Amy",
        "Email Address" => "test+2@exavault.com",
        "Subject" => "Hello from Oregon",
        "Message" => "I hope my connection is OK"
        ]
    ];

// get cURL resource
$ch = curl_init();

// set url
curl_setopt($ch, CURLOPT_URL, 'https://stagingtest.exavault.com/api/v2/forms/1p1-4iphexj9/entries/');

// set method
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');

// return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// set headers
curl_setopt($ch, CURLOPT_HTTPHEADER, [
  'ev-access-token: 44191d089c42ceb1fead63103a3183b597084997130af29312b190bae935a12b',
  'ev-api-key: stagingtest-7zHng80T36zw81DqPcGQW',
  'Content-Type: application/json; charset=utf-8',
]);


$body = json_encode($upload);

// set body
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

// send the request and save response to $response
$response = curl_exec($ch);

// stop if fails
if (!$response) {
  die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
}

echo 'HTTP Status Code: ' . curl_getinfo($ch, CURLINFO_HTTP_CODE) . PHP_EOL;
echo 'Response Body: ' . $response . PHP_EOL;

var_dump($response);

// close curl resource to free up system resources 
curl_close($ch);

