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
        'masterAccount' => 'Account',
        'status' => 'int',
        'branding' => 'bool',
        'customDomain' => 'bool',
        'planCode' => 'string',
        'diskQuotaLimit' => 'string',
        'bandwidthQuotaLimit' => 'string',
        'diskQuotaUsed' => 'string',
        'bandwidthQuotaUsed' => 'string',
        'quotaNoticeEnabled' => 'string',
        'quotaNoticeThreshold' => 'string',
        'redirect' => 'string',
        'secureOnly' => 'bool',
        'complexPasswords' => 'bool',
        'showReferralLinks' => 'bool',
        'externalDomains' => 'string',
        'freeTrial' => 'bool',
        'appliedPromotion' => 'string',
        'clientId' => 'string',
        'created' => 'string',
        'modified' => 'string'

        );

    public $id; // int
    public $username; // string
    public $maxUsers; // int
    public $userCount; // int
    public $masterAccount; // Account
    public $status; // int
    public $branding; // bool
    public $customDomain; // bool
    public $planCode; // string
    public $diskQuotaLimit; // string
    public $bandwidthQuotaLimit; // string
    public $diskQuotaUsed; // string
    public $bandwidthQuotaUsed; // string
    public $quotaNoticeEnabled; // string
    public $quotaNoticeThreshold; // string
    public $redirect; // string
    public $secureOnly; // bool
    public $complexPasswords; // bool
    public $showReferralLinks; // bool
    public $externalDomains; // string
    public $freeTrial; // bool
    public $appliedPromotion; // string
    public $clientId; // string
    public $created; // string
    public $modified; // string
    }

