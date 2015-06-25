<?php
/**
 * Copyright 2014 ExaVault, Inc.
 *
 * NOTE: This file was generated automatically. Do not modify by hand.
 */

class V1Api {

    function __construct($apiClient) {
        $this->apiClient = $apiClient;
    }

    /**
     * authenticateUser
     * Authenticates a user into the API
     * username, string: Name of of user to authenticate (required)
     * password, string: User's password (required)
     * @return AuthResponse
     */

    public function authenticateUser($username, $password) {

        // parse inputs
        $resourcePath = "/v1/authenticateUser";
        $method = "POST";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';

        // EV NOTE: the content type must be
        // "application/x-www-form-urlencoded" for POST data
        $headerParams['Content-Type'] = 'application/x-www-form-urlencoded';

        // EV NOTE: specify the "body" as form data
        if (!isset($body)) {            
            $body = array();
            $body['username'] = $username;
            $body['password'] = $password;
            }

        // make the API Call
        $response = $this->apiClient->callAPI(
            $resourcePath, $method, $queryParams, $body, $headerParams
        );

        if (!$response) {
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response, 'AuthResponse');

        return $responseObject;

        }
    /**
     * checkFilesExist
     * Checks to see if each file or folder in the array exists
     * access_token, string: Access token required to make the API call (required)
     * filePaths, array[string]: Array containing paths of the files or folders to check (required)
     * @return ExistingResourcesResponse
     */

    public function checkFilesExist($access_token, $filePaths) {

        // parse inputs
        $resourcePath = "/v1/checkFilesExist";
        $method = "POST";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';

        // EV NOTE: the content type must be
        // "application/x-www-form-urlencoded" for POST data
        $headerParams['Content-Type'] = 'application/x-www-form-urlencoded';

        // EV NOTE: specify the "body" as form data
        if (!isset($body)) {            
            $body = array();
            $body['access_token'] = $access_token;
            $body['filePaths'] = $filePaths;
            }

        // make the API Call
        $response = $this->apiClient->callAPI(
            $resourcePath, $method, $queryParams, $body, $headerParams
        );

        if (!$response) {
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response, 'ExistingResourcesResponse');

        return $responseObject;

        }
    /**
     * copyResources
     * Copies files, folders to the destination path
     * access_token, string: Access token required to make the API call (required)
     * filePaths, array[string]: Remote paths of the files or folders to copy (required)
     * destinationPath, string: Remote destination path to copy files/folders to (required)
     * @return ModifiedResourcesResponse
     */

    public function copyResources($access_token, $filePaths, $destinationPath) {

        // parse inputs
        $resourcePath = "/v1/copyResources";
        $method = "POST";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';

        // EV NOTE: the content type must be
        // "application/x-www-form-urlencoded" for POST data
        $headerParams['Content-Type'] = 'application/x-www-form-urlencoded';

        // EV NOTE: specify the "body" as form data
        if (!isset($body)) {            
            $body = array();
            $body['access_token'] = $access_token;
            $body['filePaths'] = $filePaths;
            $body['destinationPath'] = $destinationPath;
            }

        // make the API Call
        $response = $this->apiClient->callAPI(
            $resourcePath, $method, $queryParams, $body, $headerParams
        );

        if (!$response) {
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response, 'ModifiedResourcesResponse');

        return $responseObject;

        }
    /**
     * createFolder
     * Create a folder at a specified path
     * access_token, string: Access token required to make the API call (required)
     * folderName, string: Name of the folder to create (required)
     * path, string: Where to create the folder (required)
     * @return Response
     */

    public function createFolder($access_token, $folderName, $path) {

        // parse inputs
        $resourcePath = "/v1/createFolder";
        $method = "POST";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';

        // EV NOTE: the content type must be
        // "application/x-www-form-urlencoded" for POST data
        $headerParams['Content-Type'] = 'application/x-www-form-urlencoded';

        // EV NOTE: specify the "body" as form data
        if (!isset($body)) {            
            $body = array();
            $body['access_token'] = $access_token;
            $body['folderName'] = $folderName;
            $body['path'] = $path;
            }

        // make the API Call
        $response = $this->apiClient->callAPI(
            $resourcePath, $method, $queryParams, $body, $headerParams
        );

        if (!$response) {
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response, 'Response');

        return $responseObject;

        }
    /**
     * createNotification
     * Creates a new Notification object
     * access_token, string: Access token required to make the API call (required)
     * path, string: Full path of file/folder where notification is set. (required)
     * action, string: Type of action to filter on: 'upload', 'download', 'delete', 'all' (required)
     * usernames, string: User type to filter on: 'notice_user_all', 'notice_user_all_recipients', 'notice_user_all_users' (required)
     * sendEmail, bool: Set to true if the user should be notified by email when the notification is triggered. (required)
     * emails, array[string]: Email addresses to send notification to. If not specified, sends to owner by default. (optional)
     * @return Response
     */

