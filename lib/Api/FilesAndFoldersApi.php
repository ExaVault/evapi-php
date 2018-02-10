<?php
/**
 * FilesAndFoldersApi
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
 * # Introduction  Welcome to the ExaVault API documentation. Our API lets you control nearly all aspects of your ExaVault account programatically, from uploading and downloading files to creating and managing shares and notifications. Our API supports both GET and POST operations.  Capabilities of the API include:  - Uploading and downloading files. - Managing files and folders; including standard operations like move, copy and delete. - Getting information about activity occuring in your account. - Creating, updating and deleting users. - Creating and managing shares, including download-only shares and recieve folders.  - Setting up and managing notifications.  ## The API Endpoint  The ExaVault API is located at: https://api.exavault.com/v1/  # Testing w/ Postman  We've made it easy for you to test our API before you start full-scale development. Download [Postman](https://www.getpostman.com/) or the [Postman Chrome Extension](https://chrome.google.com/webstore/detail/postman/fhbjgbiflinjbdggehcddcbncdddomop?hl=en), and then download our Postman collection, below. [Obtain your API key](#section/Code-Libraries-and-Sample-PHP-Code/Obtain-your-API-key) and you'll be able to interact with your ExaVault account immediately, so you can better understand what the capabilities of the API are.  <div class=\"postman-run-button\" data-postman-action=\"collection/import\" data-postman-var-1=\"e13395afc6278ce1555f\"></div>  ![ExaVault API Postman Colletion Usage](/images/postman.png)  If you'd prefer to skip Postman and start working with code directly, take a look at the sample code below.    # Code Libraries & Sample PHP Code  Once you're ready for full-scale development, we recommend looking at our code libraries available on [GitHub](https://github.com/ExaVault). We offer code libraries for [Python](https://github.com/ExaVault/evapi-python), [PHP](https://github.com/ExaVault/evapi-php) and [JavaScript](https://github.com/ExaVault/evapi-javascript).  While we recommend using our libraries, you're welcome to interact directly with our API via HTTP GET and POST requests -- a great option particularly if you're developing in a language for which we don't yet have sample code.     - [Download Python Library &amp; Sample Code &raquo;](https://github.com/ExaVault/evapi-python) - [Download PHP Library &amp; Sample Code &raquo;](https://github.com/ExaVault/evapi-php) - [Download JavaScript Library &amp; Sample Code &raquo;](https://github.com/ExaVault/evapi-javascript)  *Note: You can generate client libraries for any language using [Swagger Editor](http://editor2.swagger.io/). Just download our documentation file, past it into editor and use 'Generate Client' dropdown.*  ## Obtain Your API Key  You will need to obtain an API key for your application from the [Client Area](https://clients.exavault.com/clientarea.php?action=products) of your account.  To obtain an API key, please follow the instructions below.   + Login to the [Accounts](https://clients.exavault.com/clientarea.php?action=products) section of the Client Area.  + Use the drop down next to your desired account, and select *Manage API Keys*.  + You will be brought to the API Key management screen. Fill out the form and save to generate a new key for your app.  *NOTE: As of Oct 2017, we are in the progress of migrating customers to our next generation platform. If your account is already on our new platform, you should log into your File Manager and create your API key under Account->Developer->Manage API Keys*.  # Status Codes  The ExaVault API returns only two HTTP status codes for its responses: 200 and 500.  When the request could be successfully processed by the endpoint, the response status code will be 200, regardless of whether the requested action could be taken.  For example, the response to a getUser request for a username that does not exist in your account would have the status of 200,  indicating that the response was received and processed, but the error member of the returned response object would contain object with `message` and `code` properties.  **Result Format:**  |Success   | Error     | Results   | | ---      | :---:       |  :---:      | | 0        |  `Object` |   Empty   | | 1        |   Empty       |    `Object` or `Array`        |     When a malformed request is received, a 500 HTTP status code will be returned, indicating that the request could not be processed.  ExaVault's API does not currently support traditional REST response codes such as '201 Created' or '405 Method Not Allowed', although we intend to support such codes a future version of the API.   # File Paths  Many API calls require you to provide one or more file paths. For example, the <a href=\"#operation/moveResources\">moveResources</a> call requires both an array of source paths, **filePaths**, and a destination path, **destinationPath**. Here's a few tips for working with paths:   - File paths should always be specified as a string, using the standard Unix format: e.g. `/path/to/a/file.txt`  - File paths are always absolute _from the home directory of the logged in user_. For example, if the user **bob** had a home directory restriction of `/bob_home`, then an API call made using his login would specify a file as `/myfile.txt`, whereas an API call made using the master user ( no home directory restriction ) would specify the same file as `/bob_home/myfile.txt`.  # API Rate Limits  We rate limit the number of API calls you can make to help prevent abuse and protect system stablity. Each API key will support 500 requests per rolling five minutes. If you make more than 500 requests in a five minute period, you will receive a response with an error object for fifteen minutes.  # Webhooks  A webhook is an HTTP callback: a simple event-notification via HTTP POST. If you define webhooks for Exavault, ExaVault will POST a  message to a URL when certain things happen.     Webhooks can be used to receive a JSON object to your endpoint URL. You choose what events will trigger webhook messages to your endpoint URL.     Webhooks will attempt to send a message up to 8 times with increasing timeouts between each attempt. All webhook requests are tracked in the webhooks log.  ## Getting Started  1. Go to the Account tab inside SWFT.  2. Choose the Developer tab.  3. Configure your endpoint URL and select the events you want to trigger webhook messages.  4. Save settings.    You are all set to receive webhook callbacks on the events you selected.  ## Verification Signature  ExaVault includes a custom HTTP header, X-Exavault-Signature, with webhooks POST requests which will contain the signature for the request.  You can use the signature to verify the request for an additional level of security.  ## Generating the Signature  1. Go to Account tab inside SWFT.  2. Choose the Developer tab.  3. Obtain the verification token. This field will only be shown if you've configured your endpoint URL.  4. In your code that receives or processes the webhooks, you should concatenate the verification token with the JSON object that we sent in our      POST request and hash it with md5.     ```     md5($verificationToken.$webhooksObject);     ```  5. Compare signature that you generated to the signature provided in the X-Exavault-Signature HTTP header  ## Example JSON Response Object  ```json   {     \"accountname\": \"mycompanyname\",     \"username\": \"john\"     \"operation\": \"Upload\",     \"protocol\": \"https\",     \"path\": \"/testfolder/filename.jpg\"     \"attempt\": 1   } ```  ## Webhooks Logs  Keep track of all your webhooks requests in the Activity section of your account. You can find the following info for each request:    1. date and time - timestamp of the request.    2. endpoint url - where the webhook was sent.    3. event - what triggered the webhook.    4. status - HTTP status or curl error code.    5. attempt - how many times we tried to send this request.    6. response size - size of the response from your server.    7. details - you can check the response body if it was sent.
 *
 * OpenAPI spec version: 1.0.1
 * 
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 *
 */

