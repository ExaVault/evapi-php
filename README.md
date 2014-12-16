evapi-php
=========

evapi-php is an API client written in PHP for connecting to the
ExaVault API. The ExaVault API is a REST-like API providing operations
for file and user management, and supports both `POST` and `GET`
requests.

To get started using ExaVault's API, you first must have an ExaVault
account and obtain an API key. For more information, please refer to
our [Developer page](https://www.exavault.com/developer) or contact
support@exavault.com for details.

## Usage ##

Once you have obtained your API key, you can begin making API requests
to upload/download files, and also to manage your users.

##### Setting the API key #####

Before you can make valid API requests, you will need to import the
API client code and set your API key.

```php
require_once('V1Api.php');
require_once('APIClient.php');

$apiKey = 'youraccountname-XXXXXXXXXXXXXXXX';
$apiUrl = 'https://api.exavault.com';
```

##### Authenticating #####

Once your API key is in place, you will likely want to authenticate so
that you can begin uploading and downloading files, creating users,
and all that other fun stuff.

```php
// create a new instance of the ExaVault API library class
$api = new V1Api( new APIClient($apiKey, $apiUrl) );

// call the authenticateUser method, passing your username and password
$response = $api->authenticateUser('yourusername', 'yourpassword');

// save this result for later, we will need it to logout
$loginSuccess = $response->success;

// if authentication was successful, store the access token
// obtained via the response body in the API instance.
if ($loginSuccess) {
    $accessToken = $response->results->accessToken;
} else {
    // Handle the error...
}
```

##### Uploading a file #####

Uploading is a bit more complicated, as it first requires obtaining an
appropriate upload URL from the API and then making a separate HTTP
request to upload the file to your account's storage server.

```php
// set the local and remote paths
$localPath = "/path/of/your/local/file";
$remotePath = "/path/on/remote/host";

// get the file size located at the local pathn
$filesize = filesize($localPath);

// get the upload URL from the Evapi object
$uploadResults = $api->getUploadFileUrl($accessToken, $filesize, $remotePath, true);

// if we were able to successfully get the upload URL, start
// uploading. Otherwise, print an error message.

if ($uploadResults->success) {

    // initialize a new curl session by passing the uploadFileUrl
    $uploadUrl = $uploadResults->results->url;
    $ch = curl_init($uploadUrl);

    // create the open file handle
    $handle = fopen($localPath, 'r');

    // set the HTTP POST header, indicating the size of file to be uploaded
    $header = array("X_File_Size: " . $filesize,
                    "Content-Type: multipart/form-data",
                    "Content-Length: " . $filesize
    );

    // Use cURL to send the HTTP request to actually upload the file

    curl_setopt($ch, CURLOPT_POST, true);           // perform upload via http post
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);  // specify the header
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    // return string of result
    curl_setopt($ch, CURLOPT_INFILE, $handle);      // specify size of file to upload
    curl_setopt($ch, CURLOPT_SSLVERSION, 1);        // specify TLS 1.0
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);    // verify common name with specified hostname
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true); // verify certificate of remote peer
    curl_exec($ch);                                 // upload the file, get back result

    $result = json_decode($result, true);           // convert result to an array
    curl_close($ch);                                // close the curl session
    fclose($handle);                                // close the open file handle

    if (!$result['success']) {
        // Whoopsie. Your upload failed.
    }
    
} else {
    // Whoopsie. The upload failed.
}
```

##### Downloading a file #####

Downloading, like the upload process, first requires obtaining an
appropriate download URL and then making a separate HTTP request to
your account's storage server.

```php
// set the filename
$filename = "file.txt";

// set the local path of the file to download to
$localPath = "/path/to/local/" . $filename;

// set the remote path where the file is located
$remotePath = "/path/to/remote/" . $filename;

// call the getDownloadFileUrl method on the API object instance
$downloadResults = $api->getDownloadFileUrl($accessToken, $remotePath);

if($downloadResults->success) {

    // get the download URL and initialize a new curl session
    $downloadUrl = $downloadResults->results->url;
    $ch = curl_init($downloadUrl);

    // set the file handle to the appropriate path
    $handle = fopen($localPath, 'w');

    // set the cURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FILE, $handle);
    curl_setopt($ch, CURLOPT_SSLVERSION, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

    $result = curl_exec($ch);
    $result = json_decode($result, true);
    curl_close($ch);
    fclose($handle);

    if (!$result['success']) {
        // Whoopsie, there was an error.
    }

} else {
    // Whoopsie, there was an error.
}
```

##### Logging Out #####

Logging out of the API is very simple. The only thing that is required
is to check to see if we were logged in in the first place; if yes,
then log out.

```php
// logout only if login was successful
if ($loginResult) {
    $api->logoutUser($accessToken);
}
```
