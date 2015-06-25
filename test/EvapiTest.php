<?php
/**
 * Copyright 2014 ExaVault, Inc.
 *
 * EvapiTest.php
 *
 * This file contains unit tests for testing the swagger generated API
 * client.
 *
 * @author Dylan Gleason, support -at- exavault -dot- com
 */

require_once('../src/V1Api.php');
require_once('../src/APIClient.php');

class EvapiTest extends PHPUnit_Framework_TestCase
{
    //
    // NOTE: set each of the below constants to match your actual
    // account information/data before running these tests. This
    // information is required in order to test API functionality
    // successfully against your account.
    //

    const USERNAME      = 'yourusername';
    const PASSWORD      = 'yourpassword';
    const API_KEY       = 'yourapp-XXXXXXXXXXXXXXXXXXXX';
    const API_SERVER    = 'https://api.exavault.com';
    const ROOT_DIR      = '/';
    const FOLDER        = 'evapi-php-tests';
    const SUBFOLDER     = 'subfolder'; 
    const TEST_USER     = 'evapi-php-tests';
    const TEST_EMAIL    = 'youremail@domain.com';
    const PREVIEW       = '/test-files/preview/images.jpg';
    const RENAME_FOLDER = 'test-rename-folder';
    const DOWNLOAD_FILE = '/test-files/file-tree.txt';
    const UPLOAD_FILE   = 'test-filename.txt';
    const TIMEZONE      = 'America/Los_Angeles';
    const USER_ROLE     = 'user';
    const PERMISSIONS   = 'upload,download,modify,delete';

    
    private static $api = null;

    private static $accessToken = null;


    /**
     * Setup the API client and authenticate for all tests.
     *
     * @return void
     */
    public static function setUpBeforeClass()
    {
        self::$api = new V1Api(new APIClient(self::API_KEY, self::API_SERVER));
        self::authenticateUser();
    }

    /**
     * Logout the test user after completing tests
     *
     * @return void
     */
    public static function tearDownAfterClass()
    {
        if (!is_null(self::$accessToken)) {
            self::$api->logoutUser(self::$accessToken);
        }
    }

    /**
     * Authenticates user with test data and returns the response
     * object.
     *
     * @return void
     */
    private static function authenticateUser()
    {
        $response = self::$api->authenticateUser(self::USERNAME, self::PASSWORD);
        if (!$response->success) {
            throw new Exception();
        }
        self::$accessToken = $response->results->accessToken;
    }

    /**
     * Create a test user and returns response object.
     *
     * @return UserResponse
     */
    private function createUser()
    {
        return self::$api->createUser(
            self::$accessToken,
            self::TEST_USER,
            self::ROOT_DIR,
            self::TEST_EMAIL,
            self::PASSWORD,
            self::USER_ROLE,
            self::PERMISSIONS,
            self::TEST_USER,
            null,
            null,
            null,
            self::TIMEZONE
        );
    }

    /**
     * Deletes the test user.
     *
     * @return Response
     */
    private function deleteUser()
    {
        return self::$api->deleteUser(self::$accessToken, self::TEST_USER);
    }


    // Test methods

    public function testAuthenticateUserAndLogout()
    {
        echo (" - " . __METHOD__ . "\n");

        $error = false;
        $authResponse = null;
        $logoutResponse = null;

        try {
            $this->createUser();
            $authResponse = self::$api->authenticateUser(self::TEST_USER, self::PASSWORD);
            $logoutResponse = self::$api->logoutUser($authResponse->results->accessToken);
            self::$api->deleteUser(self::$accessToken, self::TEST_USER);
        } catch (Exception $e) {
            $error = true;            
        }

        $this->assertFalse($error);

        $this->assertNotNull($authResponse);
        $this->assertInstanceOf('AuthResponse', $authResponse);

        $this->assertNotNull($logoutResponse);
        $this->assertInstanceOf('Response', $logoutResponse);

        $results = $authResponse->results;
        $this->assertEquals($results->username, self::TEST_USER);
        $this->assertNotEmpty(self::$accessToken);
        $this->assertNotEmpty($results->clientIp);
    }

