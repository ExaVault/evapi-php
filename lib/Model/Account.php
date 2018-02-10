<?php
/**
 * Account
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
 * Account Class Doc Comment
 *
 * @category    Class
 * @description Object contains all account properties.
 * @package     Swagger\Client
 * @author      Swagger Codegen team
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class Account implements ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      * @var string
      */
    protected static $swaggerModelName = 'Account';

    /**
      * Array of property to type mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerTypes = [
        'id' => 'int',
        'username' => 'string',
        'max_users' => 'int',
        'user_count' => 'int',
        'master_account' => '\Swagger\Client\Model\User',
        'status' => 'int',
        'branding' => 'bool',
        'custom_domain' => 'bool',
        'plan_code' => 'string',
        'package_id' => 'int',
        'disk_quota_limit' => 'int',
        'bandwidth_quota_limit' => 'int',
        'disk_quota_used' => 'int',
        'bandwidth_quota_used' => 'int',
        'quota_notice_enabled' => 'int',
        'quota_notice_threshold' => 'int',
        'redirect' => 'string',
        'secure_only' => 'bool',
        'complex_passwords' => 'bool',
        'show_referral_links' => 'bool',
        'external_domains' => 'string',
        'allowed_ip' => 'string',
        'callback_settings' => '\Swagger\Client\Model\CallbackSettings',
        'free_trial' => 'bool',
        'applied_trial' => 'string',
        'client_id' => 'int',
        'welcome_email_content' => 'string',
        'welcome_email_subject' => 'string',
        'custom_signature' => 'string',
        'created' => 'string',
        'modified' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerFormats = [
        'id' => 'int32',
        'username' => null,
        'max_users' => 'int32',
        'user_count' => 'int32',
        'master_account' => null,
        'status' => 'int32',
        'branding' => null,
        'custom_domain' => null,
        'plan_code' => null,
        'package_id' => 'int32',
        'disk_quota_limit' => 'int64',
        'bandwidth_quota_limit' => 'int64',
        'disk_quota_used' => 'int64',
        'bandwidth_quota_used' => 'int64',
        'quota_notice_enabled' => 'int32',
        'quota_notice_threshold' => 'int32',
        'redirect' => null,
        'secure_only' => null,
        'complex_passwords' => null,
        'show_referral_links' => null,
        'external_domains' => null,
        'allowed_ip' => null,
        'callback_settings' => null,
        'free_trial' => null,
        'applied_trial' => null,
        'client_id' => 'int32',
        'welcome_email_content' => null,
        'welcome_email_subject' => null,
        'custom_signature' => null,
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
        'username' => 'username',
        'max_users' => 'maxUsers',
        'user_count' => 'userCount',
        'master_account' => 'masterAccount',
        'status' => 'status',
        'branding' => 'branding',
        'custom_domain' => 'customDomain',
        'plan_code' => 'planCode',
        'package_id' => 'packageId',
        'disk_quota_limit' => 'diskQuotaLimit',
        'bandwidth_quota_limit' => 'bandwidthQuotaLimit',
        'disk_quota_used' => 'diskQuotaUsed',
        'bandwidth_quota_used' => 'bandwidthQuotaUsed',
        'quota_notice_enabled' => 'quotaNoticeEnabled',
        'quota_notice_threshold' => 'quotaNoticeThreshold',
        'redirect' => 'redirect',
        'secure_only' => 'secureOnly',
        'complex_passwords' => 'complexPasswords',
        'show_referral_links' => 'showReferralLinks',
        'external_domains' => 'externalDomains',
        'allowed_ip' => 'allowedIp',
        'callback_settings' => 'callbackSettings',
        'free_trial' => 'freeTrial',
        'applied_trial' => 'appliedTrial',
        'client_id' => 'clientId',
        'welcome_email_content' => 'welcomeEmailContent',
        'welcome_email_subject' => 'welcomeEmailSubject',
        'custom_signature' => 'customSignature',
        'created' => 'created',
        'modified' => 'modified'
    ];


    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'username' => 'setUsername',
        'max_users' => 'setMaxUsers',
        'user_count' => 'setUserCount',
        'master_account' => 'setMasterAccount',
        'status' => 'setStatus',
        'branding' => 'setBranding',
        'custom_domain' => 'setCustomDomain',
        'plan_code' => 'setPlanCode',
        'package_id' => 'setPackageId',
        'disk_quota_limit' => 'setDiskQuotaLimit',
        'bandwidth_quota_limit' => 'setBandwidthQuotaLimit',
        'disk_quota_used' => 'setDiskQuotaUsed',
        'bandwidth_quota_used' => 'setBandwidthQuotaUsed',
        'quota_notice_enabled' => 'setQuotaNoticeEnabled',
        'quota_notice_threshold' => 'setQuotaNoticeThreshold',
        'redirect' => 'setRedirect',
        'secure_only' => 'setSecureOnly',
        'complex_passwords' => 'setComplexPasswords',
        'show_referral_links' => 'setShowReferralLinks',
        'external_domains' => 'setExternalDomains',
        'allowed_ip' => 'setAllowedIp',
        'callback_settings' => 'setCallbackSettings',
        'free_trial' => 'setFreeTrial',
        'applied_trial' => 'setAppliedTrial',
        'client_id' => 'setClientId',
        'welcome_email_content' => 'setWelcomeEmailContent',
        'welcome_email_subject' => 'setWelcomeEmailSubject',
        'custom_signature' => 'setCustomSignature',
        'created' => 'setCreated',
        'modified' => 'setModified'
    ];


    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'username' => 'getUsername',
        'max_users' => 'getMaxUsers',
        'user_count' => 'getUserCount',
        'master_account' => 'getMasterAccount',
        'status' => 'getStatus',
        'branding' => 'getBranding',
        'custom_domain' => 'getCustomDomain',
        'plan_code' => 'getPlanCode',
        'package_id' => 'getPackageId',
        'disk_quota_limit' => 'getDiskQuotaLimit',
        'bandwidth_quota_limit' => 'getBandwidthQuotaLimit',
        'disk_quota_used' => 'getDiskQuotaUsed',
        'bandwidth_quota_used' => 'getBandwidthQuotaUsed',
        'quota_notice_enabled' => 'getQuotaNoticeEnabled',
        'quota_notice_threshold' => 'getQuotaNoticeThreshold',
        'redirect' => 'getRedirect',
        'secure_only' => 'getSecureOnly',
        'complex_passwords' => 'getComplexPasswords',
        'show_referral_links' => 'getShowReferralLinks',
        'external_domains' => 'getExternalDomains',
        'allowed_ip' => 'getAllowedIp',
        'callback_settings' => 'getCallbackSettings',
        'free_trial' => 'getFreeTrial',
        'applied_trial' => 'getAppliedTrial',
        'client_id' => 'getClientId',
        'welcome_email_content' => 'getWelcomeEmailContent',
        'welcome_email_subject' => 'getWelcomeEmailSubject',
        'custom_signature' => 'getCustomSignature',
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

    const STATUS_1 = 1;
    const STATUS_0 = 0;
    const REDIRECT_SWFT = 'swft';
    const REDIRECT_APP = 'app';
    

    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public function getStatusAllowableValues()
    {
        return [
            self::STATUS_1,
            self::STATUS_0,
        ];
    }
    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public function getRedirectAllowableValues()
    {
        return [
            self::REDIRECT_SWFT,
            self::REDIRECT_APP,
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
        $this->container['username'] = isset($data['username']) ? $data['username'] : null;
        $this->container['max_users'] = isset($data['max_users']) ? $data['max_users'] : null;
        $this->container['user_count'] = isset($data['user_count']) ? $data['user_count'] : null;
        $this->container['master_account'] = isset($data['master_account']) ? $data['master_account'] : null;
        $this->container['status'] = isset($data['status']) ? $data['status'] : null;
        $this->container['branding'] = isset($data['branding']) ? $data['branding'] : null;
        $this->container['custom_domain'] = isset($data['custom_domain']) ? $data['custom_domain'] : null;
        $this->container['plan_code'] = isset($data['plan_code']) ? $data['plan_code'] : null;
        $this->container['package_id'] = isset($data['package_id']) ? $data['package_id'] : null;
        $this->container['disk_quota_limit'] = isset($data['disk_quota_limit']) ? $data['disk_quota_limit'] : null;
        $this->container['bandwidth_quota_limit'] = isset($data['bandwidth_quota_limit']) ? $data['bandwidth_quota_limit'] : null;
        $this->container['disk_quota_used'] = isset($data['disk_quota_used']) ? $data['disk_quota_used'] : null;
        $this->container['bandwidth_quota_used'] = isset($data['bandwidth_quota_used']) ? $data['bandwidth_quota_used'] : null;
        $this->container['quota_notice_enabled'] = isset($data['quota_notice_enabled']) ? $data['quota_notice_enabled'] : null;
        $this->container['quota_notice_threshold'] = isset($data['quota_notice_threshold']) ? $data['quota_notice_threshold'] : null;
        $this->container['redirect'] = isset($data['redirect']) ? $data['redirect'] : null;
        $this->container['secure_only'] = isset($data['secure_only']) ? $data['secure_only'] : null;
        $this->container['complex_passwords'] = isset($data['complex_passwords']) ? $data['complex_passwords'] : null;
        $this->container['show_referral_links'] = isset($data['show_referral_links']) ? $data['show_referral_links'] : null;
        $this->container['external_domains'] = isset($data['external_domains']) ? $data['external_domains'] : null;
        $this->container['allowed_ip'] = isset($data['allowed_ip']) ? $data['allowed_ip'] : null;
        $this->container['callback_settings'] = isset($data['callback_settings']) ? $data['callback_settings'] : null;
        $this->container['free_trial'] = isset($data['free_trial']) ? $data['free_trial'] : null;
        $this->container['applied_trial'] = isset($data['applied_trial']) ? $data['applied_trial'] : null;
        $this->container['client_id'] = isset($data['client_id']) ? $data['client_id'] : null;
        $this->container['welcome_email_content'] = isset($data['welcome_email_content']) ? $data['welcome_email_content'] : null;
        $this->container['welcome_email_subject'] = isset($data['welcome_email_subject']) ? $data['welcome_email_subject'] : null;
        $this->container['custom_signature'] = isset($data['custom_signature']) ? $data['custom_signature'] : null;
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

        $allowed_values = $this->getStatusAllowableValues();
        if (!in_array($this->container['status'], $allowed_values)) {
            $invalid_properties[] = sprintf(
                "invalid value for 'status', must be one of '%s'",
                implode("', '", $allowed_values)
            );
        }

        $allowed_values = $this->getRedirectAllowableValues();
        if (!in_array($this->container['redirect'], $allowed_values)) {
            $invalid_properties[] = sprintf(
                "invalid value for 'redirect', must be one of '%s'",
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
        $allowed_values = $this->getRedirectAllowableValues();
        if (!in_array($this->container['redirect'], $allowed_values)) {
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
     * @param int $id ID of the account.
     * @return $this
     */
    public function setId($id)
    {
        $this->container['id'] = $id;

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
     * @param string $username Name of the account.
     * @return $this
     */
    public function setUsername($username)
    {
        $this->container['username'] = $username;

        return $this;
    }

    /**
     * Gets max_users
     * @return int
     */
    public function getMaxUsers()
    {
        return $this->container['max_users'];
    }

    /**
     * Sets max_users
     * @param int $max_users Maximum number of users the account can have. This can be increased by contacting ExaVault Support.
     * @return $this
     */
    public function setMaxUsers($max_users)
    {
        $this->container['max_users'] = $max_users;

        return $this;
    }

    /**
     * Gets user_count
     * @return int
     */
    public function getUserCount()
    {
        return $this->container['user_count'];
    }

    /**
     * Sets user_count
     * @param int $user_count Current number of users on the account.
     * @return $this
     */
    public function setUserCount($user_count)
    {
        $this->container['user_count'] = $user_count;

        return $this;
    }

    /**
     * Gets master_account
     * @return \Swagger\Client\Model\User
     */
    public function getMasterAccount()
    {
        return $this->container['master_account'];
    }

    /**
     * Sets master_account
     * @param \Swagger\Client\Model\User $master_account Master user object.
     * @return $this
     */
    public function setMasterAccount($master_account)
    {
        $this->container['master_account'] = $master_account;

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
     * @param int $status Account status flag. A one (1) means the account is active; zero (0) means it is suspended.
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
     * Gets branding
     * @return bool
     */
    public function getBranding()
    {
        return $this->container['branding'];
    }

    /**
     * Sets branding
     * @param bool $branding Branding flag. Set to `true` if the account has branding functionality enabled.
     * @return $this
     */
    public function setBranding($branding)
    {
        $this->container['branding'] = $branding;

        return $this;
    }

    /**
     * Gets custom_domain
     * @return bool
     */
    public function getCustomDomain()
    {
        return $this->container['custom_domain'];
    }

    /**
     * Sets custom_domain
     * @param bool $custom_domain Custom domain flag. Set to `true` if account has custom domain functionality enabled.
     * @return $this
     */
    public function setCustomDomain($custom_domain)
    {
        $this->container['custom_domain'] = $custom_domain;

        return $this;
    }

    /**
     * Gets plan_code
     * @return string
     */
    public function getPlanCode()
    {
        return $this->container['plan_code'];
    }

    /**
     * Sets plan_code
     * @param string $plan_code Code of the plan account is signed up for.
     * @return $this
     */
    public function setPlanCode($plan_code)
    {
        $this->container['plan_code'] = $plan_code;

        return $this;
    }

    /**
     * Gets package_id
     * @return int
     */
    public function getPackageId()
    {
        return $this->container['package_id'];
    }

    /**
     * Sets package_id
     * @param int $package_id Internal ID of the package that the account is signed for.
     * @return $this
     */
    public function setPackageId($package_id)
    {
        $this->container['package_id'] = $package_id;

        return $this;
    }

    /**
     * Gets disk_quota_limit
     * @return int
     */
    public function getDiskQuotaLimit()
    {
        return $this->container['disk_quota_limit'];
    }

    /**
     * Sets disk_quota_limit
     * @param int $disk_quota_limit Amount of disk space that the account has available to it. This may be increased by upgrading to a larger plan.
     * @return $this
     */
    public function setDiskQuotaLimit($disk_quota_limit)
    {
        $this->container['disk_quota_limit'] = $disk_quota_limit;

        return $this;
    }

    /**
     * Gets bandwidth_quota_limit
     * @return int
     */
    public function getBandwidthQuotaLimit()
    {
        return $this->container['bandwidth_quota_limit'];
    }

    /**
     * Sets bandwidth_quota_limit
     * @param int $bandwidth_quota_limit Amount of bandwidth that the account has available before a warning is generated. All ExaVault accounts include unlimited bandwidth, but we flag high-bandwidth users.
     * @return $this
     */
    public function setBandwidthQuotaLimit($bandwidth_quota_limit)
    {
        $this->container['bandwidth_quota_limit'] = $bandwidth_quota_limit;

        return $this;
    }

    /**
     * Gets disk_quota_used
     * @return int
     */
    public function getDiskQuotaUsed()
    {
        return $this->container['disk_quota_used'];
    }

    /**
     * Sets disk_quota_used
     * @param int $disk_quota_used Amount of disk space currently in use.
     * @return $this
     */
    public function setDiskQuotaUsed($disk_quota_used)
    {
        $this->container['disk_quota_used'] = $disk_quota_used;

        return $this;
    }

    /**
     * Gets bandwidth_quota_used
     * @return int
     */
    public function getBandwidthQuotaUsed()
    {
        return $this->container['bandwidth_quota_used'];
    }

    /**
     * Sets bandwidth_quota_used
     * @param int $bandwidth_quota_used Amount of bandwidth used by this account in the last billing period.
     * @return $this
     */
    public function setBandwidthQuotaUsed($bandwidth_quota_used)
    {
        $this->container['bandwidth_quota_used'] = $bandwidth_quota_used;

        return $this;
    }

    /**
     * Gets quota_notice_enabled
     * @return int
     */
    public function getQuotaNoticeEnabled()
    {
        return $this->container['quota_notice_enabled'];
    }

    /**
     * Sets quota_notice_enabled
     * @param int $quota_notice_enabled Should a quota warning be sent to the account owner when a threshold level of space utilization is reached?
     * @return $this
     */
    public function setQuotaNoticeEnabled($quota_notice_enabled)
    {
        $this->container['quota_notice_enabled'] = $quota_notice_enabled;

        return $this;
    }

    /**
     * Gets quota_notice_threshold
     * @return int
     */
    public function getQuotaNoticeThreshold()
    {
        return $this->container['quota_notice_threshold'];
    }

    /**
     * Sets quota_notice_threshold
     * @param int $quota_notice_threshold Treshold that triggers a quota notification.
     * @return $this
     */
    public function setQuotaNoticeThreshold($quota_notice_threshold)
    {
        $this->container['quota_notice_threshold'] = $quota_notice_threshold;

        return $this;
    }

    /**
     * Gets redirect
     * @return string
     */
    public function getRedirect()
    {
        return $this->container['redirect'];
    }

    /**
     * Sets redirect
     * @param string $redirect Internal flag indicating which version of our web interface will be used.
     * @return $this
     */
    public function setRedirect($redirect)
    {
        $allowed_values = $this->getRedirectAllowableValues();
        if (!is_null($redirect) && !in_array($redirect, $allowed_values)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'redirect', must be one of '%s'",
                    implode("', '", $allowed_values)
                )
            );
        }
        $this->container['redirect'] = $redirect;

        return $this;
    }

    /**
     * Gets secure_only
     * @return bool
     */
    public function getSecureOnly()
    {
        return $this->container['secure_only'];
    }

    /**
     * Sets secure_only
     * @param bool $secure_only Flag to indicate whether the account disables connections via insecure protocols (e.g. FTP).
     * @return $this
     */
    public function setSecureOnly($secure_only)
    {
        $this->container['secure_only'] = $secure_only;

        return $this;
    }

    /**
     * Gets complex_passwords
     * @return bool
     */
    public function getComplexPasswords()
    {
        return $this->container['complex_passwords'];
    }

    /**
     * Sets complex_passwords
     * @param bool $complex_passwords Flag to indicate whether the account requires complex passwords.
     * @return $this
     */
    public function setComplexPasswords($complex_passwords)
    {
        $this->container['complex_passwords'] = $complex_passwords;

        return $this;
    }

    /**
     * Gets show_referral_links
     * @return bool
     */
    public function getShowReferralLinks()
    {
        return $this->container['show_referral_links'];
    }

    /**
     * Sets show_referral_links
     * @param bool $show_referral_links Flag to indicate showing of referrals links in the account.
     * @return $this
     */
    public function setShowReferralLinks($show_referral_links)
    {
        $this->container['show_referral_links'] = $show_referral_links;

        return $this;
    }

    /**
     * Gets external_domains
     * @return string
     */
    public function getExternalDomains()
    {
        return $this->container['external_domains'];
    }

    /**
     * Sets external_domains
     * @param string $external_domains Custom domain used to brand this account.
     * @return $this
     */
    public function setExternalDomains($external_domains)
    {
        $this->container['external_domains'] = $external_domains;

        return $this;
    }

    /**
     * Gets allowed_ip
     * @return string
     */
    public function getAllowedIp()
    {
        return $this->container['allowed_ip'];
    }

    /**
     * Sets allowed_ip
     * @param string $allowed_ip Range of IP addresses allowed to access this account.
     * @return $this
     */
    public function setAllowedIp($allowed_ip)
    {
        $this->container['allowed_ip'] = $allowed_ip;

        return $this;
    }

    /**
     * Gets callback_settings
     * @return \Swagger\Client\Model\CallbackSettings
     */
    public function getCallbackSettings()
    {
        return $this->container['callback_settings'];
    }

    /**
     * Sets callback_settings
     * @param \Swagger\Client\Model\CallbackSettings $callback_settings Callback settings of the account.
     * @return $this
     */
    public function setCallbackSettings($callback_settings)
    {
        $this->container['callback_settings'] = $callback_settings;

        return $this;
    }

    /**
     * Gets free_trial
     * @return bool
     */
    public function getFreeTrial()
    {
        return $this->container['free_trial'];
    }

    /**
     * Sets free_trial
     * @param bool $free_trial Flag indicates if free trial enabled.
     * @return $this
     */
    public function setFreeTrial($free_trial)
    {
        $this->container['free_trial'] = $free_trial;

        return $this;
    }

    /**
     * Gets applied_trial
     * @return string
     */
    public function getAppliedTrial()
    {
        return $this->container['applied_trial'];
    }

    /**
     * Sets applied_trial
     * @param string $applied_trial Free trial description.
     * @return $this
     */
    public function setAppliedTrial($applied_trial)
    {
        $this->container['applied_trial'] = $applied_trial;

        return $this;
    }

    /**
     * Gets client_id
     * @return int
     */
    public function getClientId()
    {
        return $this->container['client_id'];
    }

    /**
     * Sets client_id
     * @param int $client_id ID of the account in our client system.
     * @return $this
     */
    public function setClientId($client_id)
    {
        $this->container['client_id'] = $client_id;

        return $this;
    }

    /**
     * Gets welcome_email_content
     * @return string
     */
    public function getWelcomeEmailContent()
    {
        return $this->container['welcome_email_content'];
    }

    /**
     * Sets welcome_email_content
     * @param string $welcome_email_content Content of welcome email each new user will receive.
     * @return $this
     */
    public function setWelcomeEmailContent($welcome_email_content)
    {
        $this->container['welcome_email_content'] = $welcome_email_content;

        return $this;
    }

    /**
     * Gets welcome_email_subject
     * @return string
     */
    public function getWelcomeEmailSubject()
    {
        return $this->container['welcome_email_subject'];
    }

    /**
     * Sets welcome_email_subject
     * @param string $welcome_email_subject Subject of welcome email each new user will receive.
     * @return $this
     */
    public function setWelcomeEmailSubject($welcome_email_subject)
    {
        $this->container['welcome_email_subject'] = $welcome_email_subject;

        return $this;
    }

    /**
     * Gets custom_signature
     * @return string
     */
    public function getCustomSignature()
    {
        return $this->container['custom_signature'];
    }

    /**
     * Sets custom_signature
     * @param string $custom_signature Custom signature for all account emails users or recipients will receive.
     * @return $this
     */
    public function setCustomSignature($custom_signature)
    {
        $this->container['custom_signature'] = $custom_signature;

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
     * @param string $created Timestamp of account creation.
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
     * @param string $modified Timestamp of account modification.
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


