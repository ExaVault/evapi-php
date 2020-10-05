<?php
require_once(__DIR__ . '/../vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

/**
 * sample_get_failed_logins.php - Use the ActivityApi to retrieve the list of users who had failed logins 
 * in the last 24 hours.
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

// We are demonstrating the use of the ActivityApi, which can be used to retrieve session and webhook logs
// We have to override the default configuration of the ActivityApi object with an updated host URL so that our code
//  will reach the correct URL for the api.
$apiInstance = new Swagger\Client\Api\ActivityApi(
    new GuzzleHttp\Client(),
    (new Swagger\Client\Configuration())->setHost($ACCOUNT_URL)
);


try {
    // The getSessionLogs method of the ActivityApi class will give us access activity logs for our account
    // See https://www.exavault.com/developer/api-docs/#operation/getSessionLogs for the details of this method

    // We must pass in our API Key and Access Token with every call, which we retrieved from the .env file above
    // This method also supports filtering parameters to limit the results returned. Check the link to 
    // our API documentation for a list of those parameters.

    $start_date = new \DateTime('yesterday');
    $end_date = new \DateTime();
    $ip_address = null;
    $user_name = null;
    $path = null;
    $type = 'PASS';
    $offset = 0;
    $limit = 200;
    $sort = "-date";
   
    $listResult = $apiInstance->getSessionLogs($API_KEY, $ACCESS_TOKEN, $start_date, $end_date, $ip_address, $user_name, $path, $type, $offset, $limit, $sort);

} catch (Exception $e) {

    // If there was a problem, such as our credentials not being correct, or the URL not working, 
    // there will be an exception thrown. 
    echo 'Exception when calling ActivityApi->getSessionLogs: ', $e->getMessage(), PHP_EOL;
    exit(1);
}

// If we got this far without the program ending, our call to getSessionLogs succeeded and returned something
// The call returns a \Swagger\Client\Model\SessionActivityResponse object
// See https://www.exavault.com/developer/api-docs/#operation/getSessionLogs for the details of the response object

$failed_logins = []; // Container to hold our info

// The returned activity will be an array of \Swagger\Client\Model\SessionActivityEntry objects, which we can access
//   from the SessionActivityResponse::getData method
$activity_logs = $listResult->getData();

// Loop over the returned items, which should include only "Connect" operations, per our filters to the getSessionLogs call
foreach ($activity_logs as $activity) {
    // Each SessionActivityEntry object has a getAttributes method that allows us to access the details for the 
    //   logged activity, which will be a \Swagger\Client\Model\SessionActivityEntryAttributes object

    // The SessionActivityEntryAttributes object has accessors for username, client IP address, status, operation, etc
    if ($activity->getAttributes()->getStatus() == "failed") {
        if (!array_key_exists($activity->getAttributes()->getUsername(), $failed_logins)) {
            $failed_logins[$activity->getAttributes()->getUsername()] = 1;
        } else {
            $failed_logins[$activity->getAttributes()->getUsername()] += 1;
        }
    }
}

echo count($failed_logins) . " Users with failed logins: " . PHP_EOL;
echo sprintf("  %-35s %s", "Username", "Count") . PHP_EOL;
echo sprintf("%'=46s", "=") . PHP_EOL;

foreach ($failed_logins as $user => $failed) {
    echo sprintf("  %-35s %d", $user, $failed) . PHP_EOL;
}