    public function testCheckFilesExist()
    {
        echo (" - " . __METHOD__ . "\n");

        $error = false;
        $response = null;

        try {
            $response = self::$api->checkFilesExist(self::$accessToken, '/');
        } catch (Exception $e) {
            $error = true;
        }

        $this->assertFalse($error);
        $this->assertNotNull($response);
        $this->assertInstanceOf('ExistingResourcesResponse', $response);
        $this->assertInstanceOf('ExistingResource', $response->results[0]);
    }

    public function testCopyResources()
    {
        echo (" - " . __METHOD__ . "\n");

        $error = false;
        $response = null;

        try {
            // create a bunch of test folders to mess around with
            self::$api->createFolder(self::$accessToken, self::FOLDER, "/");
            self::$api->createFolder(self::$accessToken, self::SUBFOLDER, "/");

            // make the actual copyResources call
            $response = self::$api->copyResources(self::$accessToken, array(self::SUBFOLDER), self::FOLDER);            

            // setup the expected values
            $folder = "/" . self::FOLDER;
            $subFolder = "/" . self::SUBFOLDER;
            $copiedFolder = $folder . $subFolder;

            // cleanup the test folders
            self::$api->deleteResources(self::$accessToken, [$folder, $subFolder]);

        } catch (Exception $e) {
            $error = true;
        }

        $this->assertFalse($error);
        $this->assertNotNull($response);
        $this->assertInstanceOf('ModifiedResourcesResponse', $response);

        $firstResult = $response->results[0];
        $this->assertNotNull($firstResult);
        $this->assertInstanceOf('ModifiedResource', $firstResult);

        $this->assertEquals($subFolder, $firstResult->file);
        $this->assertEquals($copiedFolder, $firstResult->destination);
    }

    public function testCreateFolder()
    {
        echo (" - " . __METHOD__ . "\n");

        $error = false;
        $response = null;

        try {
            // create a folder then delete it
            $response = self::$api->createFolder(self::$accessToken, self::FOLDER, "/");
            self::$api->deleteResources(self::$accessToken, ["/" . self::FOLDER]);
        } catch (Exception $e) {
            $error = true;
        }

        $this->assertFalse($error);
        $this->assertNotNull($response);
        $this->assertInstanceOf('Response', $response);
        $this->assertEquals(1, $response->success);
    }

    public function testCreateUser()
    {
        echo (" - " . __METHOD__ . "\n");

        $error = false;
        $response = null;

        try {
            // create then delete the user
            $response = $this->createUser();
            $this->deleteUser();
        } catch (Exception $e) {
            $error = true;
        }

        $this->assertFalse($error);
        $this->assertNotNull($response);
        $this->assertInstanceOf('Response', $response);
        $this->assertEquals(1, $response->success);

    }

    public function testDeleteResources()
    {
        echo (" - " . __METHOD__ . "\n");

        $error = false;
        $response = null;

        try {
            // create the test folder and then delete it
            self::$api->createFolder(self::$accessToken, self::FOLDER, "/");
            $response = self::$api->deleteResources(self::$accessToken, ["/" . self::FOLDER]);
        } catch (Exception $e) {
            $error = true;
        }

        $this->assertFalse($error);
        $this->assertNotNull($response);
        $this->assertInstanceOf('DeletedResourcesResponse', $response);
        
        $firstResult = $response->results[0];
        $this->assertNotNull($firstResult);
        $this->assertInstanceOf('DeletedResource', $firstResult);
        $this->assertEquals("/" . self::FOLDER, $firstResult->file);
    }

    public function testDeleteUser()
    {
        echo (" - " . __METHOD__ . "\n");

        $error = false;
        $response = null;
        
        try {
            // create then delete the test user
            $this->createUser();
            $response = $this->deleteUser();
        } catch (Exception $e) {
            $error = true;
        }

        $this->assertFalse($error);
        $this->assertNotNull($response);
        $this->assertInstanceOf('Response', $response);
        $this->assertEquals(1, $response->success);
    }

    public function testGetAccount()
    {
        echo (" - " . __METHOD__ . "\n");

        $error = false;
        $response = null;

        try{
            $response = self::$api->getAccount(self::$accessToken);
        } catch (Exception $e) {
            $error = true;
        }

        $this->assertFalse($error);
        $this->assertNotNull($response);
        $this->assertInstanceOf('AccountResponse', $response);

        $results = $response->results;
        $this->assertNotNull($results);
        $this->assertInstanceOf('Account', $results);
        $this->assertEquals(self::USERNAME, $results->username);
    }

