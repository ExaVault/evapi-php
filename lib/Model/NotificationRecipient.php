<?php
/**
 * NotificationRecipient
 *
 * PHP version 5
 *
 * @category Class
 * @package  Swagger\Client
 * @author   Swaagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * ExaVault API
 *
 * # Introduction  Welcome to the ExaVault API documentation. Our API lets you control nearly all aspects of your ExaVault account programatically, from uploading and downloading files to creating and managing shares and notifications. Our API supports both GET and POST operations.  Capabilities of the API include:  - Uploading and downloading files. - Managing files and folders; including standard operations like move, copy and delete. - Getting information about activity occuring in your account. - Creating, updating and deleting users. - Creating and managing shares, including download-only shares and recieve folders.  - Setting up and managing notifications.  ## The API Endpoint  The ExaVault API is located at: https://api.exavault.com/v1/  # Testing w/ Postman  We've made it easy for you to test our API before you start full-scale development. Download [Postman](https://www.getpostman.com/) or the [Postman Chrome Extension](https://chrome.google.com/webstore/detail/postman/fhbjgbiflinjbdggehcddcbncdddomop?hl=en), and then download our Postman collection, below. [Obtain your API key](#section/Code-Libraries-and-Sample-PHP-Code/Obtain-your-API-key) and you'll be able to interact with your ExaVault account immediately, so you can better understand what the capabilities of the API are.  <div class=\"postman-run-button\" data-postman-action=\"collection/import\" data-postman-var-1=\"e13395afc6278ce1555f\"></div>  ![ExaVault API Postman Colletion Usage](/images/postman.png)  If you'd prefer to skip Postman and start working with code directly, take a look at the sample code below.    # Code Libraries & Sample PHP Code  Once you're ready for full-scale development, we recommend looking at our code libraries available on [GitHub](https://github.com/ExaVault). We offer code libraries for [Python](https://github.com/ExaVault/evapi-python), [PHP](https://github.com/ExaVault/evapi-php), [C#](https://github.com/ExaVault/evapi-csharp), and [Java](https://github.com/ExaVault/evapi-java).  While we recommend using our libraries, you're welcome to interact directly with our API via HTTP GET and POST requests -- a great option particularly if you're developing in a language for which we don't yet have sample code.     - [Download Python Libraries &raquo;](https://github.com/ExaVault/evapi-python) - [Download PHP Libraries &raquo;](https://github.com/ExaVault/evapi-php) - [Download C# Libraries &raquo;](https://github.com/ExaVault/evapi-csharp) - [Download Java Libraries &raquo;](https://github.com/ExaVault/evapi-java)  ## Obtain your API key  You will need to obtain an API key for your application from the [Client Area](https://clients.exavault.com/clientarea.php?action=products) of your account.  To obtain an API key, please follow the instructions below.   + Login to the [Accounts](https://clients.exavault.com/clientarea.php?action=products) section of the Client Area.  + Use the drop down next to your desired account, and select *Manage API Keys*.  + You will be brought to the API Key management screen. Fill out the form and save to generate a new key for your app.  *NOTE: As of Oct 2017, we are in the progress of migrating customers to our next generation platform. If your account is already on our new platform, you should log into your File Manager and create your API key under Account->Developer->Manage API Keys*.  ## Example: Setting the API key  To get started, you will want to add your custom API key to your application config. Here is an example using PHP, which makes use of our sample PHP library:  ```php    require_once('V1Api.php');   require_once('APIClient.php');   $apiKey = 'myaccountname-XXXXXXXXXXXXXXXX';   $apiUrl = 'https://api.exavault.com'   ``` ## Example: Authenticating  Once your API key is in place, you will likely want to authenticate so that you can begin uploading and downloading files, creating users, and all that other fun stuff.  ```php    // create a new instance of the ExaVault API library class   $api = new V1Api( new APIClient($apiKey, $apiUrl) );     $accessToken = null;    // call the authenticateUser method, passing your username and password   $response = $api->authenticateUser('yourusername', 'yourpassword');    // save this result for later, we will need it to logout   $loginSuccess = $response->success;    // if authentication was successful, store the access token   // obtained via the response body in the API instance.    if ($loginSuccess) {       $accessToken = $response->results->accessToken;    } else {       // Handle the error...   }  ```  ## Example: Uploading a file   ```php    // set the local and remote paths   $localPath = '/path/of/your/local/file';   $remotePath = '/path/on/remote/host';    // get the file size located at the local path   $filesize = filesize($localPath);    // get the upload URL from the Evapi object   $uploadResults = $api->getUploadFileUrl($accessToken, $filesize, $remotePath, true);    // if we were able to successfully get the upload URL, start   // uploading. Otherwise, print an error message.    if($uploadResults->success) {     // initialize a new curl session by passing the uploadFileUrl     $uploadUrl = $uploadResults->results->url;     $ch = curl_init($uploadUrl);      // create the open file handle     $handle = fopen($localPath, 'r');      // set the HTTP POST header, indicating the size of file to be uploaded     $header = array('X_File_Size: ' . $filesize,                     'Content-Type: multipart/form-data',                     'Content-Length: '' . $filesize,     );      // PHP uses curl for sending HTTP requests. If using a different language     // you will likely do this differently      curl_setopt($ch, CURLOPT_POST, true);  // perform upload via http post     curl_setopt($ch, CURLOPT_HTTPHEADER, $header);  // specify the header     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  // return string of result     curl_setopt($ch, CURLOPT_INFILE, $handle);  // specify size of file to upload     curl_setopt($ch, CURLOPT_SSLVERSION, 1);  // specify TLS 1.0     curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);  // verify common name with specified hostname     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true); // verify certificate of remote peer      $result = curl_exec($ch);   // upload the file, get back result     $result = json_decode($result, true); // convert result to an array     curl_close($ch);  // close the curl session     fclose($handle);   // close the open file handle      if ($result['success']) {       // Your upload was successful!     } else {       // Wah-wah. Your upload failed for some reason.     }    } else {     // Wah-wah. Your upload failed for some reason.   }  ```  ## Example: Downloading a file  Downloading, like the upload process, first requires obtaining an appropriate download URL and then making a separate HTTP request to the API.   ```php    // set the filename   $filename = \"file.txt\";    // set the local path of the file to download to   $localPath = \"/path/to/local/\" . $filename;    // set the remote path where the file is located   $remotePath = \"/path/to/remote/\" . $filename;    // call the getDownloadFileUrl method on the API object instance   $downloadResults = $api->getDownloadFileUrl($accessToken, $remotePath);        if($downloadResults->success) {        // get the download URL and initialize a new curl session       $downloadUrl = $downloadResults->results->url;       $ch = curl_init($downloadUrl);        // set the file handle to the appropriate path       $handle = fopen($localPath, 'w');        // set the cURL options       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);       curl_setopt($ch, CURLOPT_FILE, $handle);       curl_setopt($ch, CURLOPT_SSLVERSION, 1);       curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);               $result = curl_exec($ch);       $result = json_decode($result, true);       curl_close($ch);       fclose($handle);        if ($result) {           // Download successful!       } else {           // Oops, there was an error.       }   } else {       // Oops, there was an error.   }  ```  ## Example: Logging Out  Logging out of the API is very simple. The only thing that is required is to check to see if we were logged in in the first place; if yes then log out.  ```php    // logout only if login was successful   if ($loginResult) {       $api->logoutUser($accessToken);   }  ```  # Status Codes  The ExaVault API returns only two HTTP status codes for its responses: 200 and 500.  When the request could be successfully processed by the endpoint, the response status code will be 200, regardless of whether the requested action could be taken.  For example, the response to a getUser request for a username that does not exist in your account would have the status of 200,  indicating that the response was received and processed, but the error member of the returned response object would contain object with `message` and `code` properties.  **Result Format:**  |Success   | Error     | Results   | | ---      | :---:       |  :---:      | | 0        |  `Object` |   Empty   | | 1        |   Empty       |    `Object` or `Array`        |     When a malformed request is received, a 500 HTTP status code will be returned, indicating that the request could not be processed.  ExaVault's API does not currently support traditional REST response codes such as '201 Created' or '405 Method Not Allowed', although we intend to support such codes a future version of the API.   # File Paths  Many API calls require you to provide one or more file paths. For example, the <a href=\"#operation/moveResources\">moveResources</a> call requires both an array of source paths, **filePaths**, and a destination path, **destinationPath**. Here's a few tips for working with paths:   - File paths should always be specified as a string, using the standard Unix format: e.g. `/path/to/a/file.txt`  - File paths are always absolute _from the home directory of the logged in user_. For example, if the user **bob** had a home directory restriction of `/bob_home`, then an API call made using his login would specify a file as `/myfile.txt`, whereas an API call made using the master user ( no home directory restriction ) would specify the same file as `/bob_home/myfile.txt`.  # API Rate Limits  We rate limit the number of API calls you can make to help prevent abuse and protect system stablity. Each API key will support 500 requests per rolling five minutes. If you make more than 500 requests in a five minute period, you will receive a response with an error object for fifteen minutes.  # Webhooks  A webhook is an HTTP callback: a simple event-notification via HTTP POST. If you define webhooks for Exavault, ExaVault will POST a  message to a URL when certain things happen.     Webhooks can be used to receive a JSON object to your endpoint URL. You choose what events will trigger webhook messages to your endpoint URL.     Webhooks will attempt to send a message up to 8 times with increasing timeouts between each attempt. All webhook requests are tracked in the webhooks log.  ## Getting started  1. Go to the Account tab inside SWFT.  2. Choose the Developer tab.  3. Configure your endpoint URL and select the events you want to trigger webhook messages.  4. Save settings.    You are all set to receive webhook callbacks on the events you selected.  ## Verification Signature  ExaVault includes a custom HTTP header, X-Exavault-Signature, with webhooks POST requests which will contain the signature for the request.  You can use the signature to verify the request for an additional level of security.  ## Generating the Signature  1. Go to Account tab inside SWFT.  2. Choose the Developer tab.  3. Obtain the verification token. This field will only be shown if you've configured your endpoint URL.  4. In your code that receives or processes the webhooks, you should concatenate the verification token with the JSON object that we sent in our      POST request and hash it with md5.     ```     md5($verificationToken.$webhooksObject);     ```  5. Compare signature that you generated to the signature provided in the X-Exavault-Signature HTTP header  ## Example JSON Response Object  ```json   {     \"accountname\": \"mycompanyname\",     \"username\": \"john\"     \"operation\": \"Upload\",     \"protocol\": \"https\",     \"path\": \"/testfolder/filename.jpg\"     \"attempt\": 1   } ```  ## Webhooks Logs  Keep track of all your webhooks requests in the Activity section of your account. You can find the following info for each request:    1. date and time - timestamp of the request.    2. endpoint url - where the webhook was sent.    3. event - what triggered the webhook.    4. status - HTTP status or curl error code.    5. attempt - how many times we tried to send this request.    6. response size - size of the response from your server.    7. details - you can check the response body if it was sent.
 *
 * OpenAPI spec version: 1.0.1
 * 
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 *
 */

