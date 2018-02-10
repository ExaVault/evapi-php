<?php
/**
 * Notification
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
 * Notification Class Doc Comment
 *
 * @category    Class
 * @description Object containing notification properties.
 * @package     Swagger\Client
 * @author      Swagger Codegen team
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class Notification implements ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      * @var string
      */
    protected static $swaggerModelName = 'Notification';

    /**
      * Array of property to type mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerTypes = [
        'id' => 'int',
        'user_id' => 'string',
        'type' => 'string',
        'path' => 'string',
        'name' => 'string',
        'action' => 'string',
        'usernames' => 'string[]',
        'recipients' => '\Swagger\Client\Model\NotificationRecipient[]',
        'recipient_emails' => 'string[]',
        'send_email' => 'string',
        'readable_description' => 'string',
        'readable_description_without_path' => 'string',
        'share_id' => 'string',
        'message' => 'string',
        'created' => 'string',
        'modified' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerFormats = [
        'id' => 'int32',
        'user_id' => null,
        'type' => null,
        'path' => null,
        'name' => null,
        'action' => null,
        'usernames' => null,
        'recipients' => null,
        'recipient_emails' => 'email',
        'send_email' => null,
        'readable_description' => null,
        'readable_description_without_path' => null,
        'share_id' => null,
        'message' => null,
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
        'user_id' => 'userId',
        'type' => 'type',
        'path' => 'path',
        'name' => 'name',
        'action' => 'action',
        'usernames' => 'usernames',
        'recipients' => 'recipients',
        'recipient_emails' => 'recipientEmails',
        'send_email' => 'sendEmail',
        'readable_description' => 'readableDescription',
        'readable_description_without_path' => 'readableDescriptionWithoutPath',
        'share_id' => 'shareId',
        'message' => 'message',
        'created' => 'created',
        'modified' => 'modified'
    ];


    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'user_id' => 'setUserId',
        'type' => 'setType',
        'path' => 'setPath',
        'name' => 'setName',
        'action' => 'setAction',
        'usernames' => 'setUsernames',
        'recipients' => 'setRecipients',
        'recipient_emails' => 'setRecipientEmails',
        'send_email' => 'setSendEmail',
        'readable_description' => 'setReadableDescription',
        'readable_description_without_path' => 'setReadableDescriptionWithoutPath',
        'share_id' => 'setShareId',
        'message' => 'setMessage',
        'created' => 'setCreated',
        'modified' => 'setModified'
    ];


    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'user_id' => 'getUserId',
        'type' => 'getType',
        'path' => 'getPath',
        'name' => 'getName',
        'action' => 'getAction',
        'usernames' => 'getUsernames',
        'recipients' => 'getRecipients',
        'recipient_emails' => 'getRecipientEmails',
        'send_email' => 'getSendEmail',
        'readable_description' => 'getReadableDescription',
        'readable_description_without_path' => 'getReadableDescriptionWithoutPath',
        'share_id' => 'getShareId',
        'message' => 'getMessage',
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

    const TYPE_FILE = 'file';
    const TYPE_FOLDER = 'folder';
    const TYPE_SHARED_FOLDER = 'shared_folder';
    const TYPE_SEND_RECEIPT = 'send_receipt';
    const TYPE_SHARE_RECEIPT = 'share_receipt';
    const TYPE_FILE_DROP = 'file_drop';
    const ACTION_UPLOAD = 'upload';
    const ACTION_DOWNLOAD = 'download';
    const ACTION_DELETE = 'delete';
    const ACTION_ALL = 'all';
    const SEND_EMAIL__0 = '0';
    const SEND_EMAIL__1 = '1';
    

    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public function getTypeAllowableValues()
    {
        return [
            self::TYPE_FILE,
            self::TYPE_FOLDER,
            self::TYPE_SHARED_FOLDER,
            self::TYPE_SEND_RECEIPT,
            self::TYPE_SHARE_RECEIPT,
            self::TYPE_FILE_DROP,
        ];
    }
    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public function getActionAllowableValues()
    {
        return [
            self::ACTION_UPLOAD,
            self::ACTION_DOWNLOAD,
            self::ACTION_DELETE,
            self::ACTION_ALL,
        ];
    }
    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public function getSendEmailAllowableValues()
    {
        return [
            self::SEND_EMAIL__0,
            self::SEND_EMAIL__1,
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
        $this->container['user_id'] = isset($data['user_id']) ? $data['user_id'] : null;
        $this->container['type'] = isset($data['type']) ? $data['type'] : null;
        $this->container['path'] = isset($data['path']) ? $data['path'] : null;
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['action'] = isset($data['action']) ? $data['action'] : null;
        $this->container['usernames'] = isset($data['usernames']) ? $data['usernames'] : null;
        $this->container['recipients'] = isset($data['recipients']) ? $data['recipients'] : null;
        $this->container['recipient_emails'] = isset($data['recipient_emails']) ? $data['recipient_emails'] : null;
        $this->container['send_email'] = isset($data['send_email']) ? $data['send_email'] : null;
        $this->container['readable_description'] = isset($data['readable_description']) ? $data['readable_description'] : null;
        $this->container['readable_description_without_path'] = isset($data['readable_description_without_path']) ? $data['readable_description_without_path'] : null;
        $this->container['share_id'] = isset($data['share_id']) ? $data['share_id'] : null;
        $this->container['message'] = isset($data['message']) ? $data['message'] : null;
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

        $allowed_values = $this->getTypeAllowableValues();
        if (!in_array($this->container['type'], $allowed_values)) {
            $invalid_properties[] = sprintf(
                "invalid value for 'type', must be one of '%s'",
                implode("', '", $allowed_values)
            );
        }

        $allowed_values = $this->getActionAllowableValues();
        if (!in_array($this->container['action'], $allowed_values)) {
            $invalid_properties[] = sprintf(
                "invalid value for 'action', must be one of '%s'",
                implode("', '", $allowed_values)
            );
        }

        $allowed_values = $this->getSendEmailAllowableValues();
        if (!in_array($this->container['send_email'], $allowed_values)) {
            $invalid_properties[] = sprintf(
                "invalid value for 'send_email', must be one of '%s'",
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

        $allowed_values = $this->getTypeAllowableValues();
        if (!in_array($this->container['type'], $allowed_values)) {
            return false;
        }
        $allowed_values = $this->getActionAllowableValues();
        if (!in_array($this->container['action'], $allowed_values)) {
            return false;
        }
        $allowed_values = $this->getSendEmailAllowableValues();
        if (!in_array($this->container['send_email'], $allowed_values)) {
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
     * @param int $id ID of the notification.
     * @return $this
     */
    public function setId($id)
    {
        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets user_id
     * @return string
     */
    public function getUserId()
    {
        return $this->container['user_id'];
    }

    /**
     * Sets user_id
     * @param string $user_id ID of the user that the notification belongs to.
     * @return $this
     */
    public function setUserId($user_id)
    {
        $this->container['user_id'] = $user_id;

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
     * @param string $type Notification type.
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
     * Gets path
     * @return string
     */
    public function getPath()
    {
        return $this->container['path'];
    }

    /**
     * Sets path
     * @param string $path Path to the item that the notification is set on.
     * @return $this
     */
    public function setPath($path)
    {
        $this->container['path'] = $path;

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
     * @param string $name Name of the item that the notification is set on.
     * @return $this
     */
    public function setName($name)
    {
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets action
     * @return string
     */
    public function getAction()
    {
        return $this->container['action'];
    }

    /**
     * Sets action
     * @param string $action Action that triggers notification.
     * @return $this
     */
    public function setAction($action)
    {
        $allowed_values = $this->getActionAllowableValues();
        if (!is_null($action) && !in_array($action, $allowed_values)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'action', must be one of '%s'",
                    implode("', '", $allowed_values)
                )
            );
        }
        $this->container['action'] = $action;

        return $this;
    }

    /**
     * Gets usernames
     * @return string[]
     */
    public function getUsernames()
    {
        return $this->container['usernames'];
    }

    /**
     * Sets usernames
     * @param string[] $usernames Detail on which users can trigger the notification.
     * @return $this
     */
    public function setUsernames($usernames)
    {
        $this->container['usernames'] = $usernames;

        return $this;
    }

    /**
     * Gets recipients
     * @return \Swagger\Client\Model\NotificationRecipient[]
     */
    public function getRecipients()
    {
        return $this->container['recipients'];
    }

    /**
     * Sets recipients
     * @param \Swagger\Client\Model\NotificationRecipient[] $recipients Notification recipients.
     * @return $this
     */
    public function setRecipients($recipients)
    {
        $this->container['recipients'] = $recipients;

        return $this;
    }

    /**
     * Gets recipient_emails
     * @return string[]
     */
    public function getRecipientEmails()
    {
        return $this->container['recipient_emails'];
    }

    /**
     * Sets recipient_emails
     * @param string[] $recipient_emails Email addresses of all recipients.
     * @return $this
     */
    public function setRecipientEmails($recipient_emails)
    {
        $this->container['recipient_emails'] = $recipient_emails;

        return $this;
    }

    /**
     * Gets send_email
     * @return string
     */
    public function getSendEmail()
    {
        return $this->container['send_email'];
    }

    /**
     * Sets send_email
     * @param string $send_email Send email when the notification is triggered.
     * @return $this
     */
    public function setSendEmail($send_email)
    {
        $allowed_values = $this->getSendEmailAllowableValues();
        if (!is_null($send_email) && !in_array($send_email, $allowed_values)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'send_email', must be one of '%s'",
                    implode("', '", $allowed_values)
                )
            );
        }
        $this->container['send_email'] = $send_email;

        return $this;
    }

    /**
     * Gets readable_description
     * @return string
     */
    public function getReadableDescription()
    {
        return $this->container['readable_description'];
    }

    /**
     * Sets readable_description
     * @param string $readable_description Human readable description of the notification.
     * @return $this
     */
    public function setReadableDescription($readable_description)
    {
        $this->container['readable_description'] = $readable_description;

        return $this;
    }

    /**
     * Gets readable_description_without_path
     * @return string
     */
    public function getReadableDescriptionWithoutPath()
    {
        return $this->container['readable_description_without_path'];
    }

    /**
     * Sets readable_description_without_path
     * @param string $readable_description_without_path Human readable description of the notification without item path.
     * @return $this
     */
    public function setReadableDescriptionWithoutPath($readable_description_without_path)
    {
        $this->container['readable_description_without_path'] = $readable_description_without_path;

        return $this;
    }

    /**
     * Gets share_id
     * @return string
     */
    public function getShareId()
    {
        return $this->container['share_id'];
    }

    /**
     * Sets share_id
     * @param string $share_id ID of the share that the notification belogns to.
     * @return $this
     */
    public function setShareId($share_id)
    {
        $this->container['share_id'] = $share_id;

        return $this;
    }

    /**
     * Gets message
     * @return string
     */
    public function getMessage()
    {
        return $this->container['message'];
    }

    /**
     * Sets message
     * @param string $message Custom message that will be sent to the notification recipients.
     * @return $this
     */
    public function setMessage($message)
    {
        $this->container['message'] = $message;

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
     * @param string $created Timestamp of notifiction creation.
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
     * @param string $modified Timestamp of notification modification.
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