    public function testGetCurrentUser()
    {
        echo (" - " . __METHOD__ . "\n");

        $error = false;
        $response = null;

        try{
            $response = self::$api->getCurrentUser(self::$accessToken);
        } catch (Exception $e) {
            $error = true;
        }

        $this->assertNotNull($response);
        $this->assertInstanceOf('UserResponse', $response);

        $results = $response->results;
        $this->assertNotNull($results);                    
        $this->assertInstanceOf('User', $results);

        $this->assertEquals(self::USERNAME, $results->username);
        $this->assertEquals(self::USERNAME, $results->nickname);
        $this->assertEquals("master", $results->role);
    }

    public function testGetDownloadFileUrl()
    {
        echo (" - " . __METHOD__ . "\n");

        $error = false;
        $response = null;
        
        try {
            $response = self::$api->getDownloadFileUrl(self::$accessToken, self::DOWNLOAD_FILE);
        } catch(Exception $e) {
            $error = true;
        }

        $this->assertFalse($error);
        $this->assertNotNull($response);
        $this->assertInstanceOf('UrlResponse', $response);

        $results = $response->results;
        $this->assertNotNull($results);
        $this->assertInstanceOf('Url', $results);
        $this->assertNotEmpty($results->url);
    }

    public function testGetFileActivityLogs()
    {
        echo (" - " . __METHOD__ . "\n");

        $error = false;
        $response = null;
        
        try {
            $response = self::$api->getFileActivityLogs(self::$accessToken, 0);
        } catch(Exception $e) {
            $error = true;
        }

        $this->assertFalse($error);
        $this->assertNotNull($response);
        $this->assertInstanceOf('LogResponse', $response);

        $firstResult = $response->results[0];
        $this->assertNotNull($firstResult);
        $this->assertInstanceOf('LogEntry', $firstResult);
    }

    public function testGetFolders()
    {
        echo (" - " . __METHOD__ . "\n");

        $error = false;
        $response = null;        

        try {
            $response = self::$api->getFolders(self::$accessToken, "/");
        } catch(Exception $e) {
            $error = true;
        }

        $this->assertFalse($error);
        $this->assertNotNull($response);
        $this->assertInstanceOf('ResourcePropertiesResponse', $response);

        $firstResult = $response->results[0];
        $this->assertNotNull($firstResult);
        $this->assertInstanceOf('ResourceProperty', $firstResult);
    }

    public function testGetResourceList()
    {
        echo (" - " . __METHOD__ . "\n");

        $error = false;
        $response = null;        

        try {
            $response = self::$api->getResourceList(self::$accessToken, '/', 'sort_files_type', 'asc', 1, 25);
        } catch(Exception $e) {
            $error = true;
        }

        $this->assertFalse($error);        
        $this->assertNotNull($response);
        $this->assertInstanceOf('ResourceResponse', $response);

        $results = $response->results;
        $this->assertNotNull($results);
        $this->assertInstanceOf('Resource', $results);
    }

    public function testGetResourceProperties()
    {
        echo (" - " . __METHOD__ . "\n");

        $error = false;
        $response = null;

        try {
            $response = self::$api->getResourceProperties(self::$accessToken, ["/"]);
        } catch(Exception $e) {
            $error = true;
        }

        $this->assertFalse($error);
        $this->assertNotNull($response);
        $this->assertInstanceOf('ResourcePropertiesResponse', $response);

        $firstResult = $response->results[0];
        $this->assertNotNull($firstResult);
        $this->assertInstanceOf('ResourceProperty', $firstResult);
    }

    public function testGetUser()
    {
        echo (" - " . __METHOD__ . "\n");

        $error = false;
        $response = null;

        try {
            $response = self::$api->getUser(self::$accessToken, self::USERNAME);
        } catch (Exception $e) {
            $error = true;
        }

        $this->assertFalse($error);
        $this->assertNotNull($response);
        $this->assertInstanceOf('UserResponse', $response);

        $results = $response->results;
        $this->assertNotNull($results);
        $this->assertInstanceOf('User', $results);
    }

