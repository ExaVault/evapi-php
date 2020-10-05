<?php
require_once(__DIR__ . '/../vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

/**
 * sample_shared_folder.php - Use the SharesApi to create a shared folder with a password
 */


/**
 * To use this script, add your credentials to a file named .env which is located in the same directory as this script
 * 
 * Your API key will be the EV_KEY
 * Your access token will be EV_TOKEN
 * Your account URL will be the address you should use for the API endpoint
 * 
 * To obtain your API Key and Token, you'll need to use the Developer page within the web file manager
 * See https://www.exavault.com/developer/api-docs/#section/Obtaining-Your-API-Key-and-Access-Token
 * 
 * Access tokens do not expire, so you should only need to obtain the key and token once.
 * 
 * Your account URL is determined by the name of your account. 
 * The URL that you will use is https://accountname.exavault.com/api/v2/ replacing the "accountname" part with your
 *   account name
 * See https://www.exavault.com/developer/api-docs/#section/Introduction/The-API-URL
 */
$API_KEY = $_ENV['EV_KEY'];
$ACCESS_TOKEN = $_ENV['EV_TOKEN'];
$ACCOUNT_URL = $_ENV['ACCOUNT_URL'];

// We are demonstrating the use of the SharesApi, which is used for managing shared folders and receives,
// as well as for sending files. See our Sharing 101 documentation at
// https://www.exavault.com/docs/account/05-file-sharing/00-file-sharing-101

// For this demo, we'll create a share for a new folders. If you have an existing file or folder that you want to use 
// for the share, you won't need this step where we use the ResourcesApi to create the folders first.
//
// We have to override the default configuration of the API object with an updated host URL so that our code
//  will reach the correct URL for the api. We have to override this setting for each of the API classes we use
$resourcesApi = new Swagger\Client\Api\ResourcesApi(
    new GuzzleHttp\Client(),
    (new Swagger\Client\Configuration())->setHost($ACCOUNT_URL)
);

try {
    // We will create a new folder for the demo. The folder will have a different name each time you run this script
    $folder_path = "/sample_share_" . (new \DateTime())->format("U");
    
    // API methods that take a JSON body, such as the addFolder method, require us to submit an object with the 
    // parameters we want to send to the API. This call requires a single parameter path
    $requestBody = (object) [ 'path' => $folder_path];   

    // We have to pass the $API_KEY and $ACCESS_TOKEN with every API call. 
    $result = $resourcesApi->addFolder($API_KEY, $ACCESS_TOKEN, $requestBody);

    // The addFolder method of the ResourcesApi returns a \Swagger\Client\Model\ResourceResponse object
    // See https://www.exavault.com/developer/api-docs/#operation/addFolder for the details of the response object
    echo "Created new folder {$result->getData()->getAttributes()->getPath()}" . PHP_EOL;
    
} catch (Exception $e) {
    echo 'Exception when calling ResourcesApi->addFolder: ', $e->getMessage(), PHP_EOL;
    exit(1);
}


// If we got this far without the program ending, we were able to set up our folder
// and now we can use the SharesApi to share the folder.
//
// We have to override the default configuration of the API object with an updated host URL so that our code
// will reach the correct URL for the api.
$sharesApi = new Swagger\Client\Api\SharesApi(
    new GuzzleHttp\Client(),
    (new Swagger\Client\Configuration())->setHost($ACCOUNT_URL)
);

try {

    // API methods that take a JSON body, such as the addShare method, require us to submit an object with the 
    // parameters we want to send to the API. 
    // See https://www.exavault.com/developer/api-docs/#operation/addShare for the request body schema

    // - We want to add a password to our folder
    // - We are also going to allow visitors to upload and download
    // - Note that the $folder_path variable contains the full path to the folder that was created earlier
    // - We could also have pulled the ID for the new folder out of the ResourceResponse object and used that 
    //   as a resource identifier here. For example, if the ID of the new folder is 23422, we could pass
    //   id:23422 in the resource parameter of this call.
    $requestBody = (object) [ 
        'type' => 'shared_folder',
        'name' => 'Share',
        'accessMode' => [
            'download',
            'upload'
        ],
        'resources' => [
            $folder_path
        ],
        'action' => 'download',
        'password' => '99drowssaP?'
    ];   

    // We have to pass the $API_KEY and $ACCESS_TOKEN with every API call. 
    $result = $sharesApi->addShare($API_KEY, $ACCESS_TOKEN, $requestBody);

    // The SharesApi::addShare method returns a \Swagger\Client\Model\RegularShareResponse object
    //  See https://www.exavault.com/developer/api-docs/#operation/addShare for the response schema

    echo "Created shared folder {$result->getData()->getAttributes()->getHash()} for {$folder_path}" . PHP_EOL;
    echo "Password to access the folder is 99drowssaP?" . PHP_EOL;
    

} catch (Exception $e) {

    echo 'Exception when calling SharesApi->addShare: ', $e->getMessage(), PHP_EOL;
    exit(1);
}
