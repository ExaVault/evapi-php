<?php
/**
 * UserApi
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
 * # Introduction  Welcome to the ExaVault API documentation. Our API lets you control nearly all aspects of your ExaVault account programatically, from uploading and downloading files to creating and managing shares and notifications. Our API supports both GET and POST operations.  Capabilities of the API include:  - Uploading and downloading files. - Managing files and folders; including standard operations like move, copy and delete. - Getting information about activity occuring in your account. - Creating, updating and deleting users. - Creating and managing shares, including download-only shares and recieve folders.  - Setting up and managing notifications.  ## The API Endpoint  The ExaVault API is located at: https://api.exavault.com/v1/  # Testing w/ Postman  We've made it easy for you to test our API before you start full-scale development. Download [Postman](https://www.getpostman.com/) or the [Postman Chrome Extension](https://chrome.google.com/webstore/detail/postman/fhbjgbiflinjbdggehcddcbncdddomop?hl=en), and then download our Postman collection, below. [Obtain your API key](#section/Code-Libraries-and-Sample-PHP-Code/Obtain-your-API-key) and you'll be able to interact with your ExaVault account immediately, so you can better understand what the capabilities of the API are.  <div class=\"postman-run-button\" data-postman-action=\"collection/import\" data-postman-var-1=\"e13395afc6278ce1555f\"></div>  ![ExaVault API Postman Colletion Usage](/images/postman.png)  If you'd prefer to skip Postman and start working with code directly, take a look at the sample code below.    # Code Libraries & Sample PHP Code  Once you're ready for full-scale development, we recommend looking at our code libraries available on [GitHub](https://github.com/ExaVault). We offer code libraries for [Python](https://github.com/ExaVault/evapi-python), [PHP](https://github.com/ExaVault/evapi-php), [C#](https://github.com/ExaVault/evapi-csharp), and [Java](https://github.com/ExaVault/evapi-java).  While we recommend using our libraries, you're welcome to interact directly with our API via HTTP GET and POST requests -- a great option particularly if you're developing in a language for which we don't yet have sample code.     - [Download Python Libraries &raquo;](https://github.com/ExaVault/evapi-python) - [Download PHP Libraries &raquo;](https://github.com/ExaVault/evapi-php) - [Download C# Libraries &raquo;](https://github.com/ExaVault/evapi-csharp) - [Download Java Libraries &raquo;](https://github.com/ExaVault/evapi-java)  ## Obtain your API key  You will need to obtain an API key for your application from the [Client Area](https://clients.exavault.com/clientarea.php?action=products) of your account.  To obtain an API key, please follow the instructions below.   + Login to the [Accounts](https://clients.exavault.com/clientarea.php?action=products) section of the Client Area.  + Use the drop down next to your desired account, and select *Manage API Keys*.  + You will be brought to the API Key management screen. Fill out the form and save to generate a new key for your app.  *NOTE: As of Oct 2017, we are in the progress of migrating customers to our next generation platform. If your account is already on our new platform, you should log into your File Manager and create your API key under Account->Developer->Manage API Keys*.  ## Example: Setting the API key  To get started, you will want to add your custom API key to your application config. Here is an example using PHP, which makes use of our sample PHP library:  ```php    require_once('V1Api.php');   require_once('APIClient.php');   $apiKey = 'myaccountname-XXXXXXXXXXXXXXXX';   $apiUrl = 'https://api.exavault.com'   ``` ## Example: Authenticating  Once your API key is in place, you will likely want to authenticate so that you can begin uploading and downloading files, creating users, and all that other fun stuff.  ```php    // create a new instance of the ExaVault API library class   $api = new V1Api( new APIClient($apiKey, $apiUrl) );     $accessToken = null;    // call the authenticateUser method, passing your username and password   $response = $api->authenticateUser('yourusername', 'yourpassword');    // save this result for later, we will need it to logout   $loginSuccess = $response->success;    // if authentication was successful, store the access token   // obtained via the response body in the API instance.    if ($loginSuccess) {       $accessToken = $response->results->accessToken;    } else {       // Handle the error...   }  ```  ## Example: Uploading a file   ```php    // set the local and remote paths   $localPath = '/path/of/your/local/file';   $remotePath = '/path/on/remote/host';    // get the file size located at the local path   $filesize = filesize($localPath);    // get the upload URL from the Evapi object   $uploadResults = $api->getUploadFileUrl($accessToken, $filesize, $remotePath, true);    // if we were able to successfully get the upload URL, start   // uploading. Otherwise, print an error message.    if($uploadResults->success) {     // initialize a new curl session by passing the uploadFileUrl     $uploadUrl = $uploadResults->results->url;     $ch = curl_init($uploadUrl);      // create the open file handle     $handle = fopen($localPath, 'r');      // set the HTTP POST header, indicating the size of file to be uploaded     $header = array('X_File_Size: ' . $filesize,                     'Content-Type: multipart/form-data',                     'Content-Length: '' . $filesize,     );      // PHP uses curl for sending HTTP requests. If using a different language     // you will likely do this differently      curl_setopt($ch, CURLOPT_POST, true);  // perform upload via http post     curl_setopt($ch, CURLOPT_HTTPHEADER, $header);  // specify the header     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  // return string of result     curl_setopt($ch, CURLOPT_INFILE, $handle);  // specify size of file to upload     curl_setopt($ch, CURLOPT_SSLVERSION, 1);  // specify TLS 1.0     curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);  // verify common name with specified hostname     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true); // verify certificate of remote peer      $result = curl_exec($ch);   // upload the file, get back result     $result = json_decode($result, true); // convert result to an array     curl_close($ch);  // close the curl session     fclose($handle);   // close the open file handle      if ($result['success']) {       // Your upload was successful!     } else {       // Wah-wah. Your upload failed for some reason.     }    } else {     // Wah-wah. Your upload failed for some reason.   }  ```  ## Example: Downloading a file  Downloading, like the upload process, first requires obtaining an appropriate download URL and then making a separate HTTP request to the API.   ```php    // set the filename   $filename = \"file.txt\";    // set the local path of the file to download to   $localPath = \"/path/to/local/\" . $filename;    // set the remote path where the file is located   $remotePath = \"/path/to/remote/\" . $filename;    // call the getDownloadFileUrl method on the API object instance   $downloadResults = $api->getDownloadFileUrl($accessToken, $remotePath);        if($downloadResults->success) {        // get the download URL and initialize a new curl session       $downloadUrl = $downloadResults->results->url;       $ch = curl_init($downloadUrl);        // set the file handle to the appropriate path       $handle = fopen($localPath, 'w');        // set the cURL options       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);       curl_setopt($ch, CURLOPT_FILE, $handle);       curl_setopt($ch, CURLOPT_SSLVERSION, 1);       curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);               $result = curl_exec($ch);       $result = json_decode($result, true);       curl_close($ch);       fclose($handle);        if ($result) {           // Download successful!       } else {           // Oops, there was an error.       }   } else {       // Oops, there was an error.   }  ```  ## Example: Logging Out  Logging out of the API is very simple. The only thing that is required is to check to see if we were logged in in the first place; if yes then log out.  ```php    // logout only if login was successful   if ($loginResult) {       $api->logoutUser($accessToken);   }  ```  # Status Codes  The ExaVault API returns only two HTTP status codes for its responses: 200 and 500.  When the request could be successfully processed by the endpoint, the response status code will be 200, regardless of whether the requested action could be taken.  For example, the response to a getUser request for a username that does not exist in your account would have the status of 200,  indicating that the response was received and processed, but the error member of the returned response object would contain object with `message` and `code` properties.  **Result Format:**  |Success   | Error     | Results   | | ---      | :---:       |  :---:      | | 0        |  `Object` |   Empty   | | 1        |   Empty       |    `Object` or `Array`        |     When a malformed request is received, a 500 HTTP status code will be returned, indicating that the request could not be processed.  ExaVault's API does not currently support traditional REST response codes such as '201 Created' or '405 Method Not Allowed', although we intend to support such codes a future version of the API.   # File Paths  Many API calls require you to provide one or more file paths. For example, the <a href=\"#operation/moveResources\">moveResources</a> call requires both an array of source paths, **filePaths**, and a destination path, **destinationPath**. Here's a few tips for working with paths:   - File paths should always be specified as a string, using the standard Unix format: e.g. `/path/to/a/file.txt`  - File paths are always absolute _from the home directory of the logged in user_. For example, if the user **bob** had a home directory restriction of `/bob_home`, then an API call made using his login would specify a file as `/myfile.txt`, whereas an API call made using the master user ( no home directory restriction ) would specify the same file as `/bob_home/myfile.txt`.  # API Rate Limits  We rate limit the number of API calls you can make to help prevent abuse and protect system stablity. Each API key will support 500 requests per rolling five minutes. If you make more than 500 requests in a five minute period, you will receive a response with an error object for fifteen minutes.  # Webhooks  A webhook is an HTTP callback: a simple event-notification via HTTP POST. If you define webhooks for Exavault, ExaVault will POST a  message to a URL when certain things happen.     Webhooks can be used to receive a JSON object to your endpoint URL. You choose what events will trigger webhook messages to your endpoint URL.     Webhooks will attempt to send a message up to 8 times with increasing timeouts between each attempt. All webhook requests are tracked in the webhooks log.  ## Getting started  1. Go to the Account tab inside SWFT.  2. Choose the Developer tab.  3. Configure your endpoint URL and select the events you want to trigger webhook messages.  4. Save settings.    You are all set to receive webhook callbacks on the events you selected.  ## Verification Signature  ExaVault includes a custom HTTP header, X-Exavault-Signature, with webhooks POST requests which will contain the signature for the request.  You can use the signature to verify the request for an additional level of security.  ## Generating the Signature  1. Go to Account tab inside SWFT.  2. Choose the Developer tab.  3. Obtain the verification token. This field will only be shown if you've configured your endpoint URL.  4. In your code that receives or processes the webhooks, you should concatenate the verification token with the JSON object that we sent in our      POST request and hash it with md5.     ```     md5($verificationToken.$webhooksObject);     ```  5. Compare signature that you generated to the signature provided in the X-Exavault-Signature HTTP header  ## Example JSON Response Object  ```json   {     \"accountname\": \"mycompanyname\",     \"username\": \"john\"     \"operation\": \"Upload\",     \"protocol\": \"https\",     \"path\": \"/testfolder/filename.jpg\"     \"attempt\": 1   } ```  ## Webhooks Logs  Keep track of all your webhooks requests in the Activity section of your account. You can find the following info for each request:    1. date and time - timestamp of the request.    2. endpoint url - where the webhook was sent.    3. event - what triggered the webhook.    4. status - HTTP status or curl error code.    5. attempt - how many times we tried to send this request.    6. response size - size of the response from your server.    7. details - you can check the response body if it was sent.
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
 * UserApi Class Doc Comment
 *
 * @category Class
 * @package  Swagger\Client
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class UserApi
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
     * @return UserApi
     */
    public function setApiClient(\Swagger\Client\ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
        return $this;
    }

    /**
     * Operation createUser
     *
     * createUser
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param \Swagger\Client\Model\CreateUser $create_user  (optional)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return \Swagger\Client\Model\Response
     */
    public function createUser($api_key, $create_user = null)
    {
        list($response) = $this->createUserWithHttpInfo($api_key, $create_user);
        return $response;
    }

    /**
     * Operation createUserWithHttpInfo
     *
     * createUser
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param \Swagger\Client\Model\CreateUser $create_user  (optional)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return array of \Swagger\Client\Model\Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function createUserWithHttpInfo($api_key, $create_user = null)
    {
        // verify the required parameter 'api_key' is set
        if ($api_key === null) {
            throw new \InvalidArgumentException('Missing the required parameter $api_key when calling createUser');
        }
        // parse inputs
        $resourcePath = "/createUser";
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
        if (isset($create_user)) {
            $_tempBody = $create_user;
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
                '/createUser'
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
     * Operation deleteUser
     *
     * deleteUser
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @param string $username Username of the user to delete. (required)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return \Swagger\Client\Model\Response
     */
    public function deleteUser($api_key, $access_token, $username)
    {
        list($response) = $this->deleteUserWithHttpInfo($api_key, $access_token, $username);
        return $response;
    }

    /**
     * Operation deleteUserWithHttpInfo
     *
     * deleteUser
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @param string $username Username of the user to delete. (required)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return array of \Swagger\Client\Model\Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteUserWithHttpInfo($api_key, $access_token, $username)
    {
        // verify the required parameter 'api_key' is set
        if ($api_key === null) {
            throw new \InvalidArgumentException('Missing the required parameter $api_key when calling deleteUser');
        }
        // verify the required parameter 'access_token' is set
        if ($access_token === null) {
            throw new \InvalidArgumentException('Missing the required parameter $access_token when calling deleteUser');
        }
        // verify the required parameter 'username' is set
        if ($username === null) {
            throw new \InvalidArgumentException('Missing the required parameter $username when calling deleteUser');
        }
        // parse inputs
        $resourcePath = "/deleteUser";
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
        if ($username !== null) {
            $queryParams['username'] = $this->apiClient->getSerializer()->toQueryValue($username);
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
                '/deleteUser'
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
     * Operation getAccount
     *
     * getAccount
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return \Swagger\Client\Model\AccountResponse
     */
    public function getAccount($api_key, $access_token)
    {
        list($response) = $this->getAccountWithHttpInfo($api_key, $access_token);
        return $response;
    }

    /**
     * Operation getAccountWithHttpInfo
     *
     * getAccount
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return array of \Swagger\Client\Model\AccountResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getAccountWithHttpInfo($api_key, $access_token)
    {
        // verify the required parameter 'api_key' is set
        if ($api_key === null) {
            throw new \InvalidArgumentException('Missing the required parameter $api_key when calling getAccount');
        }
        // verify the required parameter 'access_token' is set
        if ($access_token === null) {
            throw new \InvalidArgumentException('Missing the required parameter $access_token when calling getAccount');
        }
        // parse inputs
        $resourcePath = "/getAccount";
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
                '\Swagger\Client\Model\AccountResponse',
                '/getAccount'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Swagger\Client\Model\AccountResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Swagger\Client\Model\AccountResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }

            throw $e;
        }
    }

    /**
     * Operation getCurrentUser
     *
     * getCurrentUser
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return \Swagger\Client\Model\UserResponse
     */
    public function getCurrentUser($api_key, $access_token)
    {
        list($response) = $this->getCurrentUserWithHttpInfo($api_key, $access_token);
        return $response;
    }

    /**
     * Operation getCurrentUserWithHttpInfo
     *
     * getCurrentUser
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return array of \Swagger\Client\Model\UserResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getCurrentUserWithHttpInfo($api_key, $access_token)
    {
        // verify the required parameter 'api_key' is set
        if ($api_key === null) {
            throw new \InvalidArgumentException('Missing the required parameter $api_key when calling getCurrentUser');
        }
        // verify the required parameter 'access_token' is set
        if ($access_token === null) {
            throw new \InvalidArgumentException('Missing the required parameter $access_token when calling getCurrentUser');
        }
        // parse inputs
        $resourcePath = "/getCurrentUser";
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
                '\Swagger\Client\Model\UserResponse',
                '/getCurrentUser'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Swagger\Client\Model\UserResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Swagger\Client\Model\UserResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }

            throw $e;
        }
    }

    /**
     * Operation getUser
     *
     * getUser
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @param string $username Username of the user to get. (required)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return \Swagger\Client\Model\UserResponse
     */
    public function getUser($api_key, $access_token, $username)
    {
        list($response) = $this->getUserWithHttpInfo($api_key, $access_token, $username);
        return $response;
    }

    /**
     * Operation getUserWithHttpInfo
     *
     * getUser
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @param string $username Username of the user to get. (required)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return array of \Swagger\Client\Model\UserResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getUserWithHttpInfo($api_key, $access_token, $username)
    {
        // verify the required parameter 'api_key' is set
        if ($api_key === null) {
            throw new \InvalidArgumentException('Missing the required parameter $api_key when calling getUser');
        }
        // verify the required parameter 'access_token' is set
        if ($access_token === null) {
            throw new \InvalidArgumentException('Missing the required parameter $access_token when calling getUser');
        }
        // verify the required parameter 'username' is set
        if ($username === null) {
            throw new \InvalidArgumentException('Missing the required parameter $username when calling getUser');
        }
        // parse inputs
        $resourcePath = "/getUser";
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
        if ($username !== null) {
            $queryParams['username'] = $this->apiClient->getSerializer()->toQueryValue($username);
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
                '\Swagger\Client\Model\UserResponse',
                '/getUser'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Swagger\Client\Model\UserResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Swagger\Client\Model\UserResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }

            throw $e;
        }
    }

    /**
     * Operation getUsers
     *
     * getUsers
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @param string $sort_by Sort method for the returned array. (required)
     * @param string $sort_order Sort order for the returned array. (optional, default to asc)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return \Swagger\Client\Model\UsersResponse
     */
    public function getUsers($api_key, $access_token, $sort_by, $sort_order = 'asc')
    {
        list($response) = $this->getUsersWithHttpInfo($api_key, $access_token, $sort_by, $sort_order);
        return $response;
    }

    /**
     * Operation getUsersWithHttpInfo
     *
     * getUsers
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @param string $sort_by Sort method for the returned array. (required)
     * @param string $sort_order Sort order for the returned array. (optional, default to asc)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return array of \Swagger\Client\Model\UsersResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getUsersWithHttpInfo($api_key, $access_token, $sort_by, $sort_order = 'asc')
    {
        // verify the required parameter 'api_key' is set
        if ($api_key === null) {
            throw new \InvalidArgumentException('Missing the required parameter $api_key when calling getUsers');
        }
        // verify the required parameter 'access_token' is set
        if ($access_token === null) {
            throw new \InvalidArgumentException('Missing the required parameter $access_token when calling getUsers');
        }
        // verify the required parameter 'sort_by' is set
        if ($sort_by === null) {
            throw new \InvalidArgumentException('Missing the required parameter $sort_by when calling getUsers');
        }
        // parse inputs
        $resourcePath = "/getUsers";
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
        if ($sort_by !== null) {
            $queryParams['sortBy'] = $this->apiClient->getSerializer()->toQueryValue($sort_by);
        }
        // query params
        if ($sort_order !== null) {
            $queryParams['sortOrder'] = $this->apiClient->getSerializer()->toQueryValue($sort_order);
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
                '\Swagger\Client\Model\UsersResponse',
                '/getUsers'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Swagger\Client\Model\UsersResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Swagger\Client\Model\UsersResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }

            throw $e;
        }
    }

    /**
     * Operation updateUser
     *
     * updateUser
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param \Swagger\Client\Model\UpdateUser $update_user  (optional)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return \Swagger\Client\Model\Response
     */
    public function updateUser($api_key, $update_user = null)
    {
        list($response) = $this->updateUserWithHttpInfo($api_key, $update_user);
        return $response;
    }

    /**
     * Operation updateUserWithHttpInfo
     *
     * updateUser
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param \Swagger\Client\Model\UpdateUser $update_user  (optional)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return array of \Swagger\Client\Model\Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function updateUserWithHttpInfo($api_key, $update_user = null)
    {
        // verify the required parameter 'api_key' is set
        if ($api_key === null) {
            throw new \InvalidArgumentException('Missing the required parameter $api_key when calling updateUser');
        }
        // parse inputs
        $resourcePath = "/updateUser";
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
        if (isset($update_user)) {
            $_tempBody = $update_user;
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
                '/updateUser'
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
     * Operation userAvailable
     *
     * userAvailable
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @param string $username Username to check. (required)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return \Swagger\Client\Model\AvailableUserResponse
     */
    public function userAvailable($api_key, $access_token, $username)
    {
        list($response) = $this->userAvailableWithHttpInfo($api_key, $access_token, $username);
        return $response;
    }

    /**
     * Operation userAvailableWithHttpInfo
     *
     * userAvailable
     *
     * @param string $api_key API key required to make the API call. (required)
     * @param string $access_token Access token required to make the API call. (required)
     * @param string $username Username to check. (required)
     * @throws \Swagger\Client\ApiException on non-2xx response
     * @return array of \Swagger\Client\Model\AvailableUserResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function userAvailableWithHttpInfo($api_key, $access_token, $username)
    {
        // verify the required parameter 'api_key' is set
        if ($api_key === null) {
            throw new \InvalidArgumentException('Missing the required parameter $api_key when calling userAvailable');
        }
        // verify the required parameter 'access_token' is set
        if ($access_token === null) {
            throw new \InvalidArgumentException('Missing the required parameter $access_token when calling userAvailable');
        }
        // verify the required parameter 'username' is set
        if ($username === null) {
            throw new \InvalidArgumentException('Missing the required parameter $username when calling userAvailable');
        }
        // parse inputs
        $resourcePath = "/userAvailable";
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
        if ($username !== null) {
            $queryParams['username'] = $this->apiClient->getSerializer()->toQueryValue($username);
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
                '\Swagger\Client\Model\AvailableUserResponse',
                '/userAvailable'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Swagger\Client\Model\AvailableUserResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Swagger\Client\Model\AvailableUserResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }

            throw $e;
        }
    }
}