    public function testGetUsers()
    {
        echo (" - " . __METHOD__ . "\n");

        $error = false;
        $response = null;

        try {
            $response = self::$api->getUsers(self::$accessToken, "sort_users_username", "asc");
        } catch (Exception $e) {
            $error = true;
        }

        $this->assertFalse($error);
        $this->assertNotNull($response);
        $this->assertInstanceOf('UsersResponse', $response);

        $firstResult = $response->results[0];
        $this->assertNotNull($firstResult);                    
        $this->assertInstanceOf('User', $firstResult);
    }

    public function testMoveResources()
    {
        echo (" - " . __METHOD__ . "\n");

        $error = false;
        $response = null;

        try {
            // create a bunch of test folders to mess around with
            self::$api->createFolder(self::$accessToken, self::FOLDER, "/");
            self::$api->createFolder(self::$accessToken, self::SUBFOLDER, "/");

            // make actual call to moveResources
            $response = self::$api->moveResources(self::$accessToken, array(self::SUBFOLDER), self::FOLDER);            

            // setup the expected values
            $folder = "/" . self::FOLDER;
            $subFolder = "/" . self::SUBFOLDER;
            $movedFolder = $folder . $subFolder;

            // cleanup test folder
            self::$api->deleteResources(self::$accessToken, [$folder]);

        } catch (Exception $e) {
            $error = true;
        }

        $this->assertFalse($error);
        $this->assertNotNull($response);
        $this->assertInstanceOf('ModifiedResourcesResponse', $response);

        $firstResult = $response->results[0];
        $this->assertNotNull($firstResult);
        $this->assertInstanceOf('ModifiedResource', $firstResult);
        $this->assertEquals($subFolder, $firstResult->file);
        $this->assertEquals($movedFolder, $firstResult->destination);
    }

    public function testPreviewFile()
    {
        echo (" - " . __METHOD__ . "\n");

        $error = false;
        $response = null;

        try {
            $response = self::$api->previewFile(self::$accessToken, self::PREVIEW, "small");
        } catch (Exception $e) {
            $error = true;
        }

        $this->assertFalse($error);
        $this->assertNotNull($response);
        $this->assertInstanceOf('PreviewFileResponse', $response);

        $results = $response->results;
        $this->assertNotNull($results);
        $this->assertInstanceOf('PreviewFile', $results);
    }

    public function testRenameResource()
    {
        echo (" - " . __METHOD__ . "\n");

        $error = false;
        $response = null;

        try {
            self::$api->createFolder(self::$accessToken, self::RENAME_FOLDER, "/");
            $newFolderName = self::RENAME_FOLDER . "-rename";
            $response = self::$api->renameResource(self::$accessToken, self::RENAME_FOLDER, $newFolderName);

            // cleanup the folder
            self::$api->deleteResources(self::$accessToken, [$newFolderName]);            
        } catch (Exception $e) {
            $error = true;
        }

        $this->assertFalse($error);
        $this->assertNotNull($response);
        $this->assertInstanceOf('Response', $response);
        $this->assertEquals(1, $response->success);
    }

    public function testUpdateUser()
    {
        echo (" - " . __METHOD__ . "\n");

        $error = false;
        $response = null;

        try {
            // create the user, then get their userId
            $this->createUser();
            $response = self::$api->getUser(self::$accessToken, self::TEST_USER);
            $userId = $response->results->id;

            // make the call to updateUser
            $response = self::$api->updateUser(self::$accessToken, $userId, self::TEST_USER . "-changed");
            
        } catch (Exception $e) {
            $error = true;
        }

        $this->assertNotNull($response);
        $this->assertInstanceOf('Response', $response);
        $this->assertEquals(1, $response->success);

        self::$api->deleteUser(self::$accessToken, self::TEST_USER . "-changed");
    }

    public function testUserAvailable()
    {
        echo (" - " . __METHOD__ . "\n");

        $error = false;
        $response = null;        

        try {
            $response = self::$api->userAvailable(self::$accessToken, self::USERNAME);
        } catch (Exception $e) {
            $error = true;
        }

        $this->assertFalse($error);
        $this->assertNotNull($response);
        $this->assertInstanceOf('AvailableUserResponse', $response);

        $results = $response->results;
        $this->assertNotNull($results);
        $this->assertInstanceOf('AvailableUser', $results);
        $this->assertEquals(false, $results->available);
    }
}
