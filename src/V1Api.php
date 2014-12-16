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

        //parse inputs
        $resourcePath = "/v1/authenticateUser";
        $resourcePath = str_replace("{format}", "json", $resourcePath);
        $method = "GET";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';
        $headerParams['Content-Type'] = '';

        if($username !== null) {
            $queryParams['username'] = $this->apiClient->toQueryValue($username);
        }
        if($password !== null) {
            $queryParams['password'] = $this->apiClient->toQueryValue($password);
        }
        //make the API Call
        if (! isset($body)) {
            $body = null;
        }
        $response = $this->apiClient->callAPI($resourcePath, $method,
                                              $queryParams, $body,
                                              $headerParams);


        if(! $response){
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response,
                                                        'AuthResponse');
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

        //parse inputs
        $resourcePath = "/v1/checkFilesExist";
        $resourcePath = str_replace("{format}", "json", $resourcePath);
        $method = "GET";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';
        $headerParams['Content-Type'] = '';

        if($access_token !== null) {
            $queryParams['access_token'] = $this->apiClient->toQueryValue($access_token);
        }
        if($filePaths !== null) {
            $queryParams['filePaths'] = $this->apiClient->toQueryValue($filePaths);
        }
        //make the API Call
        if (! isset($body)) {
            $body = null;
        }
        $response = $this->apiClient->callAPI($resourcePath, $method,
                                              $queryParams, $body,
                                              $headerParams);


        if(! $response){
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response,
                                                        'ExistingResourcesResponse');
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

        //parse inputs
        $resourcePath = "/v1/copyResources";
        $resourcePath = str_replace("{format}", "json", $resourcePath);
        $method = "GET";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';
        $headerParams['Content-Type'] = '';

        if($access_token !== null) {
            $queryParams['access_token'] = $this->apiClient->toQueryValue($access_token);
        }
        if($filePaths !== null) {
            $queryParams['filePaths'] = $this->apiClient->toQueryValue($filePaths);
        }
        if($destinationPath !== null) {
            $queryParams['destinationPath'] = $this->apiClient->toQueryValue($destinationPath);
        }
        //make the API Call
        if (! isset($body)) {
            $body = null;
        }
        $response = $this->apiClient->callAPI($resourcePath, $method,
                                              $queryParams, $body,
                                              $headerParams);


        if(! $response){
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response,
                                                        'ModifiedResourcesResponse');
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

        //parse inputs
        $resourcePath = "/v1/createFolder";
        $resourcePath = str_replace("{format}", "json", $resourcePath);
        $method = "GET";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';
        $headerParams['Content-Type'] = '';

        if($access_token !== null) {
            $queryParams['access_token'] = $this->apiClient->toQueryValue($access_token);
        }
        if($folderName !== null) {
            $queryParams['folderName'] = $this->apiClient->toQueryValue($folderName);
        }
        if($path !== null) {
            $queryParams['path'] = $this->apiClient->toQueryValue($path);
        }
        //make the API Call
        if (! isset($body)) {
            $body = null;
        }
        $response = $this->apiClient->callAPI($resourcePath, $method,
                                              $queryParams, $body,
                                              $headerParams);


        if(! $response){
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response,
                                                        'Response');
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
     * permissions, array[string]: An array of permissions for the user. The following values are supported: upload, download, delete, modify, list, changePassword, share, notification (required)
     * nickname, string: The user's nickname (optional)
     * locked, bool: If true, the user's account is locked by default (optional)
     * welcomeEmail, bool: If true, send a user email upon creation (optional)
     * timeZone, string: The user's timezone, used for accurate time display within SWFT. See &lt;a href='https://php.net/manual/en/timezones.php' target='blank'&gt;this page&lt;/a&gt; for allowed values (required)
     * @return Response
     */

    public function createUser($access_token, $username, $destinationFolder, $email, $password, $role, $permissions, $nickname=null, $locked=null, $welcomeEmail=null, $timeZone) {

        //parse inputs
        $resourcePath = "/v1/createUser";
        $resourcePath = str_replace("{format}", "json", $resourcePath);
        $method = "GET";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';
        $headerParams['Content-Type'] = '';

        if($access_token !== null) {
            $queryParams['access_token'] = $this->apiClient->toQueryValue($access_token);
        }
        if($username !== null) {
            $queryParams['username'] = $this->apiClient->toQueryValue($username);
        }
        if($destinationFolder !== null) {
            $queryParams['destinationFolder'] = $this->apiClient->toQueryValue($destinationFolder);
        }
        if($email !== null) {
            $queryParams['email'] = $this->apiClient->toQueryValue($email);
        }
        if($password !== null) {
            $queryParams['password'] = $this->apiClient->toQueryValue($password);
        }
        if($role !== null) {
            $queryParams['role'] = $this->apiClient->toQueryValue($role);
        }
        if($permissions !== null) {
            $queryParams['permissions'] = $this->apiClient->toQueryValue($permissions);
        }
        if($timeZone !== null) {
            $queryParams['timeZone'] = $this->apiClient->toQueryValue($timeZone);
        }
        if($nickname !== null) {
            $queryParams['nickname'] = $this->apiClient->toQueryValue($nickname);
        }
        if($locked !== null) {
            $queryParams['locked'] = $this->apiClient->toQueryValue($locked);
        }
        if($welcomeEmail !== null) {
            $queryParams['welcomeEmail'] = $this->apiClient->toQueryValue($welcomeEmail);
        }
        //make the API Call
        if (! isset($body)) {
            $body = null;
        }
        $response = $this->apiClient->callAPI($resourcePath, $method,
                                              $queryParams, $body,
                                              $headerParams);


        if(! $response){
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response,
                                                        'Response');
        return $responseObject;

        }
    /**
     * deleteResources
     * Delete the specified files/folders
     * access_token, string: Access token required to make the API call (required)
     * filePaths, array[string]: Array containing paths of the files or folder to delete (required)
     * @return FilesResponse
     */

    public function deleteResources($access_token, $filePaths) {

        //parse inputs
        $resourcePath = "/v1/deleteResources";
        $resourcePath = str_replace("{format}", "json", $resourcePath);
        $method = "GET";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';
        $headerParams['Content-Type'] = '';

        if($access_token !== null) {
            $queryParams['access_token'] = $this->apiClient->toQueryValue($access_token);
        }
        if($filePaths !== null) {
            $queryParams['filePaths'] = $this->apiClient->toQueryValue($filePaths);
        }
        //make the API Call
        if (! isset($body)) {
            $body = null;
        }
        $response = $this->apiClient->callAPI($resourcePath, $method,
                                              $queryParams, $body,
                                              $headerParams);


        if(! $response){
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response,
                                                        'FilesResponse');
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

        //parse inputs
        $resourcePath = "/v1/deleteUser";
        $resourcePath = str_replace("{format}", "json", $resourcePath);
        $method = "GET";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';
        $headerParams['Content-Type'] = '';

        if($access_token !== null) {
            $queryParams['access_token'] = $this->apiClient->toQueryValue($access_token);
        }
        if($username !== null) {
            $queryParams['username'] = $this->apiClient->toQueryValue($username);
        }
        //make the API Call
        if (! isset($body)) {
            $body = null;
        }
        $response = $this->apiClient->callAPI($resourcePath, $method,
                                              $queryParams, $body,
                                              $headerParams);


        if(! $response){
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response,
                                                        'Response');
        return $responseObject;

        }
    /**
     * getAccount
     * Gets the account object for the currently logged in user
     * access_token, string: Access token required to make the API call (required)
     * @return AccountResponse
     */

    public function getAccount($access_token) {

        //parse inputs
        $resourcePath = "/v1/getAccount";
        $resourcePath = str_replace("{format}", "json", $resourcePath);
        $method = "GET";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';
        $headerParams['Content-Type'] = '';

        if($access_token !== null) {
            $queryParams['access_token'] = $this->apiClient->toQueryValue($access_token);
        }
        //make the API Call
        if (! isset($body)) {
            $body = null;
        }
        $response = $this->apiClient->callAPI($resourcePath, $method,
                                              $queryParams, $body,
                                              $headerParams);


        if(! $response){
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response,
                                                        'AccountResponse');
        return $responseObject;

        }
    /**
     * getCurrentUser
     * Gets the user object for the currently logged in user
     * access_token, string: Access token required to make the API call (required)
     * @return UserResponse
     */

    public function getCurrentUser($access_token) {

        //parse inputs
        $resourcePath = "/v1/getCurrentUser";
        $resourcePath = str_replace("{format}", "json", $resourcePath);
        $method = "GET";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';
        $headerParams['Content-Type'] = '';

        if($access_token !== null) {
            $queryParams['access_token'] = $this->apiClient->toQueryValue($access_token);
        }
        //make the API Call
        if (! isset($body)) {
            $body = null;
        }
        $response = $this->apiClient->callAPI($resourcePath, $method,
                                              $queryParams, $body,
                                              $headerParams);


        if(! $response){
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response,
                                                        'UserResponse');
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

        //parse inputs
        $resourcePath = "/v1/getDownloadFileUrl";
        $resourcePath = str_replace("{format}", "json", $resourcePath);
        $method = "GET";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';
        $headerParams['Content-Type'] = '';

        if($access_token !== null) {
            $queryParams['access_token'] = $this->apiClient->toQueryValue($access_token);
        }
        if($filePaths !== null) {
            $queryParams['filePaths'] = $this->apiClient->toQueryValue($filePaths);
        }
        if($downloadName !== null) {
            $queryParams['downloadName'] = $this->apiClient->toQueryValue($downloadName);
        }
        //make the API Call
        if (! isset($body)) {
            $body = null;
        }
        $response = $this->apiClient->callAPI($resourcePath, $method,
                                              $queryParams, $body,
                                              $headerParams);


        if(! $response){
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response,
                                                        'UrlResponse');
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

        //parse inputs
        $resourcePath = "/v1/getFileActivityLogs";
        $resourcePath = str_replace("{format}", "json", $resourcePath);
        $method = "GET";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';
        $headerParams['Content-Type'] = '';

        if($access_token !== null) {
            $queryParams['access_token'] = $this->apiClient->toQueryValue($access_token);
        }
        if($offset !== null) {
            $queryParams['offset'] = $this->apiClient->toQueryValue($offset);
        }
        if($sortBy !== null) {
            $queryParams['sortBy'] = $this->apiClient->toQueryValue($sortBy);
        }
        if($sortOrder !== null) {
            $queryParams['sortOrder'] = $this->apiClient->toQueryValue($sortOrder);
        }
        if($filterBy !== null) {
            $queryParams['filterBy'] = $this->apiClient->toQueryValue($filterBy);
        }
        if($filter !== null) {
            $queryParams['filter'] = $this->apiClient->toQueryValue($filter);
        }
        if($itemLimit !== null) {
            $queryParams['itemLimit'] = $this->apiClient->toQueryValue($itemLimit);
        }
        //make the API Call
        if (! isset($body)) {
            $body = null;
        }
        $response = $this->apiClient->callAPI($resourcePath, $method,
                                              $queryParams, $body,
                                              $headerParams);


        if(! $response){
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response,
                                                        'LogResponse');
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

        //parse inputs
        $resourcePath = "/v1/getFolders";
        $resourcePath = str_replace("{format}", "json", $resourcePath);
        $method = "GET";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';
        $headerParams['Content-Type'] = '';

        if($access_token !== null) {
            $queryParams['access_token'] = $this->apiClient->toQueryValue($access_token);
        }
        if($path !== null) {
            $queryParams['path'] = $this->apiClient->toQueryValue($path);
        }
        //make the API Call
        if (! isset($body)) {
            $body = null;
        }
        $response = $this->apiClient->callAPI($resourcePath, $method,
                                              $queryParams, $body,
                                              $headerParams);


        if(! $response){
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response,
                                                        'ResourcePropertiesResponse');
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

        //parse inputs
        $resourcePath = "/v1/getResourceList";
        $resourcePath = str_replace("{format}", "json", $resourcePath);
        $method = "GET";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';
        $headerParams['Content-Type'] = '';

        if($access_token !== null) {
            $queryParams['access_token'] = $this->apiClient->toQueryValue($access_token);
        }
        if($path !== null) {
            $queryParams['path'] = $this->apiClient->toQueryValue($path);
        }
        if($sortBy !== null) {
            $queryParams['sortBy'] = $this->apiClient->toQueryValue($sortBy);
        }
        if($sortOrder !== null) {
            $queryParams['sortOrder'] = $this->apiClient->toQueryValue($sortOrder);
        }
        if($offset !== null) {
            $queryParams['offset'] = $this->apiClient->toQueryValue($offset);
        }
        if($limit !== null) {
            $queryParams['limit'] = $this->apiClient->toQueryValue($limit);
        }
        if($detailed !== null) {
            $queryParams['detailed'] = $this->apiClient->toQueryValue($detailed);
        }
        if($pattern !== null) {
            $queryParams['pattern'] = $this->apiClient->toQueryValue($pattern);
        }
        //make the API Call
        if (! isset($body)) {
            $body = null;
        }
        $response = $this->apiClient->callAPI($resourcePath, $method,
                                              $queryParams, $body,
                                              $headerParams);


        if(! $response){
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response,
                                                        'ResourceResponse');
        return $responseObject;

        }
    /**
     * getResourceProperties
     * Get the properties for each of the specified files/folders.
     * access_token, string: Access token required to make the API call (required)
     * filePaths, array[string]: Array containing paths of the files or folder to get (required)
     * @return ResourcePropertiesResponse
     */

    public function getResourceProperties($access_token, $filePaths) {

        //parse inputs
        $resourcePath = "/v1/getResourceProperties";
        $resourcePath = str_replace("{format}", "json", $resourcePath);
        $method = "GET";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';
        $headerParams['Content-Type'] = '';

        if($access_token !== null) {
            $queryParams['access_token'] = $this->apiClient->toQueryValue($access_token);
        }
        if($filePaths !== null) {
            $queryParams['filePaths'] = $this->apiClient->toQueryValue($filePaths);
        }
        //make the API Call
        if (! isset($body)) {
            $body = null;
        }
        $response = $this->apiClient->callAPI($resourcePath, $method,
                                              $queryParams, $body,
                                              $headerParams);


        if(! $response){
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response,
                                                        'ResourcePropertiesResponse');
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

        //parse inputs
        $resourcePath = "/v1/getUploadFileUrl";
        $resourcePath = str_replace("{format}", "json", $resourcePath);
        $method = "GET";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';
        $headerParams['Content-Type'] = '';

        if($access_token !== null) {
            $queryParams['access_token'] = $this->apiClient->toQueryValue($access_token);
        }
        if($fileSize !== null) {
            $queryParams['fileSize'] = $this->apiClient->toQueryValue($fileSize);
        }
        if($destinationPath !== null) {
            $queryParams['destinationPath'] = $this->apiClient->toQueryValue($destinationPath);
        }
        if($allowOverwrite !== null) {
            $queryParams['allowOverwrite'] = $this->apiClient->toQueryValue($allowOverwrite);
        }
        if($resume !== null) {
            $queryParams['resume'] = $this->apiClient->toQueryValue($resume);
        }
        //make the API Call
        if (! isset($body)) {
            $body = null;
        }
        $response = $this->apiClient->callAPI($resourcePath, $method,
                                              $queryParams, $body,
                                              $headerParams);


        if(! $response){
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response,
                                                        'UrlResponse');
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

        //parse inputs
        $resourcePath = "/v1/getUser";
        $resourcePath = str_replace("{format}", "json", $resourcePath);
        $method = "GET";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';
        $headerParams['Content-Type'] = '';

        if($access_token !== null) {
            $queryParams['access_token'] = $this->apiClient->toQueryValue($access_token);
        }
        if($username !== null) {
            $queryParams['username'] = $this->apiClient->toQueryValue($username);
        }
        //make the API Call
        if (! isset($body)) {
            $body = null;
        }
        $response = $this->apiClient->callAPI($resourcePath, $method,
                                              $queryParams, $body,
                                              $headerParams);


        if(! $response){
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response,
                                                        'UserResponse');
        return $responseObject;

        }
    /**
     * getUsers
     * Gets the user object for the currently logged in user
     * access_token, string: Access token required to make the API call (required)
     * sortBy, string: sort method ['sort_users_username' or 'sort_users_nickname' or 'sort_users_email' or 'sort_users_home_folder' or 'sort_users_permissions'] (required)
     * sortOrder, string: sort order, i.e. 'asc' or 'desc' (required)
     * @return UsersResponse
     */

    public function getUsers($access_token, $sortBy, $sortOrder) {

        //parse inputs
        $resourcePath = "/v1/getUsers";
        $resourcePath = str_replace("{format}", "json", $resourcePath);
        $method = "GET";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';
        $headerParams['Content-Type'] = '';

        if($access_token !== null) {
            $queryParams['access_token'] = $this->apiClient->toQueryValue($access_token);
        }
        if($sortBy !== null) {
            $queryParams['sortBy'] = $this->apiClient->toQueryValue($sortBy);
        }
        if($sortOrder !== null) {
            $queryParams['sortOrder'] = $this->apiClient->toQueryValue($sortOrder);
        }
        //make the API Call
        if (! isset($body)) {
            $body = null;
        }
        $response = $this->apiClient->callAPI($resourcePath, $method,
                                              $queryParams, $body,
                                              $headerParams);


        if(! $response){
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response,
                                                        'UsersResponse');
        return $responseObject;

        }
    /**
     * logoutUser
     * Removes user's access token from database, logging them out of API
     * access_token, string: Access token required to make the API call (required)
     * @return Response
     */

    public function logoutUser($access_token) {

        //parse inputs
        $resourcePath = "/v1/logoutUser";
        $resourcePath = str_replace("{format}", "json", $resourcePath);
        $method = "GET";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';
        $headerParams['Content-Type'] = '';

        if($access_token !== null) {
            $queryParams['access_token'] = $this->apiClient->toQueryValue($access_token);
        }
        //make the API Call
        if (! isset($body)) {
            $body = null;
        }
        $response = $this->apiClient->callAPI($resourcePath, $method,
                                              $queryParams, $body,
                                              $headerParams);


        if(! $response){
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response,
                                                        'Response');
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

        //parse inputs
        $resourcePath = "/v1/moveResources";
        $resourcePath = str_replace("{format}", "json", $resourcePath);
        $method = "GET";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';
        $headerParams['Content-Type'] = '';

        if($access_token !== null) {
            $queryParams['access_token'] = $this->apiClient->toQueryValue($access_token);
        }
        if($filePaths !== null) {
            $queryParams['filePaths'] = $this->apiClient->toQueryValue($filePaths);
        }
        if($destinationPath !== null) {
            $queryParams['destinationPath'] = $this->apiClient->toQueryValue($destinationPath);
        }
        //make the API Call
        if (! isset($body)) {
            $body = null;
        }
        $response = $this->apiClient->callAPI($resourcePath, $method,
                                              $queryParams, $body,
                                              $headerParams);


        if(! $response){
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response,
                                                        'ModifiedResourcesResponse');
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

        //parse inputs
        $resourcePath = "/v1/previewFile";
        $resourcePath = str_replace("{format}", "json", $resourcePath);
        $method = "GET";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';
        $headerParams['Content-Type'] = '';

        if($access_token !== null) {
            $queryParams['access_token'] = $this->apiClient->toQueryValue($access_token);
        }
        if($path !== null) {
            $queryParams['path'] = $this->apiClient->toQueryValue($path);
        }
        if($size !== null) {
            $queryParams['size'] = $this->apiClient->toQueryValue($size);
        }
        if($width !== null) {
            $queryParams['width'] = $this->apiClient->toQueryValue($width);
        }
        if($height !== null) {
            $queryParams['height'] = $this->apiClient->toQueryValue($height);
        }
        if($page !== null) {
            $queryParams['page'] = $this->apiClient->toQueryValue($page);
        }
        //make the API Call
        if (! isset($body)) {
            $body = null;
        }
        $response = $this->apiClient->callAPI($resourcePath, $method,
                                              $queryParams, $body,
                                              $headerParams);


        if(! $response){
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response,
                                                        'PreviewFileResponse');
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

        //parse inputs
        $resourcePath = "/v1/renameResource";
        $resourcePath = str_replace("{format}", "json", $resourcePath);
        $method = "GET";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';
        $headerParams['Content-Type'] = '';

        if($access_token !== null) {
            $queryParams['access_token'] = $this->apiClient->toQueryValue($access_token);
        }
        if($filePath !== null) {
            $queryParams['filePath'] = $this->apiClient->toQueryValue($filePath);
        }
        if($newName !== null) {
            $queryParams['newName'] = $this->apiClient->toQueryValue($newName);
        }
        //make the API Call
        if (! isset($body)) {
            $body = null;
        }
        $response = $this->apiClient->callAPI($resourcePath, $method,
                                              $queryParams, $body,
                                              $headerParams);


        if(! $response){
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response,
                                                        'Response');
        return $responseObject;

        }
    /**
     * updateUser
     * Updates a subaccount user for the current account
     * access_token, string: Access token required to make the API call (required)
     * userId, int: The user ID, must be obtained from getUser method first (required)
     * username, string: Name of the subaccount user to modify (optional)
     * nickname, string: The user's nickname (optional)
     * email, string: The user's email (optional)
     * destinationFolder, string: The user's home folder (optional)
     * password, string: The user's password (optional)
     * locked, bool: If true, the user's account is locked by default (optional)
     * role, string: The user's role, i.e: 'user', 'admin', 'master' (optional)
     * permissions, array[string]: An array of permissions for the user (optional)
     * @return Response
     */

    public function updateUser($access_token, $userId, $username=null, $nickname=null, $email=null, $destinationFolder=null, $password=null, $locked=null, $role=null, $permissions=null) {

        //parse inputs
        $resourcePath = "/v1/updateUser";
        $resourcePath = str_replace("{format}", "json", $resourcePath);
        $method = "GET";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';
        $headerParams['Content-Type'] = '';

        if($access_token !== null) {
            $queryParams['access_token'] = $this->apiClient->toQueryValue($access_token);
        }
        if($userId !== null) {
            $queryParams['userId'] = $this->apiClient->toQueryValue($userId);
        }
        if($username !== null) {
            $queryParams['username'] = $this->apiClient->toQueryValue($username);
        }
        if($nickname !== null) {
            $queryParams['nickname'] = $this->apiClient->toQueryValue($nickname);
        }
        if($email !== null) {
            $queryParams['email'] = $this->apiClient->toQueryValue($email);
        }
        if($destinationFolder !== null) {
            $queryParams['destinationFolder'] = $this->apiClient->toQueryValue($destinationFolder);
        }
        if($password !== null) {
            $queryParams['password'] = $this->apiClient->toQueryValue($password);
        }
        if($locked !== null) {
            $queryParams['locked'] = $this->apiClient->toQueryValue($locked);
        }
        if($role !== null) {
            $queryParams['role'] = $this->apiClient->toQueryValue($role);
        }
        if($permissions !== null) {
            $queryParams['permissions'] = $this->apiClient->toQueryValue($permissions);
        }
        //make the API Call
        if (! isset($body)) {
            $body = null;
        }
        $response = $this->apiClient->callAPI($resourcePath, $method,
                                              $queryParams, $body,
                                              $headerParams);


        if(! $response){
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response,
                                                        'Response');
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

        //parse inputs
        $resourcePath = "/v1/userAvailable";
        $resourcePath = str_replace("{format}", "json", $resourcePath);
        $method = "GET";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = '(mediaType,application/json)';
        $headerParams['Content-Type'] = '';

        if($access_token !== null) {
            $queryParams['access_token'] = $this->apiClient->toQueryValue($access_token);
        }
        if($username !== null) {
            $queryParams['username'] = $this->apiClient->toQueryValue($username);
        }
        //make the API Call
        if (! isset($body)) {
            $body = null;
        }
        $response = $this->apiClient->callAPI($resourcePath, $method,
                                              $queryParams, $body,
                                              $headerParams);


        if(! $response){
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response,
                                                        'AvailableUserResponse');
        return $responseObject;

        }
    
    }

