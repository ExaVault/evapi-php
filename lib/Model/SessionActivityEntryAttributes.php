<?php
/**
 * SessionActivityEntryAttributes
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
 * SessionActivityEntryAttributes Class Doc Comment
 *
 * @category Class
 * @package  ExaVault
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class SessionActivityEntryAttributes implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'SessionActivityEntry_attributes';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'bytesTransferred' => 'int',
'created' => 'string',
'duration' => 'int',
'fileName' => 'string',
'fileSource' => 'string',
'ipAddress' => 'string',
'operation' => 'string',
'protocol' => 'string',
'sessionId' => 'string',
'status' => 'string',
'username' => 'string'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'bytesTransferred' => 'int64',
'created' => null,
'duration' => null,
'fileName' => null,
'fileSource' => null,
'ipAddress' => null,
'operation' => null,
'protocol' => null,
'sessionId' => null,
'status' => null,
'username' => null    ];

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
        'bytesTransferred' => 'bytesTransferred',
'created' => 'created',
'duration' => 'duration',
'fileName' => 'fileName',
'fileSource' => 'fileSource',
'ipAddress' => 'ipAddress',
'operation' => 'operation',
'protocol' => 'protocol',
'sessionId' => 'sessionId',
'status' => 'status',
'username' => 'username'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'bytesTransferred' => 'setBytesTransferred',
'created' => 'setCreated',
'duration' => 'setDuration',
'fileName' => 'setFileName',
'fileSource' => 'setFileSource',
'ipAddress' => 'setIpAddress',
'operation' => 'setOperation',
'protocol' => 'setProtocol',
'sessionId' => 'setSessionId',
'status' => 'setStatus',
'username' => 'setUsername'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'bytesTransferred' => 'getBytesTransferred',
'created' => 'getCreated',
'duration' => 'getDuration',
'fileName' => 'getFileName',
'fileSource' => 'getFileSource',
'ipAddress' => 'getIpAddress',
'operation' => 'getOperation',
'protocol' => 'getProtocol',
'sessionId' => 'getSessionId',
'status' => 'getStatus',
'username' => 'getUsername'    ];

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
        $this->container['bytesTransferred'] = isset($data['bytesTransferred']) ? $data['bytesTransferred'] : null;
        $this->container['created'] = isset($data['created']) ? $data['created'] : null;
        $this->container['duration'] = isset($data['duration']) ? $data['duration'] : null;
        $this->container['fileName'] = isset($data['fileName']) ? $data['fileName'] : null;
        $this->container['fileSource'] = isset($data['fileSource']) ? $data['fileSource'] : null;
        $this->container['ipAddress'] = isset($data['ipAddress']) ? $data['ipAddress'] : null;
        $this->container['operation'] = isset($data['operation']) ? $data['operation'] : null;
        $this->container['protocol'] = isset($data['protocol']) ? $data['protocol'] : null;
        $this->container['sessionId'] = isset($data['sessionId']) ? $data['sessionId'] : null;
        $this->container['status'] = isset($data['status']) ? $data['status'] : null;
        $this->container['username'] = isset($data['username']) ? $data['username'] : null;
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
     * Gets bytesTransferred
     *
     * @return int
     */
    public function getBytesTransferred()
    {
        return $this->container['bytesTransferred'];
    }

    /**
     * Sets bytesTransferred
     *
     * @param int $bytesTransferred bytesTransferred
     *
     * @return $this
     */
    public function setBytesTransferred($bytesTransferred)
    {
        $this->container['bytesTransferred'] = $bytesTransferred;

        return $this;
    }

    /**
     * Gets created
     *
     * @return string
     */
    public function getCreated()
    {
        return $this->container['created'];
    }

    /**
     * Sets created
     *
     * @param string $created created
     *
     * @return $this
     */
    public function setCreated($created)
    {
        $this->container['created'] = $created;

        return $this;
    }

    /**
     * Gets duration
     *
     * @return int
     */
    public function getDuration()
    {
        return $this->container['duration'];
    }

    /**
     * Sets duration
     *
     * @param int $duration duration
     *
     * @return $this
     */
    public function setDuration($duration)
    {
        $this->container['duration'] = $duration;

        return $this;
    }

    /**
     * Gets fileName
     *
     * @return string
     */
    public function getFileName()
    {
        return $this->container['fileName'];
    }

    /**
     * Sets fileName
     *
     * @param string $fileName fileName
     *
     * @return $this
     */
    public function setFileName($fileName)
    {
        $this->container['fileName'] = $fileName;

        return $this;
    }

    /**
     * Gets fileSource
     *
     * @return string
     */
    public function getFileSource()
    {
        return $this->container['fileSource'];
    }

    /**
     * Sets fileSource
     *
     * @param string $fileSource fileSource
     *
     * @return $this
     */
    public function setFileSource($fileSource)
    {
        $this->container['fileSource'] = $fileSource;

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
     * @param string $ipAddress ipAddress
     *
     * @return $this
     */
    public function setIpAddress($ipAddress)
    {
        $this->container['ipAddress'] = $ipAddress;

        return $this;
    }

    /**
     * Gets operation
     *
     * @return string
     */
    public function getOperation()
    {
        return $this->container['operation'];
    }

    /**
     * Sets operation
     *
     * @param string $operation operation
     *
     * @return $this
     */
    public function setOperation($operation)
    {
        $this->container['operation'] = $operation;

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
     * @param string $protocol protocol
     *
     * @return $this
     */
    public function setProtocol($protocol)
    {
        $this->container['protocol'] = $protocol;

        return $this;
    }

    /**
     * Gets sessionId
     *
     * @return string
     */
    public function getSessionId()
    {
        return $this->container['sessionId'];
    }

    /**
     * Sets sessionId
     *
     * @param string $sessionId sessionId
     *
     * @return $this
     */
    public function setSessionId($sessionId)
    {
        $this->container['sessionId'] = $sessionId;

        return $this;
    }

    /**
     * Gets status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     *
     * @param string $status status
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $this->container['status'] = $status;

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
     * @param string $username username
     *
     * @return $this
     */
    public function setUsername($username)
    {
        $this->container['username'] = $username;

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
