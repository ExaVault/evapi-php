<?php
/**
 * Body17
 *
 * PHP version 5
 *
 * @category Class
 * @package  ExaVault
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * ExaVault API
 *
 * See our API reference documentation at https://www.exavault.com/developer/api-docs/
 *
 * OpenAPI spec version: 2.0
 * Contact: support@exavault.com
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 * Swagger Codegen version: 3.0.22
 */
/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace ExaVault\Model;

use \ArrayAccess;
use \ExaVault\ObjectSerializer;

/**
 * Body17 Class Doc Comment
 *
 * @category Class
 * @package  ExaVault
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class Body17 implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'body_17';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'name' => 'string',
'resources' => 'string[]',
'access_mode' => 'string[]',
'embed' => 'bool',
'recipients' => '\ExaVault\Model\SharesRecipients[]',
'expiration' => '\DateTime',
'has_notification' => 'bool',
'is_public' => 'bool',
'message' => 'string',
'notification_emails' => 'string[]',
'password' => 'string',
'require_email' => 'bool',
'subject' => 'string',
'file_drop_create_folders' => 'bool',
'status' => 'int'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'name' => null,
'resources' => null,
'access_mode' => null,
'embed' => null,
'recipients' => null,
'expiration' => 'date-time',
'has_notification' => null,
'is_public' => null,
'message' => null,
'notification_emails' => 'email',
'password' => null,
'require_email' => null,
'subject' => null,
'file_drop_create_folders' => null,
'status' => null    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerTypes()
    {
        return self::$swaggerTypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerFormats()
    {
        return self::$swaggerFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'name' => 'name',
'resources' => 'resources',
'access_mode' => 'accessMode',
'embed' => 'embed',
'recipients' => 'recipients',
'expiration' => 'expiration',
'has_notification' => 'hasNotification',
'is_public' => 'isPublic',
'message' => 'message',
'notification_emails' => 'notificationEmails',
'password' => 'password',
'require_email' => 'requireEmail',
'subject' => 'subject',
'file_drop_create_folders' => 'fileDropCreateFolders',
'status' => 'status'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'name' => 'setName',
'resources' => 'setResources',
'access_mode' => 'setAccessMode',
'embed' => 'setEmbed',
'recipients' => 'setRecipients',
'expiration' => 'setExpiration',
'has_notification' => 'setHasNotification',
'is_public' => 'setIsPublic',
'message' => 'setMessage',
'notification_emails' => 'setNotificationEmails',
'password' => 'setPassword',
'require_email' => 'setRequireEmail',
'subject' => 'setSubject',
'file_drop_create_folders' => 'setFileDropCreateFolders',
'status' => 'setStatus'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'name' => 'getName',
'resources' => 'getResources',
'access_mode' => 'getAccessMode',
'embed' => 'getEmbed',
'recipients' => 'getRecipients',
'expiration' => 'getExpiration',
'has_notification' => 'getHasNotification',
'is_public' => 'getIsPublic',
'message' => 'getMessage',
'notification_emails' => 'getNotificationEmails',
'password' => 'getPassword',
'require_email' => 'getRequireEmail',
'subject' => 'getSubject',
'file_drop_create_folders' => 'getFileDropCreateFolders',
'status' => 'getStatus'    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$swaggerModelName;
    }

    

    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['resources'] = isset($data['resources']) ? $data['resources'] : null;
        $this->container['access_mode'] = isset($data['access_mode']) ? $data['access_mode'] : null;
        $this->container['embed'] = isset($data['embed']) ? $data['embed'] : null;
        $this->container['recipients'] = isset($data['recipients']) ? $data['recipients'] : null;
        $this->container['expiration'] = isset($data['expiration']) ? $data['expiration'] : null;
        $this->container['has_notification'] = isset($data['has_notification']) ? $data['has_notification'] : null;
        $this->container['is_public'] = isset($data['is_public']) ? $data['is_public'] : null;
        $this->container['message'] = isset($data['message']) ? $data['message'] : null;
        $this->container['notification_emails'] = isset($data['notification_emails']) ? $data['notification_emails'] : null;
        $this->container['password'] = isset($data['password']) ? $data['password'] : null;
        $this->container['require_email'] = isset($data['require_email']) ? $data['require_email'] : null;
        $this->container['subject'] = isset($data['subject']) ? $data['subject'] : null;
        $this->container['file_drop_create_folders'] = isset($data['file_drop_create_folders']) ? $data['file_drop_create_folders'] : null;
        $this->container['status'] = isset($data['status']) ? $data['status'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string $name Name of the share.
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets resources
     *
     * @return string[]
     */
    public function getResources()
    {
        return $this->container['resources'];
    }

    /**
     * Sets resources
     *
     * @param string[] $resources Array of resources for this share. See details on [how to specify resources](#section/Identifying-Resources) above.  **shared_folder** and **receive** shares must have only one `resource`, which is a directory that does not have a current share attached.  **send** shares may have multiple `resource` parameters.   **NOTE**: Sending this parameter will **REPLACE** the existing resources with the resources included in this request.
     *
     * @return $this
     */
    public function setResources($resources)
    {
        $this->container['resources'] = $resources;

        return $this;
    }

    /**
     * Gets access_mode
     *
     * @return string[]
     */
    public function getAccessMode()
    {
        return $this->container['access_mode'];
    }

    /**
     * Sets access_mode
     *
     * @param string[] $access_mode What visitors who view this share can do. Valid options include **download**, **upload**, **delete**, **modify**
     *
     * @return $this
     */
    public function setAccessMode($access_mode)
    {
        $this->container['access_mode'] = $access_mode;

        return $this;
    }

    /**
     * Gets embed
     *
     * @return bool
     */
    public function getEmbed()
    {
        return $this->container['embed'];
    }

    /**
     * Sets embed
     *
     * @param bool $embed Whether the share can be embedded in another web page.
     *
     * @return $this
     */
    public function setEmbed($embed)
    {
        $this->container['embed'] = $embed;

        return $this;
    }

    /**
     * Gets recipients
     *
     * @return \ExaVault\Model\SharesRecipients[]
     */
    public function getRecipients()
    {
        return $this->container['recipients'];
    }

    /**
     * Sets recipients
     *
     * @param \ExaVault\Model\SharesRecipients[] $recipients People you want to invite to the share.   **Note**: unless you also set the `subject` and `message` for the new share, invitation emails will not be sent to these recipients.  **Note**: Recipients in this list will **REPLACE** the recipients already assigned to this share.
     *
     * @return $this
     */
    public function setRecipients($recipients)
    {
        $this->container['recipients'] = $recipients;

        return $this;
    }

    /**
     * Gets expiration
     *
     * @return \DateTime
     */
    public function getExpiration()
    {
        return $this->container['expiration'];
    }

    /**
     * Sets expiration
     *
     * @param \DateTime $expiration New expiration date and time for the share
     *
     * @return $this
     */
    public function setExpiration($expiration)
    {
        $this->container['expiration'] = $expiration;

        return $this;
    }

    /**
     * Gets has_notification
     *
     * @return bool
     */
    public function getHasNotification()
    {
        return $this->container['has_notification'];
    }

    /**
     * Sets has_notification
     *
     * @param bool $has_notification Whether delivery receipts should be sent for this share.
     *
     * @return $this
     */
    public function setHasNotification($has_notification)
    {
        $this->container['has_notification'] = $has_notification;

        return $this;
    }

    /**
     * Gets is_public
     *
     * @return bool
     */
    public function getIsPublic()
    {
        return $this->container['is_public'];
    }

    /**
     * Sets is_public
     *
     * @param bool $is_public Whether people can visit the share without following a link from an invitation email
     *
     * @return $this
     */
    public function setIsPublic($is_public)
    {
        $this->container['is_public'] = $is_public;

        return $this;
    }

    /**
     * Gets message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->container['message'];
    }

    /**
     * Sets message
     *
     * @param string $message Message content to use for emails inviting recipients to the share. Ignored if you have not also provided `recipients` and a `subject`
     *
     * @return $this
     */
    public function setMessage($message)
    {
        $this->container['message'] = $message;

        return $this;
    }

    /**
     * Gets notification_emails
     *
     * @return string[]
     */
    public function getNotificationEmails()
    {
        return $this->container['notification_emails'];
    }

    /**
     * Sets notification_emails
     *
     * @param string[] $notification_emails List of email addresses to send delivery receipts to. Ignored if `hasNotification` is false.
     *
     * @return $this
     */
    public function setNotificationEmails($notification_emails)
    {
        $this->container['notification_emails'] = $notification_emails;

        return $this;
    }

    /**
     * Gets password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->container['password'];
    }

    /**
     * Sets password
     *
     * @param string $password New password for the share. To leave the password unchanged, do not send this parameter.
     *
     * @return $this
     */
    public function setPassword($password)
    {
        $this->container['password'] = $password;

        return $this;
    }

    /**
     * Gets require_email
     *
     * @return bool
     */
    public function getRequireEmail()
    {
        return $this->container['require_email'];
    }

    /**
     * Sets require_email
     *
     * @param bool $require_email Whether visitors to the share will be required to enter their email in order to access the share.
     *
     * @return $this
     */
    public function setRequireEmail($require_email)
    {
        $this->container['require_email'] = $require_email;

        return $this;
    }

    /**
     * Gets subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->container['subject'];
    }

    /**
     * Sets subject
     *
     * @param string $subject Subject to use on emails inviting recipients to the share. Ignored if you have not also provided `recipients` and a `message`
     *
     * @return $this
     */
    public function setSubject($subject)
    {
        $this->container['subject'] = $subject;

        return $this;
    }

    /**
     * Gets file_drop_create_folders
     *
     * @return bool
     */
    public function getFileDropCreateFolders()
    {
        return $this->container['file_drop_create_folders'];
    }

    /**
     * Sets file_drop_create_folders
     *
     * @param bool $file_drop_create_folders Whether uploads to a receive folder should be automatically placed into subfolders. See our [receive folder documentation](/docs/account/05-file-sharing/05-form-builder#advanced-form-settings)
     *
     * @return $this
     */
    public function setFileDropCreateFolders($file_drop_create_folders)
    {
        $this->container['file_drop_create_folders'] = $file_drop_create_folders;

        return $this;
    }

    /**
     * Gets status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     *
     * @param int $status New status for the share. You can set an active share to inactive by setting the status to **0**
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $this->container['status'] = $status;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     *
     * @param integer $offset Offset
     * @param mixed   $value  Value to be set
     *
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
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) { // use JSON pretty print
            return json_encode(
                ObjectSerializer::sanitizeForSerialization($this),
                JSON_PRETTY_PRINT
            );
        }

        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}
