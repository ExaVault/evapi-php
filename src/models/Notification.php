<?php
/**
 * Notification.php
 *
 * Copyright 2014 ExaVault, Inc.
 *
 * NOTE: This file was generated automatically. Do not modify by hand.
 */

class Notification {

    static $swaggerTypes = array(
        'id' => 'int',
        'userId' => 'string',
        'type' => 'string',
        'path' => 'string',
        'name' => 'string',
        'action' => 'string',
        'usernames' => 'array[string]',
        'recipients' => 'array[Recipient]',
        'recipientEmails' => 'array[string]',
        'sendEmail' => 'string',
        'readableDescription' => 'string',
        'readableDescriptionWithoutPath' => 'string',
        'shareId' => 'string',
        'created' => 'string',
        'modified' => 'string'

        );

    public $id; // int
    public $userId; // string
    public $type; // string
    public $path; // string
    public $name; // string
    public $action; // string
    public $usernames; // array[string]
    public $recipients; // array[Recipient]
    public $recipientEmails; // array[string]
    public $sendEmail; // string
    public $readableDescription; // string
    public $readableDescriptionWithoutPath; // string
    public $shareId; // string
    public $created; // string
    public $modified; // string
    }

