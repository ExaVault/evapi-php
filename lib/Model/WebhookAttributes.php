<?php
/**
 * WebhookAttributes
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
 * WebhookAttributes Class Doc Comment
 *
 * @category Class
 * @package  ExaVault
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class WebhookAttributes implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'WebhookAttributes';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'endpointUrl' => 'string',
'failed' => 'bool',
'verificationToken' => 'string',
'responseVersion' => 'string',
'triggers' => '\ExaVault\Model\WebhookTriggers',
'created' => '\DateTime',
'modified' => '\DateTime'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'endpointUrl' => 'uri',
'failed' => null,
'verificationToken' => null,
'responseVersion' => null,
'triggers' => null,
'created' => 'date-time',
'modified' => 'date-time'    ];

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
        'endpointUrl' => 'endpointUrl',
'failed' => 'failed',
'verificationToken' => 'verificationToken',
'responseVersion' => 'responseVersion',
'triggers' => 'triggers',
'created' => 'created',
'modified' => 'modified'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'endpointUrl' => 'setEndpointUrl',
'failed' => 'setFailed',
'verificationToken' => 'setVerificationToken',
'responseVersion' => 'setResponseVersion',
'triggers' => 'setTriggers',
'created' => 'setCreated',
'modified' => 'setModified'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'endpointUrl' => 'getEndpointUrl',
'failed' => 'getFailed',
'verificationToken' => 'getVerificationToken',
'responseVersion' => 'getResponseVersion',
'triggers' => 'getTriggers',
'created' => 'getCreated',
'modified' => 'getModified'    ];

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

    const RESPONSE_VERSION_V1 = 'v1';
const RESPONSE_VERSION_V2 = 'v2';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getResponseVersionAllowableValues()
    {
        return [
            self::RESPONSE_VERSION_V1,
self::RESPONSE_VERSION_V2,        ];
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
        $this->container['endpointUrl'] = isset($data['endpointUrl']) ? $data['endpointUrl'] : null;
        $this->container['failed'] = isset($data['failed']) ? $data['failed'] : null;
        $this->container['verificationToken'] = isset($data['verificationToken']) ? $data['verificationToken'] : null;
        $this->container['responseVersion'] = isset($data['responseVersion']) ? $data['responseVersion'] : null;
        $this->container['triggers'] = isset($data['triggers']) ? $data['triggers'] : null;
        $this->container['created'] = isset($data['created']) ? $data['created'] : null;
        $this->container['modified'] = isset($data['modified']) ? $data['modified'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        $allowedValues = $this->getResponseVersionAllowableValues();
        if (!is_null($this->container['responseVersion']) && !in_array($this->container['responseVersion'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'responseVersion', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

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
     * Gets endpointUrl
     *
     * @return string
     */
    public function getEndpointUrl()
    {
        return $this->container['endpointUrl'];
    }

    /**
     * Sets endpointUrl
     *
     * @param string $endpointUrl The endpoint is where the webhook request will be sent.
     *
     * @return $this
     */
    public function setEndpointUrl($endpointUrl)
    {
        $this->container['endpointUrl'] = $endpointUrl;

        return $this;
    }

    /**
     * Gets failed
     *
     * @return bool
     */
    public function getFailed()
    {
        return $this->container['failed'];
    }

    /**
     * Sets failed
     *
     * @param bool $failed Whether webhook has been disabled for too many consecutive failures
     *
     * @return $this
     */
    public function setFailed($failed)
    {
        $this->container['failed'] = $failed;

        return $this;
    }

    /**
     * Gets verificationToken
     *
     * @return string
     */
    public function getVerificationToken()
    {
        return $this->container['verificationToken'];
    }

    /**
     * Sets verificationToken
     *
     * @param string $verificationToken Token for verifying sender is ExaVault
     *
     * @return $this
     */
    public function setVerificationToken($verificationToken)
    {
        $this->container['verificationToken'] = $verificationToken;

        return $this;
    }

    /**
     * Gets responseVersion
     *
     * @return string
     */
    public function getResponseVersion()
    {
        return $this->container['responseVersion'];
    }

    /**
     * Sets responseVersion
     *
     * @param string $responseVersion The version of webhook request to send to the endpoint URL
     *
     * @return $this
     */
    public function setResponseVersion($responseVersion)
    {
        $allowedValues = $this->getResponseVersionAllowableValues();
        if (!is_null($responseVersion) && !in_array($responseVersion, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'responseVersion', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['responseVersion'] = $responseVersion;

        return $this;
    }

    /**
     * Gets triggers
     *
     * @return \ExaVault\Model\WebhookTriggers
     */
    public function getTriggers()
    {
        return $this->container['triggers'];
    }

    /**
     * Sets triggers
     *
     * @param \ExaVault\Model\WebhookTriggers $triggers triggers
     *
     * @return $this
     */
    public function setTriggers($triggers)
    {
        $this->container['triggers'] = $triggers;

        return $this;
    }

    /**
     * Gets created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->container['created'];
    }

    /**
     * Sets created
     *
     * @param \DateTime $created Timestamp when webhook configuration was added to system.
     *
     * @return $this
     */
    public function setCreated($created)
    {
        $this->container['created'] = $created;

        return $this;
    }

    /**
     * Gets modified
     *
     * @return \DateTime
     */
    public function getModified()
    {
        return $this->container['modified'];
    }

    /**
     * Sets modified
     *
     * @param \DateTime $modified Timestamp when webhook configuration was last modified
     *
     * @return $this
     */
    public function setModified($modified)
    {
        $this->container['modified'] = $modified;

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