<?php
/**
 * CallbackSettings
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
 * # Introduction  Welcome to the ExaVault API documentation. Our API lets you control nearly all aspects of your ExaVault account programatically, from uploading and downloading files to creating and managing shares and notifications. Our API supports both GET and POST operations.  Capabilities of the API include:  - Uploading and downloading files. - Managing files and folders; including standard operations like move, copy and delete. - Getting information about activity occuring in your account. - Creating, updating and deleting users. - Creating and managing shares, including download-only shares and recieve folders.  - Setting up and managing notifications.  ## The API Endpoint  The ExaVault API is located at: https://api.exavault.com/v1/  # Testing w/ Postman  We've made it easy for you to test our API before you start full-scale development. Download [Postman](https://www.getpostman.com/) or the [Postman Chrome Extension](https://chrome.google.com/webstore/detail/postman/fhbjgbiflinjbdggehcddcbncdddomop?hl=en), and then download our Postman collection, below. [Obtain your API key](#section/Code-Libraries-and-Sample-PHP-Code/Obtain-your-API-key) and you'll be able to interact with your ExaVault account immediately, so you can better understand what the capabilities of the API are.  <div class=\"postman-run-button\" data-postman-action=\"collection/import\" data-postman-var-1=\"e13395afc6278ce1555f\"></div>  ![ExaVault API Postman Colletion Usage](/images/postman.png)  If you'd prefer to skip Postman and start working with code directly, take a look at the sample code below.    # Code Libraries & Sample PHP Code  Once you're ready for full-scale development, we recommend looking at our code libraries available on [GitHub](https://github.com/ExaVault). We offer code libraries for [Python](https://github.com/ExaVault/evapi-python), [PHP](https://github.com/ExaVault/evapi-php) and [JavaScript](https://github.com/ExaVault/evapi-javascript).  While we recommend using our libraries, you're welcome to interact directly with our API via HTTP GET and POST requests -- a great option particularly if you're developing in a language for which we don't yet have sample code.     - [Download Python Library &amp; Sample Code &raquo;](https://github.com/ExaVault/evapi-python) - [Download PHP Library &amp; Sample Code &raquo;](https://github.com/ExaVault/evapi-php) - [Download JavaScript Library &amp; Sample Code &raquo;](https://github.com/ExaVault/evapi-javascript)  *Note: You can generate client libraries for any language using [Swagger Editor](http://editor2.swagger.io/). Just download our documentation file, past it into editor and use 'Generate Client' dropdown.*  ## Obtain Your API Key  You will need to obtain an API key for your application from the [Client Area](https://clients.exavault.com/clientarea.php?action=products) of your account.  To obtain an API key, please follow the instructions below.   + Login to the [Accounts](https://clients.exavault.com/clientarea.php?action=products) section of the Client Area.  + Use the drop down next to your desired account, and select *Manage API Keys*.  + You will be brought to the API Key management screen. Fill out the form and save to generate a new key for your app.  *NOTE: As of Oct 2017, we are in the progress of migrating customers to our next generation platform. If your account is already on our new platform, you should log into your File Manager and create your API key under Account->Developer->Manage API Keys*.  # Status Codes  The ExaVault API returns only two HTTP status codes for its responses: 200 and 500.  When the request could be successfully processed by the endpoint, the response status code will be 200, regardless of whether the requested action could be taken.  For example, the response to a getUser request for a username that does not exist in your account would have the status of 200,  indicating that the response was received and processed, but the error member of the returned response object would contain object with `message` and `code` properties.  **Result Format:**  |Success   | Error     | Results   | | ---      | :---:       |  :---:      | | 0        |  `Object` |   Empty   | | 1        |   Empty       |    `Object` or `Array`        |     When a malformed request is received, a 500 HTTP status code will be returned, indicating that the request could not be processed.  ExaVault's API does not currently support traditional REST response codes such as '201 Created' or '405 Method Not Allowed', although we intend to support such codes a future version of the API.   # File Paths  Many API calls require you to provide one or more file paths. For example, the <a href=\"#operation/moveResources\">moveResources</a> call requires both an array of source paths, **filePaths**, and a destination path, **destinationPath**. Here's a few tips for working with paths:   - File paths should always be specified as a string, using the standard Unix format: e.g. `/path/to/a/file.txt`  - File paths are always absolute _from the home directory of the logged in user_. For example, if the user **bob** had a home directory restriction of `/bob_home`, then an API call made using his login would specify a file as `/myfile.txt`, whereas an API call made using the master user ( no home directory restriction ) would specify the same file as `/bob_home/myfile.txt`.  # API Rate Limits  We rate limit the number of API calls you can make to help prevent abuse and protect system stablity. Each API key will support 500 requests per rolling five minutes. If you make more than 500 requests in a five minute period, you will receive a response with an error object for fifteen minutes.  # Webhooks  A webhook is an HTTP callback: a simple event-notification via HTTP POST. If you define webhooks for Exavault, ExaVault will POST a  message to a URL when certain things happen.     Webhooks can be used to receive a JSON object to your endpoint URL. You choose what events will trigger webhook messages to your endpoint URL.     Webhooks will attempt to send a message up to 8 times with increasing timeouts between each attempt. All webhook requests are tracked in the webhooks log.  ## Getting Started  1. Go to the Account tab inside SWFT.  2. Choose the Developer tab.  3. Configure your endpoint URL and select the events you want to trigger webhook messages.  4. Save settings.    You are all set to receive webhook callbacks on the events you selected.  ## Verification Signature  ExaVault includes a custom HTTP header, X-Exavault-Signature, with webhooks POST requests which will contain the signature for the request.  You can use the signature to verify the request for an additional level of security.  ## Generating the Signature  1. Go to Account tab inside SWFT.  2. Choose the Developer tab.  3. Obtain the verification token. This field will only be shown if you've configured your endpoint URL.  4. In your code that receives or processes the webhooks, you should concatenate the verification token with the JSON object that we sent in our      POST request and hash it with md5.     ```     md5($verificationToken.$webhooksObject);     ```  5. Compare signature that you generated to the signature provided in the X-Exavault-Signature HTTP header  ## Example JSON Response Object  ```json   {     \"accountname\": \"mycompanyname\",     \"username\": \"john\"     \"operation\": \"Upload\",     \"protocol\": \"https\",     \"path\": \"/testfolder/filename.jpg\"     \"attempt\": 1   } ```  ## Webhooks Logs  Keep track of all your webhooks requests in the Activity section of your account. You can find the following info for each request:    1. date and time - timestamp of the request.    2. endpoint url - where the webhook was sent.    3. event - what triggered the webhook.    4. status - HTTP status or curl error code.    5. attempt - how many times we tried to send this request.    6. response size - size of the response from your server.    7. details - you can check the response body if it was sent.
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
 * CallbackSettings Class Doc Comment
 *
 * @category    Class
 * @package     Swagger\Client
 * @author      Swagger Codegen team
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class CallbackSettings implements ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      * @var string
      */
    protected static $swaggerModelName = 'CallbackSettings';

    /**
      * Array of property to type mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerTypes = [
        'account_id' => 'string',
        'endpoint_url' => 'string',
        'token' => 'string',
        'upload' => 'string',
        'download' => 'string',
        'delete' => 'string',
        'create_folder' => 'string',
        'rename' => 'string',
        'move' => 'string',
        'copy' => 'string',
        'compress' => 'string',
        'extract' => 'string',
        'share_folder' => 'string',
        'send_files' => 'string',
        'receive_files' => 'string',
        'update_share' => 'string',
        'update_receive' => 'string',
        'delete_send' => 'string',
        'delete_receive' => 'string',
        'delete_share' => 'string',
        'create_notification' => 'string',
        'update_notification' => 'string',
        'delete_notification' => 'string',
        'create_user' => 'string',
        'update_user' => 'string',
        'delete_user' => 'string',
        'user_connect' => 'string',
        'user_disconnect' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerFormats = [
        'account_id' => null,
        'endpoint_url' => null,
        'token' => null,
        'upload' => null,
        'download' => null,
        'delete' => null,
        'create_folder' => null,
        'rename' => null,
        'move' => null,
        'copy' => null,
        'compress' => null,
        'extract' => null,
        'share_folder' => null,
        'send_files' => null,
        'receive_files' => null,
        'update_share' => null,
        'update_receive' => null,
        'delete_send' => null,
        'delete_receive' => null,
        'delete_share' => null,
        'create_notification' => null,
        'update_notification' => null,
        'delete_notification' => null,
        'create_user' => null,
        'update_user' => null,
        'delete_user' => null,
        'user_connect' => null,
        'user_disconnect' => null
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
        'account_id' => 'accountId',
        'endpoint_url' => 'endpointUrl',
        'token' => 'token',
        'upload' => 'upload',
        'download' => 'download',
        'delete' => 'delete',
        'create_folder' => 'createFolder',
        'rename' => 'rename',
        'move' => 'move',
        'copy' => 'copy',
        'compress' => 'compress',
        'extract' => 'extract',
        'share_folder' => 'shareFolder',
        'send_files' => 'sendFiles',
        'receive_files' => 'receiveFiles',
        'update_share' => 'updateShare',
        'update_receive' => 'updateReceive',
        'delete_send' => 'deleteSend',
        'delete_receive' => 'deleteReceive',
        'delete_share' => 'deleteShare',
        'create_notification' => 'createNotification',
        'update_notification' => 'updateNotification',
        'delete_notification' => 'deleteNotification',
        'create_user' => 'createUser',
        'update_user' => 'updateUser',
        'delete_user' => 'deleteUser',
        'user_connect' => 'userConnect',
        'user_disconnect' => 'userDisconnect'
    ];


    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = [
        'account_id' => 'setAccountId',
        'endpoint_url' => 'setEndpointUrl',
        'token' => 'setToken',
        'upload' => 'setUpload',
        'download' => 'setDownload',
        'delete' => 'setDelete',
        'create_folder' => 'setCreateFolder',
        'rename' => 'setRename',
        'move' => 'setMove',
        'copy' => 'setCopy',
        'compress' => 'setCompress',
        'extract' => 'setExtract',
        'share_folder' => 'setShareFolder',
        'send_files' => 'setSendFiles',
        'receive_files' => 'setReceiveFiles',
        'update_share' => 'setUpdateShare',
        'update_receive' => 'setUpdateReceive',
        'delete_send' => 'setDeleteSend',
        'delete_receive' => 'setDeleteReceive',
        'delete_share' => 'setDeleteShare',
        'create_notification' => 'setCreateNotification',
        'update_notification' => 'setUpdateNotification',
        'delete_notification' => 'setDeleteNotification',
        'create_user' => 'setCreateUser',
        'update_user' => 'setUpdateUser',
        'delete_user' => 'setDeleteUser',
        'user_connect' => 'setUserConnect',
        'user_disconnect' => 'setUserDisconnect'
    ];


    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = [
        'account_id' => 'getAccountId',
        'endpoint_url' => 'getEndpointUrl',
        'token' => 'getToken',
        'upload' => 'getUpload',
        'download' => 'getDownload',
        'delete' => 'getDelete',
        'create_folder' => 'getCreateFolder',
        'rename' => 'getRename',
        'move' => 'getMove',
        'copy' => 'getCopy',
        'compress' => 'getCompress',
        'extract' => 'getExtract',
        'share_folder' => 'getShareFolder',
        'send_files' => 'getSendFiles',
        'receive_files' => 'getReceiveFiles',
        'update_share' => 'getUpdateShare',
        'update_receive' => 'getUpdateReceive',
        'delete_send' => 'getDeleteSend',
        'delete_receive' => 'getDeleteReceive',
        'delete_share' => 'getDeleteShare',
        'create_notification' => 'getCreateNotification',
        'update_notification' => 'getUpdateNotification',
        'delete_notification' => 'getDeleteNotification',
        'create_user' => 'getCreateUser',
        'update_user' => 'getUpdateUser',
        'delete_user' => 'getDeleteUser',
        'user_connect' => 'getUserConnect',
        'user_disconnect' => 'getUserDisconnect'
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
        $this->container['account_id'] = isset($data['account_id']) ? $data['account_id'] : null;
        $this->container['endpoint_url'] = isset($data['endpoint_url']) ? $data['endpoint_url'] : null;
        $this->container['token'] = isset($data['token']) ? $data['token'] : null;
        $this->container['upload'] = isset($data['upload']) ? $data['upload'] : null;
        $this->container['download'] = isset($data['download']) ? $data['download'] : null;
        $this->container['delete'] = isset($data['delete']) ? $data['delete'] : null;
        $this->container['create_folder'] = isset($data['create_folder']) ? $data['create_folder'] : null;
        $this->container['rename'] = isset($data['rename']) ? $data['rename'] : null;
        $this->container['move'] = isset($data['move']) ? $data['move'] : null;
        $this->container['copy'] = isset($data['copy']) ? $data['copy'] : null;
        $this->container['compress'] = isset($data['compress']) ? $data['compress'] : null;
        $this->container['extract'] = isset($data['extract']) ? $data['extract'] : null;
        $this->container['share_folder'] = isset($data['share_folder']) ? $data['share_folder'] : null;
        $this->container['send_files'] = isset($data['send_files']) ? $data['send_files'] : null;
        $this->container['receive_files'] = isset($data['receive_files']) ? $data['receive_files'] : null;
        $this->container['update_share'] = isset($data['update_share']) ? $data['update_share'] : null;
        $this->container['update_receive'] = isset($data['update_receive']) ? $data['update_receive'] : null;
        $this->container['delete_send'] = isset($data['delete_send']) ? $data['delete_send'] : null;
        $this->container['delete_receive'] = isset($data['delete_receive']) ? $data['delete_receive'] : null;
        $this->container['delete_share'] = isset($data['delete_share']) ? $data['delete_share'] : null;
        $this->container['create_notification'] = isset($data['create_notification']) ? $data['create_notification'] : null;
        $this->container['update_notification'] = isset($data['update_notification']) ? $data['update_notification'] : null;
        $this->container['delete_notification'] = isset($data['delete_notification']) ? $data['delete_notification'] : null;
        $this->container['create_user'] = isset($data['create_user']) ? $data['create_user'] : null;
        $this->container['update_user'] = isset($data['update_user']) ? $data['update_user'] : null;
        $this->container['delete_user'] = isset($data['delete_user']) ? $data['delete_user'] : null;
        $this->container['user_connect'] = isset($data['user_connect']) ? $data['user_connect'] : null;
        $this->container['user_disconnect'] = isset($data['user_disconnect']) ? $data['user_disconnect'] : null;
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
     * Gets account_id
     * @return string
     */
    public function getAccountId()
    {
        return $this->container['account_id'];
    }

    /**
     * Sets account_id
     * @param string $account_id ID of the account these settings belongs to.
     * @return $this
     */
    public function setAccountId($account_id)
    {
        $this->container['account_id'] = $account_id;

        return $this;
    }

    /**
     * Gets endpoint_url
     * @return string
     */
    public function getEndpointUrl()
    {
        return $this->container['endpoint_url'];
    }

    /**
     * Sets endpoint_url
     * @param string $endpoint_url Where callback settings object sent to.
     * @return $this
     */
    public function setEndpointUrl($endpoint_url)
    {
        $this->container['endpoint_url'] = $endpoint_url;

        return $this;
    }

    /**
     * Gets token
     * @return string
     */
    public function getToken()
    {
        return $this->container['token'];
    }

    /**
     * Sets token
     * @param string $token Verification token for the request authentication.
     * @return $this
     */
    public function setToken($token)
    {
        $this->container['token'] = $token;

        return $this;
    }

    /**
     * Gets upload
     * @return string
     */
    public function getUpload()
    {
        return $this->container['upload'];
    }

    /**
     * Sets upload
     * @param string $upload Trigger callback on upload.
     * @return $this
     */
    public function setUpload($upload)
    {
        $this->container['upload'] = $upload;

        return $this;
    }

    /**
     * Gets download
     * @return string
     */
    public function getDownload()
    {
        return $this->container['download'];
    }

    /**
     * Sets download
     * @param string $download Trigger callback on download.
     * @return $this
     */
    public function setDownload($download)
    {
        $this->container['download'] = $download;

        return $this;
    }

    /**
     * Gets delete
     * @return string
     */
    public function getDelete()
    {
        return $this->container['delete'];
    }

    /**
     * Sets delete
     * @param string $delete Trigger callback on delete.
     * @return $this
     */
    public function setDelete($delete)
    {
        $this->container['delete'] = $delete;

        return $this;
    }

    /**
     * Gets create_folder
     * @return string
     */
    public function getCreateFolder()
    {
        return $this->container['create_folder'];
    }

    /**
     * Sets create_folder
     * @param string $create_folder Trigger callback on fodler create.
     * @return $this
     */
    public function setCreateFolder($create_folder)
    {
        $this->container['create_folder'] = $create_folder;

        return $this;
    }

    /**
     * Gets rename
     * @return string
     */
    public function getRename()
    {
        return $this->container['rename'];
    }

    /**
     * Sets rename
     * @param string $rename Trigger callback on rename.
     * @return $this
     */
    public function setRename($rename)
    {
        $this->container['rename'] = $rename;

        return $this;
    }

    /**
     * Gets move
     * @return string
     */
    public function getMove()
    {
        return $this->container['move'];
    }

    /**
     * Sets move
     * @param string $move Trigger callback on move.
     * @return $this
     */
    public function setMove($move)
    {
        $this->container['move'] = $move;

        return $this;
    }

    /**
     * Gets copy
     * @return string
     */
    public function getCopy()
    {
        return $this->container['copy'];
    }

    /**
     * Sets copy
     * @param string $copy Trigger callback on copy.
     * @return $this
     */
    public function setCopy($copy)
    {
        $this->container['copy'] = $copy;

        return $this;
    }

    /**
     * Gets compress
     * @return string
     */
    public function getCompress()
    {
        return $this->container['compress'];
    }

    /**
     * Sets compress
     * @param string $compress Trigger callback on compress.
     * @return $this
     */
    public function setCompress($compress)
    {
        $this->container['compress'] = $compress;

        return $this;
    }

    /**
     * Gets extract
     * @return string
     */
    public function getExtract()
    {
        return $this->container['extract'];
    }

    /**
     * Sets extract
     * @param string $extract Trigger callback on extract.
     * @return $this
     */
    public function setExtract($extract)
    {
        $this->container['extract'] = $extract;

        return $this;
    }

    /**
     * Gets share_folder
     * @return string
     */
    public function getShareFolder()
    {
        return $this->container['share_folder'];
    }

    /**
     * Sets share_folder
     * @param string $share_folder Trigger callback on share folder create.
     * @return $this
     */
    public function setShareFolder($share_folder)
    {
        $this->container['share_folder'] = $share_folder;

        return $this;
    }

    /**
     * Gets send_files
     * @return string
     */
    public function getSendFiles()
    {
        return $this->container['send_files'];
    }

    /**
     * Sets send_files
     * @param string $send_files Trigger callback on send files.
     * @return $this
     */
    public function setSendFiles($send_files)
    {
        $this->container['send_files'] = $send_files;

        return $this;
    }

    /**
     * Gets receive_files
     * @return string
     */
    public function getReceiveFiles()
    {
        return $this->container['receive_files'];
    }

    /**
     * Sets receive_files
     * @param string $receive_files Trigger callback on receive folder create.
     * @return $this
     */
    public function setReceiveFiles($receive_files)
    {
        $this->container['receive_files'] = $receive_files;

        return $this;
    }

    /**
     * Gets update_share
     * @return string
     */
    public function getUpdateShare()
    {
        return $this->container['update_share'];
    }

    /**
     * Sets update_share
     * @param string $update_share Trigger callback on share folder update.
     * @return $this
     */
    public function setUpdateShare($update_share)
    {
        $this->container['update_share'] = $update_share;

        return $this;
    }

    /**
     * Gets update_receive
     * @return string
     */
    public function getUpdateReceive()
    {
        return $this->container['update_receive'];
    }

    /**
     * Sets update_receive
     * @param string $update_receive Trigger callback on receive folder update.
     * @return $this
     */
    public function setUpdateReceive($update_receive)
    {
        $this->container['update_receive'] = $update_receive;

        return $this;
    }

    /**
     * Gets delete_send
     * @return string
     */
    public function getDeleteSend()
    {
        return $this->container['delete_send'];
    }

    /**
     * Sets delete_send
     * @param string $delete_send Trigger callback on send files delete.
     * @return $this
     */
    public function setDeleteSend($delete_send)
    {
        $this->container['delete_send'] = $delete_send;

        return $this;
    }

    /**
     * Gets delete_receive
     * @return string
     */
    public function getDeleteReceive()
    {
        return $this->container['delete_receive'];
    }

    /**
     * Sets delete_receive
     * @param string $delete_receive Trigger callback on receive folder delete.
     * @return $this
     */
    public function setDeleteReceive($delete_receive)
    {
        $this->container['delete_receive'] = $delete_receive;

        return $this;
    }

    /**
     * Gets delete_share
     * @return string
     */
    public function getDeleteShare()
    {
        return $this->container['delete_share'];
    }

    /**
     * Sets delete_share
     * @param string $delete_share Trigger callback on share folder delete.
     * @return $this
     */
    public function setDeleteShare($delete_share)
    {
        $this->container['delete_share'] = $delete_share;

        return $this;
    }

    /**
     * Gets create_notification
     * @return string
     */
    public function getCreateNotification()
    {
        return $this->container['create_notification'];
    }

    /**
     * Sets create_notification
     * @param string $create_notification Trigger callback on notification create.
     * @return $this
     */
    public function setCreateNotification($create_notification)
    {
        $this->container['create_notification'] = $create_notification;

        return $this;
    }

    /**
     * Gets update_notification
     * @return string
     */
    public function getUpdateNotification()
    {
        return $this->container['update_notification'];
    }

    /**
     * Sets update_notification
     * @param string $update_notification Trigger callback on notification update.
     * @return $this
     */
    public function setUpdateNotification($update_notification)
    {
        $this->container['update_notification'] = $update_notification;

        return $this;
    }

    /**
     * Gets delete_notification
     * @return string
     */
    public function getDeleteNotification()
    {
        return $this->container['delete_notification'];
    }

    /**
     * Sets delete_notification
     * @param string $delete_notification Trigger callback on notification delete.
     * @return $this
     */
    public function setDeleteNotification($delete_notification)
    {
        $this->container['delete_notification'] = $delete_notification;

        return $this;
    }

    /**
     * Gets create_user
     * @return string
     */
    public function getCreateUser()
    {
        return $this->container['create_user'];
    }

    /**
     * Sets create_user
     * @param string $create_user Trigger callback on user create.
     * @return $this
     */
    public function setCreateUser($create_user)
    {
        $this->container['create_user'] = $create_user;

        return $this;
    }

    /**
     * Gets update_user
     * @return string
     */
    public function getUpdateUser()
    {
        return $this->container['update_user'];
    }

    /**
     * Sets update_user
     * @param string $update_user Trigger callback on user update.
     * @return $this
     */
    public function setUpdateUser($update_user)
    {
        $this->container['update_user'] = $update_user;

        return $this;
    }

    /**
     * Gets delete_user
     * @return string
     */
    public function getDeleteUser()
    {
        return $this->container['delete_user'];
    }

    /**
     * Sets delete_user
     * @param string $delete_user Trigger callback on user delete.
     * @return $this
     */
    public function setDeleteUser($delete_user)
    {
        $this->container['delete_user'] = $delete_user;

        return $this;
    }

    /**
     * Gets user_connect
     * @return string
     */
    public function getUserConnect()
    {
        return $this->container['user_connect'];
    }

    /**
     * Sets user_connect
     * @param string $user_connect Trigger callback on user connect.
     * @return $this
     */
    public function setUserConnect($user_connect)
    {
        $this->container['user_connect'] = $user_connect;

        return $this;
    }

    /**
     * Gets user_disconnect
     * @return string
     */
    public function getUserDisconnect()
    {
        return $this->container['user_disconnect'];
    }

    /**
     * Sets user_disconnect
     * @param string $user_disconnect Trigger callback on user disconnect.
     * @return $this
     */
    public function setUserDisconnect($user_disconnect)
    {
        $this->container['user_disconnect'] = $user_disconnect;

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


