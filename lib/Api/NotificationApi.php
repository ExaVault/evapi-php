<?php
/**
 * NotificationApi
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
 * NotificationApi Class Doc Comment
 *
 * @category Class
 * @package  Swagger\Client
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class NotificationApi
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
     * @return NotificationApi
     */
    public function setApiClient(\Swagger\Client\ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
        return $this;
    }

    /**
     * Operation createNotification
     *
     * createNotification
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @param string $type Type of resource you&#39;re setting the notification on. (required)
     * @param string $path Full path of file/folder where the notification is set. (required)
     * @param string $action Type of action to filter on. Notifications will only be fired for the given type of action. (required)
     * @param string[] $usernames Determines which users should trigger the notification. Either one of the values above, or an array of usernames. (required)
     * @param bool $send_email Set to true if the user should be notified by email when the notification is triggered. (required)
     * @param string[] $emails Email addresses to send the notification to. If not specified, sends to the authenticated user. (optional)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return \Swagger\Client\Model\NotificationResponse
     */
    public function createNotification($api_key, $access_token, $type, $path, $action, $usernames, $send_email, $emails = null)
    {
        list($response) = $this->createNotificationWithHttpInfo($api_key, $access_token, $type, $path, $action, $usernames, $send_email, $emails);
        return $response;
    }

    /**
     * Operation createNotificationWithHttpInfo
     *
     * createNotification
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @param string $type Type of resource you&#39;re setting the notification on. (required)
     * @param string $path Full path of file/folder where the notification is set. (required)
     * @param string $action Type of action to filter on. Notifications will only be fired for the given type of action. (required)
     * @param string[] $usernames Determines which users should trigger the notification. Either one of the values above, or an array of usernames. (required)
     * @param bool $send_email Set to true if the user should be notified by email when the notification is triggered. (required)
     * @param string[] $emails Email addresses to send the notification to. If not specified, sends to the authenticated user. (optional)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return array of \Swagger\Client\Model\NotificationResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function createNotificationWithHttpInfo($api_key, $access_token, $type, $path, $action, $usernames, $send_email, $emails = null)
    {
        // verify the required parameter 'api_key' is set
        if ($api_key === null) {
            throw new \InvalidArgumentException('Missing the required parameter $api_key when calling createNotification');
        }
        // verify the required parameter 'access_token' is set
        if ($access_token === null) {
            throw new \InvalidArgumentException('Missing the required parameter $access_token when calling createNotification');
        }
        // verify the required parameter 'type' is set
        if ($type === null) {
            throw new \InvalidArgumentException('Missing the required parameter $type when calling createNotification');
        }
        // verify the required parameter 'path' is set
        if ($path === null) {
            throw new \InvalidArgumentException('Missing the required parameter $path when calling createNotification');
        }
        // verify the required parameter 'action' is set
        if ($action === null) {
            throw new \InvalidArgumentException('Missing the required parameter $action when calling createNotification');
        }
        // verify the required parameter 'usernames' is set
        if ($usernames === null) {
            throw new \InvalidArgumentException('Missing the required parameter $usernames when calling createNotification');
        }
        // verify the required parameter 'send_email' is set
        if ($send_email === null) {
            throw new \InvalidArgumentException('Missing the required parameter $send_email when calling createNotification');
        }
        // parse inputs
        $resourcePath = "/createNotification";
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
        if ($path !== null) {
            $formParams['path'] = $this->apiClient->getSerializer()->toFormValue($path);
        }
        // form params
        if ($action !== null) {
            $formParams['action'] = $this->apiClient->getSerializer()->toFormValue($action);
        }
        // form params
        if ($usernames !== null) {
            $formParams['usernames'] = $this->apiClient->getSerializer()->toFormValue($usernames);
        }
        // form params
        if ($send_email !== null) {
            $formParams['sendEmail'] = $this->apiClient->getSerializer()->toFormValue($send_email);
        }
        // form params
        if ($emails !== null) {
            $formParams['emails'] = $this->apiClient->getSerializer()->toFormValue($emails);
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
                '\Swagger\Client\Model\NotificationResponse',
                '/createNotification'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Swagger\Client\Model\NotificationResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Swagger\Client\Model\NotificationResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }

            throw $e;
        }
    }

    /**
     * Operation deleteNotification
     *
     * deleteNotification
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @param int $id ID of the notification to delete. Use &lt;a href&#x3D;\&quot;#operation/getNotifications\&quot;&gt;getNotifications&lt;/a&gt; if you need to lookup an ID. (required)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return \Swagger\Client\Model\Response
     */
    public function deleteNotification($api_key, $access_token, $id)
    {
        list($response) = $this->deleteNotificationWithHttpInfo($api_key, $access_token, $id);
        return $response;
    }

    /**
     * Operation deleteNotificationWithHttpInfo
     *
     * deleteNotification
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @param int $id ID of the notification to delete. Use &lt;a href&#x3D;\&quot;#operation/getNotifications\&quot;&gt;getNotifications&lt;/a&gt; if you need to lookup an ID. (required)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return array of \Swagger\Client\Model\Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteNotificationWithHttpInfo($api_key, $access_token, $id)
    {
        // verify the required parameter 'api_key' is set
        if ($api_key === null) {
            throw new \InvalidArgumentException('Missing the required parameter $api_key when calling deleteNotification');
        }
        // verify the required parameter 'access_token' is set
        if ($access_token === null) {
            throw new \InvalidArgumentException('Missing the required parameter $access_token when calling deleteNotification');
        }
        // verify the required parameter 'id' is set
        if ($id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $id when calling deleteNotification');
        }
        // parse inputs
        $resourcePath = "/deleteNotification";
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
                '/deleteNotification'
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
     * Operation getNotification
     *
     * getNotification
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @param int $id ID of the notification. Use &lt;a href&#x3D;\&quot;#operation/getNotifications\&quot;&gt;getNotifications&lt;/a&gt; if you need to lookup an ID. (required)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return \Swagger\Client\Model\NotificationResponse
     */
    public function getNotification($api_key, $access_token, $id)
    {
        list($response) = $this->getNotificationWithHttpInfo($api_key, $access_token, $id);
        return $response;
    }

    /**
     * Operation getNotificationWithHttpInfo
     *
     * getNotification
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @param int $id ID of the notification. Use &lt;a href&#x3D;\&quot;#operation/getNotifications\&quot;&gt;getNotifications&lt;/a&gt; if you need to lookup an ID. (required)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return array of \Swagger\Client\Model\NotificationResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getNotificationWithHttpInfo($api_key, $access_token, $id)
    {
        // verify the required parameter 'api_key' is set
        if ($api_key === null) {
            throw new \InvalidArgumentException('Missing the required parameter $api_key when calling getNotification');
        }
        // verify the required parameter 'access_token' is set
        if ($access_token === null) {
            throw new \InvalidArgumentException('Missing the required parameter $access_token when calling getNotification');
        }
        // verify the required parameter 'id' is set
        if ($id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $id when calling getNotification');
        }
        // parse inputs
        $resourcePath = "/getNotification";
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
                '\Swagger\Client\Model\NotificationResponse',
                '/getNotification'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Swagger\Client\Model\NotificationResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Swagger\Client\Model\NotificationResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }

            throw $e;
        }
    }

    /**
     * Operation getNotifications
     *
     * getNotifications
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @param string $type Type of notification to filter on. (required)
     * @param string $sort_by Sort method. (optional, default to sort_notifications_folder_name)
     * @param string $sort_order Sort order. (optional, default to asc)
     * @param string $filter Filter by the provided search terms. (optional)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return \Swagger\Client\Model\NotificationsResponse
     */
    public function getNotifications($api_key, $access_token, $type, $sort_by = 'sort_notifications_folder_name', $sort_order = 'asc', $filter = null)
    {
        list($response) = $this->getNotificationsWithHttpInfo($api_key, $access_token, $type, $sort_by, $sort_order, $filter);
        return $response;
    }

    /**
     * Operation getNotificationsWithHttpInfo
     *
     * getNotifications
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @param string $type Type of notification to filter on. (required)
     * @param string $sort_by Sort method. (optional, default to sort_notifications_folder_name)
     * @param string $sort_order Sort order. (optional, default to asc)
     * @param string $filter Filter by the provided search terms. (optional)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return array of \Swagger\Client\Model\NotificationsResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getNotificationsWithHttpInfo($api_key, $access_token, $type, $sort_by = 'sort_notifications_folder_name', $sort_order = 'asc', $filter = null)
    {
        // verify the required parameter 'api_key' is set
        if ($api_key === null) {
            throw new \InvalidArgumentException('Missing the required parameter $api_key when calling getNotifications');
        }
        // verify the required parameter 'access_token' is set
        if ($access_token === null) {
            throw new \InvalidArgumentException('Missing the required parameter $access_token when calling getNotifications');
        }
        // verify the required parameter 'type' is set
        if ($type === null) {
            throw new \InvalidArgumentException('Missing the required parameter $type when calling getNotifications');
        }
        // parse inputs
        $resourcePath = "/getNotifications";
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
                '\Swagger\Client\Model\NotificationsResponse',
                '/getNotifications'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Swagger\Client\Model\NotificationsResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Swagger\Client\Model\NotificationsResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }

            throw $e;
        }
    }

    /**
     * Operation updateNotification
     *
     * updateNotification
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param \Swagger\Client\Model\UpdateNotification $update_notification  (optional)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return \Swagger\Client\Model\Response
     */
    public function updateNotification($api_key, $update_notification = null)
    {
        list($response) = $this->updateNotificationWithHttpInfo($api_key, $update_notification);
        return $response;
    }

    /**
     * Operation updateNotificationWithHttpInfo
     *
     * updateNotification
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param \Swagger\Client\Model\UpdateNotification $update_notification  (optional)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return array of \Swagger\Client\Model\Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function updateNotificationWithHttpInfo($api_key, $update_notification = null)
    {
        // verify the required parameter 'api_key' is set
        if ($api_key === null) {
            throw new \InvalidArgumentException('Missing the required parameter $api_key when calling updateNotification');
        }
        // parse inputs
        $resourcePath = "/updateNotification";
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
        // body params
        $_tempBody = null;
        if (isset($update_notification)) {
            $_tempBody = $update_notification;
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
                '/updateNotification'
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