/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace Swagger\Client\Model;

use \ArrayAccess;

/**
 * NotificationRecipient Class Doc Comment
 *
 * @category    Class
 * @package     Swagger\Client
 * @author      Swagger Codegen team
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class NotificationRecipient implements ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      * @var string
      */
    protected static $swaggerModelName = 'NotificationRecipient';

    /**
      * Array of property to type mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerTypes = [
        'id' => 'int',
        'notification_id' => 'string',
        'email' => 'string',
        'created' => 'string',
        'modified' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerFormats = [
        'id' => 'int32',
        'notification_id' => null,
        'email' => null,
        'created' => 'YYYY-mm-dd hh:mm:ss',
        'modified' => 'YYYY-mm-dd hh:mm:ss'
    ];

    public static function swaggerTypes()
    {
        return self::$swaggerTypes;
    }

    public static function swaggerFormats()
    {
        return self::$swaggerFormats;
    }

    /**
     * Array of attributes where the key is the local name, and the value is the original name
     * @var string[]
     */
    protected static $attributeMap = [
        'id' => 'id',
        'notification_id' => 'notificationId',
        'email' => 'email',
        'created' => 'created',
        'modified' => 'modified'
    ];


    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'notification_id' => 'setNotificationId',
        'email' => 'setEmail',
        'created' => 'setCreated',
        'modified' => 'setModified'
    ];


    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'notification_id' => 'getNotificationId',
        'email' => 'getEmail',
        'created' => 'getCreated',
        'modified' => 'getModified'
    ];

    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    public static function setters()
    {
        return self::$setters;
    }

    public static function getters()
    {
        return self::$getters;
    }

    

    

    /**
     * Associative array for storing property values
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     * @param mixed[] $data Associated array of property values initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['id'] = isset($data['id']) ? $data['id'] : null;
        $this->container['notification_id'] = isset($data['notification_id']) ? $data['notification_id'] : null;
        $this->container['email'] = isset($data['email']) ? $data['email'] : null;
        $this->container['created'] = isset($data['created']) ? $data['created'] : null;
        $this->container['modified'] = isset($data['modified']) ? $data['modified'] : null;
    }

    /**
     * show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalid_properties = [];

        return $invalid_properties;
    }

    /**
     * validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {

        return true;
    }


    /**
     * Gets id
     * @return int
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     * @param int $id ID of the recipient.
     * @return $this
     */
    public function setId($id)
    {
        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets notification_id
     * @return string
     */
    public function getNotificationId()
    {
        return $this->container['notification_id'];
    }

    /**
     * Sets notification_id
     * @param string $notification_id ID of the notification that the recipient belongs to.
     * @return $this
     */
    public function setNotificationId($notification_id)
    {
        $this->container['notification_id'] = $notification_id;

        return $this;
    }

    /**
     * Gets email
     * @return string
     */
    public function getEmail()
    {
        return $this->container['email'];
    }

    /**
     * Sets email
     * @param string $email Recipient email.
     * @return $this
     */
    public function setEmail($email)
    {
        $this->container['email'] = $email;

        return $this;
    }

    /**
     * Gets created
     * @return string
     */
    public function getCreated()
    {
        return $this->container['created'];
    }

    /**
     * Sets created
     * @param string $created Timestamp of adding notification recipient.
     * @return $this
     */
    public function setCreated($created)
    {
        $this->container['created'] = $created;

        return $this;
    }

    /**
     * Gets modified
     * @return string
     */
    public function getModified()
    {
        return $this->container['modified'];
    }

    /**
     * Sets modified
     * @param string $modified Timestamp of notification recipient modification.
     * @return $this
     */
    public function setModified($modified)
    {
        $this->container['modified'] = $modified;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     * @param  integer $offset Offset
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     * @param  integer $offset Offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     * @param  integer $offset Offset
     * @param  mixed   $value  Value to be set
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     * @param  integer $offset Offset
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) { // use JSON pretty print
            return json_encode(\Swagger\Client\ObjectSerializer::sanitizeForSerialization($this), JSON_PRETTY_PRINT);
        }

        return json_encode(\Swagger\Client\ObjectSerializer::sanitizeForSerialization($this));
    }
}