    public function createNotification($access_token, $path, $action, $usernames, $sendEmail, $emails=null) {

        // parse inputs
        $resourcePath = "/v1/createNotification";
        $method = "POST";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';

        // EV NOTE: the content type must be
        // "application/x-www-form-urlencoded" for POST data
        $headerParams['Content-Type'] = 'application/x-www-form-urlencoded';

        // EV NOTE: specify the "body" as form data
        if (!isset($body)) {            
            $body = array();
            $body['access_token'] = $access_token;
            $body['path'] = $path;
            $body['action'] = $action;
            $body['usernames'] = $usernames;
            $body['sendEmail'] = $sendEmail;
            $body['emails'] = $emails;
            }

        // make the API Call
        $response = $this->apiClient->callAPI(
            $resourcePath, $method, $queryParams, $body, $headerParams
        );

        if (!$response) {
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response, 'Response');

        return $responseObject;

        }
    /**
     * createShare
     * Create a new Share object
     * access_token, string: Access token required to make the API call (required)
     * type, string: The type of share to create: shared_folder, send, receive. (required)
     * name, string: Name of the Share. (required)
     * filePaths, array[string]: Array of strings containing the file paths to share. (required)
     * subject, string: Share message subject (for email invitations). (optional)
     * message, string: Share message contents (for email invitations). (optional)
     * emails, array[string]: Array of strings for email recipients (for email invitations). (optional)
     * ccEmail, string: Specifies a CC email recipient. (optional)
     * requireEmail, bool: Requires a user's email to access (defaults to false if not specified). (optional)
     * accessMode, string: Type of permissions share recipients have (upload, download, modify). Defaults to download if no option specified. (optional)
     * embed, bool: Allows user to embed a widget with the share. Defaults to false if not specified. (optional)
     * isPublic, bool: True if share has a public URL, otherwise defaults to false (optional)
     * password, string: If not null, value of password is required to access this Share (optional)
     * expiration, string: The date the current Share should expire, formatted YYYY-mm-dd (optional)
     * hasNotification, bool: True if the user should be notified about activity on this Share. (optional)
     * notificationEmails, array[string]: An array of recipients who should receive notification emails. (optional)
     * fileDropCreateFolders, bool: If true, all receive folder submissions will be uploaded separate folders (only applicable for Receive folder types) (optional)
     * @return Response
     */

    public function createShare($access_token, $type, $name, $filePaths, $subject=null, $message=null, $emails=null, $ccEmail=null, $requireEmail=null, $accessMode=null, $embed=null, $isPublic=null, $password=null, $expiration=null, $hasNotification=null, $notificationEmails=null, $fileDropCreateFolders=null) {

        // parse inputs
        $resourcePath = "/v1/createShare";
        $method = "POST";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';

        // EV NOTE: the content type must be
        // "application/x-www-form-urlencoded" for POST data
        $headerParams['Content-Type'] = 'application/x-www-form-urlencoded';

        // EV NOTE: specify the "body" as form data
        if (!isset($body)) {            
            $body = array();
            $body['access_token'] = $access_token;
            $body['type'] = $type;
            $body['name'] = $name;
            $body['filePaths'] = $filePaths;
            $body['subject'] = $subject;
            $body['message'] = $message;
            $body['emails'] = $emails;
            $body['ccEmail'] = $ccEmail;
            $body['requireEmail'] = $requireEmail;
            $body['accessMode'] = $accessMode;
            $body['embed'] = $embed;
            $body['isPublic'] = $isPublic;
            $body['password'] = $password;
            $body['expiration'] = $expiration;
            $body['hasNotification'] = $hasNotification;
            $body['notificationEmails'] = $notificationEmails;
            $body['fileDropCreateFolders'] = $fileDropCreateFolders;
            }

        // make the API Call
        $response = $this->apiClient->callAPI(
            $resourcePath, $method, $queryParams, $body, $headerParams
        );

        if (!$response) {
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response, 'Response');

        return $responseObject;

        }
    /**
     * createUser
     * Adds a new subaccount user to the current account
     * access_token, string: Access token required to make the API call (required)
     * username, string: Name of the subaccount user to create (required)
     * destinationFolder, string: The user's home folder (required)
     * email, string: The user's email address (required)
     * password, string: The user's password (required)
     * role, string: The user's role, i.e: 'user' or 'admin' (required)
     * permissions, string: A CSV string of user permissions. The following values are supported: upload, download, delete, modify, list, changePassword, share, notification. (required)
     * nickname, string: The user's nickname (optional)
     * expiration, string: The date when the user should expire, formatted YYYY-mm-dd (optional)
     * locked, bool: If true, the user's account is locked by default (optional)
     * welcomeEmail, bool: If true, send a user email upon creation (optional)
     * timeZone, string: The user's timezone, used for accurate time display within SWFT. See &lt;a href='https://php.net/manual/en/timezones.php' target='blank'&gt;this page&lt;/a&gt; for allowed values (required)
     * @return Response
     */

    public function createUser($access_token, $username, $destinationFolder, $email, $password, $role, $permissions, $nickname=null, $expiration=null, $locked=null, $welcomeEmail=null, $timeZone) {

        // parse inputs
        $resourcePath = "/v1/createUser";
        $method = "POST";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';

        // EV NOTE: the content type must be
        // "application/x-www-form-urlencoded" for POST data
        $headerParams['Content-Type'] = 'application/x-www-form-urlencoded';

        // EV NOTE: specify the "body" as form data
        if (!isset($body)) {            
            $body = array();
            $body['access_token'] = $access_token;
            $body['username'] = $username;
            $body['destinationFolder'] = $destinationFolder;
            $body['email'] = $email;
            $body['password'] = $password;
            $body['role'] = $role;
            $body['permissions'] = $permissions;
            $body['nickname'] = $nickname;
            $body['expiration'] = $expiration;
            $body['locked'] = $locked;
            $body['welcomeEmail'] = $welcomeEmail;
            $body['timeZone'] = $timeZone;
            }

        // make the API Call
        $response = $this->apiClient->callAPI(
            $resourcePath, $method, $queryParams, $body, $headerParams
        );

        if (!$response) {
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response, 'Response');

        return $responseObject;

        }
    /**
     * deleteNotification
     * Deletes a Notification by ID
     * access_token, string: Access token required to make the API call (required)
     * id, int: ID of the Notification to delete. (required)
     * @return Response
     */

