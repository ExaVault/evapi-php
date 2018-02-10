<?php
/**
 * Share
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
 * Share Class Doc Comment
 *
 * @category    Class
 * @description Object contains share properties.
 * @package     Swagger\Client
 * @author      Swagger Codegen team
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class Share implements ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      * @var string
      */
    protected static $swaggerModelName = 'Share';

    /**
      * Array of property to type mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerTypes = [
        'id' => 'int',
        'name' => 'string',
        'has_password' => 'bool',
        'public' => 'bool',
        'access_mode' => 'string',
        'access_description' => 'string',
        'embed' => 'bool',
        'hash' => 'string',
        'owner_hash' => 'string',
        'expiration' => 'string',
        'expired' => 'bool',
        'resent' => 'string',
        'owner' => 'int',
        'owner_username' => 'string',
        'type' => 'string',
        'require_email' => 'bool',
        'file_drop_create_folders' => 'bool',
        'paths' => 'string[]',
        'recipients' => '\Swagger\Client\Model\ShareRecipient[]',
        'recipients_with_owner' => '\Swagger\Client\Model\ShareRecipient[]',
        'messages' => '\Swagger\Client\Model\Message[]',
        'inherited' => 'bool',
        'status' => 'int',
        'has_notification' => 'bool',
        'notification' => 'string',
        'created' => 'string',
        'modified' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerFormats = [
        'id' => 'int32',
        'name' => null,
        'has_password' => null,
        'public' => null,
        'access_mode' => null,
        'access_description' => null,
        'embed' => null,
        'hash' => null,
        'owner_hash' => null,
        'expiration' => null,
        'expired' => null,
        'resent' => 'YYYY-mm-dd hh:mm:ss',
        'owner' => 'int32',
        'owner_username' => null,
        'type' => null,
        'require_email' => null,
        'file_drop_create_folders' => null,
        'paths' => null,
        'recipients' => null,
        'recipients_with_owner' => null,
        'messages' => null,
        'inherited' => null,
        'status' => 'int32',
        'has_notification' => null,
        'notification' => null,
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
        'name' => 'name',
        'has_password' => 'hasPassword',
        'public' => 'public',
        'access_mode' => 'accessMode',
        'access_description' => 'accessDescription',
        'embed' => 'embed',
        'hash' => 'hash',
        'owner_hash' => 'ownerHash',
        'expiration' => 'expiration',
        'expired' => 'expired',
        'resent' => 'resent',
        'owner' => 'owner',
        'owner_username' => 'ownerUsername',
        'type' => 'type',
        'require_email' => 'requireEmail',
        'file_drop_create_folders' => 'fileDropCreateFolders',
        'paths' => 'paths',
        'recipients' => 'recipients',
        'recipients_with_owner' => 'recipientsWithOwner',
        'messages' => 'messages',
        'inherited' => 'inherited',
        'status' => 'status',
        'has_notification' => 'hasNotification',
        'notification' => 'notification',
        'created' => 'created',
        'modified' => 'modified'
    ];


    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'name' => 'setName',
        'has_password' => 'setHasPassword',
        'public' => 'setPublic',
        'access_mode' => 'setAccessMode',
        'access_description' => 'setAccessDescription',
        'embed' => 'setEmbed',
        'hash' => 'setHash',
        'owner_hash' => 'setOwnerHash',
        'expiration' => 'setExpiration',
        'expired' => 'setExpired',
        'resent' => 'setResent',
        'owner' => 'setOwner',
        'owner_username' => 'setOwnerUsername',
        'type' => 'setType',
        'require_email' => 'setRequireEmail',
        'file_drop_create_folders' => 'setFileDropCreateFolders',
        'paths' => 'setPaths',
        'recipients' => 'setRecipients',
        'recipients_with_owner' => 'setRecipientsWithOwner',
        'messages' => 'setMessages',
        'inherited' => 'setInherited',
        'status' => 'setStatus',
        'has_notification' => 'setHasNotification',
        'notification' => 'setNotification',
        'created' => 'setCreated',
        'modified' => 'setModified'
    ];


    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'name' => 'getName',
        'has_password' => 'getHasPassword',
        'public' => 'getPublic',
        'access_mode' => 'getAccessMode',
        'access_description' => 'getAccessDescription',
        'embed' => 'getEmbed',
        'hash' => 'getHash',
        'owner_hash' => 'getOwnerHash',
        'expiration' => 'getExpiration',
        'expired' => 'getExpired',
        'resent' => 'getResent',
        'owner' => 'getOwner',
        'owner_username' => 'getOwnerUsername',
        'type' => 'getType',
        'require_email' => 'getRequireEmail',
        'file_drop_create_folders' => 'getFileDropCreateFolders',
        'paths' => 'getPaths',
        'recipients' => 'getRecipients',
        'recipients_with_owner' => 'getRecipientsWithOwner',
        'messages' => 'getMessages',
        'inherited' => 'getInherited',
        'status' => 'getStatus',
        'has_notification' => 'getHasNotification',
        'notification' => 'getNotification',
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

    const ACCESS_MODE_UPLOAD = 'upload';
    const ACCESS_MODE_DOWNLOAD = 'download';
    const ACCESS_MODE_DOWNLOAD_UPLOAD = 'download_upload';
    const ACCESS_MODE_DOWNLOAD_UPLOAD_MODIFY_DELETE = 'download_upload_modify_delete';
    const TYPE_SHARED_FOLDER = 'shared_folder';
    const TYPE_SEND = 'send';
    const TYPE_RECEIVE = 'receive';
    const STATUS_0 = 0;
    const STATUS_1 = 1;
    

    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public function getAccessModeAllowableValues()
    {
        return [
            self::ACCESS_MODE_UPLOAD,
            self::ACCESS_MODE_DOWNLOAD,
            self::ACCESS_MODE_DOWNLOAD_UPLOAD,
            self::ACCESS_MODE_DOWNLOAD_UPLOAD_MODIFY_DELETE,
        ];
    }
    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public function getTypeAllowableValues()
    {
        return [
            self::TYPE_SHARED_FOLDER,
            self::TYPE_SEND,
            self::TYPE_RECEIVE,
        ];
    }
    
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
        $this->container['id'] = isset($data['id']) ? $data['id'] : null;
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['has_password'] = isset($data['has_password']) ? $data['has_password'] : null;
        $this->container['public'] = isset($data['public']) ? $data['public'] : null;
        $this->container['access_mode'] = isset($data['access_mode']) ? $data['access_mode'] : null;
        $this->container['access_description'] = isset($data['access_description']) ? $data['access_description'] : null;
        $this->container['embed'] = isset($data['embed']) ? $data['embed'] : null;
        $this->container['hash'] = isset($data['hash']) ? $data['hash'] : null;
        $this->container['owner_hash'] = isset($data['owner_hash']) ? $data['owner_hash'] : null;
        $this->container['expiration'] = isset($data['expiration']) ? $data['expiration'] : null;
        $this->container['expired'] = isset($data['expired']) ? $data['expired'] : null;
        $this->container['resent'] = isset($data['resent']) ? $data['resent'] : null;
        $this->container['owner'] = isset($data['owner']) ? $data['owner'] : null;
        $this->container['owner_username'] = isset($data['owner_username']) ? $data['owner_username'] : null;
        $this->container['type'] = isset($data['type']) ? $data['type'] : null;
        $this->container['require_email'] = isset($data['require_email']) ? $data['require_email'] : null;
        $this->container['file_drop_create_folders'] = isset($data['file_drop_create_folders']) ? $data['file_drop_create_folders'] : null;
        $this->container['paths'] = isset($data['paths']) ? $data['paths'] : null;
        $this->container['recipients'] = isset($data['recipients']) ? $data['recipients'] : null;
        $this->container['recipients_with_owner'] = isset($data['recipients_with_owner']) ? $data['recipients_with_owner'] : null;
        $this->container['messages'] = isset($data['messages']) ? $data['messages'] : null;
        $this->container['inherited'] = isset($data['inherited']) ? $data['inherited'] : null;
        $this->container['status'] = isset($data['status']) ? $data['status'] : null;
        $this->container['has_notification'] = isset($data['has_notification']) ? $data['has_notification'] : null;
        $this->container['notification'] = isset($data['notification']) ? $data['notification'] : null;
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

        $allowed_values = $this->getAccessModeAllowableValues();
        if (!in_array($this->container['access_mode'], $allowed_values)) {
            $invalid_properties[] = sprintf(
                "invalid value for 'access_mode', must be one of '%s'",
                implode("', '", $allowed_values)
            );
        }

        $allowed_values = $this->getTypeAllowableValues();
        if (!in_array($this->container['type'], $allowed_values)) {
            $invalid_properties[] = sprintf(
                "invalid value for 'type', must be one of '%s'",
                implode("', '", $allowed_values)
            );
        }

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

        $allowed_values = $this->getAccessModeAllowableValues();
        if (!in_array($this->container['access_mode'], $allowed_values)) {
            return false;
        }
        $allowed_values = $this->getTypeAllowableValues();
        if (!in_array($this->container['type'], $allowed_values)) {
            return false;
        }
        $allowed_values = $this->getStatusAllowableValues();
        if (!in_array($this->container['status'], $allowed_values)) {
            return false;
        }
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
     * @param int $id ID of the share.
     * @return $this
     */
    public function setId($id)
    {
        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets name
     * @return string
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     * @param string $name Share name.
     * @return $this
     */
    public function setName($name)
    {
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets has_password
     * @return bool
     */
    public function getHasPassword()
    {
        return $this->container['has_password'];
    }

    /**
     * Sets has_password
     * @param bool $has_password True if the share has password.
     * @return $this
     */
    public function setHasPassword($has_password)
    {
        $this->container['has_password'] = $has_password;

        return $this;
    }

    /**
     * Gets public
     * @return bool
     */
    public function getPublic()
    {
        return $this->container['public'];
    }

    /**
     * Sets public
     * @param bool $public True if the share has a public url.
     * @return $this
     */
    public function setPublic($public)
    {
        $this->container['public'] = $public;

        return $this;
    }

    /**
     * Gets access_mode
     * @return string
     */
    public function getAccessMode()
    {
        return $this->container['access_mode'];
    }

    /**
     * Sets access_mode
     * @param string $access_mode Access rights for the share.
     * @return $this
     */
    public function setAccessMode($access_mode)
    {
        $allowed_values = $this->getAccessModeAllowableValues();
        if (!is_null($access_mode) && !in_array($access_mode, $allowed_values)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'access_mode', must be one of '%s'",
                    implode("', '", $allowed_values)
                )
            );
        }
        $this->container['access_mode'] = $access_mode;

        return $this;
    }

    /**
     * Gets access_description
     * @return string
     */
    public function getAccessDescription()
    {
        return $this->container['access_description'];
    }

    /**
     * Sets access_description
     * @param string $access_description Description of the share access rights.
     * @return $this
     */
    public function setAccessDescription($access_description)
    {
        $this->container['access_description'] = $access_description;

        return $this;
    }

    /**
     * Gets embed
     * @return bool
     */
    public function getEmbed()
    {
        return $this->container['embed'];
    }

    /**
     * Sets embed
     * @param bool $embed True if share can be embedded.
     * @return $this
     */
    public function setEmbed($embed)
    {
        $this->container['embed'] = $embed;

        return $this;
    }

    /**
     * Gets hash
     * @return string
     */
    public function getHash()
    {
        return $this->container['hash'];
    }

    /**
     * Sets hash
     * @param string $hash Share hash.
     * @return $this
     */
    public function setHash($hash)
    {
        $this->container['hash'] = $hash;

        return $this;
    }

    /**
     * Gets owner_hash
     * @return string
     */
    public function getOwnerHash()
    {
        return $this->container['owner_hash'];
    }

    /**
     * Sets owner_hash
     * @param string $owner_hash Share owner's hash.
     * @return $this
     */
    public function setOwnerHash($owner_hash)
    {
        $this->container['owner_hash'] = $owner_hash;

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
     * @param string $expiration Expiration date of the share.
     * @return $this
     */
    public function setExpiration($expiration)
    {
        $this->container['expiration'] = $expiration;

        return $this;
    }

    /**
     * Gets expired
     * @return bool
     */
    public function getExpired()
    {
        return $this->container['expired'];
    }

    /**
     * Sets expired
     * @param bool $expired True if the share has expired.
     * @return $this
     */
    public function setExpired($expired)
    {
        $this->container['expired'] = $expired;

        return $this;
    }

    /**
     * Gets resent
     * @return string
     */
    public function getResent()
    {
        return $this->container['resent'];
    }

    /**
     * Sets resent
     * @param string $resent Invitations resent date. Can be `null` if resent never happened.
     * @return $this
     */
    public function setResent($resent)
    {
        $this->container['resent'] = $resent;

        return $this;
    }

    /**
     * Gets owner
     * @return int
     */
    public function getOwner()
    {
        return $this->container['owner'];
    }

    /**
     * Sets owner
     * @param int $owner ID of the share owner.
     * @return $this
     */
    public function setOwner($owner)
    {
        $this->container['owner'] = $owner;

        return $this;
    }

    /**
     * Gets owner_username
     * @return string
     */
    public function getOwnerUsername()
    {
        return $this->container['owner_username'];
    }

    /**
     * Sets owner_username
     * @param string $owner_username Username of share owner.
     * @return $this
     */
    public function setOwnerUsername($owner_username)
    {
        $this->container['owner_username'] = $owner_username;

        return $this;
    }

    /**
     * Gets type
     * @return string
     */
    public function getType()
    {
        return $this->container['type'];
    }

    /**
     * Sets type
     * @param string $type Type of share.
     * @return $this
     */
    public function setType($type)
    {
        $allowed_values = $this->getTypeAllowableValues();
        if (!is_null($type) && !in_array($type, $allowed_values)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'type', must be one of '%s'",
                    implode("', '", $allowed_values)
                )
            );
        }
        $this->container['type'] = $type;

        return $this;
    }

    /**
     * Gets require_email
     * @return bool
     */
    public function getRequireEmail()
    {
        return $this->container['require_email'];
    }

    /**
     * Sets require_email
     * @param bool $require_email True if share requires email to access.
     * @return $this
     */
    public function setRequireEmail($require_email)
    {
        $this->container['require_email'] = $require_email;

        return $this;
    }

    /**
     * Gets file_drop_create_folders
     * @return bool
     */
    public function getFileDropCreateFolders()
    {
        return $this->container['file_drop_create_folders'];
    }

    /**
     * Sets file_drop_create_folders
     * @param bool $file_drop_create_folders Flag to show if separate folders should be created for each file upload to receive folder.
     * @return $this
     */
    public function setFileDropCreateFolders($file_drop_create_folders)
    {
        $this->container['file_drop_create_folders'] = $file_drop_create_folders;

        return $this;
    }

    /**
     * Gets paths
     * @return string[]
     */
    public function getPaths()
    {
        return $this->container['paths'];
    }

    /**
     * Sets paths
     * @param string[] $paths Path to the shared resource in your account.
     * @return $this
     */
    public function setPaths($paths)
    {
        $this->container['paths'] = $paths;

        return $this;
    }

    /**
     * Gets recipients
     * @return \Swagger\Client\Model\ShareRecipient[]
     */
    public function getRecipients()
    {
        return $this->container['recipients'];
    }

    /**
     * Sets recipients
     * @param \Swagger\Client\Model\ShareRecipient[] $recipients Array of recipients.
     * @return $this
     */
    public function setRecipients($recipients)
    {
        $this->container['recipients'] = $recipients;

        return $this;
    }

    /**
     * Gets recipients_with_owner
     * @return \Swagger\Client\Model\ShareRecipient[]
     */
    public function getRecipientsWithOwner()
    {
        return $this->container['recipients_with_owner'];
    }

    /**
     * Sets recipients_with_owner
     * @param \Swagger\Client\Model\ShareRecipient[] $recipients_with_owner Array of recipients with owner.
     * @return $this
     */
    public function setRecipientsWithOwner($recipients_with_owner)
    {
        $this->container['recipients_with_owner'] = $recipients_with_owner;

        return $this;
    }

    /**
     * Gets messages
     * @return \Swagger\Client\Model\Message[]
     */
    public function getMessages()
    {
        return $this->container['messages'];
    }

    /**
     * Sets messages
     * @param \Swagger\Client\Model\Message[] $messages Array of invitation messages.
     * @return $this
     */
    public function setMessages($messages)
    {
        $this->container['messages'] = $messages;

        return $this;
    }

    /**
     * Gets inherited
     * @return bool
     */
    public function getInherited()
    {
        return $this->container['inherited'];
    }

    /**
     * Sets inherited
     * @param bool $inherited True if share inherited from parent folder.
     * @return $this
     */
    public function setInherited($inherited)
    {
        $this->container['inherited'] = $inherited;

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
     * @param int $status Share activity status. Can be active (1) or deactivated (0).
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
     * Gets has_notification
     * @return bool
     */
    public function getHasNotification()
    {
        return $this->container['has_notification'];
    }

    /**
     * Sets has_notification
     * @param bool $has_notification True if share has notification.
     * @return $this
     */
    public function setHasNotification($has_notification)
    {
        $this->container['has_notification'] = $has_notification;

        return $this;
    }

    /**
     * Gets notification
     * @return string
     */
    public function getNotification()
    {
        return $this->container['notification'];
    }

    /**
     * Sets notification
     * @param string $notification Notification object if share has one.
     * @return $this
     */
    public function setNotification($notification)
    {
        $this->container['notification'] = $notification;

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
     * @param string $created Timestamp of share creation.
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
     * @param string $modified Timestamp of share modification. Can be `null` if it wasn't modified.
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


