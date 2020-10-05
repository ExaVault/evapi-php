<?php
require_once(__DIR__ . '/../vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

/**
 * sample_upload_files.php - Use the ResourcesApi to upload a file to your account
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

// We are demonstrating the use of the ResourcesApi, which can be used to manage files and folders in your account

// For this demo, we'll upload a file found in the same folder as this sample code.
//
// We are going to upload the file as a different name each time so that it is obvious that the file is being upload
// There are parameters to control whether files can be overwritten by repeated uploads
//
// We have to override the default configuration of the API object with an updated host URL so that our code
//  will reach the correct URL for the api. We have to override this setting for each of the API classes we use
$resourcesApi = new Swagger\Client\Api\ResourcesApi(
    new GuzzleHttp\Client(),
    (new Swagger\Client\Configuration())->setHost($ACCOUNT_URL)
);


try {
    
    // We are uploading a sample file provided along with this script.
    // It will have a different name in the account each time it is uploaded
    $filename = __DIR__ . "/files/ExaVault Quick Start.pdf";
    $target_filename = 'Quick Start' .  (new \DateTime())->format("U") . ".pdf";
    $target_size = filesize($filename);

    // The uploadFile method of the ResourcesApi class will let us upload a file to our account
    // See https://www.exavault.com/developer/api-docs/#operation/uploadFile for the details of this method
    //
    $result = $resourcesApi->uploadFile($API_KEY, $ACCESS_TOKEN, $target_filename, $target_size, $filename);

    // The uploadFile method of the ResourcesApi returns a \Swagger\Client\Model\ResourceResponse object
    // See https://www.exavault.com/developer/api-docs/#operation/uploadFile for the details of the response object

    // Verify that the uploaded file's reported size matches what we expected.
    // The getAttributes method of the ResourceResponse object will let us get the details of the file
    $size_uploaded = $result->getData()->getAttributes()->getSize();

    if ($size_uploaded != $target_size) {
        echo "Uploaded file does not match expected size. Should be {$target_filename} but is {$size_uploaded}" . PHP_EOL;
        exit (3);
    }

    // Success! 
    echo "Uploaded " . $result->getData()->getAttributes()->getPath() . PHP_EOL;

} catch (Exception $e) {

    // If there was a problem, such as our credentials not being correct or not having upload permissions,
    // there will be an exception thrown. 
    echo 'Exception when calling ResourcesApi->uploadFile: ', $e->getMessage(), PHP_EOL;
    exit(1);
}


