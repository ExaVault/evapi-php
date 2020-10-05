<?php
require_once(__DIR__ . '/../vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

/**
 * sample_add_user.php - Use the UsersApi to create a new user with a home directory
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

// We are demonstrating the use of the UsersApi, which is used to create, update and remove users in your account.
//
// We have to override the default configuration of the API object with an updated host URL so that our code
//  will reach the correct URL for the api.
$usersApi = new Swagger\Client\Api\UsersApi(
    new GuzzleHttp\Client(),
    (new Swagger\Client\Configuration())->setHost($ACCOUNT_URL)
);

try {

    // API methods that take a JSON body, such as the addUser method, require us to submit an object with the 
    // parameters we want to send to the API. 
    // See https://www.exavault.com/developer/api-docs/#operation/addUser for the request body schema
    //
    // We're going to use our API Key as the username because usernames must be unique
    // You can change values below to make new users if you have run the script to create your sample user
    $requestBody = (object) [ 
        "username" => $API_KEY,
        "homeResource" => "/Home directory for API Users",
        "email" => "test@example.com",
        "password" => "99drowssaP",
        "role" => "user",
        "permissions" => "download,upload,modify,list,changePassword,share,notification,delete",
        "timeZone" => "UTC",
        "nickname" => "Created via the API",
        "welcomeEmail" => true,
    ];   

    // We have to pass the $API_KEY and $ACCESS_TOKEN with every API call. 
    $result = $usersApi->addUser($API_KEY, $ACCESS_TOKEN, $requestBody);

    // The UsersApi::addUser method returns a \Swagger\Client\Model\UserResponse object
    // See https://www.exavault.com/developer/api-docs/#operation/addUser for the response body schema
    echo "Created new user {$API_KEY}" . PHP_EOL;

} catch (Exception $e) {
    echo 'Exception when calling UsersApi->addUser: ', $e->getMessage(), PHP_EOL;
    exit(1);
}
