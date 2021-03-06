<?php
/**
 * WebhookV2Details
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
 * WebhookV2Details Class Doc Comment
 *
 * @category Class
 * @package  ExaVault
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class WebhookV2Details implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'WebhookV2Details';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'attemptId' => 'string',
'accountName' => 'string',
'eventTimestamp' => '\DateTime',
'ipAddress' => 'string',
'protocol' => 'string',
'username' => 'string',
'event' => 'string',
'eventData' => '\ExaVault\Model\WebhookV2EventData'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'attemptId' => null,
'accountName' => null,
'eventTimestamp' => 'date-time',
'ipAddress' => null,
'protocol' => null,
'username' => null,
'event' => null,
'eventData' => null    ];

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
        'attemptId' => 'attemptId',
'accountName' => 'accountName',
'eventTimestamp' => 'eventTimestamp',
'ipAddress' => 'ipAddress',
'protocol' => 'protocol',
'username' => 'username',
'event' => 'event',
'eventData' => 'eventData'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'attemptId' => 'setAttemptId',
'accountName' => 'setAccountName',
'eventTimestamp' => 'setEventTimestamp',
'ipAddress' => 'setIpAddress',
'protocol' => 'setProtocol',
'username' => 'setUsername',
'event' => 'setEvent',
'eventData' => 'setEventData'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'attemptId' => 'getAttemptId',
'accountName' => 'getAccountName',
'eventTimestamp' => 'getEventTimestamp',
'ipAddress' => 'getIpAddress',
'protocol' => 'getProtocol',
'username' => 'getUsername',
'event' => 'getEvent',
'eventData' => 'getEventData'    ];

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
        $this->container['attemptId'] = isset($data['attemptId']) ? $data['attemptId'] : null;
        $this->container['accountName'] = isset($data['accountName']) ? $data['accountName'] : null;
        $this->container['eventTimestamp'] = isset($data['eventTimestamp']) ? $data['eventTimestamp'] : null;
        $this->container['ipAddress'] = isset($data['ipAddress']) ? $data['ipAddress'] : null;
        $this->container['protocol'] = isset($data['protocol']) ? $data['protocol'] : null;
        $this->container['username'] = isset($data['username']) ? $data['username'] : null;
        $this->container['event'] = isset($data['event']) ? $data['event'] : null;
        $this->container['eventData'] = isset($data['eventData']) ? $data['eventData'] : null;
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
     * Gets attemptId
     *
     * @return string
     */
    public function getAttemptId()
    {
        return $this->container['attemptId'];
    }

    /**
     * Sets attemptId
     *
     * @param string $attemptId Entry - retry identifier
     *
     * @return $this
     */
    public function setAttemptId($attemptId)
    {
        $this->container['attemptId'] = $attemptId;

        return $this;
    }

    /**
     * Gets accountName
     *
     * @return string
     */
    public function getAccountName()
    {
        return $this->container['accountName'];
    }

    /**
     * Sets accountName
     *
     * @param string $accountName Account master username
     *
     * @return $this
     */
    public function setAccountName($accountName)
    {
        $this->container['accountName'] = $accountName;

        return $this;
    }

    /**
     * Gets eventTimestamp
     *
     * @return \DateTime
     */
    public function getEventTimestamp()
    {
        return $this->container['eventTimestamp'];
    }

    /**
     * Sets eventTimestamp
     *
     * @param \DateTime $eventTimestamp Date and time event originally took place
     *
     * @return $this
     */
    public function setEventTimestamp($eventTimestamp)
    {
        $this->container['eventTimestamp'] = $eventTimestamp;

        return $this;
    }

    /**
     * Gets ipAddress
     *
     * @return string
     */
    public function getIpAddress()
    {
        return $this->container['ipAddress'];
    }

    /**
     * Sets ipAddress
     *
     * @param string $ipAddress IP address of related activity
     *
     * @return $this
     */
    public function setIpAddress($ipAddress)
    {
        $this->container['ipAddress'] = $ipAddress;

        return $this;
    }

    /**
     * Gets protocol
     *
     * @return string
     */
    public function getProtocol()
    {
        return $this->container['protocol'];
    }

    /**
     * Sets protocol
     *
     * @param string $protocol Type of connection used for related activity
     *
     * @return $this
     */
    public function setProtocol($protocol)
    {
        $this->container['protocol'] = $protocol;

        return $this;
    }

    /**
     * Gets username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->container['username'];
    }

    /**
     * Sets username
     *
     * @param string $username Username logged for related activity. May refer to someone who is not a user of the account, such as a share recipient or \"publ
     *
     * @return $this
     */
    public function setUsername($username)
    {
        $this->container['username'] = $username;

        return $this;
    }

    /**
     * Gets event
     *
     * @return string
     */
    public function getEvent()
    {
        return $this->container['event'];
    }

    /**
     * Sets event
     *
     * @param string $event Type of related activity
     *
     * @return $this
     */
    public function setEvent($event)
    {
        $this->container['event'] = $event;

        return $this;
    }

    /**
     * Gets eventData
     *
     * @return \ExaVault\Model\WebhookV2EventData
     */
    public function getEventData()
    {
        return $this->container['eventData'];
    }

    /**
     * Sets eventData
     *
     * @param \ExaVault\Model\WebhookV2EventData $eventData eventData
     *
     * @return $this
     */
    public function setEventData($eventData)
    {
        $this->container['eventData'] = $eventData;

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
