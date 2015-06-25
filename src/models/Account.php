<?php
/**
 * Account.php
 *
 * Copyright 2014 ExaVault, Inc.
 *
 * NOTE: This file was generated automatically. Do not modify by hand.
 */

class Account {

    static $swaggerTypes = array(
        'id' => 'int',
        'username' => 'string',
        'maxUsers' => 'int',
        'userCount' => 'int',
        'masterAccount' => 'User',
        'status' => 'int',
        'branding' => 'bool',
        'customDomain' => 'bool',
        'planCode' => 'string',
        'diskQuotaLimit' => 'int',
        'bandwidthQuotaLimit' => 'int',
        'diskQuotaUsed' => 'int',
        'bandwidthQuotaUsed' => 'int',
        'quotaNoticeEnabled' => 'int',
        'quotaNoticeThreshold' => 'int',
        'redirect' => 'string',
        'secureOnly' => 'bool',
        'complexPasswords' => 'bool',
        'showReferralLinks' => 'bool',
        'externalDomains' => 'string',
        'freeTrial' => 'bool',
        'appliedTrial' => 'string',
        'clientId' => 'int',
        'created' => 'string',
        'modified' => 'string'

        );

    public $id; // int
    public $username; // string
    public $maxUsers; // int
    public $userCount; // int
    public $masterAccount; // User
    public $status; // int
    public $branding; // bool
    public $customDomain; // bool
    public $planCode; // string
    public $diskQuotaLimit; // int
    public $bandwidthQuotaLimit; // int
    public $diskQuotaUsed; // int
    public $bandwidthQuotaUsed; // int
    public $quotaNoticeEnabled; // int
    public $quotaNoticeThreshold; // int
    public $redirect; // string
    public $secureOnly; // bool
    public $complexPasswords; // bool
    public $showReferralLinks; // bool
    public $externalDomains; // string
    public $freeTrial; // bool
    public $appliedTrial; // string
    public $clientId; // int
    public $created; // string
    public $modified; // string
    }