    public function deleteNotification($access_token, $id) {

        // parse inputs
        $resourcePath = "/v1/deleteNotification";
        $method = "POST";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';

        // EV NOTE: the content type must be
        // "application/x-www-form-urlencoded" for POST data
        $headerParams['Content-Type'] = 'application/x-www-form-urlencoded';

        // EV NOTE: specify the "body" as form data
        if (!isset($body)) {            
            $body = array();
            $body['access_token'] = $access_token;
            $body['id'] = $id;
            }

        // make the API Call
        $response = $this->apiClient->callAPI(
            $resourcePath, $method, $queryParams, $body, $headerParams
        );

        if (!$response) {
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response, 'Response');

        return $responseObject;

        }
    /**
     * deleteResources
     * Delete the specified files/folders
     * access_token, string: Access token required to make the API call (required)
     * filePaths, array[string]: Array containing paths of the files or folder to delete (required)
     * @return DeletedResourcesResponse
     */

    public function deleteResources($access_token, $filePaths) {

        // parse inputs
        $resourcePath = "/v1/deleteResources";
        $method = "POST";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';

        // EV NOTE: the content type must be
        // "application/x-www-form-urlencoded" for POST data
        $headerParams['Content-Type'] = 'application/x-www-form-urlencoded';

        // EV NOTE: specify the "body" as form data
        if (!isset($body)) {            
            $body = array();
            $body['access_token'] = $access_token;
            $body['filePaths'] = $filePaths;
            }

        // make the API Call
        $response = $this->apiClient->callAPI(
            $resourcePath, $method, $queryParams, $body, $headerParams
        );

        if (!$response) {
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response, 'DeletedResourcesResponse');

        return $responseObject;

        }
    /**
     * deleteShare
     * Deletes a Share by ID
     * access_token, string: Access token required to make the API call (required)
     * id, int: ID of the Share to delete. (required)
     * @return Response
     */

    public function deleteShare($access_token, $id) {

        // parse inputs
        $resourcePath = "/v1/deleteShare";
        $method = "POST";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';

        // EV NOTE: the content type must be
        // "application/x-www-form-urlencoded" for POST data
        $headerParams['Content-Type'] = 'application/x-www-form-urlencoded';

        // EV NOTE: specify the "body" as form data
        if (!isset($body)) {            
            $body = array();
            $body['access_token'] = $access_token;
            $body['id'] = $id;
            }

        // make the API Call
        $response = $this->apiClient->callAPI(
            $resourcePath, $method, $queryParams, $body, $headerParams
        );

        if (!$response) {
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response, 'Response');

        return $responseObject;

        }
    /**
     * deleteUser
     * Deletes a subaccount user for the current account
     * access_token, string: Access token required to make the API call (required)
     * username, string: Name of the subaccount user to delete (required)
     * @return Response
     */

    public function deleteUser($access_token, $username) {

        // parse inputs
        $resourcePath = "/v1/deleteUser";
        $method = "POST";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';

        // EV NOTE: the content type must be
        // "application/x-www-form-urlencoded" for POST data
        $headerParams['Content-Type'] = 'application/x-www-form-urlencoded';

        // EV NOTE: specify the "body" as form data
        if (!isset($body)) {            
            $body = array();
            $body['access_token'] = $access_token;
            $body['username'] = $username;
            }

        // make the API Call
        $response = $this->apiClient->callAPI(
            $resourcePath, $method, $queryParams, $body, $headerParams
        );

        if (!$response) {
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response, 'Response');

        return $responseObject;

        }
    /**
     * getAccount
     * Gets the account object for the currently logged in user
     * access_token, string: Access token required to make the API call (required)
     * @return AccountResponse
     */

    public function getAccount($access_token) {

        // parse inputs
        $resourcePath = "/v1/getAccount";
        $method = "POST";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';

        // EV NOTE: the content type must be
        // "application/x-www-form-urlencoded" for POST data
        $headerParams['Content-Type'] = 'application/x-www-form-urlencoded';

        // EV NOTE: specify the "body" as form data
        if (!isset($body)) {            
            $body = array();
            $body['access_token'] = $access_token;
            }

        // make the API Call
        $response = $this->apiClient->callAPI(
            $resourcePath, $method, $queryParams, $body, $headerParams
        );

        if (!$response) {
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response, 'AccountResponse');

        return $responseObject;

        }
    /**
     * getCurrentUser
     * Gets the user object for the currently logged in user
     * access_token, string: Access token required to make the API call (required)
     * @return UserResponse
     */

    public function getCurrentUser($access_token) {

        // parse inputs
        $resourcePath = "/v1/getCurrentUser";
        $method = "POST";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';

        // EV NOTE: the content type must be
        // "application/x-www-form-urlencoded" for POST data
        $headerParams['Content-Type'] = 'application/x-www-form-urlencoded';

        // EV NOTE: specify the "body" as form data
        if (!isset($body)) {            
            $body = array();
            $body['access_token'] = $access_token;
            }

        // make the API Call
        $response = $this->apiClient->callAPI(
            $resourcePath, $method, $queryParams, $body, $headerParams
        );

        if (!$response) {
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response, 'UserResponse');

        return $responseObject;

        }
    /**
     * getDownloadFileUrl
     * Returns a unique URL for handling file downloads
     * access_token, string: Access token required to make the API call (required)
     * filePaths, string: Path of file to be downloaded (required)
     * downloadName, string: The name of the file to be downloaded (optional)
     * @return UrlResponse
     */

