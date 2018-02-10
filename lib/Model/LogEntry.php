<?php
/**
 * LogEntry
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
 * LogEntry Class Doc Comment
 *
 * @category    Class
 * @package     Swagger\Client
 * @author      Swagger Codegen team
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class LogEntry implements ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      * @var string
      */
    protected static $swaggerModelName = 'LogEntry';

    /**
      * Array of property to type mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerTypes = [
        'file_name' => 'string',
        'file_source' => 'string',
        'operation' => 'string',
        'duration' => 'string',
        'bytes_transferred' => 'string',
        'id' => 'string',
        'created' => 'string',
        'username' => 'string',
        'session_id' => 'string',
        'ip_address' => 'string',
        'protocol' => 'string',
        'status' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerFormats = [
        'file_name' => null,
        'file_source' => null,
        'operation' => null,
        'duration' => null,
        'bytes_transferred' => null,
        'id' => null,
        'created' => 'YYYY-mm-dd hh:mm:ss',
        'username' => null,
        'session_id' => null,
        'ip_address' => null,
        'protocol' => null,
        'status' => null
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
        'file_name' => 'fileName',
        'file_source' => 'fileSource',
        'operation' => 'operation',
        'duration' => 'duration',
        'bytes_transferred' => 'bytesTransferred',
        'id' => 'id',
        'created' => 'created',
        'username' => 'username',
        'session_id' => 'sessionId',
        'ip_address' => 'ipAddress',
        'protocol' => 'protocol',
        'status' => 'status'
    ];


    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = [
        'file_name' => 'setFileName',
        'file_source' => 'setFileSource',
        'operation' => 'setOperation',
        'duration' => 'setDuration',
        'bytes_transferred' => 'setBytesTransferred',
        'id' => 'setId',
        'created' => 'setCreated',
        'username' => 'setUsername',
        'session_id' => 'setSessionId',
        'ip_address' => 'setIpAddress',
        'protocol' => 'setProtocol',
        'status' => 'setStatus'
    ];


    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = [
        'file_name' => 'getFileName',
        'file_source' => 'getFileSource',
        'operation' => 'getOperation',
        'duration' => 'getDuration',
        'bytes_transferred' => 'getBytesTransferred',
        'id' => 'getId',
        'created' => 'getCreated',
        'username' => 'getUsername',
        'session_id' => 'getSessionId',
        'ip_address' => 'getIpAddress',
        'protocol' => 'getProtocol',
        'status' => 'getStatus'
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

    const OPERATION_PASS = 'PASS';
    const OPERATION__EXIT = 'EXIT';
    const OPERATION_STOR = 'STOR';
    const OPERATION_RETR = 'RETR';
    const OPERATION_DELE = 'DELE';
    const OPERATION_MKD = 'MKD';
    const OPERATION_RMD = 'RMD';
    const OPERATION_RNTO = 'RNTO';
    const OPERATION_COPY = 'COPY';
    const OPERATION_MOVE = 'MOVE';
    const OPERATION_SEND = 'SEND';
    const OPERATION_SHARE = 'SHARE';
    const OPERATION_RECV = 'RECV';
    const OPERATION_NOTIFY = 'NOTIFY';
    const OPERATION_EDIT_SEND = 'EDIT_SEND';
    const OPERATION_EDIT_SHARE = 'EDIT_SHARE';
    const OPERATION_EDIT_RECV = 'EDIT_RECV';
    const OPERATION_EDIT_NTFY = 'EDIT_NTFY';
    const OPERATION_EDIT_USER = 'EDIT_USER';
    const OPERATION_DELE_SEND = 'DELE_SEND';
    const OPERATION_DELE_SHARE = 'DELE_SHARE';
    const OPERATION_DELE_NTFY = 'DELE_NTFY';
    const OPERATION_DELE_USER = 'DELE_USER';
    const OPERATION_DELE_RECV = 'DELE_RECV';
    const OPERATION_COMPR = 'COMPR';
    const OPERATION_EXTRACT = 'EXTRACT';
    const OPERATION_DFA = 'DFA';
    const OPERATION_EDIT_DFA = 'EDIT_DFA';
    const OPERATION_DELE_DFA = 'DELE_DFA';
    

    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public function getOperationAllowableValues()
    {
        return [
            self::OPERATION_PASS,
            self::OPERATION__EXIT,
            self::OPERATION_STOR,
            self::OPERATION_RETR,
            self::OPERATION_DELE,
            self::OPERATION_MKD,
            self::OPERATION_RMD,
            self::OPERATION_RNTO,
            self::OPERATION_COPY,
            self::OPERATION_MOVE,
            self::OPERATION_SEND,
            self::OPERATION_SHARE,
            self::OPERATION_RECV,
            self::OPERATION_NOTIFY,
            self::OPERATION_EDIT_SEND,
            self::OPERATION_EDIT_SHARE,
            self::OPERATION_EDIT_RECV,
            self::OPERATION_EDIT_NTFY,
            self::OPERATION_EDIT_USER,
            self::OPERATION_DELE_SEND,
            self::OPERATION_DELE_SHARE,
            self::OPERATION_DELE_NTFY,
            self::OPERATION_DELE_USER,
            self::OPERATION_DELE_RECV,
            self::OPERATION_COMPR,
            self::OPERATION_EXTRACT,
            self::OPERATION_DFA,
            self::OPERATION_EDIT_DFA,
            self::OPERATION_DELE_DFA,
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
        $this->container['file_name'] = isset($data['file_name']) ? $data['file_name'] : null;
        $this->container['file_source'] = isset($data['file_source']) ? $data['file_source'] : null;
        $this->container['operation'] = isset($data['operation']) ? $data['operation'] : null;
        $this->container['duration'] = isset($data['duration']) ? $data['duration'] : null;
        $this->container['bytes_transferred'] = isset($data['bytes_transferred']) ? $data['bytes_transferred'] : null;
        $this->container['id'] = isset($data['id']) ? $data['id'] : null;
        $this->container['created'] = isset($data['created']) ? $data['created'] : null;
        $this->container['username'] = isset($data['username']) ? $data['username'] : null;
        $this->container['session_id'] = isset($data['session_id']) ? $data['session_id'] : null;
        $this->container['ip_address'] = isset($data['ip_address']) ? $data['ip_address'] : null;
        $this->container['protocol'] = isset($data['protocol']) ? $data['protocol'] : null;
        $this->container['status'] = isset($data['status']) ? $data['status'] : null;
    }

    /**
     * show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalid_properties = [];

        $allowed_values = $this->getOperationAllowableValues();
        if (!in_array($this->container['operation'], $allowed_values)) {
            $invalid_properties[] = sprintf(
                "invalid value for 'operation', must be one of '%s'",
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

        $allowed_values = $this->getOperationAllowableValues();
        if (!in_array($this->container['operation'], $allowed_values)) {
            return false;
        }
        return true;
    }


    /**
     * Gets file_name
     * @return string
     */
    public function getFileName()
    {
        return $this->container['file_name'];
    }

    /**
     * Sets file_name
     * @param string $file_name Current resource path.
     * @return $this
     */
    public function setFileName($file_name)
    {
        $this->container['file_name'] = $file_name;

        return $this;
    }

    /**
     * Gets file_source
     * @return string
     */
    public function getFileSource()
    {
        return $this->container['file_source'];
    }

    /**
     * Sets file_source
     * @param string $file_source Original path to the resource. Can be null if operation type not move or copy.
     * @return $this
     */
    public function setFileSource($file_source)
    {
        $this->container['file_source'] = $file_source;

        return $this;
    }

    /**
     * Gets operation
     * @return string
     */
    public function getOperation()
    {
        return $this->container['operation'];
    }

    /**
     * Sets operation
     * @param string $operation Type of operation that happened in the account.
     * @return $this
     */
    public function setOperation($operation)
    {
        $allowed_values = $this->getOperationAllowableValues();
        if (!is_null($operation) && !in_array($operation, $allowed_values)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'operation', must be one of '%s'",
                    implode("', '", $allowed_values)
                )
            );
        }
        $this->container['operation'] = $operation;

        return $this;
    }

    /**
     * Gets duration
     * @return string
     */
    public function getDuration()
    {
        return $this->container['duration'];
    }

    /**
     * Sets duration
     * @param string $duration Duration of the operation.
     * @return $this
     */
    public function setDuration($duration)
    {
        $this->container['duration'] = $duration;

        return $this;
    }

    /**
     * Gets bytes_transferred
     * @return string
     */
    public function getBytesTransferred()
    {
        return $this->container['bytes_transferred'];
    }

    /**
     * Sets bytes_transferred
     * @param string $bytes_transferred Amount of bytes transfered during the operation.
     * @return $this
     */
    public function setBytesTransferred($bytes_transferred)
    {
        $this->container['bytes_transferred'] = $bytes_transferred;

        return $this;
    }

    /**
     * Gets id
     * @return string
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     * @param string $id ID of the log entry.
     * @return $this
     */
    public function setId($id)
    {
        $this->container['id'] = $id;

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
     * @param string $created Timestamp of the operation.
     * @return $this
     */
    public function setCreated($created)
    {
        $this->container['created'] = $created;

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
     * @param string $username Name of the user who triggered the operation.
     * @return $this
     */
    public function setUsername($username)
    {
        $this->container['username'] = $username;

        return $this;
    }

    /**
     * Gets session_id
     * @return string
     */
    public function getSessionId()
    {
        return $this->container['session_id'];
    }

    /**
     * Sets session_id
     * @param string $session_id ID of user's session.
     * @return $this
     */
    public function setSessionId($session_id)
    {
        $this->container['session_id'] = $session_id;

        return $this;
    }

    /**
     * Gets ip_address
     * @return string
     */
    public function getIpAddress()
    {
        return $this->container['ip_address'];
    }

    /**
     * Sets ip_address
     * @param string $ip_address IP address of the connected client.
     * @return $this
     */
    public function setIpAddress($ip_address)
    {
        $this->container['ip_address'] = $ip_address;

        return $this;
    }

    /**
     * Gets protocol
     * @return string
     */
    public function getProtocol()
    {
        return $this->container['protocol'];
    }

    /**
     * Sets protocol
     * @param string $protocol Protocol used for the operation. Protocol can vary on type of application you or your users used to work with your account. Some of possible values are `SWFT`, `APP`, `SFTP`, `FTP`, `FTPS`.
     * @return $this
     */
    public function setProtocol($protocol)
    {
        $this->container['protocol'] = $protocol;

        return $this;
    }

    /**
     * Gets status
     * @return string
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     * @param string $status Operation status.
     * @return $this
     */
    public function setStatus($status)
    {
        $this->container['status'] = $status;

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


