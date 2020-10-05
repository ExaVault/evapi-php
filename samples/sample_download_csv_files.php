<?php
require_once(__DIR__ . '/../vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

/**
 * sample_download_csv_files.php - Use the ResourcesApi to download all of the CSV files found within a folder tree
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

// We have to override the default configuration of the API object with an updated host URL so that our code
//  will reach the correct URL for the api. We have to override this setting for each of the API classes we use
$resourcesApi = new Swagger\Client\Api\ResourcesApi(
    new GuzzleHttp\Client(),
    (new Swagger\Client\Configuration())->setHost($ACCOUNT_URL)
);

$downloadApi = new Swagger\Client\Api\DownloadApi(
    new GuzzleHttp\Client(),
    (new Swagger\Client\Configuration())->setHost($ACCOUNT_URL)
);

try {
    // For this demo, we want to download all of the CSV files located within a certain folder.
    // - Your account comes pre-loaded with a folder tree named "Sample Files and Folders" which contains 
    // a folder tree containing many samples. If you have renamed, deleted or moved this folder,
    // this demo script will not work.

    // First, we'll get a list of all the CSV files within the desired folder

    $listResult = $resourcesApi->listResources($API_KEY, $ACCESS_TOKEN, "/Sample Files and Folders", null, 0, null, 'file', '*.csv');

    // The ResourcesApi::listResources method returns a \Swagger\Client\Model\ResourceCollectionResponse object
    // See https://www.exavault.com/developer/api-docs/#operation/listResources for the response schema

    // The ResourceCollectionResponse::getReturnedResults method will indicate how many matching files are included
    // in this response. If we didn't find any matches, there's nothing else to do
    if ($listResult->getReturnedResults() == 0 ) {
        echo "Found no files to download" . PHP_EOL;
        exit(0);
    } else {  
        echo "Found " . $listResult->getReturnedResults() . " CSV files to download" . PHP_EOL;
    }
        
} catch (Exception $e) {
    echo 'Exception when calling Api: ', $e->getMessage(), PHP_EOL;
    exit(1);
}

// If we got this far, there are files for us to download
// We are going to save the IDs of all the files we want to download into an array
$downloads = [];
$listed_files = $listResult->getData();
foreach ($listed_files as $listed_file) {
    $downloads[] = "id:" . $listed_file->getId();
    echo ($listed_file->getAttributes()->getPath()) . PHP_EOL;
} 

try {
    
    // Now that we used the ResourcesApi to gather all of the IDs of the resources that 
    // matched our search, we will use the DownloadApi to download multiple files
    /****************************************************************************************/
    /** NOTE - THIS IS AN UNUSUAL WORKAROUND REQUIRED BY THE AUTO-GENERATED PHP ClIENT SDK **/
    /****************************************************************************************/
    /** Ideally, we would use the ResourcesApi for all resources calls, but due to a bug in
     * the library that creates the ResourcesApi, you cannot download multiple files at once
     * using that API. Instead, use the DownloadApi download methods which has the same parameters and
     * output as the ResourcesApi See https://www.exavault.com/developer/api-docs/#operation/download
     */
    /************************************************************************************/
    $result = $downloadApi->download($API_KEY, $ACCESS_TOKEN, $downloads);

    // The body of the result is the binary content of our file(s), 
    // We write that content into a single file, named with .zip if there were multiple files 
    // downloaded or just named .csv if not (since we were storing csvs)
    if (count($downloads) > 1) {
        $download_file = __DIR__ . "/files/download.zip";
    } else {
        $download_file = __DIR__ . "/files/download-" . (new \DateTime())->format("U") . ".csv";
    }
    file_put_contents($download_file, $result);

    echo "File(s) downloaded to " . $download_file;

} catch (Exception $e) {
    echo 'Exception when calling Api: ', $e->getMessage(), PHP_EOL;
    exit(1);
}