    public function getDownloadFileUrl($access_token, $filePaths, $downloadName=null) {

        // parse inputs
        $resourcePath = "/v1/getDownloadFileUrl";
        $method = "POST";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';

        // EV NOTE: the content type must be
        // "application/x-www-form-urlencoded" for POST data
        $headerParams['Content-Type'] = 'application/x-www-form-urlencoded';

        // EV NOTE: specify the "body" as form data
        if (!isset($body)) {            
            $body = array();
            $body['access_token'] = $access_token;
            $body['filePaths'] = $filePaths;
            $body['downloadName'] = $downloadName;
            }

        // make the API Call
        $response = $this->apiClient->callAPI(
            $resourcePath, $method, $queryParams, $body, $headerParams
        );

        if (!$response) {
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response, 'UrlResponse');

        return $responseObject;

        }
    /**
     * getFileActivityLogs
     * Returns a list of account activity. Allows for searching the activity log.
     * access_token, string: Access token required to make the API call (required)
     * filterBy, string: Field to search on ['filter_logs_date' or 'filter_logs_ip_address' or 'filter_logs_username' or 'filter_logs_operation' or 'filter_logs_file'] (optional)
     * filter, string: Search criteria. For date ranges, use format 'start_date::end_date' (optional)
     * itemLimit, int: Number of logs to return. Can be used for pagination. (optional)
     * offset, int: Starting record in the result set. Can be used for pagination. (optional)
     * sortBy, string: Sort method ['sort_logs_date' or 'sort_logs_ip_address' or 'sort_logs_username' or 'sort_logs_file' or 'sort_logs_file_source' or 'sort_logs_operation', or 'sort_logs_duration', or 'sort_logs_size', or 'sort_logs_protocol'] (optional)
     * sortOrder, string: Sort in either ascending or descending order: asc, desc (optional)
     * @return LogResponse
     */

    public function getFileActivityLogs($access_token, $filterBy=null, $filter=null, $itemLimit=null, $offset=null, $sortBy=null, $sortOrder=null) {

        // parse inputs
        $resourcePath = "/v1/getFileActivityLogs";
        $method = "POST";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';

        // EV NOTE: the content type must be
        // "application/x-www-form-urlencoded" for POST data
        $headerParams['Content-Type'] = 'application/x-www-form-urlencoded';

        // EV NOTE: specify the "body" as form data
        if (!isset($body)) {            
            $body = array();
            $body['access_token'] = $access_token;
            $body['filterBy'] = $filterBy;
            $body['filter'] = $filter;
            $body['itemLimit'] = $itemLimit;
            $body['offset'] = $offset;
            $body['sortBy'] = $sortBy;
            $body['sortOrder'] = $sortOrder;
            }

        // make the API Call
        $response = $this->apiClient->callAPI(
            $resourcePath, $method, $queryParams, $body, $headerParams
        );

        if (!$response) {
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response, 'LogResponse');

        return $responseObject;

        }
    /**
     * getFolders
     * Get folders for a specified path
     * access_token, string: Access token required to make the API call (required)
     * path, string: The remote file path (required)
     * @return ResourcePropertiesResponse
     */

    public function getFolders($access_token, $path) {

        // parse inputs
        $resourcePath = "/v1/getFolders";
        $method = "POST";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';

        // EV NOTE: the content type must be
        // "application/x-www-form-urlencoded" for POST data
        $headerParams['Content-Type'] = 'application/x-www-form-urlencoded';

        // EV NOTE: specify the "body" as form data
        if (!isset($body)) {            
            $body = array();
            $body['access_token'] = $access_token;
            $body['path'] = $path;
            }

        // make the API Call
        $response = $this->apiClient->callAPI(
            $resourcePath, $method, $queryParams, $body, $headerParams
        );

        if (!$response) {
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response, 'ResourcePropertiesResponse');

        return $responseObject;

        }
    /**
     * getNotification
     * Returns a notification based on the given ID
     * access_token, string: Access token required to make the API call (required)
     * id, int: ID of the Notification (required)
     * @return NotificationResponse
     */

    public function getNotification($access_token, $id) {

        // parse inputs
        $resourcePath = "/v1/getNotification";
        $method = "POST";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';

        // EV NOTE: the content type must be
        // "application/x-www-form-urlencoded" for POST data
        $headerParams['Content-Type'] = 'application/x-www-form-urlencoded';

        // EV NOTE: specify the "body" as form data
        if (!isset($body)) {            
            $body = array();
            $body['access_token'] = $access_token;
            $body['id'] = $id;
            }

        // make the API Call
        $response = $this->apiClient->callAPI(
            $resourcePath, $method, $queryParams, $body, $headerParams
        );

        if (!$response) {
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response, 'NotificationResponse');

        return $responseObject;

        }
    /**
     * getNotifications
     * Returns all notifications for the current user
     * access_token, string: Access token required to make the API call (required)
     * type, string: Type of notification to filter on: 'file', 'folder', 'shared_folder', 'send_receipt', 'share_receipt', 'file_drop' (required)
     * sortBy, string: Sort by one of the following: 'sort_notifications_folder_name', 'sort_notifications_path', 'sort_notifications_date' (optional)
     * sortOrder, string: Sort by 'asc' or 'desc' order. (optional)
     * filter, string: Filter by the provided search terms. (optional)
     * @return NotificationsResponse
     */

    public function getNotifications($access_token, $type, $sortBy=null, $sortOrder=null, $filter=null) {

        // parse inputs
        $resourcePath = "/v1/getNotifications";
        $method = "POST";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';

        // EV NOTE: the content type must be
        // "application/x-www-form-urlencoded" for POST data
        $headerParams['Content-Type'] = 'application/x-www-form-urlencoded';

        // EV NOTE: specify the "body" as form data
        if (!isset($body)) {            
            $body = array();
            $body['access_token'] = $access_token;
            $body['type'] = $type;
            $body['sortBy'] = $sortBy;
            $body['sortOrder'] = $sortOrder;
            $body['filter'] = $filter;
            }

        // make the API Call
        $response = $this->apiClient->callAPI(
            $resourcePath, $method, $queryParams, $body, $headerParams
        );

        if (!$response) {
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response, 'NotificationsResponse');

        return $responseObject;

        }
    /**
     * getNotificationActivity
     * Returns all notification activity for the current user
     * access_token, string: Access token required to make the API call (required)
     * @return NotificationActivityResponse
     */

