<?php
require_once('/path/to/evapi-php/autoload.php');

#authenticateUser

$authentication_api_instance = new Swagger\Client\Api\AuthenticationApi();
$api_key = 'your_api_key_goe_here'; 
$username = 'existing_username_goes_here';
$password = 'user_password_goes_here'; 
$accessToken = '';

try {

  $response = $authentication_api_instance->authenticateUser($api_key, $username, $password);
  $loginSuccess = $response['success'];

  if ($loginSuccess) {
    $accessToken = $response['results']['access_token'];
  } else {
    // something went wrong check $response['error'] for more details
    throw new Exception($response['error']['message']);
  }

} catch (Exception $e) {
    // server error occured
    echo 'Exception when calling AuthenticationApi->authenticateUser: ', $e->getMessage(), PHP_EOL;
    exit;
}

#createFolder

$files_folders_api_instance = new Swagger\Client\Api\FilesAndFoldersApi();
$folderName = 'api_test_folder'.rand();
$path = '/';

try{

  $response = $files_folders_api_instance->createFolder($api_key, $accessToken, $folderName, $path);
  $createSuccess = $response['success'];

  if ($createSuccess) {
    // Folder created successfully
    echo ('Folder created successfully');
  }
  else{
    // something went wrong check $response['error'] for more details
    throw new Exception($response['error']['message']);
  }

} catch (Exception $e) {
    // server error occured
    echo 'Exception when calling FilesAndFoldersApi->createFolder: ', $e->getMessage(), PHP_EOL;
    exit;
}

#getAcitivityLogs

$activity_api_instance = new Swagger\Client\Api\ActivityApi();
$offset = 0;
$sort_by = "sort_logs_date"; 
$sort_order = "desc"; 

try {

  $response = $activity_api_instance->getFileActivityLogs($api_key, $accessToken, $offset, $sort_by, $sort_order);
  $getActivitySuccess = $response['success'];


  if ($getActivitySuccess) {
    // Geat array with log entries
    $activityLogs = $response['results'];
    print_r($activityLogs);
  }
  else{
    // something went wrong check $response['error'] for more details
    throw new Exception($response['error']['message']);
  }

} catch (Exception $e) {
    echo 'Exception when calling ActivityApi->getFileActivityLogs: ', $e->getMessage(), PHP_EOL;
    exit;
}

# To logout the current user, simply check the $loginSuccess flag that was stored earlier and then call the `logoutUser` method
if ($loginSuccess) {
  $authentication_api_instance->logoutUser($api_key, $accessToken);
}
?>