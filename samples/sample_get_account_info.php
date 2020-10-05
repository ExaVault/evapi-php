<?php
require_once(__DIR__ . '/../vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

/**
 * sample_get_account.php - Use the AccountApi to return your account info and check disk usage
 */

/**
 * To use this script, add your credentials to a file named .env which is located in the same directory as the script
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

// We are demonstrating the use of the AccountAPI, which can be used to manage the account settings 
// We have to override the default configuration of the AccountApi with an updated host URL so that our code
//  will reach the correct URL for the api.
$apiInstance = new Swagger\Client\Api\AccountApi(
    new GuzzleHttp\Client(),
    (new Swagger\Client\Configuration())->setHost($ACCOUNT_URL)
);

try {
    // The getAccount method of the AccountApi class will give us access to the current status of our account
    // See https://www.exavault.com/developer/api-docs/#operation/getAccount for the details of this method

    // We must pass in our API Key and Access Token with every call, which we retrieved from the .env file above
    $result = $apiInstance->getAccount($API_KEY, $ACCESS_TOKEN);

} catch (Exception $e) {

    // If there was a problem, such as our credentials not being correct, or the URL not working, 
    // there will be an exception thrown 
    echo 'Exception when calling AccountApi->getAccount: ', $e->getMessage(), PHP_EOL;
    exit(1);
}

// If we got this far without the program ending, our call to getAccount succeeded and returned something
// The call returns a Swagger\Client\Model\AccountResponse object
// See https://www.exavault.com/developer/api-docs/#operation/getAccount for the details of the response object

// The AccountResponse object that we got back ($result) is composed of additional, nested objects
// The Quota object will tell us how much space we've used
$quota = $result->getData()->getAttributes()->getQuota();

// The values returned in the Quota object are given in bytes, so we convert that to GB
$account_max_size = $quota->getDiskLimit() / (1024 * 1024 * 1024);
$account_current_size = $quota->getDiskUsed() / (1024 * 1024 * 1024);


echo "Account used: " . round($account_current_size, 1) . "GB (" . round(((float)$account_current_size / $account_max_size) * 100, 1) . "%)" . PHP_EOL;
echo "Total size: " . round($account_max_size, 1) . "GB" . PHP_EOL;