    public function getNotificationActivity($access_token) {

        // parse inputs
        $resourcePath = "/v1/getNotificationActivity";
        $method = "POST";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';

        // EV NOTE: the content type must be
        // "application/x-www-form-urlencoded" for POST data
        $headerParams['Content-Type'] = 'application/x-www-form-urlencoded';

        // EV NOTE: specify the "body" as form data
        if (!isset($body)) {            
            $body = array();
            $body['access_token'] = $access_token;
            }

        // make the API Call
        $response = $this->apiClient->callAPI(
            $resourcePath, $method, $queryParams, $body, $headerParams
        );

        if (!$response) {
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response, 'NotificationActivityResponse');

        return $responseObject;

        }
    /**
     * getResourceList
     * Get a listing of files/folders for the specified path
     * access_token, string: Access token required to make the API call (required)
     * path, string: The remote file path (required)
     * sortBy, string: Sort according to attribute: sort_files_name, sort_files_size, sort_files_date, sort_files_type, sort_files_timeline (required)
     * sortOrder, string: Sort in either ascending or descending order: asc, desc (required)
     * offset, int: Determines which item to start on for pagination (required)
     * limit, int: The number of files to limit the result (required)
     * detailed, bool: If true, returns sharedFolder, notifications or other objects associated with specified path (optional)
     * pattern, string: Regex string. If not null, perform a search with specified pattern (optional)
     * @return ResourceResponse
     */

    public function getResourceList($access_token, $path, $sortBy, $sortOrder, $offset, $limit, $detailed=null, $pattern=null) {

        // parse inputs
        $resourcePath = "/v1/getResourceList";
        $method = "POST";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';

        // EV NOTE: the content type must be
        // "application/x-www-form-urlencoded" for POST data
        $headerParams['Content-Type'] = 'application/x-www-form-urlencoded';

        // EV NOTE: specify the "body" as form data
        if (!isset($body)) {            
            $body = array();
            $body['access_token'] = $access_token;
            $body['path'] = $path;
            $body['sortBy'] = $sortBy;
            $body['sortOrder'] = $sortOrder;
            $body['offset'] = $offset;
            $body['limit'] = $limit;
            $body['detailed'] = $detailed;
            $body['pattern'] = $pattern;
            }

        // make the API Call
        $response = $this->apiClient->callAPI(
            $resourcePath, $method, $queryParams, $body, $headerParams
        );

        if (!$response) {
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response, 'ResourceResponse');

        return $responseObject;

        }
    /**
     * getResourceProperties
     * Get the properties for each of the specified files/folders
     * access_token, string: Access token required to make the API call (required)
     * filePaths, array[string]: Array containing paths of the files or folder to get (required)
     * @return ResourcePropertiesResponse
     */

    public function getResourceProperties($access_token, $filePaths) {

        // parse inputs
        $resourcePath = "/v1/getResourceProperties";
        $method = "POST";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';

        // EV NOTE: the content type must be
        // "application/x-www-form-urlencoded" for POST data
        $headerParams['Content-Type'] = 'application/x-www-form-urlencoded';

        // EV NOTE: specify the "body" as form data
        if (!isset($body)) {            
            $body = array();
            $body['access_token'] = $access_token;
            $body['filePaths'] = $filePaths;
            }

        // make the API Call
        $response = $this->apiClient->callAPI(
            $resourcePath, $method, $queryParams, $body, $headerParams
        );

        if (!$response) {
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response, 'ResourcePropertiesResponse');

        return $responseObject;

        }
    /**
     * getShare
     * Returns a share by the specified ID
     * access_token, string: Access token required to make the API call (required)
     * id, int: ID of the requested Share (required)
     * @return ShareResponse
     */

    public function getShare($access_token, $id) {

        // parse inputs
        $resourcePath = "/v1/getShare";
        $method = "POST";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';

        // EV NOTE: the content type must be
        // "application/x-www-form-urlencoded" for POST data
        $headerParams['Content-Type'] = 'application/x-www-form-urlencoded';

        // EV NOTE: specify the "body" as form data
        if (!isset($body)) {            
            $body = array();
            $body['access_token'] = $access_token;
            $body['id'] = $id;
            }

        // make the API Call
        $response = $this->apiClient->callAPI(
            $resourcePath, $method, $queryParams, $body, $headerParams
        );

        if (!$response) {
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response, 'ShareResponse');

        return $responseObject;

        }
    /**
     * getShares
     * Returns all Shares for the current user
     * access_token, string: Access token required to make the API call (required)
     * type, string: The type of share to return: 'shared_folder', 'send', or 'receive'. If no argument specified, will return all Shares types. (optional)
     * sortBy, string: Sort by one of the following: 'sort_shares_name', 'sort_shares_date', 'sort_shares_user', 'sort_shares_access_mode'. (optional)
     * sortOrder, string: Sort by 'asc' or 'desc' order. (optional)
     * filter, string: Filter by the provided search terms. (optional)
     * include, string: Filter by all, active-only, or current user's only. (optional)
     * offset, int: Start position of results to return, for pagination. (optional)
     * limit, int: Maximum number of elements to return or 0 if no limit. (optional)
     * @return SharesResponse
     */

