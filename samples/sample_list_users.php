<?php
require_once(__DIR__ . '/../vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

/**
 * sample_list_users.php - Use the UsersApi to create a report of account users
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

// We are demonstrating the use of the UsersApi, which can be used to retrieve user settings and create a report
// We have to override the default configuration of the UserApi object with an updated host URL so that our code
//  will reach the correct URL for the api.
$apiInstance = new Swagger\Client\Api\UsersApi(
    new GuzzleHttp\Client(),
    (new Swagger\Client\Configuration())->setHost($ACCOUNT_URL)
);

// Array to store our results in
$list_of_users = [];

try {
    // The listUsers method of the UsersApi class will give us access the users defined in our account
    // See https://www.exavault.com/developer/api-docs/#operation/listUsers for the details of this method

    // We must pass in our API Key and Access Token with every call, which we retrieved from the .env file above
    // This method also supports filtering parameters to limit the results returned. Check the link to 
    // our API documentation for a list of those parameters.
    $listResult = $apiInstance->listUsers($API_KEY, $ACCESS_TOKEN);

} catch (Exception $e) {

    // If there was a problem, such as our credentials not being correct, or the URL not working, 
    // there will be an exception thrown. 
    echo 'Exception when calling UserApi->listUsers: ', $e->getMessage(), PHP_EOL;
    exit(1);
}

// If we got this far without the program ending, our call to listUsers succeeded and returned something
// The call returns a \Swagger\Client\Model\UserCollectionResponse object
// See https://www.exavault.com/developer/api-docs/#operation/listUsers for the details of the response object

$total_users_for_account = $listResult->getTotalResults();
$total_users_retrieved = $listResult->getReturnedResults();

// The returned users will be an array of \Swagger\Client\Model\User objects which we can access from the 
//   UserCollectionResponse::getData method
$users_retrieved = $listResult->getData();

// We are creating a CSV file in the same directory as this script. 
// 
// This opens the file for writing (which removes existing data) and gives us a file handle that we 
// can use to write the CSV data with
$output_filename = __DIR__ . "/files/users_listing.csv";
$output = fopen($output_filename, 'w');


// Writing the column titles to our CSV file
$csv_column_headers = ['Id','Username','Nickname','Email Address','Home Folder','Role','Time Zone',
'Download','Upload','Modify','Delete','List','Change Password','Share','Notification',
'View Form Data','Delete Form Data','Expiration','Last Logged In','locked','Created','Modified'];
fputcsv($output, $csv_column_headers);

// Looping over the users array that we got back from our listUsers call.
foreach ($users_retrieved as $user) {

    // The internal ID of a user isn't visible in the web file manager. It is used by the API to 
    //   access the user. 
    $id = $user->getId();
    
    // The detailed data about the individual user is accessed through the User::getAttributes method
    // which returns a \Swagger\Client\Model\UserAttributes object
    $username           = $user->getAttributes()->getUsername();
    $nickname           = $user->getAttributes()->getNickname();
    $email              = $user->getAttributes()->getEmail();
    $home_dir           = $user->getAttributes()->getHomeDir();
    $role               = $user->getAttributes()->getRole();
    $time_zone          = $user->getAttributes()->getTimeZone();
    $created            = $user->getAttributes()->getCreated()->format('M d, Y H:i:sa');
    $modified           = $user->getAttributes()->getModified()->format('M d, Y H:i:sa');
    $access_timestamp   = $user->getAttributes()->getAccessTimestamp();
    $expiration         = $user->getAttributes()->getExpiration();
    $locked             = ($user->getAttributes()->getStatus() ? '' : 'locked');

    // The access timestamp returns a non-standard value representing 'never'
    $last_logged_in = (substr($access_timestamp,0,4) === "0000" ? 'never' : $access_timestamp);

    // The UserAttributes::getPermissions method returns a \Swagger\Client\Model\UserPermissions object,
    //   which contains the true/false flags for each of the permissions available to a user
    //   See https://www.exavault.com/docs/account/04-users/00-introduction#managing-user-roles-and-permissions
    //
    $download = ($user->getAttributes()->getPermissions()->getDownload() ? 'download' : '' );
    $upload = ($user->getAttributes()->getPermissions()->getUpload() ? 'upload' : '' );
    $modify = ($user->getAttributes()->getPermissions()->getModify() ? 'moodify' : '' );
    $delete = ($user->getAttributes()->getPermissions()->getDelete() ? 'delete' : '' );
    $list = ($user->getAttributes()->getPermissions()->getList() ? 'list' : '' );
    $change_password = ($user->getAttributes()->getPermissions()->getChangePassword() ? 'change password' : '' );
    $share = ($user->getAttributes()->getPermissions()->getShare() ? 'share' : '' );
    $notification = ($user->getAttributes()->getPermissions()->getNotification() ? 'notification' : '' );
    $view_form_data = ($user->getAttributes()->getPermissions()->getViewFormData() ? 'view form data' : '' );
    $delete_form_data = ($user->getAttributes()->getPermissions()->getDeleteFormData() ? 'delete_form_data' : '' );

    // Make an array of the current user's data and append it to the list we will use to create our report
    $data = compact('id','username','nickname','email','home_dir','role','time_zone',
    'download','upload','modify','delete','list','change_password','share','notification',
    'view_form_data','delete_form_data','expiration','last_logged_in','locked','created','modified');
    fputcsv($output,  $data);
}
// Close our file handle 
fclose($output);

echo "Listed: " . $total_users_retrieved . " users to " . $output_filename . PHP_EOL;

