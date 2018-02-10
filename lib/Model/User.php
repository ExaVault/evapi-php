<?php
/**
 * User
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
 * User Class Doc Comment
 *
 * @category    Class
 * @description Object contais user properties.
 * @package     Swagger\Client
 * @author      Swagger Codegen team
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class User implements ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      * @var string
      */
    protected static $swaggerModelName = 'User';

    /**
      * Array of property to type mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerTypes = [
        'gid' => 'int',
        'status' => 'int',
        'expiration' => 'string',
        'created' => 'string',
        'modified' => 'string',
        'access_timestamp' => 'string',
        'id' => 'int',
        'owning_account_id' => 'int',
        'username' => 'string',
        'nickname' => 'string',
        'email' => 'string',
        'home_dir' => 'string',
        'download' => 'bool',
        'upload' => 'bool',
        'modify' => 'bool',
        'delete' => 'bool',
        'list' => 'bool',
        'change_password' => 'bool',
        'share' => 'bool',
        'notification' => 'bool',
        'role' => 'string',
        'time_zone' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerFormats = [
        'gid' => 'int32',
        'status' => 'int32',
        'expiration' => null,
        'created' => 'YYYY-mm-dd hh:mm:ss',
        'modified' => 'YYYY-mm-dd hh:mm:ss',
        'access_timestamp' => 'YYYY-mm-dd hh:mm:ss',
        'id' => 'int32',
        'owning_account_id' => 'int32',
        'username' => null,
        'nickname' => null,
        'email' => null,
        'home_dir' => null,
        'download' => null,
        'upload' => null,
        'modify' => null,
        'delete' => null,
        'list' => null,
        'change_password' => null,
        'share' => null,
        'notification' => null,
        'role' => null,
        'time_zone' => null
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
        'gid' => 'gid',
        'status' => 'status',
        'expiration' => 'expiration',
        'created' => 'created',
        'modified' => 'modified',
        'access_timestamp' => 'accessTimestamp',
        'id' => 'id',
        'owning_account_id' => 'owningAccountId',
        'username' => 'username',
        'nickname' => 'nickname',
        'email' => 'email',
        'home_dir' => 'homeDir',
        'download' => 'download',
        'upload' => 'upload',
        'modify' => 'modify',
        'delete' => 'delete',
        'list' => 'list',
        'change_password' => 'changePassword',
        'share' => 'share',
        'notification' => 'notification',
        'role' => 'role',
        'time_zone' => 'timeZone'
    ];


    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = [
        'gid' => 'setGid',
        'status' => 'setStatus',
        'expiration' => 'setExpiration',
        'created' => 'setCreated',
        'modified' => 'setModified',
        'access_timestamp' => 'setAccessTimestamp',
        'id' => 'setId',
        'owning_account_id' => 'setOwningAccountId',
        'username' => 'setUsername',
        'nickname' => 'setNickname',
        'email' => 'setEmail',
        'home_dir' => 'setHomeDir',
        'download' => 'setDownload',
        'upload' => 'setUpload',
        'modify' => 'setModify',
        'delete' => 'setDelete',
        'list' => 'setList',
        'change_password' => 'setChangePassword',
        'share' => 'setShare',
        'notification' => 'setNotification',
        'role' => 'setRole',
        'time_zone' => 'setTimeZone'
    ];


    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = [
        'gid' => 'getGid',
        'status' => 'getStatus',
        'expiration' => 'getExpiration',
        'created' => 'getCreated',
        'modified' => 'getModified',
        'access_timestamp' => 'getAccessTimestamp',
        'id' => 'getId',
        'owning_account_id' => 'getOwningAccountId',
        'username' => 'getUsername',
        'nickname' => 'getNickname',
        'email' => 'getEmail',
        'home_dir' => 'getHomeDir',
        'download' => 'getDownload',
        'upload' => 'getUpload',
        'modify' => 'getModify',
        'delete' => 'getDelete',
        'list' => 'getList',
        'change_password' => 'getChangePassword',
        'share' => 'getShare',
        'notification' => 'getNotification',
        'role' => 'getRole',
        'time_zone' => 'getTimeZone'
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

    const STATUS_0 = 0;
    const STATUS_1 = 1;
    

    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public function getStatusAllowableValues()
    {
        return [
            self::STATUS_0,
            self::STATUS_1,
        ];
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
        $this->container['gid'] = isset($data['gid']) ? $data['gid'] : null;
        $this->container['status'] = isset($data['status']) ? $data['status'] : null;
        $this->container['expiration'] = isset($data['expiration']) ? $data['expiration'] : null;
        $this->container['created'] = isset($data['created']) ? $data['created'] : null;
        $this->container['modified'] = isset($data['modified']) ? $data['modified'] : null;
        $this->container['access_timestamp'] = isset($data['access_timestamp']) ? $data['access_timestamp'] : null;
        $this->container['id'] = isset($data['id']) ? $data['id'] : null;
        $this->container['owning_account_id'] = isset($data['owning_account_id']) ? $data['owning_account_id'] : null;
        $this->container['username'] = isset($data['username']) ? $data['username'] : null;
        $this->container['nickname'] = isset($data['nickname']) ? $data['nickname'] : null;
        $this->container['email'] = isset($data['email']) ? $data['email'] : null;
        $this->container['home_dir'] = isset($data['home_dir']) ? $data['home_dir'] : null;
        $this->container['download'] = isset($data['download']) ? $data['download'] : null;
        $this->container['upload'] = isset($data['upload']) ? $data['upload'] : null;
        $this->container['modify'] = isset($data['modify']) ? $data['modify'] : null;
        $this->container['delete'] = isset($data['delete']) ? $data['delete'] : null;
        $this->container['list'] = isset($data['list']) ? $data['list'] : null;
        $this->container['change_password'] = isset($data['change_password']) ? $data['change_password'] : null;
        $this->container['share'] = isset($data['share']) ? $data['share'] : null;
        $this->container['notification'] = isset($data['notification']) ? $data['notification'] : null;
        $this->container['role'] = isset($data['role']) ? $data['role'] : null;
        $this->container['time_zone'] = isset($data['time_zone']) ? $data['time_zone'] : null;
    }

    /**
     * show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalid_properties = [];

        $allowed_values = $this->getStatusAllowableValues();
        if (!in_array($this->container['status'], $allowed_values)) {
            $invalid_properties[] = sprintf(
                "invalid value for 'status', must be one of '%s'",
                implode("', '", $allowed_values)
            );
        }

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

        $allowed_values = $this->getStatusAllowableValues();
        if (!in_array($this->container['status'], $allowed_values)) {
            return false;
        }
        return true;
    }


    /**
     * Gets gid
     * @return int
     */
    public function getGid()
    {
        return $this->container['gid'];
    }

    /**
     * Sets gid
     * @param int $gid GID of the user.
     * @return $this
     */
    public function setGid($gid)
    {
        $this->container['gid'] = $gid;

        return $this;
    }

    /**
     * Gets status
     * @return int
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     * @param int $status Indicates user activity status.
     * @return $this
     */
    public function setStatus($status)
    {
        $allowed_values = $this->getStatusAllowableValues();
        if (!is_null($status) && !in_array($status, $allowed_values)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'status', must be one of '%s'",
                    implode("', '", $allowed_values)
                )
            );
        }
        $this->container['status'] = $status;

        return $this;
    }

    /**
     * Gets expiration
     * @return string
     */
    public function getExpiration()
    {
        return $this->container['expiration'];
    }

    /**
     * Sets expiration
     * @param string $expiration Timestamp of user expiration.
     * @return $this
     */
    public function setExpiration($expiration)
    {
        $this->container['expiration'] = $expiration;

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
     * @param string $created Timestamp of user creation.
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
     * @param string $modified Timestamp of user modification.
     * @return $this
     */
    public function setModified($modified)
    {
        $this->container['modified'] = $modified;

        return $this;
    }

    /**
     * Gets access_timestamp
     * @return string
     */
    public function getAccessTimestamp()
    {
        return $this->container['access_timestamp'];
    }

    /**
     * Sets access_timestamp
     * @param string $access_timestamp Timestamp of user accesing the account.
     * @return $this
     */
    public function setAccessTimestamp($access_timestamp)
    {
        $this->container['access_timestamp'] = $access_timestamp;

        return $this;
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
     * @param int $id ID of the user.
     * @return $this
     */
    public function setId($id)
    {
        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets owning_account_id
     * @return int
     */
    public function getOwningAccountId()
    {
        return $this->container['owning_account_id'];
    }

    /**
     * Sets owning_account_id
     * @param int $owning_account_id ID of the account this user belongs to.
     * @return $this
     */
    public function setOwningAccountId($owning_account_id)
    {
        $this->container['owning_account_id'] = $owning_account_id;

        return $this;
    }

    /**
     * Gets username
     * @return string
     */
    public function getUsername()
    {
        return $this->container['username'];
    }

    /**
     * Sets username
     * @param string $username Username of the user.
     * @return $this
     */
    public function setUsername($username)
    {
        $this->container['username'] = $username;

        return $this;
    }

    /**
     * Gets nickname
     * @return string
     */
    public function getNickname()
    {
        return $this->container['nickname'];
    }

    /**
     * Sets nickname
     * @param string $nickname Nickname of the user.
     * @return $this
     */
    public function setNickname($nickname)
    {
        $this->container['nickname'] = $nickname;

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
     * @param string $email Email address of the user.
     * @return $this
     */
    public function setEmail($email)
    {
        $this->container['email'] = $email;

        return $this;
    }

    /**
     * Gets home_dir
     * @return string
     */
    public function getHomeDir()
    {
        return $this->container['home_dir'];
    }

    /**
     * Sets home_dir
     * @param string $home_dir Path to the user's home folder.
     * @return $this
     */
    public function setHomeDir($home_dir)
    {
        $this->container['home_dir'] = $home_dir;

        return $this;
    }

    /**
     * Gets download
     * @return bool
     */
    public function getDownload()
    {
        return $this->container['download'];
    }

    /**
     * Sets download
     * @param bool $download Download permission flag.
     * @return $this
     */
    public function setDownload($download)
    {
        $this->container['download'] = $download;

        return $this;
    }

    /**
     * Gets upload
     * @return bool
     */
    public function getUpload()
    {
        return $this->container['upload'];
    }

    /**
     * Sets upload
     * @param bool $upload Upload permission flag.
     * @return $this
     */
    public function setUpload($upload)
    {
        $this->container['upload'] = $upload;

        return $this;
    }

    /**
     * Gets modify
     * @return bool
     */
    public function getModify()
    {
        return $this->container['modify'];
    }

    /**
     * Sets modify
     * @param bool $modify Modify permission flag.
     * @return $this
     */
    public function setModify($modify)
    {
        $this->container['modify'] = $modify;

        return $this;
    }

    /**
     * Gets delete
     * @return bool
     */
    public function getDelete()
    {
        return $this->container['delete'];
    }

    /**
     * Sets delete
     * @param bool $delete Delete permission flag.
     * @return $this
     */
    public function setDelete($delete)
    {
        $this->container['delete'] = $delete;

        return $this;
    }

    /**
     * Gets list
     * @return bool
     */
    public function getList()
    {
        return $this->container['list'];
    }

    /**
     * Sets list
     * @param bool $list View files permission flag.
     * @return $this
     */
    public function setList($list)
    {
        $this->container['list'] = $list;

        return $this;
    }

    /**
     * Gets change_password
     * @return bool
     */
    public function getChangePassword()
    {
        return $this->container['change_password'];
    }

    /**
     * Sets change_password
     * @param bool $change_password Change permission flag.
     * @return $this
     */
    public function setChangePassword($change_password)
    {
        $this->container['change_password'] = $change_password;

        return $this;
    }

    /**
     * Gets share
     * @return bool
     */
    public function getShare()
    {
        return $this->container['share'];
    }

    /**
     * Sets share
     * @param bool $share Share folders permission flag.
     * @return $this
     */
    public function setShare($share)
    {
        $this->container['share'] = $share;

        return $this;
    }

    /**
     * Gets notification
     * @return bool
     */
    public function getNotification()
    {
        return $this->container['notification'];
    }

    /**
     * Sets notification
     * @param bool $notification Create notifications permission flag.
     * @return $this
     */
    public function setNotification($notification)
    {
        $this->container['notification'] = $notification;

        return $this;
    }

    /**
     * Gets role
     * @return string
     */
    public function getRole()
    {
        return $this->container['role'];
    }

    /**
     * Sets role
     * @param string $role User's role.
     * @return $this
     */
    public function setRole($role)
    {
        $this->container['role'] = $role;

        return $this;
    }

    /**
     * Gets time_zone
     * @return string
     */
    public function getTimeZone()
    {
        return $this->container['time_zone'];
    }

    /**
     * Sets time_zone
     * @param string $time_zone User's timezone.
     * @return $this
     */
    public function setTimeZone($time_zone)
    {
        $this->container['time_zone'] = $time_zone;

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


