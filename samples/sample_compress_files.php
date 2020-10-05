<?php
require_once(__DIR__ . '/../vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

/**
 * sample_compress_files.php - Use the Resources API to compress files 
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

// We are demonstrating the use of the ResourcesApi, which is used for file operations (upload, download, delete, etc)
//
// For this demo, we'll create a new folder and upload some files into it. Then we'll compress some of the files into
// a new zip file in the folder

// We have to override the default configuration of the API object with an updated host URL so that our code
//  will reach the correct URL for the api. We have to override this setting for each of the API classes we use
$resourcesApi = new Swagger\Client\Api\ResourcesApi(
    new GuzzleHttp\Client(),
    (new Swagger\Client\Configuration())->setHost($ACCOUNT_URL)
);

// We will create a new folder tree for the demo. The top-level folder will have a different name each time you run this script
$parentFolder = "sample_compress_" . (new \DateTime())->format("U");

// We are uploading a sample file provided along with this script.
// It will have a different name in the account each time it is uploaded
$filename = __DIR__ . "/files/ExaVault Quick Start.pdf";
$target_size = filesize($filename);

// We'll store the IDs, which we'll grab from the responses from new resource uploads, that we want to compress
$compress_resources = [];

for ($i=1; $i < 6; $i++) {
    // We're  uploading the same file under different names to make sure we have multiple files in our target folder
    $target_filename = "/{$parentFolder}/Quick Start {$i}.pdf";
    try {

        // The uploadFile method of the ResourcesApi class will let us upload a file to our account
        // See https://www.exavault.com/developer/api-docs/#operation/uploadFile for the details of this method
        //
        $result = $resourcesApi->uploadFile($API_KEY, $ACCESS_TOKEN, $target_filename, $target_size, $filename);    

        // We want to make an archive that contains the files we've uploaded
        // The ResourcesApi::uploadFile method returns a \Swagger\Client\Model\ResourceResponse object
        // The ResourceResponse::getData method will give us a Resource object
        // The Resource::getId method will give us the resource ID of the newly uploaded file
        $compress_resources[] = "id:" . $result->getData()->getId();
    } catch (Exception $e) {
        echo 'Exception setting up files: ', $e->getMessage(), PHP_EOL;
        exit(1);
    }
}
echo "Uploaded starting files to {$parentFolder}" . PHP_EOL;


// If we got this far, we have a folder that contains 5 PDF files
// Next we are going to use the same ResourcesApi to compress those files into a zip file
// Compressing files doesn't remove the files from the account

try {
    // We stored the resource IDs of all the files we want to compress into the $compress_resources[] array

    // API methods that take a JSON body, such as the compressFiles method, require us to submit an object with the 
    // parameters we want to send to the API. 
    // See https://www.exavault.com/developer/api-docs/#operation/compressFiles for the request body schema
    //
    // This will overwrite an existing zip file with a new one
    $requestBody = (object) [ 
        "resources" => $compress_resources,
        "parentResource" => "/",
        "archiveName" => "zipped_files.zip"
    ];   
    $result = $resourcesApi->compressFiles($API_KEY, $ACCESS_TOKEN, $requestBody);

    // The ResourcesApi::compressFiles method returns a \Swagger\Client\Model\ResourceResponse object
    echo "Created archive at " . $result->getData()->getAttributes()->getPath() . PHP_EOL;

} catch (Exception $e) {
    echo 'Exception when compressing files: ', $e->getMessage(), PHP_EOL;
    exit(4);
}

