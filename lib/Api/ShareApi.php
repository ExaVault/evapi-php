<?php
/**
 * ShareApi
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
 * ShareApi Class Doc Comment
 *
 * @category Class
 * @package  Swagger\Client
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class ShareApi
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
     * @return ShareApi
     */
    public function setApiClient(\Swagger\Client\ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
        return $this;
    }

    /**
     * Operation createShare
     *
     * createShare
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @param string $type The type of share to create. See above for a description of each. (required)
     * @param string $name Name of the share. (required)
     * @param string[] $file_paths Array of strings containing the file paths to share. (required)
     * @param string $access_mode Type of permissions share recipients have. (required)
     * @param string $subject Share message subject (for email invitations). (optional)
     * @param string $message Share message contents (for email invitations). (optional)
     * @param string[] $emails Array of strings for email recipients (for email invitations). (optional)
     * @param string[] $cc_email Array of strings for CC email recipients (for email invitations). (optional)
     * @param bool $require_email Requires a user to enter their email address to access. If set true, isPublic must also be set true.  Please note that emails are not validated; we simply log the email in the share activity.  If you want a share to be invite only (e.g. restricted access to only invited email addresses) you should set this to false, and pass the set of email addresses via the &#x60;emails&#x60; paramater. (optional, default to false)
     * @param bool $embed Allows user to embed a widget with the share. (optional, default to false)
     * @param bool $is_public True if share has a public URL. If false, the only way to access the share will be via the personalized URL sent via the email invite process. (optional, default to false)
     * @param string $password If not null, value of password is required to access this share. (optional)
     * @param string $expiration The timestamp the current share should expire, formatted &#x60;YYYY-mm-dd hh:mm:ss&#x60;. (optional)
     * @param bool $has_notification True if the user should be notified about activity on this share. (optional, default to false)
     * @param string[] $notification_emails An array of recipients who should receive notification emails. (optional)
     * @param bool $file_drop_create_folders If true, all receive folder submissions will be uploaded separate folders (only applicable for the &#x60;receive&#x60; share type). (optional, default to false)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return \Swagger\Client\Model\ShareResponse
     */
    public function createShare($api_key, $access_token, $type, $name, $file_paths, $access_mode, $subject = null, $message = null, $emails = null, $cc_email = null, $require_email = 'false', $embed = 'false', $is_public = 'false', $password = null, $expiration = null, $has_notification = 'false', $notification_emails = null, $file_drop_create_folders = 'false')
    {
        list($response) = $this->createShareWithHttpInfo($api_key, $access_token, $type, $name, $file_paths, $access_mode, $subject, $message, $emails, $cc_email, $require_email, $embed, $is_public, $password, $expiration, $has_notification, $notification_emails, $file_drop_create_folders);
        return $response;
    }

    /**
     * Operation createShareWithHttpInfo
     *
     * createShare
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @param string $type The type of share to create. See above for a description of each. (required)
     * @param string $name Name of the share. (required)
     * @param string[] $file_paths Array of strings containing the file paths to share. (required)
     * @param string $access_mode Type of permissions share recipients have. (required)
     * @param string $subject Share message subject (for email invitations). (optional)
     * @param string $message Share message contents (for email invitations). (optional)
     * @param string[] $emails Array of strings for email recipients (for email invitations). (optional)
     * @param string[] $cc_email Array of strings for CC email recipients (for email invitations). (optional)
     * @param bool $require_email Requires a user to enter their email address to access. If set true, isPublic must also be set true.  Please note that emails are not validated; we simply log the email in the share activity.  If you want a share to be invite only (e.g. restricted access to only invited email addresses) you should set this to false, and pass the set of email addresses via the &#x60;emails&#x60; paramater. (optional, default to false)
     * @param bool $embed Allows user to embed a widget with the share. (optional, default to false)
     * @param bool $is_public True if share has a public URL. If false, the only way to access the share will be via the personalized URL sent via the email invite process. (optional, default to false)
     * @param string $password If not null, value of password is required to access this share. (optional)
     * @param string $expiration The timestamp the current share should expire, formatted &#x60;YYYY-mm-dd hh:mm:ss&#x60;. (optional)
     * @param bool $has_notification True if the user should be notified about activity on this share. (optional, default to false)
     * @param string[] $notification_emails An array of recipients who should receive notification emails. (optional)
     * @param bool $file_drop_create_folders If true, all receive folder submissions will be uploaded separate folders (only applicable for the &#x60;receive&#x60; share type). (optional, default to false)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return array of \Swagger\Client\Model\ShareResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function createShareWithHttpInfo($api_key, $access_token, $type, $name, $file_paths, $access_mode, $subject = null, $message = null, $emails = null, $cc_email = null, $require_email = 'false', $embed = 'false', $is_public = 'false', $password = null, $expiration = null, $has_notification = 'false', $notification_emails = null, $file_drop_create_folders = 'false')
    {
        // verify the required parameter 'api_key' is set
        if ($api_key === null) {
            throw new \InvalidArgumentException('Missing the required parameter $api_key when calling createShare');
        }
        // verify the required parameter 'access_token' is set
        if ($access_token === null) {
            throw new \InvalidArgumentException('Missing the required parameter $access_token when calling createShare');
        }
        // verify the required parameter 'type' is set
        if ($type === null) {
            throw new \InvalidArgumentException('Missing the required parameter $type when calling createShare');
        }
        // verify the required parameter 'name' is set
        if ($name === null) {
            throw new \InvalidArgumentException('Missing the required parameter $name when calling createShare');
        }
        // verify the required parameter 'file_paths' is set
        if ($file_paths === null) {
            throw new \InvalidArgumentException('Missing the required parameter $file_paths when calling createShare');
        }
        // verify the required parameter 'access_mode' is set
        if ($access_mode === null) {
            throw new \InvalidArgumentException('Missing the required parameter $access_mode when calling createShare');
        }
        // parse inputs
        $resourcePath = "/createShare";
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
        if ($type !== null) {
            $formParams['type'] = $this->apiClient->getSerializer()->toFormValue($type);
        }
        // form params
        if ($name !== null) {
            $formParams['name'] = $this->apiClient->getSerializer()->toFormValue($name);
        }
        // form params
        if ($file_paths !== null) {
            $formParams['filePaths'] = $this->apiClient->getSerializer()->toFormValue($file_paths);
        }
        // form params
        if ($access_mode !== null) {
            $formParams['accessMode'] = $this->apiClient->getSerializer()->toFormValue($access_mode);
        }
        // form params
        if ($subject !== null) {
            $formParams['subject'] = $this->apiClient->getSerializer()->toFormValue($subject);
        }
        // form params
        if ($message !== null) {
            $formParams['message'] = $this->apiClient->getSerializer()->toFormValue($message);
        }
        // form params
        if ($emails !== null) {
            $formParams['emails'] = $this->apiClient->getSerializer()->toFormValue($emails);
        }
        // form params
        if ($cc_email !== null) {
            $formParams['ccEmail'] = $this->apiClient->getSerializer()->toFormValue($cc_email);
        }
        // form params
        if ($require_email !== null) {
            $formParams['requireEmail'] = $this->apiClient->getSerializer()->toFormValue($require_email);
        }
        // form params
        if ($embed !== null) {
            $formParams['embed'] = $this->apiClient->getSerializer()->toFormValue($embed);
        }
        // form params
        if ($is_public !== null) {
            $formParams['isPublic'] = $this->apiClient->getSerializer()->toFormValue($is_public);
        }
        // form params
        if ($password !== null) {
            $formParams['password'] = $this->apiClient->getSerializer()->toFormValue($password);
        }
        // form params
        if ($expiration !== null) {
            $formParams['expiration'] = $this->apiClient->getSerializer()->toFormValue($expiration);
        }
        // form params
        if ($has_notification !== null) {
            $formParams['hasNotification'] = $this->apiClient->getSerializer()->toFormValue($has_notification);
        }
        // form params
        if ($notification_emails !== null) {
            $formParams['notificationEmails'] = $this->apiClient->getSerializer()->toFormValue($notification_emails);
        }
        // form params
        if ($file_drop_create_folders !== null) {
            $formParams['fileDropCreateFolders'] = $this->apiClient->getSerializer()->toFormValue($file_drop_create_folders);
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
                '\Swagger\Client\Model\ShareResponse',
                '/createShare'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Swagger\Client\Model\ShareResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Swagger\Client\Model\ShareResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }

            throw $e;
        }
    }

    /**
     * Operation deleteShare
     *
     * deleteShare
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @param int $id ID of the share to delete. Use &lt;a href&#x3D;\&quot;#operation/getShares\&quot;&gt;getShares&lt;/a&gt; if you need to lookup an ID. (required)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return \Swagger\Client\Model\Response
     */
    public function deleteShare($api_key, $access_token, $id)
    {
        list($response) = $this->deleteShareWithHttpInfo($api_key, $access_token, $id);
        return $response;
    }

    /**
     * Operation deleteShareWithHttpInfo
     *
     * deleteShare
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @param int $id ID of the share to delete. Use &lt;a href&#x3D;\&quot;#operation/getShares\&quot;&gt;getShares&lt;/a&gt; if you need to lookup an ID. (required)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return array of \Swagger\Client\Model\Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteShareWithHttpInfo($api_key, $access_token, $id)
    {
        // verify the required parameter 'api_key' is set
        if ($api_key === null) {
            throw new \InvalidArgumentException('Missing the required parameter $api_key when calling deleteShare');
        }
        // verify the required parameter 'access_token' is set
        if ($access_token === null) {
            throw new \InvalidArgumentException('Missing the required parameter $access_token when calling deleteShare');
        }
        // verify the required parameter 'id' is set
        if ($id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $id when calling deleteShare');
        }
        // parse inputs
        $resourcePath = "/deleteShare";
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
        if ($id !== null) {
            $queryParams['id'] = $this->apiClient->getSerializer()->toQueryValue($id);
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
                '\Swagger\Client\Model\Response',
                '/deleteShare'
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
     * Operation getShare
     *
     * getShare
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @param int $id ID of the requested share. Note this is our internal ID, not the share hash. Use &lt;a href&#x3D;\&quot;#operation/getShares\&quot;&gt;getShares&lt;/a&gt; if you need to lookup an ID. (required)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return \Swagger\Client\Model\ShareResponse
     */
    public function getShare($api_key, $access_token, $id)
    {
        list($response) = $this->getShareWithHttpInfo($api_key, $access_token, $id);
        return $response;
    }

    /**
     * Operation getShareWithHttpInfo
     *
     * getShare
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @param int $id ID of the requested share. Note this is our internal ID, not the share hash. Use &lt;a href&#x3D;\&quot;#operation/getShares\&quot;&gt;getShares&lt;/a&gt; if you need to lookup an ID. (required)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return array of \Swagger\Client\Model\ShareResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getShareWithHttpInfo($api_key, $access_token, $id)
    {
        // verify the required parameter 'api_key' is set
        if ($api_key === null) {
            throw new \InvalidArgumentException('Missing the required parameter $api_key when calling getShare');
        }
        // verify the required parameter 'access_token' is set
        if ($access_token === null) {
            throw new \InvalidArgumentException('Missing the required parameter $access_token when calling getShare');
        }
        // verify the required parameter 'id' is set
        if ($id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $id when calling getShare');
        }
        // parse inputs
        $resourcePath = "/getShare";
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
        if ($id !== null) {
            $queryParams['id'] = $this->apiClient->getSerializer()->toQueryValue($id);
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
                '\Swagger\Client\Model\ShareResponse',
                '/getShare'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Swagger\Client\Model\ShareResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Swagger\Client\Model\ShareResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }

            throw $e;
        }
    }

    /**
     * Operation getShares
     *
     * getShares
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @param string $sort_by Sort method. (required)
     * @param string $sort_order Sort order. (required)
     * @param string $type The type of share to return. If no argument specified, will return all shares of all types. (optional)
     * @param string $filter Filter by the provided search terms. (optional)
     * @param string $include Filter returned shares. You can get all shares in the account, only active ones or shares you own. (optional, default to all)
     * @param int $offset Start position of results to return, for pagination. Defaults to zero (0). (optional)
     * @param int $limit Maximum number of shares to return. (optional)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return \Swagger\Client\Model\SharesResponse
     */
    public function getShares($api_key, $access_token, $sort_by, $sort_order, $type = null, $filter = null, $include = 'all', $offset = null, $limit = null)
    {
        list($response) = $this->getSharesWithHttpInfo($api_key, $access_token, $sort_by, $sort_order, $type, $filter, $include, $offset, $limit);
        return $response;
    }

    /**
     * Operation getSharesWithHttpInfo
     *
     * getShares
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @param string $sort_by Sort method. (required)
     * @param string $sort_order Sort order. (required)
     * @param string $type The type of share to return. If no argument specified, will return all shares of all types. (optional)
     * @param string $filter Filter by the provided search terms. (optional)
     * @param string $include Filter returned shares. You can get all shares in the account, only active ones or shares you own. (optional, default to all)
     * @param int $offset Start position of results to return, for pagination. Defaults to zero (0). (optional)
     * @param int $limit Maximum number of shares to return. (optional)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return array of \Swagger\Client\Model\SharesResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getSharesWithHttpInfo($api_key, $access_token, $sort_by, $sort_order, $type = null, $filter = null, $include = 'all', $offset = null, $limit = null)
    {
        // verify the required parameter 'api_key' is set
        if ($api_key === null) {
            throw new \InvalidArgumentException('Missing the required parameter $api_key when calling getShares');
        }
        // verify the required parameter 'access_token' is set
        if ($access_token === null) {
            throw new \InvalidArgumentException('Missing the required parameter $access_token when calling getShares');
        }
        // verify the required parameter 'sort_by' is set
        if ($sort_by === null) {
            throw new \InvalidArgumentException('Missing the required parameter $sort_by when calling getShares');
        }
        // verify the required parameter 'sort_order' is set
        if ($sort_order === null) {
            throw new \InvalidArgumentException('Missing the required parameter $sort_order when calling getShares');
        }
        // parse inputs
        $resourcePath = "/getShares";
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
        if ($type !== null) {
            $queryParams['type'] = $this->apiClient->getSerializer()->toQueryValue($type);
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
        if ($filter !== null) {
            $queryParams['filter'] = $this->apiClient->getSerializer()->toQueryValue($filter);
        }
        // query params
        if ($include !== null) {
            $queryParams['include'] = $this->apiClient->getSerializer()->toQueryValue($include);
        }
        // query params
        if ($offset !== null) {
            $queryParams['offset'] = $this->apiClient->getSerializer()->toQueryValue($offset);
        }
        // query params
        if ($limit !== null) {
            $queryParams['limit'] = $this->apiClient->getSerializer()->toQueryValue($limit);
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
                '\Swagger\Client\Model\SharesResponse',
                '/getShares'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Swagger\Client\Model\SharesResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Swagger\Client\Model\SharesResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }

            throw $e;
        }
    }

    /**
     * Operation updateShare
     *
     * updateShare
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @param int $id ID of the share to update. Use &lt;a href&#x3D;\&quot;#operation/getShares\&quot;&gt;getShares&lt;/a&gt; if you need to lookup an ID. (required)
     * @param string $name Name of the share. (optional)
     * @param string[] $file_paths Array of strings containing the file paths to share. (optional)
     * @param string $access_mode Type of permissions share recipients have. (optional)
     * @param string $subject Share message subject (for email invitations). (optional)
     * @param string $message Share message contents (for email invitations). (optional)
     * @param string[] $emails Array of strings for email recipients (for email invitations). (optional)
     * @param string[] $cc_email Array of strings for CC email recipients (for email invitations). (optional)
     * @param bool $require_email Requires a user to enter their email address to access. If set true, isPublic must also be set true.  Please note that emails are not validated; we simply log the email in the share activity.  If you want a share to be invite only (e.g. restricted access to only invited email addresses) you should set this to false, and pass the set of email addresses via the &#x60;emails&#x60; paramater. (optional, default to false)
     * @param bool $embed Allows user to embed a widget with the share. (optional, default to false)
     * @param bool $is_public True if share has a public URL. If false, the only way to access the share will be via the personalized URL sent via the email invite process. (optional, default to false)
     * @param string $password If not null, value of password is required to access this share. (optional)
     * @param string $expiration The timestamp the current share should expire, formatted &#x60;YYYY-mm-dd hh:mm:ss&#x60;. (optional)
     * @param bool $has_notification True if the user should be notified about activity on this share. (optional, default to false)
     * @param string[] $notification_emails An array of recipients who should receive notification emails. (optional)
     * @param bool $file_drop_create_folders If true, all receive folder submissions will be uploaded separate folders (only applicable for the &#x60;receive&#x60; share type). (optional, default to false)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return \Swagger\Client\Model\Response
     */
    public function updateShare($api_key, $access_token, $id, $name = null, $file_paths = null, $access_mode = null, $subject = null, $message = null, $emails = null, $cc_email = null, $require_email = 'false', $embed = 'false', $is_public = 'false', $password = null, $expiration = null, $has_notification = 'false', $notification_emails = null, $file_drop_create_folders = 'false')
    {
        list($response) = $this->updateShareWithHttpInfo($api_key, $access_token, $id, $name, $file_paths, $access_mode, $subject, $message, $emails, $cc_email, $require_email, $embed, $is_public, $password, $expiration, $has_notification, $notification_emails, $file_drop_create_folders);
        return $response;
    }

    /**
     * Operation updateShareWithHttpInfo
     *
     * updateShare
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @param int $id ID of the share to update. Use &lt;a href&#x3D;\&quot;#operation/getShares\&quot;&gt;getShares&lt;/a&gt; if you need to lookup an ID. (required)
     * @param string $name Name of the share. (optional)
     * @param string[] $file_paths Array of strings containing the file paths to share. (optional)
     * @param string $access_mode Type of permissions share recipients have. (optional)
     * @param string $subject Share message subject (for email invitations). (optional)
     * @param string $message Share message contents (for email invitations). (optional)
     * @param string[] $emails Array of strings for email recipients (for email invitations). (optional)
     * @param string[] $cc_email Array of strings for CC email recipients (for email invitations). (optional)
     * @param bool $require_email Requires a user to enter their email address to access. If set true, isPublic must also be set true.  Please note that emails are not validated; we simply log the email in the share activity.  If you want a share to be invite only (e.g. restricted access to only invited email addresses) you should set this to false, and pass the set of email addresses via the &#x60;emails&#x60; paramater. (optional, default to false)
     * @param bool $embed Allows user to embed a widget with the share. (optional, default to false)
     * @param bool $is_public True if share has a public URL. If false, the only way to access the share will be via the personalized URL sent via the email invite process. (optional, default to false)
     * @param string $password If not null, value of password is required to access this share. (optional)
     * @param string $expiration The timestamp the current share should expire, formatted &#x60;YYYY-mm-dd hh:mm:ss&#x60;. (optional)
     * @param bool $has_notification True if the user should be notified about activity on this share. (optional, default to false)
     * @param string[] $notification_emails An array of recipients who should receive notification emails. (optional)
     * @param bool $file_drop_create_folders If true, all receive folder submissions will be uploaded separate folders (only applicable for the &#x60;receive&#x60; share type). (optional, default to false)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return array of \Swagger\Client\Model\Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function updateShareWithHttpInfo($api_key, $access_token, $id, $name = null, $file_paths = null, $access_mode = null, $subject = null, $message = null, $emails = null, $cc_email = null, $require_email = 'false', $embed = 'false', $is_public = 'false', $password = null, $expiration = null, $has_notification = 'false', $notification_emails = null, $file_drop_create_folders = 'false')
    {
        // verify the required parameter 'api_key' is set
        if ($api_key === null) {
            throw new \InvalidArgumentException('Missing the required parameter $api_key when calling updateShare');
        }
        // verify the required parameter 'access_token' is set
        if ($access_token === null) {
            throw new \InvalidArgumentException('Missing the required parameter $access_token when calling updateShare');
        }
        // verify the required parameter 'id' is set
        if ($id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $id when calling updateShare');
        }
        // parse inputs
        $resourcePath = "/updateShare";
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
        if ($id !== null) {
            $formParams['id'] = $this->apiClient->getSerializer()->toFormValue($id);
        }
        // form params
        if ($name !== null) {
            $formParams['name'] = $this->apiClient->getSerializer()->toFormValue($name);
        }
        // form params
        if ($file_paths !== null) {
            $formParams['filePaths'] = $this->apiClient->getSerializer()->toFormValue($file_paths);
        }
        // form params
        if ($access_mode !== null) {
            $formParams['accessMode'] = $this->apiClient->getSerializer()->toFormValue($access_mode);
        }
        // form params
        if ($subject !== null) {
            $formParams['subject'] = $this->apiClient->getSerializer()->toFormValue($subject);
        }
        // form params
        if ($message !== null) {
            $formParams['message'] = $this->apiClient->getSerializer()->toFormValue($message);
        }
        // form params
        if ($emails !== null) {
            $formParams['emails'] = $this->apiClient->getSerializer()->toFormValue($emails);
        }
        // form params
        if ($cc_email !== null) {
            $formParams['ccEmail'] = $this->apiClient->getSerializer()->toFormValue($cc_email);
        }
        // form params
        if ($require_email !== null) {
            $formParams['requireEmail'] = $this->apiClient->getSerializer()->toFormValue($require_email);
        }
        // form params
        if ($embed !== null) {
            $formParams['embed'] = $this->apiClient->getSerializer()->toFormValue($embed);
        }
        // form params
        if ($is_public !== null) {
            $formParams['isPublic'] = $this->apiClient->getSerializer()->toFormValue($is_public);
        }
        // form params
        if ($password !== null) {
            $formParams['password'] = $this->apiClient->getSerializer()->toFormValue($password);
        }
        // form params
        if ($expiration !== null) {
            $formParams['expiration'] = $this->apiClient->getSerializer()->toFormValue($expiration);
        }
        // form params
        if ($has_notification !== null) {
            $formParams['hasNotification'] = $this->apiClient->getSerializer()->toFormValue($has_notification);
        }
        // form params
        if ($notification_emails !== null) {
            $formParams['notificationEmails'] = $this->apiClient->getSerializer()->toFormValue($notification_emails);
        }
        // form params
        if ($file_drop_create_folders !== null) {
            $formParams['fileDropCreateFolders'] = $this->apiClient->getSerializer()->toFormValue($file_drop_create_folders);
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
                '/updateShare'
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