/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace Swagger\Client\Api;

use \Swagger\Client\ApiClient;
use \Swagger\Client\ApiException;
use \Swagger\Client\Configuration;
use \Swagger\Client\ObjectSerializer;

/**
 * FilesAndFoldersApi Class Doc Comment
 *
 * @category Class
 * @package  Swagger\Client
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class FilesAndFoldersApi
{
    /**
     * API Client
     *
     * @var \Swagger\Client\ApiClient instance of the ApiClient
     */
    protected $apiClient;

    /**
     * Constructor
     *
     * @param \Swagger\Client\ApiClient|null $apiClient The api client to use
     */
    public function __construct(\Swagger\Client\ApiClient $apiClient = null)
    {
        if ($apiClient === null) {
            $apiClient = new ApiClient();
        }

        $this->apiClient = $apiClient;
    }

    /**
     * Get API client
     *
     * @return \Swagger\Client\ApiClient get the API client
     */
    public function getApiClient()
    {
        return $this->apiClient;
    }

    /**
     * Set the API client
     *
     * @param \Swagger\Client\ApiClient $apiClient set the API client
     *
     * @return FilesAndFoldersApi
     */
    public function setApiClient(\Swagger\Client\ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
        return $this;
    }

    /**
     * Operation checkFilesExist
     *
     * checkFilesExist
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @param string[] $file_paths Array containing file/folder paths to check. (required)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return \Swagger\Client\Model\ExistingResourcesResponse
     */
    public function checkFilesExist($api_key, $access_token, $file_paths)
    {
        list($response) = $this->checkFilesExistWithHttpInfo($api_key, $access_token, $file_paths);
        return $response;
    }

    /**
     * Operation checkFilesExistWithHttpInfo
     *
     * checkFilesExist
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @param string[] $file_paths Array containing file/folder paths to check. (required)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return array of \Swagger\Client\Model\ExistingResourcesResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function checkFilesExistWithHttpInfo($api_key, $access_token, $file_paths)
    {
        // verify the required parameter 'api_key' is set
        if ($api_key === null) {
            throw new \InvalidArgumentException('Missing the required parameter $api_key when calling checkFilesExist');
        }
        // verify the required parameter 'access_token' is set
        if ($access_token === null) {
            throw new \InvalidArgumentException('Missing the required parameter $access_token when calling checkFilesExist');
        }
        // verify the required parameter 'file_paths' is set
        if ($file_paths === null) {
            throw new \InvalidArgumentException('Missing the required parameter $file_paths when calling checkFilesExist');
        }
        // parse inputs
        $resourcePath = "/checkFilesExist";
        $httpBody = '';
        $queryParams = [];
        $headerParams = [];
        $formParams = [];
        $_header_accept = $this->apiClient->selectHeaderAccept(['application/json']);
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = $this->apiClient->selectHeaderContentType([]);

        // query params
        if ($access_token !== null) {
            $queryParams['access_token'] = $this->apiClient->getSerializer()->toQueryValue($access_token);
        }
        // query params
        if (is_array($file_paths)) {
            /* EV use false as the last param on serializeCollection call */
            $file_paths = $this->apiClient->getSerializer()->serializeCollection($file_paths, 'multi', false);
        }
        if ($file_paths !== null) {
            $queryParams['filePaths[]'] = $this->apiClient->getSerializer()->toQueryValue($file_paths);
        }
        // header params
        if ($api_key !== null) {
            $headerParams['api_key'] = $this->apiClient->getSerializer()->toHeaderValue($api_key);
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        // make the API Call
        try {
            list($response, $statusCode, $httpHeader) = $this->apiClient->callApi(
                $resourcePath,
                'GET',
                $queryParams,
                $httpBody,
                $headerParams,
                '\Swagger\Client\Model\ExistingResourcesResponse',
                '/checkFilesExist'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Swagger\Client\Model\ExistingResourcesResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Swagger\Client\Model\ExistingResourcesResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }

            throw $e;
        }
    }

    /**
     * Operation copyResources
     *
     * copyResources
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @param string[] $file_paths Array containing file/folder paths to copy. (required)
     * @param string $destination_path Remote destination path to copy files/folders to. (required)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return \Swagger\Client\Model\ModifiedResourcesResponse
     */
    public function copyResources($api_key, $access_token, $file_paths, $destination_path)
    {
        list($response) = $this->copyResourcesWithHttpInfo($api_key, $access_token, $file_paths, $destination_path);
        return $response;
    }

    /**
     * Operation copyResourcesWithHttpInfo
     *
     * copyResources
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @param string[] $file_paths Array containing file/folder paths to copy. (required)
     * @param string $destination_path Remote destination path to copy files/folders to. (required)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return array of \Swagger\Client\Model\ModifiedResourcesResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function copyResourcesWithHttpInfo($api_key, $access_token, $file_paths, $destination_path)
    {
        // verify the required parameter 'api_key' is set
        if ($api_key === null) {
            throw new \InvalidArgumentException('Missing the required parameter $api_key when calling copyResources');
        }
        // verify the required parameter 'access_token' is set
        if ($access_token === null) {
            throw new \InvalidArgumentException('Missing the required parameter $access_token when calling copyResources');
        }
        // verify the required parameter 'file_paths' is set
        if ($file_paths === null) {
            throw new \InvalidArgumentException('Missing the required parameter $file_paths when calling copyResources');
        }
        // verify the required parameter 'destination_path' is set
        if ($destination_path === null) {
            throw new \InvalidArgumentException('Missing the required parameter $destination_path when calling copyResources');
        }
        // parse inputs
        $resourcePath = "/copyResources";
        $httpBody = '';
        $queryParams = [];
        $headerParams = [];
        $formParams = [];
        $_header_accept = $this->apiClient->selectHeaderAccept(['application/json']);
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = $this->apiClient->selectHeaderContentType(['application/x-www-form-urlencoded']);

        // header params
        if ($api_key !== null) {
            $headerParams['api_key'] = $this->apiClient->getSerializer()->toHeaderValue($api_key);
        }
        // form params
        if ($access_token !== null) {
            $formParams['access_token'] = $this->apiClient->getSerializer()->toFormValue($access_token);
        }
        // form params
        if ($file_paths !== null) {
            $formParams['filePaths'] = $this->apiClient->getSerializer()->toFormValue($file_paths);
        }
        // form params
        if ($destination_path !== null) {
            $formParams['destinationPath'] = $this->apiClient->getSerializer()->toFormValue($destination_path);
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        // make the API Call
        try {
            list($response, $statusCode, $httpHeader) = $this->apiClient->callApi(
                $resourcePath,
                'POST',
                $queryParams,
                $httpBody,
                $headerParams,
                '\Swagger\Client\Model\ModifiedResourcesResponse',
                '/copyResources'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Swagger\Client\Model\ModifiedResourcesResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Swagger\Client\Model\ModifiedResourcesResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }

            throw $e;
        }
    }

    /**
     * Operation createFolder
     *
     * createFolder
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @param string $folder_name Name of the folder to create. (required)
     * @param string $path Where to create the folder. Use **_/_** to create a folder in the user&#39;s home directory. (required)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return \Swagger\Client\Model\Response
     */
    public function createFolder($api_key, $access_token, $folder_name, $path)
    {
        list($response) = $this->createFolderWithHttpInfo($api_key, $access_token, $folder_name, $path);
        return $response;
    }

    /**
     * Operation createFolderWithHttpInfo
     *
     * createFolder
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @param string $folder_name Name of the folder to create. (required)
     * @param string $path Where to create the folder. Use **_/_** to create a folder in the user&#39;s home directory. (required)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return array of \Swagger\Client\Model\Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function createFolderWithHttpInfo($api_key, $access_token, $folder_name, $path)
    {
        // verify the required parameter 'api_key' is set
        if ($api_key === null) {
            throw new \InvalidArgumentException('Missing the required parameter $api_key when calling createFolder');
        }
        // verify the required parameter 'access_token' is set
        if ($access_token === null) {
            throw new \InvalidArgumentException('Missing the required parameter $access_token when calling createFolder');
        }
        // verify the required parameter 'folder_name' is set
        if ($folder_name === null) {
            throw new \InvalidArgumentException('Missing the required parameter $folder_name when calling createFolder');
        }
        // verify the required parameter 'path' is set
        if ($path === null) {
            throw new \InvalidArgumentException('Missing the required parameter $path when calling createFolder');
        }
        // parse inputs
        $resourcePath = "/createFolder";
        $httpBody = '';
        $queryParams = [];
        $headerParams = [];
        $formParams = [];
        $_header_accept = $this->apiClient->selectHeaderAccept(['application/json']);
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = $this->apiClient->selectHeaderContentType(['application/x-www-form-urlencoded']);

        // header params
        if ($api_key !== null) {
            $headerParams['api_key'] = $this->apiClient->getSerializer()->toHeaderValue($api_key);
        }
        // form params
        if ($access_token !== null) {
            $formParams['access_token'] = $this->apiClient->getSerializer()->toFormValue($access_token);
        }
        // form params
        if ($folder_name !== null) {
            $formParams['folderName'] = $this->apiClient->getSerializer()->toFormValue($folder_name);
        }
        // form params
        if ($path !== null) {
            $formParams['path'] = $this->apiClient->getSerializer()->toFormValue($path);
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        // make the API Call
        try {
            list($response, $statusCode, $httpHeader) = $this->apiClient->callApi(
                $resourcePath,
                'POST',
                $queryParams,
                $httpBody,
                $headerParams,
                '\Swagger\Client\Model\Response',
                '/createFolder'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Swagger\Client\Model\Response', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Swagger\Client\Model\Response', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }

            throw $e;
        }
    }

    /**
     * Operation deleteResources
     *
     * deleteResources
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @param string[] $file_paths Array containing paths of the files or folder to delete. (required)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return \Swagger\Client\Model\DeletedResourcesResponse
     */
    public function deleteResources($api_key, $access_token, $file_paths)
    {
        list($response) = $this->deleteResourcesWithHttpInfo($api_key, $access_token, $file_paths);
        return $response;
    }

    /**
     * Operation deleteResourcesWithHttpInfo
     *
     * deleteResources
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @param string[] $file_paths Array containing paths of the files or folder to delete. (required)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return array of \Swagger\Client\Model\DeletedResourcesResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteResourcesWithHttpInfo($api_key, $access_token, $file_paths)
    {
        // verify the required parameter 'api_key' is set
        if ($api_key === null) {
            throw new \InvalidArgumentException('Missing the required parameter $api_key when calling deleteResources');
        }
        // verify the required parameter 'access_token' is set
        if ($access_token === null) {
            throw new \InvalidArgumentException('Missing the required parameter $access_token when calling deleteResources');
        }
        // verify the required parameter 'file_paths' is set
        if ($file_paths === null) {
            throw new \InvalidArgumentException('Missing the required parameter $file_paths when calling deleteResources');
        }
        // parse inputs
        $resourcePath = "/deleteResources";
        $httpBody = '';
        $queryParams = [];
        $headerParams = [];
        $formParams = [];
        $_header_accept = $this->apiClient->selectHeaderAccept(['application/json']);
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = $this->apiClient->selectHeaderContentType([]);

        // query params
        if ($access_token !== null) {
            $queryParams['access_token'] = $this->apiClient->getSerializer()->toQueryValue($access_token);
        }
        // query params
        if (is_array($file_paths)) {
            /* EV use false as the last param on serializeCollection call */
            $file_paths = $this->apiClient->getSerializer()->serializeCollection($file_paths, 'multi', false);
        }
        if ($file_paths !== null) {
            $queryParams['filePaths[]'] = $this->apiClient->getSerializer()->toQueryValue($file_paths);
        }
        // header params
        if ($api_key !== null) {
            $headerParams['api_key'] = $this->apiClient->getSerializer()->toHeaderValue($api_key);
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        // make the API Call
        try {
            list($response, $statusCode, $httpHeader) = $this->apiClient->callApi(
                $resourcePath,
                'GET',
                $queryParams,
                $httpBody,
                $headerParams,
                '\Swagger\Client\Model\DeletedResourcesResponse',
                '/deleteResources'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Swagger\Client\Model\DeletedResourcesResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Swagger\Client\Model\DeletedResourcesResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }

            throw $e;
        }
    }

    /**
     * Operation getDownloadFileUrl
     *
     * getDownloadFileUrl
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @param string $file_paths Path of file to be downloaded. (required)
     * @param string $download_name The name of the file to be downloaded. (optional)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return \Swagger\Client\Model\UrlResponse
     */
    public function getDownloadFileUrl($api_key, $access_token, $file_paths, $download_name = null)
    {
        list($response) = $this->getDownloadFileUrlWithHttpInfo($api_key, $access_token, $file_paths, $download_name);
        return $response;
    }

    /**
     * Operation getDownloadFileUrlWithHttpInfo
     *
     * getDownloadFileUrl
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @param string $file_paths Path of file to be downloaded. (required)
     * @param string $download_name The name of the file to be downloaded. (optional)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return array of \Swagger\Client\Model\UrlResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getDownloadFileUrlWithHttpInfo($api_key, $access_token, $file_paths, $download_name = null)
    {
        // verify the required parameter 'api_key' is set
        if ($api_key === null) {
            throw new \InvalidArgumentException('Missing the required parameter $api_key when calling getDownloadFileUrl');
        }
        // verify the required parameter 'access_token' is set
        if ($access_token === null) {
            throw new \InvalidArgumentException('Missing the required parameter $access_token when calling getDownloadFileUrl');
        }
        // verify the required parameter 'file_paths' is set
        if ($file_paths === null) {
            throw new \InvalidArgumentException('Missing the required parameter $file_paths when calling getDownloadFileUrl');
        }
        // parse inputs
        $resourcePath = "/getDownloadFileUrl";
        $httpBody = '';
        $queryParams = [];
        $headerParams = [];
        $formParams = [];
        $_header_accept = $this->apiClient->selectHeaderAccept(['application/json']);
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = $this->apiClient->selectHeaderContentType([]);

        // query params
        if ($access_token !== null) {
            $queryParams['access_token'] = $this->apiClient->getSerializer()->toQueryValue($access_token);
        }
        // query params
        if ($file_paths !== null) {
            $queryParams['filePaths'] = $this->apiClient->getSerializer()->toQueryValue($file_paths);
        }
        // query params
        if ($download_name !== null) {
            $queryParams['downloadName'] = $this->apiClient->getSerializer()->toQueryValue($download_name);
        }
        // header params
        if ($api_key !== null) {
            $headerParams['api_key'] = $this->apiClient->getSerializer()->toHeaderValue($api_key);
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        // make the API Call
        try {
            list($response, $statusCode, $httpHeader) = $this->apiClient->callApi(
                $resourcePath,
                'GET',
                $queryParams,
                $httpBody,
                $headerParams,
                '\Swagger\Client\Model\UrlResponse',
                '/getDownloadFileUrl'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Swagger\Client\Model\UrlResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Swagger\Client\Model\UrlResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }

            throw $e;
        }
    }

    /**
     * Operation getFolders
     *
     * getFolders
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @param string $path Path to get folders for. (required)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return \Swagger\Client\Model\ResourcePropertiesResponse
     */
    public function getFolders($api_key, $access_token, $path)
    {
        list($response) = $this->getFoldersWithHttpInfo($api_key, $access_token, $path);
        return $response;
    }

    /**
     * Operation getFoldersWithHttpInfo
     *
     * getFolders
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @param string $path Path to get folders for. (required)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return array of \Swagger\Client\Model\ResourcePropertiesResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getFoldersWithHttpInfo($api_key, $access_token, $path)
    {
        // verify the required parameter 'api_key' is set
        if ($api_key === null) {
            throw new \InvalidArgumentException('Missing the required parameter $api_key when calling getFolders');
        }
        // verify the required parameter 'access_token' is set
        if ($access_token === null) {
            throw new \InvalidArgumentException('Missing the required parameter $access_token when calling getFolders');
        }
        // verify the required parameter 'path' is set
        if ($path === null) {
            throw new \InvalidArgumentException('Missing the required parameter $path when calling getFolders');
        }
        // parse inputs
        $resourcePath = "/getFolders";
        $httpBody = '';
        $queryParams = [];
        $headerParams = [];
        $formParams = [];
        $_header_accept = $this->apiClient->selectHeaderAccept(['application/json']);
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = $this->apiClient->selectHeaderContentType([]);

        // query params
        if ($access_token !== null) {
            $queryParams['access_token'] = $this->apiClient->getSerializer()->toQueryValue($access_token);
        }
        // query params
        if ($path !== null) {
            $queryParams['path'] = $this->apiClient->getSerializer()->toQueryValue($path);
        }
        // header params
        if ($api_key !== null) {
            $headerParams['api_key'] = $this->apiClient->getSerializer()->toHeaderValue($api_key);
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        // make the API Call
        try {
            list($response, $statusCode, $httpHeader) = $this->apiClient->callApi(
                $resourcePath,
                'GET',
                $queryParams,
                $httpBody,
                $headerParams,
                '\Swagger\Client\Model\ResourcePropertiesResponse',
                '/getFolders'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Swagger\Client\Model\ResourcePropertiesResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Swagger\Client\Model\ResourcePropertiesResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }

            throw $e;
        }
    }

    /**
     * Operation getResourceList
     *
     * getResourceList
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @param string $path Path to get listing of resources for. (required)
     * @param string $sort_by Sort method. Use in conjunction with **sort_order**, below. (optional, default to sort_files_name)
     * @param string $sort_order Sort order. (optional, default to asc)
     * @param int $offset Determines which item to start on for pagination. Use zero (0) to start at the beginning of the list. (optional, default to 0)
     * @param int $limit The number of files to limit the result. Cannot be set higher than 100. If you have more than one hundred files in your directory, make multiple calls to **getResourceList**, incrementing the **offset** parameter, above. (optional, default to 50)
     * @param bool $detailed If true, returns sharedFolder, notifications or other objects associated with specified path. You should only set this paramter to true if you need the additional details, as the API call is less perfomant when it is enabled. (optional, default to false)
     * @param string $pattern Regex string. If not null, perform a search with specified pattern. (optional)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return \Swagger\Client\Model\ResourceResponse
     */
    public function getResourceList($api_key, $access_token, $path, $sort_by = 'sort_files_name', $sort_order = 'asc', $offset = '0', $limit = '50', $detailed = 'false', $pattern = null)
    {
        list($response) = $this->getResourceListWithHttpInfo($api_key, $access_token, $path, $sort_by, $sort_order, $offset, $limit, $detailed, $pattern);
        return $response;
    }

    /**
     * Operation getResourceListWithHttpInfo
     *
     * getResourceList
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @param string $path Path to get listing of resources for. (required)
     * @param string $sort_by Sort method. Use in conjunction with **sort_order**, below. (optional, default to sort_files_name)
     * @param string $sort_order Sort order. (optional, default to asc)
     * @param int $offset Determines which item to start on for pagination. Use zero (0) to start at the beginning of the list. (optional, default to 0)
     * @param int $limit The number of files to limit the result. Cannot be set higher than 100. If you have more than one hundred files in your directory, make multiple calls to **getResourceList**, incrementing the **offset** parameter, above. (optional, default to 50)
     * @param bool $detailed If true, returns sharedFolder, notifications or other objects associated with specified path. You should only set this paramter to true if you need the additional details, as the API call is less perfomant when it is enabled. (optional, default to false)
     * @param string $pattern Regex string. If not null, perform a search with specified pattern. (optional)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return array of \Swagger\Client\Model\ResourceResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getResourceListWithHttpInfo($api_key, $access_token, $path, $sort_by = 'sort_files_name', $sort_order = 'asc', $offset = '0', $limit = '50', $detailed = 'false', $pattern = null)
    {
        // verify the required parameter 'api_key' is set
        if ($api_key === null) {
            throw new \InvalidArgumentException('Missing the required parameter $api_key when calling getResourceList');
        }
        // verify the required parameter 'access_token' is set
        if ($access_token === null) {
            throw new \InvalidArgumentException('Missing the required parameter $access_token when calling getResourceList');
        }
        // verify the required parameter 'path' is set
        if ($path === null) {
            throw new \InvalidArgumentException('Missing the required parameter $path when calling getResourceList');
        }
        // parse inputs
        $resourcePath = "/getResourceList";
        $httpBody = '';
        $queryParams = [];
        $headerParams = [];
        $formParams = [];
        $_header_accept = $this->apiClient->selectHeaderAccept(['application/json']);
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = $this->apiClient->selectHeaderContentType([]);

        // query params
        if ($access_token !== null) {
            $queryParams['access_token'] = $this->apiClient->getSerializer()->toQueryValue($access_token);
        }
        // query params
        if ($path !== null) {
            $queryParams['path'] = $this->apiClient->getSerializer()->toQueryValue($path);
        }
        // query params
        if ($sort_by !== null) {
            $queryParams['sortBy'] = $this->apiClient->getSerializer()->toQueryValue($sort_by);
        }
        // query params
        if ($sort_order !== null) {
            $queryParams['sortOrder'] = $this->apiClient->getSerializer()->toQueryValue($sort_order);
        }
        // query params
        if ($offset !== null) {
            $queryParams['offset'] = $this->apiClient->getSerializer()->toQueryValue($offset);
        }
        // query params
        if ($limit !== null) {
            $queryParams['limit'] = $this->apiClient->getSerializer()->toQueryValue($limit);
        }
        // query params
        if ($detailed !== null) {
            $queryParams['detailed'] = $this->apiClient->getSerializer()->toQueryValue($detailed);
        }
        // query params
        if ($pattern !== null) {
            $queryParams['pattern'] = $this->apiClient->getSerializer()->toQueryValue($pattern);
        }
        // header params
        if ($api_key !== null) {
            $headerParams['api_key'] = $this->apiClient->getSerializer()->toHeaderValue($api_key);
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        // make the API Call
        try {
            list($response, $statusCode, $httpHeader) = $this->apiClient->callApi(
                $resourcePath,
                'GET',
                $queryParams,
                $httpBody,
                $headerParams,
                '\Swagger\Client\Model\ResourceResponse',
                '/getResourceList'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Swagger\Client\Model\ResourceResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Swagger\Client\Model\ResourceResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }

            throw $e;
        }
    }

    /**
     * Operation getResourceProperties
     *
     * getResourceProperties
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @param string[] $file_paths Array containing paths of the files or folder to get metadata for. (required)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return \Swagger\Client\Model\ResourcePropertiesResponse
     */
    public function getResourceProperties($api_key, $access_token, $file_paths)
    {
        list($response) = $this->getResourcePropertiesWithHttpInfo($api_key, $access_token, $file_paths);
        return $response;
    }

    /**
     * Operation getResourcePropertiesWithHttpInfo
     *
     * getResourceProperties
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @param string[] $file_paths Array containing paths of the files or folder to get metadata for. (required)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return array of \Swagger\Client\Model\ResourcePropertiesResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getResourcePropertiesWithHttpInfo($api_key, $access_token, $file_paths)
    {
        // verify the required parameter 'api_key' is set
        if ($api_key === null) {
            throw new \InvalidArgumentException('Missing the required parameter $api_key when calling getResourceProperties');
        }
        // verify the required parameter 'access_token' is set
        if ($access_token === null) {
            throw new \InvalidArgumentException('Missing the required parameter $access_token when calling getResourceProperties');
        }
        // verify the required parameter 'file_paths' is set
        if ($file_paths === null) {
            throw new \InvalidArgumentException('Missing the required parameter $file_paths when calling getResourceProperties');
        }
        // parse inputs
        $resourcePath = "/getResourceProperties";
        $httpBody = '';
        $queryParams = [];
        $headerParams = [];
        $formParams = [];
        $_header_accept = $this->apiClient->selectHeaderAccept(['application/json']);
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = $this->apiClient->selectHeaderContentType([]);

        // query params
        if ($access_token !== null) {
            $queryParams['access_token'] = $this->apiClient->getSerializer()->toQueryValue($access_token);
        }
        // query params
        if (is_array($file_paths)) {
            /* EV use false as the last param on serializeCollection call */
            $file_paths = $this->apiClient->getSerializer()->serializeCollection($file_paths, 'multi', false);
        }
        if ($file_paths !== null) {
            $queryParams['filePaths[]'] = $this->apiClient->getSerializer()->toQueryValue($file_paths);
        }
        // header params
        if ($api_key !== null) {
            $headerParams['api_key'] = $this->apiClient->getSerializer()->toHeaderValue($api_key);
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        // make the API Call
        try {
            list($response, $statusCode, $httpHeader) = $this->apiClient->callApi(
                $resourcePath,
                'GET',
                $queryParams,
                $httpBody,
                $headerParams,
                '\Swagger\Client\Model\ResourcePropertiesResponse',
                '/getResourceProperties'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Swagger\Client\Model\ResourcePropertiesResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Swagger\Client\Model\ResourcePropertiesResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }

            throw $e;
        }
    }

    /**
     * Operation getUploadFileUrl
     *
     * getUploadFileUrl
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @param int $file_size Size of the file to upload, in bytes. (required)
     * @param string $destination_path Path relative to account&#39;s home directory, including file name. (required)
     * @param bool $allow_overwrite True if the file should be overwritten, false if different file names should be generated. Call &lt;a href&#x3D;\&quot;#operation/checkFilesExist\&quot;&gt;checkFilesExist&lt;/a&gt; first if you need to determine whether or not a file with the same name already exists. (optional, default to true)
     * @param bool $resume True if upload resume is supported, false if it isn&#39;t. (optional, default to false)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return \Swagger\Client\Model\UrlResponse
     */
    public function getUploadFileUrl($api_key, $access_token, $file_size, $destination_path, $allow_overwrite = 'true', $resume = 'false')
    {
        list($response) = $this->getUploadFileUrlWithHttpInfo($api_key, $access_token, $file_size, $destination_path, $allow_overwrite, $resume);
        return $response;
    }

    /**
     * Operation getUploadFileUrlWithHttpInfo
     *
     * getUploadFileUrl
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @param int $file_size Size of the file to upload, in bytes. (required)
     * @param string $destination_path Path relative to account&#39;s home directory, including file name. (required)
     * @param bool $allow_overwrite True if the file should be overwritten, false if different file names should be generated. Call &lt;a href&#x3D;\&quot;#operation/checkFilesExist\&quot;&gt;checkFilesExist&lt;/a&gt; first if you need to determine whether or not a file with the same name already exists. (optional, default to true)
     * @param bool $resume True if upload resume is supported, false if it isn&#39;t. (optional, default to false)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return array of \Swagger\Client\Model\UrlResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getUploadFileUrlWithHttpInfo($api_key, $access_token, $file_size, $destination_path, $allow_overwrite = 'true', $resume = 'false')
    {
        // verify the required parameter 'api_key' is set
        if ($api_key === null) {
            throw new \InvalidArgumentException('Missing the required parameter $api_key when calling getUploadFileUrl');
        }
        // verify the required parameter 'access_token' is set
        if ($access_token === null) {
            throw new \InvalidArgumentException('Missing the required parameter $access_token when calling getUploadFileUrl');
        }
        // verify the required parameter 'file_size' is set
        if ($file_size === null) {
            throw new \InvalidArgumentException('Missing the required parameter $file_size when calling getUploadFileUrl');
        }
        // verify the required parameter 'destination_path' is set
        if ($destination_path === null) {
            throw new \InvalidArgumentException('Missing the required parameter $destination_path when calling getUploadFileUrl');
        }
        // parse inputs
        $resourcePath = "/getUploadFileUrl";
        $httpBody = '';
        $queryParams = [];
        $headerParams = [];
        $formParams = [];
        $_header_accept = $this->apiClient->selectHeaderAccept(['application/json']);
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = $this->apiClient->selectHeaderContentType([]);

        // query params
        if ($access_token !== null) {
            $queryParams['access_token'] = $this->apiClient->getSerializer()->toQueryValue($access_token);
        }
        // query params
        if ($file_size !== null) {
            $queryParams['fileSize'] = $this->apiClient->getSerializer()->toQueryValue($file_size);
        }
        // query params
        if ($destination_path !== null) {
            $queryParams['destinationPath'] = $this->apiClient->getSerializer()->toQueryValue($destination_path);
        }
        // query params
        if ($allow_overwrite !== null) {
            $queryParams['allowOverwrite'] = $this->apiClient->getSerializer()->toQueryValue($allow_overwrite);
        }
        // query params
        if ($resume !== null) {
            $queryParams['resume'] = $this->apiClient->getSerializer()->toQueryValue($resume);
        }
        // header params
        if ($api_key !== null) {
            $headerParams['api_key'] = $this->apiClient->getSerializer()->toHeaderValue($api_key);
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        // make the API Call
        try {
            list($response, $statusCode, $httpHeader) = $this->apiClient->callApi(
                $resourcePath,
                'GET',
                $queryParams,
                $httpBody,
                $headerParams,
                '\Swagger\Client\Model\UrlResponse',
                '/getUploadFileUrl'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Swagger\Client\Model\UrlResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Swagger\Client\Model\UrlResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }

            throw $e;
        }
    }

    /**
     * Operation moveResources
     *
     * moveResources
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @param string[] $file_paths Array containing file/folder paths to move. (required)
     * @param string $destination_path Remote destination path to move files/folders to. (required)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return \Swagger\Client\Model\ModifiedResourcesResponse
     */
    public function moveResources($api_key, $access_token, $file_paths, $destination_path)
    {
        list($response) = $this->moveResourcesWithHttpInfo($api_key, $access_token, $file_paths, $destination_path);
        return $response;
    }

    /**
     * Operation moveResourcesWithHttpInfo
     *
     * moveResources
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @param string[] $file_paths Array containing file/folder paths to move. (required)
     * @param string $destination_path Remote destination path to move files/folders to. (required)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return array of \Swagger\Client\Model\ModifiedResourcesResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function moveResourcesWithHttpInfo($api_key, $access_token, $file_paths, $destination_path)
    {
        // verify the required parameter 'api_key' is set
        if ($api_key === null) {
            throw new \InvalidArgumentException('Missing the required parameter $api_key when calling moveResources');
        }
        // verify the required parameter 'access_token' is set
        if ($access_token === null) {
            throw new \InvalidArgumentException('Missing the required parameter $access_token when calling moveResources');
        }
        // verify the required parameter 'file_paths' is set
        if ($file_paths === null) {
            throw new \InvalidArgumentException('Missing the required parameter $file_paths when calling moveResources');
        }
        // verify the required parameter 'destination_path' is set
        if ($destination_path === null) {
            throw new \InvalidArgumentException('Missing the required parameter $destination_path when calling moveResources');
        }
        // parse inputs
        $resourcePath = "/moveResources";
        $httpBody = '';
        $queryParams = [];
        $headerParams = [];
        $formParams = [];
        $_header_accept = $this->apiClient->selectHeaderAccept(['application/json']);
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = $this->apiClient->selectHeaderContentType(['application/x-www-form-urlencoded']);

        // header params
        if ($api_key !== null) {
            $headerParams['api_key'] = $this->apiClient->getSerializer()->toHeaderValue($api_key);
        }
        // form params
        if ($access_token !== null) {
            $formParams['access_token'] = $this->apiClient->getSerializer()->toFormValue($access_token);
        }
        // form params
        if ($file_paths !== null) {
            $formParams['filePaths'] = $this->apiClient->getSerializer()->toFormValue($file_paths);
        }
        // form params
        if ($destination_path !== null) {
            $formParams['destinationPath'] = $this->apiClient->getSerializer()->toFormValue($destination_path);
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        // make the API Call
        try {
            list($response, $statusCode, $httpHeader) = $this->apiClient->callApi(
                $resourcePath,
                'POST',
                $queryParams,
                $httpBody,
                $headerParams,
                '\Swagger\Client\Model\ModifiedResourcesResponse',
                '/moveResources'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Swagger\Client\Model\ModifiedResourcesResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Swagger\Client\Model\ModifiedResourcesResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }

            throw $e;
        }
    }

    /**
     * Operation previewFile
     *
     * previewFile
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @param string $path Path of the image relative to the user&#39;s home directory. (required)
     * @param string $size The size of the image. (required)
     * @param int $width Overrides sizes. Sets to a specific width. (optional)
     * @param int $height Overrides sizes. Sets to a specific height. (optional)
     * @param int $page Page number for the &#x60;.pdf&#x60; or &#x60;.doc&#x60; files. (optional, default to 0)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return \Swagger\Client\Model\PreviewFileResponse
     */
    public function previewFile($api_key, $access_token, $path, $size, $width = null, $height = null, $page = '0')
    {
        list($response) = $this->previewFileWithHttpInfo($api_key, $access_token, $path, $size, $width, $height, $page);
        return $response;
    }

    /**
     * Operation previewFileWithHttpInfo
     *
     * previewFile
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @param string $path Path of the image relative to the user&#39;s home directory. (required)
     * @param string $size The size of the image. (required)
     * @param int $width Overrides sizes. Sets to a specific width. (optional)
     * @param int $height Overrides sizes. Sets to a specific height. (optional)
     * @param int $page Page number for the &#x60;.pdf&#x60; or &#x60;.doc&#x60; files. (optional, default to 0)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return array of \Swagger\Client\Model\PreviewFileResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function previewFileWithHttpInfo($api_key, $access_token, $path, $size, $width = null, $height = null, $page = '0')
    {
        // verify the required parameter 'api_key' is set
        if ($api_key === null) {
            throw new \InvalidArgumentException('Missing the required parameter $api_key when calling previewFile');
        }
        // verify the required parameter 'access_token' is set
        if ($access_token === null) {
            throw new \InvalidArgumentException('Missing the required parameter $access_token when calling previewFile');
        }
        // verify the required parameter 'path' is set
        if ($path === null) {
            throw new \InvalidArgumentException('Missing the required parameter $path when calling previewFile');
        }
        // verify the required parameter 'size' is set
        if ($size === null) {
            throw new \InvalidArgumentException('Missing the required parameter $size when calling previewFile');
        }
        // parse inputs
        $resourcePath = "/previewFile";
        $httpBody = '';
        $queryParams = [];
        $headerParams = [];
        $formParams = [];
        $_header_accept = $this->apiClient->selectHeaderAccept(['application/json']);
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = $this->apiClient->selectHeaderContentType([]);

        // query params
        if ($access_token !== null) {
            $queryParams['access_token'] = $this->apiClient->getSerializer()->toQueryValue($access_token);
        }
        // query params
        if ($path !== null) {
            $queryParams['path'] = $this->apiClient->getSerializer()->toQueryValue($path);
        }
        // query params
        if ($size !== null) {
            $queryParams['size'] = $this->apiClient->getSerializer()->toQueryValue($size);
        }
        // query params
        if ($width !== null) {
            $queryParams['width'] = $this->apiClient->getSerializer()->toQueryValue($width);
        }
        // query params
        if ($height !== null) {
            $queryParams['height'] = $this->apiClient->getSerializer()->toQueryValue($height);
        }
        // query params
        if ($page !== null) {
            $queryParams['page'] = $this->apiClient->getSerializer()->toQueryValue($page);
        }
        // header params
        if ($api_key !== null) {
            $headerParams['api_key'] = $this->apiClient->getSerializer()->toHeaderValue($api_key);
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        // make the API Call
        try {
            list($response, $statusCode, $httpHeader) = $this->apiClient->callApi(
                $resourcePath,
                'GET',
                $queryParams,
                $httpBody,
                $headerParams,
                '\Swagger\Client\Model\PreviewFileResponse',
                '/previewFile'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Swagger\Client\Model\PreviewFileResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Swagger\Client\Model\PreviewFileResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }

            throw $e;
        }
    }

    /**
     * Operation renameResource
     *
     * renameResource
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @param string $file_path Remote path of the file or folder to rename. (required)
     * @param string $new_name The new name of the file or folder. (required)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return \Swagger\Client\Model\Response
     */
    public function renameResource($api_key, $access_token, $file_path, $new_name)
    {
        list($response) = $this->renameResourceWithHttpInfo($api_key, $access_token, $file_path, $new_name);
        return $response;
    }

    /**
     * Operation renameResourceWithHttpInfo
     *
     * renameResource
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @param string $file_path Remote path of the file or folder to rename. (required)
     * @param string $new_name The new name of the file or folder. (required)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return array of \Swagger\Client\Model\Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function renameResourceWithHttpInfo($api_key, $access_token, $file_path, $new_name)
    {
        // verify the required parameter 'api_key' is set
        if ($api_key === null) {
            throw new \InvalidArgumentException('Missing the required parameter $api_key when calling renameResource');
        }
        // verify the required parameter 'access_token' is set
        if ($access_token === null) {
            throw new \InvalidArgumentException('Missing the required parameter $access_token when calling renameResource');
        }
        // verify the required parameter 'file_path' is set
        if ($file_path === null) {
            throw new \InvalidArgumentException('Missing the required parameter $file_path when calling renameResource');
        }
        // verify the required parameter 'new_name' is set
        if ($new_name === null) {
            throw new \InvalidArgumentException('Missing the required parameter $new_name when calling renameResource');
        }
        // parse inputs
        $resourcePath = "/renameResource";
        $httpBody = '';
        $queryParams = [];
        $headerParams = [];
        $formParams = [];
        $_header_accept = $this->apiClient->selectHeaderAccept(['application/json']);
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = $this->apiClient->selectHeaderContentType(['application/x-www-form-urlencoded']);

        // header params
        if ($api_key !== null) {
            $headerParams['api_key'] = $this->apiClient->getSerializer()->toHeaderValue($api_key);
        }
        // form params
        if ($access_token !== null) {
            $formParams['access_token'] = $this->apiClient->getSerializer()->toFormValue($access_token);
        }
        // form params
        if ($file_path !== null) {
            $formParams['filePath'] = $this->apiClient->getSerializer()->toFormValue($file_path);
        }
        // form params
        if ($new_name !== null) {
            $formParams['newName'] = $this->apiClient->getSerializer()->toFormValue($new_name);
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        // make the API Call
        try {
            list($response, $statusCode, $httpHeader) = $this->apiClient->callApi(
                $resourcePath,
                'POST',
                $queryParams,
                $httpBody,
                $headerParams,
                '\Swagger\Client\Model\Response',
                '/renameResource'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Swagger\Client\Model\Response', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Swagger\Client\Model\Response', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }

            throw $e;
        }
    }
}
