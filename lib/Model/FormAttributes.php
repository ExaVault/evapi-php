<?php
/**
 * FormAttributes
 *
 * PHP version 5
 *
 * @category Class
 * @package  Swagger\Client
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
 * Swagger Codegen version: 3.0.20
 */
/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace Swagger\Client\Model;

use \ArrayAccess;
use \Swagger\Client\ObjectSerializer;

/**
 * FormAttributes Class Doc Comment
 *
 * @category Class
 * @description Attributes of the form including it&#x27;s included fields and css styles
 * @package  Swagger\Client
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class FormAttributes implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'FormAttributes';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'form_description' => 'string',
'submit_button_text' => 'string',
'success_message' => 'string',
'css_styles' => 'string',
'elements' => 'null[]'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'form_description' => null,
'submit_button_text' => null,
'success_message' => null,
'css_styles' => null,
'elements' => null    ];

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
        'form_description' => 'formDescription',
'submit_button_text' => 'submitButtonText',
'success_message' => 'successMessage',
'css_styles' => 'cssStyles',
'elements' => 'elements'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'form_description' => 'setFormDescription',
'submit_button_text' => 'setSubmitButtonText',
'success_message' => 'setSuccessMessage',
'css_styles' => 'setCssStyles',
'elements' => 'setElements'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'form_description' => 'getFormDescription',
'submit_button_text' => 'getSubmitButtonText',
'success_message' => 'getSuccessMessage',
'css_styles' => 'getCssStyles',
'elements' => 'getElements'    ];

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
        $this->container['form_description'] = isset($data['form_description']) ? $data['form_description'] : null;
        $this->container['submit_button_text'] = isset($data['submit_button_text']) ? $data['submit_button_text'] : null;
        $this->container['success_message'] = isset($data['success_message']) ? $data['success_message'] : null;
        $this->container['css_styles'] = isset($data['css_styles']) ? $data['css_styles'] : null;
        $this->container['elements'] = isset($data['elements']) ? $data['elements'] : null;
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
     * Gets form_description
     *
     * @return string
     */
    public function getFormDescription()
    {
        return $this->container['form_description'];
    }

    /**
     * Sets form_description
     *
     * @param string $form_description Text that appears at the top of a receive form
     *
     * @return $this
     */
    public function setFormDescription($form_description)
    {
        $this->container['form_description'] = $form_description;

        return $this;
    }

    /**
     * Gets submit_button_text
     *
     * @return string
     */
    public function getSubmitButtonText()
    {
        return $this->container['submit_button_text'];
    }

    /**
     * Sets submit_button_text
     *
     * @param string $submit_button_text Text that appears on the submit button for the form
     *
     * @return $this
     */
    public function setSubmitButtonText($submit_button_text)
    {
        $this->container['submit_button_text'] = $submit_button_text;

        return $this;
    }

    /**
     * Gets success_message
     *
     * @return string
     */
    public function getSuccessMessage()
    {
        return $this->container['success_message'];
    }

    /**
     * Sets success_message
     *
     * @param string $success_message Message displayed to submitter after files are uploaded
     *
     * @return $this
     */
    public function setSuccessMessage($success_message)
    {
        $this->container['success_message'] = $success_message;

        return $this;
    }

    /**
     * Gets css_styles
     *
     * @return string
     */
    public function getCssStyles()
    {
        return $this->container['css_styles'];
    }

    /**
     * Sets css_styles
     *
     * @param string $css_styles CSS Styles of the form.
     *
     * @return $this
     */
    public function setCssStyles($css_styles)
    {
        $this->container['css_styles'] = $css_styles;

        return $this;
    }

    /**
     * Gets elements
     *
     * @return null[]
     */
    public function getElements()
    {
        return $this->container['elements'];
    }

    /**
     * Sets elements
     *
     * @param null[] $elements Array of form fields defined for the form
     *
     * @return $this
     */
    public function setElements($elements)
    {
        $this->container['elements'] = $elements;

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