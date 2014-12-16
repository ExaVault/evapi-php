<?php
/**
 * Share.php
 *
 * Copyright 2014 ExaVault, Inc.
 *
 * NOTE: This file was generated automatically. Do not modify by hand.
 */

class Share {

    static $swaggerTypes = array(
        'id' => 'int',
        'name' => 'string',
        'hasPassword' => 'bool',
        'isPublic' => 'bool',
        'accessMode' => 'string',
        'accessDescription' => 'string',
        'embed' => 'bool',
        'hash' => 'string',
        'ownerHash' => 'string',
        'expiration' => 'string',
        'trackingStatus' => 'string',
        'expired' => 'string',
        'resent' => 'bool',
        'owner' => 'int',
        'ownerUsername' => 'string',
        'type' => 'string',
        'requireEmail' => 'bool',
        'fileDropCreateFolders' => 'bool',
        'paths' => 'array[string]',
        'recipients' => 'array[Recipient]',
        'recipientsWithOwner' => 'array[Recipient]',
        'messages' => 'array[Message]',
        'inherited' => 'bool',
        'status' => 'int',
        'hasNotification' => 'bool',
        'notification' => 'string',
        'created' => 'string',
        'modified' => 'string'

        );

    public $id; // int
    public $name; // string
    public $hasPassword; // bool
    public $isPublic; // bool
    public $accessMode; // string
    public $accessDescription; // string
    public $embed; // bool
    public $hash; // string
    public $ownerHash; // string
    public $expiration; // string
    public $trackingStatus; // string
    public $expired; // string
    public $resent; // bool
    public $owner; // int
    public $ownerUsername; // string
    public $type; // string
    public $requireEmail; // bool
    public $fileDropCreateFolders; // bool
    public $paths; // array[string]
    public $recipients; // array[Recipient]
    public $recipientsWithOwner; // array[Recipient]
    public $messages; // array[Message]
    public $inherited; // bool
    public $status; // int
    public $hasNotification; // bool
    public $notification; // string
    public $created; // string
    public $modified; // string
    }

