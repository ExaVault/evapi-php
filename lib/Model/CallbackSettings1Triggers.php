<?php
/**
 * CallbackSettings1Triggers
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
 * CallbackSettings1Triggers Class Doc Comment
 *
 * @category Class
 * @description Whether a webhook should be sent for various operations.
 * @package  Swagger\Client
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class CallbackSettings1Triggers implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'CallbackSettings_1_triggers';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'download' => 'bool',
'upload' => 'bool',
'delete' => 'bool',
'create_folder' => 'bool',
'rename' => 'bool',
'move' => 'bool',
'copy' => 'bool',
'compress' => 'bool',
'extract' => 'bool',
'share_folder' => 'bool',
'send_files' => 'bool',
'receive_files' => 'bool',
'update_share' => 'bool',
'update_receive' => 'bool',
'delete_send' => 'bool',
'delete_receive' => 'bool',
'delete_share' => 'bool',
'create_notification' => 'bool',
'update_notification' => 'bool',
'delete_notification' => 'bool',
'create_user' => 'bool',
'update_user' => 'bool',
'delete_user' => 'bool',
'user_connect' => 'bool',
'user_disconnect' => 'bool'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'download' => null,
'upload' => null,
'delete' => null,
'create_folder' => null,
'rename' => null,
'move' => null,
'copy' => null,
'compress' => null,
'extract' => null,
'share_folder' => null,
'send_files' => null,
'receive_files' => null,
'update_share' => null,
'update_receive' => null,
'delete_send' => null,
'delete_receive' => null,
'delete_share' => null,
'create_notification' => null,
'update_notification' => null,
'delete_notification' => null,
'create_user' => null,
'update_user' => null,
'delete_user' => null,
'user_connect' => null,
'user_disconnect' => null    ];

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
        'download' => 'download',
'upload' => 'upload',
'delete' => 'delete',
'create_folder' => 'createFolder',
'rename' => 'rename',
'move' => 'move',
'copy' => 'copy',
'compress' => 'compress',
'extract' => 'extract',
'share_folder' => 'shareFolder',
'send_files' => 'sendFiles',
'receive_files' => 'receiveFiles',
'update_share' => 'updateShare',
'update_receive' => 'updateReceive',
'delete_send' => 'deleteSend',
'delete_receive' => 'deleteReceive',
'delete_share' => 'deleteShare',
'create_notification' => 'createNotification',
'update_notification' => 'updateNotification',
'delete_notification' => 'deleteNotification',
'create_user' => 'createUser',
'update_user' => 'updateUser',
'delete_user' => 'deleteUser',
'user_connect' => 'userConnect',
'user_disconnect' => 'userDisconnect'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'download' => 'setDownload',
'upload' => 'setUpload',
'delete' => 'setDelete',
'create_folder' => 'setCreateFolder',
'rename' => 'setRename',
'move' => 'setMove',
'copy' => 'setCopy',
'compress' => 'setCompress',
'extract' => 'setExtract',
'share_folder' => 'setShareFolder',
'send_files' => 'setSendFiles',
'receive_files' => 'setReceiveFiles',
'update_share' => 'setUpdateShare',
'update_receive' => 'setUpdateReceive',
'delete_send' => 'setDeleteSend',
'delete_receive' => 'setDeleteReceive',
'delete_share' => 'setDeleteShare',
'create_notification' => 'setCreateNotification',
'update_notification' => 'setUpdateNotification',
'delete_notification' => 'setDeleteNotification',
'create_user' => 'setCreateUser',
'update_user' => 'setUpdateUser',
'delete_user' => 'setDeleteUser',
'user_connect' => 'setUserConnect',
'user_disconnect' => 'setUserDisconnect'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'download' => 'getDownload',
'upload' => 'getUpload',
'delete' => 'getDelete',
'create_folder' => 'getCreateFolder',
'rename' => 'getRename',
'move' => 'getMove',
'copy' => 'getCopy',
'compress' => 'getCompress',
'extract' => 'getExtract',
'share_folder' => 'getShareFolder',
'send_files' => 'getSendFiles',
'receive_files' => 'getReceiveFiles',
'update_share' => 'getUpdateShare',
'update_receive' => 'getUpdateReceive',
'delete_send' => 'getDeleteSend',
'delete_receive' => 'getDeleteReceive',
'delete_share' => 'getDeleteShare',
'create_notification' => 'getCreateNotification',
'update_notification' => 'getUpdateNotification',
'delete_notification' => 'getDeleteNotification',
'create_user' => 'getCreateUser',
'update_user' => 'getUpdateUser',
'delete_user' => 'getDeleteUser',
'user_connect' => 'getUserConnect',
'user_disconnect' => 'getUserDisconnect'    ];

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
        $this->container['download'] = isset($data['download']) ? $data['download'] : null;
        $this->container['upload'] = isset($data['upload']) ? $data['upload'] : null;
        $this->container['delete'] = isset($data['delete']) ? $data['delete'] : null;
        $this->container['create_folder'] = isset($data['create_folder']) ? $data['create_folder'] : null;
        $this->container['rename'] = isset($data['rename']) ? $data['rename'] : null;
        $this->container['move'] = isset($data['move']) ? $data['move'] : null;
        $this->container['copy'] = isset($data['copy']) ? $data['copy'] : null;
        $this->container['compress'] = isset($data['compress']) ? $data['compress'] : null;
        $this->container['extract'] = isset($data['extract']) ? $data['extract'] : null;
        $this->container['share_folder'] = isset($data['share_folder']) ? $data['share_folder'] : null;
        $this->container['send_files'] = isset($data['send_files']) ? $data['send_files'] : null;
        $this->container['receive_files'] = isset($data['receive_files']) ? $data['receive_files'] : null;
        $this->container['update_share'] = isset($data['update_share']) ? $data['update_share'] : null;
        $this->container['update_receive'] = isset($data['update_receive']) ? $data['update_receive'] : null;
        $this->container['delete_send'] = isset($data['delete_send']) ? $data['delete_send'] : null;
        $this->container['delete_receive'] = isset($data['delete_receive']) ? $data['delete_receive'] : null;
        $this->container['delete_share'] = isset($data['delete_share']) ? $data['delete_share'] : null;
        $this->container['create_notification'] = isset($data['create_notification']) ? $data['create_notification'] : null;
        $this->container['update_notification'] = isset($data['update_notification']) ? $data['update_notification'] : null;
        $this->container['delete_notification'] = isset($data['delete_notification']) ? $data['delete_notification'] : null;
        $this->container['create_user'] = isset($data['create_user']) ? $data['create_user'] : null;
        $this->container['update_user'] = isset($data['update_user']) ? $data['update_user'] : null;
        $this->container['delete_user'] = isset($data['delete_user']) ? $data['delete_user'] : null;
        $this->container['user_connect'] = isset($data['user_connect']) ? $data['user_connect'] : null;
        $this->container['user_disconnect'] = isset($data['user_disconnect']) ? $data['user_disconnect'] : null;
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
     * Gets download
     *
     * @return bool
     */
    public function getDownload()
    {
        return $this->container['download'];
    }

    /**
     * Sets download
     *
     * @param bool $download download
     *
     * @return $this
     */
    public function setDownload($download)
    {
        $this->container['download'] = $download;

        return $this;
    }

    /**
     * Gets upload
     *
     * @return bool
     */
    public function getUpload()
    {
        return $this->container['upload'];
    }

    /**
     * Sets upload
     *
     * @param bool $upload upload
     *
     * @return $this
     */
    public function setUpload($upload)
    {
        $this->container['upload'] = $upload;

        return $this;
    }

    /**
     * Gets delete
     *
     * @return bool
     */
    public function getDelete()
    {
        return $this->container['delete'];
    }

    /**
     * Sets delete
     *
     * @param bool $delete delete
     *
     * @return $this
     */
    public function setDelete($delete)
    {
        $this->container['delete'] = $delete;

        return $this;
    }

    /**
     * Gets create_folder
     *
     * @return bool
     */
    public function getCreateFolder()
    {
        return $this->container['create_folder'];
    }

    /**
     * Sets create_folder
     *
     * @param bool $create_folder create_folder
     *
     * @return $this
     */
    public function setCreateFolder($create_folder)
    {
        $this->container['create_folder'] = $create_folder;

        return $this;
    }

    /**
     * Gets rename
     *
     * @return bool
     */
    public function getRename()
    {
        return $this->container['rename'];
    }

    /**
     * Sets rename
     *
     * @param bool $rename rename
     *
     * @return $this
     */
    public function setRename($rename)
    {
        $this->container['rename'] = $rename;

        return $this;
    }

    /**
     * Gets move
     *
     * @return bool
     */
    public function getMove()
    {
        return $this->container['move'];
    }

    /**
     * Sets move
     *
     * @param bool $move move
     *
     * @return $this
     */
    public function setMove($move)
    {
        $this->container['move'] = $move;

        return $this;
    }

    /**
     * Gets copy
     *
     * @return bool
     */
    public function getCopy()
    {
        return $this->container['copy'];
    }

    /**
     * Sets copy
     *
     * @param bool $copy copy
     *
     * @return $this
     */
    public function setCopy($copy)
    {
        $this->container['copy'] = $copy;

        return $this;
    }

    /**
     * Gets compress
     *
     * @return bool
     */
    public function getCompress()
    {
        return $this->container['compress'];
    }

    /**
     * Sets compress
     *
     * @param bool $compress compress
     *
     * @return $this
     */
    public function setCompress($compress)
    {
        $this->container['compress'] = $compress;

        return $this;
    }

    /**
     * Gets extract
     *
     * @return bool
     */
    public function getExtract()
    {
        return $this->container['extract'];
    }

    /**
     * Sets extract
     *
     * @param bool $extract extract
     *
     * @return $this
     */
    public function setExtract($extract)
    {
        $this->container['extract'] = $extract;

        return $this;
    }

    /**
     * Gets share_folder
     *
     * @return bool
     */
    public function getShareFolder()
    {
        return $this->container['share_folder'];
    }

    /**
     * Sets share_folder
     *
     * @param bool $share_folder share_folder
     *
     * @return $this
     */
    public function setShareFolder($share_folder)
    {
        $this->container['share_folder'] = $share_folder;

        return $this;
    }

    /**
     * Gets send_files
     *
     * @return bool
     */
    public function getSendFiles()
    {
        return $this->container['send_files'];
    }

    /**
     * Sets send_files
     *
     * @param bool $send_files send_files
     *
     * @return $this
     */
    public function setSendFiles($send_files)
    {
        $this->container['send_files'] = $send_files;

        return $this;
    }

    /**
     * Gets receive_files
     *
     * @return bool
     */
    public function getReceiveFiles()
    {
        return $this->container['receive_files'];
    }

    /**
     * Sets receive_files
     *
     * @param bool $receive_files receive_files
     *
     * @return $this
     */
    public function setReceiveFiles($receive_files)
    {
        $this->container['receive_files'] = $receive_files;

        return $this;
    }

    /**
     * Gets update_share
     *
     * @return bool
     */
    public function getUpdateShare()
    {
        return $this->container['update_share'];
    }

    /**
     * Sets update_share
     *
     * @param bool $update_share update_share
     *
     * @return $this
     */
    public function setUpdateShare($update_share)
    {
        $this->container['update_share'] = $update_share;

        return $this;
    }

    /**
     * Gets update_receive
     *
     * @return bool
     */
    public function getUpdateReceive()
    {
        return $this->container['update_receive'];
    }

    /**
     * Sets update_receive
     *
     * @param bool $update_receive update_receive
     *
     * @return $this
     */
    public function setUpdateReceive($update_receive)
    {
        $this->container['update_receive'] = $update_receive;

        return $this;
    }

    /**
     * Gets delete_send
     *
     * @return bool
     */
    public function getDeleteSend()
    {
        return $this->container['delete_send'];
    }

    /**
     * Sets delete_send
     *
     * @param bool $delete_send delete_send
     *
     * @return $this
     */
    public function setDeleteSend($delete_send)
    {
        $this->container['delete_send'] = $delete_send;

        return $this;
    }

    /**
     * Gets delete_receive
     *
     * @return bool
     */
    public function getDeleteReceive()
    {
        return $this->container['delete_receive'];
    }

    /**
     * Sets delete_receive
     *
     * @param bool $delete_receive delete_receive
     *
     * @return $this
     */
    public function setDeleteReceive($delete_receive)
    {
        $this->container['delete_receive'] = $delete_receive;

        return $this;
    }

    /**
     * Gets delete_share
     *
     * @return bool
     */
    public function getDeleteShare()
    {
        return $this->container['delete_share'];
    }

    /**
     * Sets delete_share
     *
     * @param bool $delete_share delete_share
     *
     * @return $this
     */
    public function setDeleteShare($delete_share)
    {
        $this->container['delete_share'] = $delete_share;

        return $this;
    }

    /**
     * Gets create_notification
     *
     * @return bool
     */
    public function getCreateNotification()
    {
        return $this->container['create_notification'];
    }

    /**
     * Sets create_notification
     *
     * @param bool $create_notification create_notification
     *
     * @return $this
     */
    public function setCreateNotification($create_notification)
    {
        $this->container['create_notification'] = $create_notification;

        return $this;
    }

    /**
     * Gets update_notification
     *
     * @return bool
     */
    public function getUpdateNotification()
    {
        return $this->container['update_notification'];
    }

    /**
     * Sets update_notification
     *
     * @param bool $update_notification update_notification
     *
     * @return $this
     */
    public function setUpdateNotification($update_notification)
    {
        $this->container['update_notification'] = $update_notification;

        return $this;
    }

    /**
     * Gets delete_notification
     *
     * @return bool
     */
    public function getDeleteNotification()
    {
        return $this->container['delete_notification'];
    }

    /**
     * Sets delete_notification
     *
     * @param bool $delete_notification delete_notification
     *
     * @return $this
     */
    public function setDeleteNotification($delete_notification)
    {
        $this->container['delete_notification'] = $delete_notification;

        return $this;
    }

    /**
     * Gets create_user
     *
     * @return bool
     */
    public function getCreateUser()
    {
        return $this->container['create_user'];
    }

    /**
     * Sets create_user
     *
     * @param bool $create_user create_user
     *
     * @return $this
     */
    public function setCreateUser($create_user)
    {
        $this->container['create_user'] = $create_user;

        return $this;
    }

    /**
     * Gets update_user
     *
     * @return bool
     */
    public function getUpdateUser()
    {
        return $this->container['update_user'];
    }

    /**
     * Sets update_user
     *
     * @param bool $update_user update_user
     *
     * @return $this
     */
    public function setUpdateUser($update_user)
    {
        $this->container['update_user'] = $update_user;

        return $this;
    }

    /**
     * Gets delete_user
     *
     * @return bool
     */
    public function getDeleteUser()
    {
        return $this->container['delete_user'];
    }

    /**
     * Sets delete_user
     *
     * @param bool $delete_user delete_user
     *
     * @return $this
     */
    public function setDeleteUser($delete_user)
    {
        $this->container['delete_user'] = $delete_user;

        return $this;
    }

    /**
     * Gets user_connect
     *
     * @return bool
     */
    public function getUserConnect()
    {
        return $this->container['user_connect'];
    }

    /**
     * Sets user_connect
     *
     * @param bool $user_connect user_connect
     *
     * @return $this
     */
    public function setUserConnect($user_connect)
    {
        $this->container['user_connect'] = $user_connect;

        return $this;
    }

    /**
     * Gets user_disconnect
     *
     * @return bool
     */
    public function getUserDisconnect()
    {
        return $this->container['user_disconnect'];
    }

    /**
     * Sets user_disconnect
     *
     * @param bool $user_disconnect user_disconnect
     *
     * @return $this
     */
    public function setUserDisconnect($user_disconnect)
    {
        $this->container['user_disconnect'] = $user_disconnect;

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