    public function getShares($access_token, $type=null, $sortBy=null, $sortOrder=null, $filter=null, $include=null, $offset=null, $limit=null) {

        // parse inputs
        $resourcePath = "/v1/getShares";
        $method = "POST";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';

        // EV NOTE: the content type must be
        // "application/x-www-form-urlencoded" for POST data
        $headerParams['Content-Type'] = 'application/x-www-form-urlencoded';

        // EV NOTE: specify the "body" as form data
        if (!isset($body)) {            
            $body = array();
            $body['access_token'] = $access_token;
            $body['type'] = $type;
            $body['sortBy'] = $sortBy;
            $body['sortOrder'] = $sortOrder;
            $body['filter'] = $filter;
            $body['include'] = $include;
            $body['offset'] = $offset;
            $body['limit'] = $limit;
            }

        // make the API Call
        $response = $this->apiClient->callAPI(
            $resourcePath, $method, $queryParams, $body, $headerParams
        );

        if (!$response) {
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response, 'SharesResponse');

        return $responseObject;

        }
    /**
     * getShareActivity
     * Return activity log entries for the specified Share ID
     * access_token, string: Access token required to make the API call (required)
     * id, int: ID of the Share (required)
     * @return ShareActivityResponse
     */

    public function getShareActivity($access_token, $id) {

        // parse inputs
        $resourcePath = "/v1/getShareActivity";
        $method = "POST";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';

        // EV NOTE: the content type must be
        // "application/x-www-form-urlencoded" for POST data
        $headerParams['Content-Type'] = 'application/x-www-form-urlencoded';

        // EV NOTE: specify the "body" as form data
        if (!isset($body)) {            
            $body = array();
            $body['access_token'] = $access_token;
            $body['id'] = $id;
            }

        // make the API Call
        $response = $this->apiClient->callAPI(
            $resourcePath, $method, $queryParams, $body, $headerParams
        );

        if (!$response) {
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response, 'ShareActivityResponse');

        return $responseObject;

        }
    /**
     * getUploadFileUrl
     * Returns a unique URL for handling file uploads
     * access_token, string: Access token required to make the API call (required)
     * fileSize, int: Size of the file to upload, in bytes (required)
     * destinationPath, string: Path relative to account's home directory, including file name (required)
     * allowOverwrite, bool: True if the file should be overwritten, false if different file names should be generated (optional)
     * resume, bool: True if upload resume is supported, false if it isn't (optional)
     * @return UrlResponse
     */

    public function getUploadFileUrl($access_token, $fileSize, $destinationPath, $allowOverwrite=null, $resume=null) {

        // parse inputs
        $resourcePath = "/v1/getUploadFileUrl";
        $method = "POST";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';

        // EV NOTE: the content type must be
        // "application/x-www-form-urlencoded" for POST data
        $headerParams['Content-Type'] = 'application/x-www-form-urlencoded';

        // EV NOTE: specify the "body" as form data
        if (!isset($body)) {            
            $body = array();
            $body['access_token'] = $access_token;
            $body['fileSize'] = $fileSize;
            $body['destinationPath'] = $destinationPath;
            $body['allowOverwrite'] = $allowOverwrite;
            $body['resume'] = $resume;
            }

        // make the API Call
        $response = $this->apiClient->callAPI(
            $resourcePath, $method, $queryParams, $body, $headerParams
        );

        if (!$response) {
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response, 'UrlResponse');

        return $responseObject;

        }
    /**
     * getUser
     * Get the specified subaccount user for the current account
     * access_token, string: Access token required to make the API call (required)
     * username, string: Name of the subaccount user to get (required)
     * @return UserResponse
     */

    public function getUser($access_token, $username) {

        // parse inputs
        $resourcePath = "/v1/getUser";
        $method = "POST";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';

        // EV NOTE: the content type must be
        // "application/x-www-form-urlencoded" for POST data
        $headerParams['Content-Type'] = 'application/x-www-form-urlencoded';

        // EV NOTE: specify the "body" as form data
        if (!isset($body)) {            
            $body = array();
            $body['access_token'] = $access_token;
            $body['username'] = $username;
            }

        // make the API Call
        $response = $this->apiClient->callAPI(
            $resourcePath, $method, $queryParams, $body, $headerParams
        );

        if (!$response) {
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response, 'UserResponse');

        return $responseObject;

        }
    /**
     * getUsers
     * Gets the user object for the currently logged in user
     * access_token, string: Access token required to make the API call (required)
     * sortBy, string: sort method ['sort_users_username' or 'sort_users_nickname' or 'sort_users_email' or 'sort_users_home_folder'] (required)
     * sortOrder, string: sort order, i.e. 'asc' or 'desc' (required)
     * @return UsersResponse
     */

    public function getUsers($access_token, $sortBy, $sortOrder) {

        // parse inputs
        $resourcePath = "/v1/getUsers";
        $method = "POST";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';

        // EV NOTE: the content type must be
        // "application/x-www-form-urlencoded" for POST data
        $headerParams['Content-Type'] = 'application/x-www-form-urlencoded';

        // EV NOTE: specify the "body" as form data
        if (!isset($body)) {            
            $body = array();
            $body['access_token'] = $access_token;
            $body['sortBy'] = $sortBy;
            $body['sortOrder'] = $sortOrder;
            }

        // make the API Call
        $response = $this->apiClient->callAPI(
            $resourcePath, $method, $queryParams, $body, $headerParams
        );

        if (!$response) {
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response, 'UsersResponse');

        return $responseObject;

        }
    /**
     * logoutUser
     * Removes user's access token from database, logging them out of API
     * access_token, string: Access token required to make the API call (required)
     * @return Response
     */

