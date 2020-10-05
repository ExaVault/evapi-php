<?php
require_once(__DIR__ . '/../vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

/**
 * sample_add_notification.php - Use the NotificationsApi to create a Notification on a folder
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

// We are demonstrating the use of the NotificationsApi, which can be used to manage notification settings 
//  for files and folders

// For this demo, we'll create a new folder tree and add notifications to those new folders. If you have 
// an existing file or folder that you want to create a notification for, you won't need the step where
// we use the ResourcesApi to create the folders first.
//
// We have to override the default configuration of the API object with an updated host URL so that our code
//  will reach the correct URL for the api. We have to override this setting for each of the API classes we use
$resourcesApi = new Swagger\Client\Api\ResourcesApi(
    new GuzzleHttp\Client(),
    (new Swagger\Client\Configuration())->setHost($ACCOUNT_URL)
);

try {
    // We will create a new folder tree for the demo. The top-level folder will have a different name each time you run this script
    $parentFolder = "sample_notifications_" . (new \DateTime())->format("U");
    
    // We can actually be sneaky and add missing parent folders by passing a multi-level path
    $upload_folder = "/" . $parentFolder . "/uploads";
    $download_folder = "/" . $parentFolder . "/downloads";

    // API methods that take a JSON body, such as the addFolder method, require us to submit an object with the 
    // parameters we want to send to the API. This call requires a single parameter path
    $requestBody = (object) [ 'path' => $upload_folder];   

    // We have to pass the $API_KEY and $ACCESS_TOKEN with every API call. 
    $result = $resourcesApi->addFolder($API_KEY, $ACCESS_TOKEN, $requestBody);

    // The addFolder method of the ResourcesApi returns a \Swagger\Client\Model\ResourceResponse object
    // See https://www.exavault.com/developer/api-docs/#operation/addFolder for the details of the response object
    echo "Created new folder {$result->getData()->getAttributes()->getPath()}" . PHP_EOL;
    
    // Now we can add the second folder
    $requestBody = (object) [ 'path' => $download_folder];   
    $result = $resourcesApi->addFolder($API_KEY, $ACCESS_TOKEN, $requestBody);
    
    // The addFolder method of the ResourcesApi returns a \Swagger\Client\Model\ResourceResponse object
    // See https://www.exavault.com/developer/api-docs/#operation/addFolder for the details of the response object
    echo "Created new folder {$result->getData()->getAttributes()->getPath()}" . PHP_EOL;

} catch (Exception $e) {
    echo 'Exception when calling ResourcesApi->addFolder: ', $e->getMessage(), PHP_EOL;
    exit(1);
}


// If we got this far without the program ending, we were able to set up our folders to create notifications,
//   and now we can use the NotificationsApi to create those
// We have to override the default configuration of the API object with an updated host URL so that our code
//  will reach the correct URL for the api.
$notificationsApi = new Swagger\Client\Api\NotificationsApi(
    new GuzzleHttp\Client(),
    (new Swagger\Client\Configuration())->setHost($ACCOUNT_URL)
);

try {

    // API methods that take a JSON body, such as the addFolder method, require us to submit an object with the 
    // parameters we want to send to the API. 
    // See https://www.exavault.com/developer/api-docs/#operation/addNotification for the request body schema

    // - We want to be notified by email whenever anyone downloads from our downloads folder, so we are using
    //   the constant "notice_user_all", which means anyone, including users and share recipients.
    //   See  https://www.exavault.com/developer/api-docs/#operation/addNotification  for a list of other 
    //   constants that can be used in the usernames array
    // - Note that the $download_folder variable contains the full path to the folder that was created earlier
    // - We could also have pulled the ID for the new folder out of the ResourceResponse object and used that 
    //   as a resource identifier here. For example, if the ID of the downloads folder is 23422, we could pass
    //   id:23422 in the resource parameter of this call.
    $requestBody = (object) [ 
        'type' => 'folder',
        'resource' => $download_folder,
        'action' => 'download',
        'usernames' => ['notice_user_all'],
        'sendEmail' => true
    ];   

    // We have to pass the $API_KEY and $ACCESS_TOKEN with every API call. 
    $result = $notificationsApi->addNotification($API_KEY, $ACCESS_TOKEN, $requestBody);

    echo "Created download notification for {$download_folder}" . PHP_EOL;

    // - Next we will add a notification that will send a message to several addresses when a user uploads
    //   into our uploads folder. 
    // - As with the other notification, we will pass in the full path to the folder in the resource parameter
    //
    // There are some things we're doing differently:
    //   - We're using a different constant for the usernames parameter "notice_users_all_users", which means
    //   only trigger notifications when an action is done by a user account (not share recipients) 
    //   See  https://www.exavault.com/developer/api-docs/#operation/addNotification for a list of other 
    //   constants that can be used in the usernames array
    //   - We are sending the notification to a bunch of email addresses, rather than just our own
    //   - We have added an optional custom message to be included in each notification email
    $requestBody = (object) [
        'type' => 'folder',
        'resource' => $upload_folder,
        'action' => 'upload',
        'usernames' => ['notice_user_all_users'],
        'sendEmail' => true,
        'recipients' => [
            'sally@example.com',
            'sidharth@example.com',
            'lgomez@example.com'
        ],
        'message' => 'Files have been uploaded into the main folder for you.'
    ];   

    // We have to pass the $API_KEY and $ACCESS_TOKEN with every API call. 
    $result = $notificationsApi->addNotification($API_KEY, $ACCESS_TOKEN, $requestBody);

    echo "Created upload notification for {$upload_folder}" . PHP_EOL;    


} catch (Exception $e) {

    echo 'Exception when calling NotificationsApi->addNotification: ', $e->getMessage(), PHP_EOL;
    exit(1);
}