    public function logoutUser($access_token) {

        // parse inputs
        $resourcePath = "/v1/logoutUser";
        $method = "POST";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';

        // EV NOTE: the content type must be
        // "application/x-www-form-urlencoded" for POST data
        $headerParams['Content-Type'] = 'application/x-www-form-urlencoded';

        // EV NOTE: specify the "body" as form data
        if (!isset($body)) {            
            $body = array();
            $body['access_token'] = $access_token;
            }

        // make the API Call
        $response = $this->apiClient->callAPI(
            $resourcePath, $method, $queryParams, $body, $headerParams
        );

        if (!$response) {
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response, 'Response');

        return $responseObject;

        }
    /**
     * moveResources
     * Moves files, folders to the destination path
     * access_token, string: Access token required to make the API call (required)
     * filePaths, array[string]: Remote paths of the files or folders to move (required)
     * destinationPath, string: Remote destination path to move files/folders to (required)
     * @return ModifiedResourcesResponse
     */

    public function moveResources($access_token, $filePaths, $destinationPath) {

        // parse inputs
        $resourcePath = "/v1/moveResources";
        $method = "POST";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';

        // EV NOTE: the content type must be
        // "application/x-www-form-urlencoded" for POST data
        $headerParams['Content-Type'] = 'application/x-www-form-urlencoded';

        // EV NOTE: specify the "body" as form data
        if (!isset($body)) {            
            $body = array();
            $body['access_token'] = $access_token;
            $body['filePaths'] = $filePaths;
            $body['destinationPath'] = $destinationPath;
            }

        // make the API Call
        $response = $this->apiClient->callAPI(
            $resourcePath, $method, $queryParams, $body, $headerParams
        );

        if (!$response) {
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response, 'ModifiedResourcesResponse');

        return $responseObject;

        }
    /**
     * previewFile
     * Returns a resized image of the specified document for support file types
     * access_token, string: Access token required to make the API call (required)
     * path, string: Path of the image relative to the user's home directory (required)
     * size, string: The size of the image: small, medium, large (required)
     * width, int: Overrides sizes. Sets to a specific width (optional)
     * height, int: Overrides sizes. Sets to a specific height (optional)
     * page, int: Page number for the document (optional)
     * @return PreviewFileResponse
     */

    public function previewFile($access_token, $path, $size, $width=null, $height=null, $page=null) {

        // parse inputs
        $resourcePath = "/v1/previewFile";
        $method = "POST";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';

        // EV NOTE: the content type must be
        // "application/x-www-form-urlencoded" for POST data
        $headerParams['Content-Type'] = 'application/x-www-form-urlencoded';

        // EV NOTE: specify the "body" as form data
        if (!isset($body)) {            
            $body = array();
            $body['access_token'] = $access_token;
            $body['path'] = $path;
            $body['size'] = $size;
            $body['width'] = $width;
            $body['height'] = $height;
            $body['page'] = $page;
            }

        // make the API Call
        $response = $this->apiClient->callAPI(
            $resourcePath, $method, $queryParams, $body, $headerParams
        );

        if (!$response) {
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response, 'PreviewFileResponse');

        return $responseObject;

        }
    /**
     * renameResource
     * Rename a file or folder at the specified path
     * access_token, string: Access token required to make the API call (required)
     * filePath, string: Remote path of the files or folder to rename (required)
     * newName, string: The new name of the file or folder (required)
     * @return Response
     */

    public function renameResource($access_token, $filePath, $newName) {

        // parse inputs
        $resourcePath = "/v1/renameResource";
        $method = "POST";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';

        // EV NOTE: the content type must be
        // "application/x-www-form-urlencoded" for POST data
        $headerParams['Content-Type'] = 'application/x-www-form-urlencoded';

        // EV NOTE: specify the "body" as form data
        if (!isset($body)) {            
            $body = array();
            $body['access_token'] = $access_token;
            $body['filePath'] = $filePath;
            $body['newName'] = $newName;
            }

        // make the API Call
        $response = $this->apiClient->callAPI(
            $resourcePath, $method, $queryParams, $body, $headerParams
        );

        if (!$response) {
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response, 'Response');

        return $responseObject;

        }
    /**
     * updateNotification
     * Updates an existing notification by ID
     * access_token, string: Access token required to make the API call (required)
     * id, int: The notification ID (required)
     * path, string: Full path of file/folder where notification is set. (optional)
     * action, string: Type of action to filter on: 'upload', 'download', 'delete', 'all' (optional)
     * usernames, string: User type to filter on: 'notice_user_all', 'notice_user_all_recipients', 'notice_user_all_users' (optional)
     * emails, array[string]: Email addresses to send notification to. If not specified, sends to owner by default. (optional)
     * sendEmail, bool: Set to true if the user should be notified by email when the notification is triggered. (optional)
     * @return Response
     */

    public function updateNotification($access_token, $id, $path=null, $action=null, $usernames=null, $emails=null, $sendEmail=null) {

        // parse inputs
        $resourcePath = "/v1/updateNotification";
        $method = "POST";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';

        // EV NOTE: the content type must be
        // "application/x-www-form-urlencoded" for POST data
        $headerParams['Content-Type'] = 'application/x-www-form-urlencoded';

        // EV NOTE: specify the "body" as form data
        if (!isset($body)) {            
            $body = array();
            $body['access_token'] = $access_token;
            $body['id'] = $id;
            $body['path'] = $path;
            $body['action'] = $action;
            $body['usernames'] = $usernames;
            $body['emails'] = $emails;
            $body['sendEmail'] = $sendEmail;
            }

        // make the API Call
        $response = $this->apiClient->callAPI(
            $resourcePath, $method, $queryParams, $body, $headerParams
        );

        if (!$response) {
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response, 'Response');

        return $responseObject;

        }
    /**
     * updateShare
     * Update an existing Share by ID
     * access_token, string: Access token required to make the API call (required)
     * id, int: The ID of the Share to update. (required)
     * name, string: Name of the Share. (optional)
     * filePaths, array[string]: Array of strings containing the file paths to share. (optional)
     * subject, string: Share message subject (for email invitations). (optional)
     * message, string: Share message contents (for email invitations). (optional)
     * emails, array[string]: Array of strings for email recipients (for email invitations). (optional)
     * ccEmail, string: Specifies a CC email recipient. (optional)
     * requireEmail, bool: Requires a user's email to access (defaults to false if not specified). (optional)
     * accessMode, string: Type of permissions share recipients have (upload, download, modify). Defaults to download if no option specified. (optional)
     * embed, bool: Allows user to embed a widget with the share. Defaults to false if not specified. (optional)
     * isPublic, bool: True if share has a public URL, otherwise defaults to false (optional)
     * password, string: If not null, value of password is required to access this Share (optional)
     * expiration, string: The date the current Share should expire, formatted YYYY-mm-dd (optional)
     * hasNotification, bool: True if the user should be notified about activity on this Share. (optional)
     * notificationEmails, array[string]: An array of recipients who should receive notification emails. (optional)
     * fileDropCreateFolders, bool: If true, all receive folder submissions will be uploaded separate folders (only applicable for Receive folder types) (optional)
     * @return Response
     */

    public function updateShare($access_token, $id, $name=null, $filePaths=null, $subject=null, $message=null, $emails=null, $ccEmail=null, $requireEmail=null, $accessMode=null, $embed=null, $isPublic=null, $password=null, $expiration=null, $hasNotification=null, $notificationEmails=null, $fileDropCreateFolders=null) {

        // parse inputs
        $resourcePath = "/v1/updateShare";
        $method = "POST";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';

        // EV NOTE: the content type must be
        // "application/x-www-form-urlencoded" for POST data
        $headerParams['Content-Type'] = 'application/x-www-form-urlencoded';

        // EV NOTE: specify the "body" as form data
        if (!isset($body)) {            
            $body = array();
            $body['access_token'] = $access_token;
            $body['id'] = $id;
            $body['name'] = $name;
            $body['filePaths'] = $filePaths;
            $body['subject'] = $subject;
            $body['message'] = $message;
            $body['emails'] = $emails;
            $body['ccEmail'] = $ccEmail;
            $body['requireEmail'] = $requireEmail;
            $body['accessMode'] = $accessMode;
            $body['embed'] = $embed;
            $body['isPublic'] = $isPublic;
            $body['password'] = $password;
            $body['expiration'] = $expiration;
            $body['hasNotification'] = $hasNotification;
            $body['notificationEmails'] = $notificationEmails;
            $body['fileDropCreateFolders'] = $fileDropCreateFolders;
            }

        // make the API Call
        $response = $this->apiClient->callAPI(
            $resourcePath, $method, $queryParams, $body, $headerParams
        );

        if (!$response) {
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response, 'Response');

        return $responseObject;

        }
    /**
     * updateUser
     * Updates a subaccount user for the current account
     * access_token, string: Access token required to make the API call (required)
     * userId, int: The user ID, must be obtained from getUser method first (required)
     * username, string: Name of the subaccount user to modify (optional)
     * nickname, string: The user's nickname (optional)
     * expiration, string: The date when use should expire in format: YYYY-MM-DD (optional)
     * email, string: The user's email (optional)
     * destinationFolder, string: The user's home folder (optional)
     * password, string: The user's password (optional)
     * locked, bool: If true, the user's account is locked by default (optional)
     * role, string: The user's role, i.e: 'user', 'admin', 'master' (optional)
     * permissions, string: A CSV string of user permissions. (optional)
     * @return Response
     */

    public function updateUser($access_token, $userId, $username=null, $nickname=null, $expiration=null, $email=null, $destinationFolder=null, $password=null, $locked=null, $role=null, $permissions=null) {

        // parse inputs
        $resourcePath = "/v1/updateUser";
        $method = "POST";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';

        // EV NOTE: the content type must be
        // "application/x-www-form-urlencoded" for POST data
        $headerParams['Content-Type'] = 'application/x-www-form-urlencoded';

        // EV NOTE: specify the "body" as form data
        if (!isset($body)) {            
            $body = array();
            $body['access_token'] = $access_token;
            $body['userId'] = $userId;
            $body['username'] = $username;
            $body['nickname'] = $nickname;
            $body['expiration'] = $expiration;
            $body['email'] = $email;
            $body['destinationFolder'] = $destinationFolder;
            $body['password'] = $password;
            $body['locked'] = $locked;
            $body['role'] = $role;
            $body['permissions'] = $permissions;
            }

        // make the API Call
        $response = $this->apiClient->callAPI(
            $resourcePath, $method, $queryParams, $body, $headerParams
        );

        if (!$response) {
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response, 'Response');

        return $responseObject;

        }
    /**
     * userAvailable
     * Returns true if requested username has not already been taken in the system
     * access_token, string: Access token required to make the API call (required)
     * username, string: Username to check (required)
     * @return AvailableUserResponse
     */

    public function userAvailable($access_token, $username) {

        // parse inputs
        $resourcePath = "/v1/userAvailable";
        $method = "POST";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';

        // EV NOTE: the content type must be
        // "application/x-www-form-urlencoded" for POST data
        $headerParams['Content-Type'] = 'application/x-www-form-urlencoded';

        // EV NOTE: specify the "body" as form data
        if (!isset($body)) {            
            $body = array();
            $body['access_token'] = $access_token;
            $body['username'] = $username;
            }

        // make the API Call
        $response = $this->apiClient->callAPI(
            $resourcePath, $method, $queryParams, $body, $headerParams
        );

        if (!$response) {
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response, 'AvailableUserResponse');

        return $responseObject;

        }
    
    }

