<?php
/**
 * Copyright 2014 ExaVault, Inc.
 *
 * EvapiTest.php
 *
 * This file contains unit tests for testing the swagger generated API
 * client
 */

require_once('../client/php/src/V1Api.php');
require_once('../client/php/src/APIClient.php');

class EvapiTest extends PHPUnit_Framework_TestCase
{
    //
    // NOTE: set each of the below constants to match your actual
    // account information/data before running these tests. This
    // information is required in order to test API functionality
    // successfully against your account.
    //

    const USERNAME      = 'yourusername';                // required for all tests
    const PASSWORD      = 'yourpassword';                // required for all tests
    const API_KEY       = 'yourusername-1234';           // required for all tests
    const API_SERVER    = 'https://api.exavault.com';    // required for all tests
    const FOLDER        = 'unit-tests';                  // for testCopyResources, testMoveResources, etc.
    const SUBFOLDER     = 'subfolder';                   // for testCopyResources, testMoveResources, etc.
    const TEST_USER     = 'unit-tests';                  // for testCreateUser
    const TEST_EMAIL    = 'youremail@domain.com';        // for testCreateUser
    const PREVIEW       = '/path/to/preview/file.jpg';   // for testPreviewFile
    const RENAME_FOLDER = '/folder-to-rename';           // for testRenameResource
    const DOWNLOAD_FILE = '/path/of/file/to/download';   // for testGetDownloadFileUrl
    const TIMEZONE      = 'America/Los_Angeles';         // for testCreateUser

    /**
     * BEGIN TESTS
     */

    public function setup()
    {
        // init the API client
        $this->api = new V1Api(new APIClient(self::API_KEY, self::API_SERVER));
    }

    public function testAuthenticateUser()
    {
        echo (" - " . __METHOD__ . "\n");

        // authenticate user and save access token
        try {
            $response = $this->authenticateUser();
            $results = $response->results;
        } catch (Exception $e) {
            // do nothing
        }

        $this->assertNotNull($response);
        $this->assertInstanceOf(AuthResponse, $response);
        $this->assertEquals($results->username, self::USERNAME);
        $this->assertNotEmpty($this->accessToken);
        $this->assertNotEmpty($results->clientIp);
    }

    public function testCheckFilesExist()
    {
        echo (" - " . __METHOD__ . "\n");

        $this->authenticateUser();

        try {
            $response = $this->api->checkFilesExist($this->accessToken, '/');
        } catch (Exception $e) {
            // do nothing
        }

        $this->assertNotNull($response);
        $this->assertInstanceOf(ExistingResourcesResponse, $response);
        $this->assertInstanceOf(ExistingResource, $response->results[0]);
    }

    public function testCopyResources()
    {
        echo (" - " . __METHOD__ . "\n");

        $this->authenticateUser();

        try {
            // create a bunch of test folders to mess around with
            $this->api->createFolder($this->accessToken, self::FOLDER, "/");
            $this->api->createFolder($this->accessToken, self::SUBFOLDER, "/");

            // make the actual copyResources call
            $response = $this->api->copyResources($this->accessToken, array(self::SUBFOLDER), self::FOLDER);
            $firstResult = $response->results[0];

            // setup the expected values
            $folder = "/" . self::FOLDER;
            $subFolder = "/" . self::SUBFOLDER;
            $copiedFolder = $folder . $subFolder;

        } catch (Exception $e) {
            // do nothing
        }

        $this->assertNotNull($response);
        $this->assertNotNull($firstResult);
        $this->assertInstanceOf(ModifiedResourcesResponse, $response);
        $this->assertInstanceOf(ModifiedResource, $firstResult);
        $this->assertEquals($subFolder, $firstResult->file);
        $this->assertEquals($copiedFolder, $firstResult->destination);

        // cleanup our test folders
        $this->api->deleteResources($this->accessToken, $folder);
        $this->api->deleteResources($this->accessToken, $subFolder);
    }

    public function testCreateFolder()
    {
        echo (" - " . __METHOD__ . "\n");

        $this->authenticateUser();

        try {
            $response = $this->api->createFolder($this->accessToken, self::FOLDER, "/");
        } catch (Exception $e) {
            // do nothing
        }

        $this->assertNotNull($response);
        $this->assertInstanceOf(Response, $response);
        $this->assertEquals(1, $response->success);

        // cleanup test folder
        $this->api->deleteResources($this->accessToken, "/" . self::FOLDER);
    }

    public function testCreateUser()
    {
        echo (" - " . __METHOD__ . "\n");

        // authenticate the user
        $this->authenticateUser();

        try {
            $response = $this->createUser();
        } catch (Exception $e) {
            // do nothing
        }

        $this->assertNotNull($response);
        $this->assertInstanceOf(Response, $response);
        $this->assertEquals(1, $response->success);

        // delete the user
        $this->deleteUser();
    }

    public function testDeleteResources()
    {
        echo (" - " . __METHOD__ . "\n");

        $this->authenticateUser();

        // create the test folder
        $this->api->createFolder($this->accessToken, self::FOLDER, "/");

        // call the deleteResources method
        try {
            $response = $this->api->deleteResources($this->accessToken, "/" . self::FOLDER);
            $firstResult = $response->results[0];
        } catch (Exception $e) {
            // do nothing
        }

        $this->assertNotNull($response);
        $this->assertNotNull($firstResult);
        $this->assertInstanceOf(FilesResponse, $response);
        $this->assertInstanceOf(File, $firstResult);
        $this->assertEquals("/" . self::FOLDER, $firstResult->file);
    }

    public function testDeleteUser()
    {
        echo (" - " . __METHOD__ . "\n");

        $this->authenticateUser();

        // create then delete the test user
        try {
            $this->createUser();
            $response = $this->deleteUser();
        } catch (Exception $e) {
            // do nothing
        }

        $this->assertNotNull($response);
        $this->assertInstanceOf(Response, $response);
        $this->assertEquals(1, $response->success);
    }

    public function testGetAccount()
    {
        echo (" - " . __METHOD__ . "\n");

        $this->authenticateUser();

        try{
            $response = $this->api->getAccount($this->accessToken);
            $results = $response->results;
        } catch (Exception $e) {
        }

        $this->assertNotNull($response);
        $this->assertNotNull($results);
        $this->assertInstanceOf(AccountResponse, $response);
        $this->assertInstanceOf(Account, $results);
        $this->assertEquals(self::USERNAME, $results->username);
    }

    public function testGetCurrentUser()
    {
        echo (" - " . __METHOD__ . "\n");

        $this->authenticateUser();

        try{
            $response = $this->api->getCurrentUser($this->accessToken);
            $results = $response->results;
        } catch (Exception $e) {
        }

        $this->assertNotNull($response);
        $this->assertNotNull($results);
        $this->assertInstanceOf(UserResponse, $response);
        $this->assertInstanceOf(User, $results);
        $this->assertEquals(self::USERNAME, $results->username);
        $this->assertEquals(self::USERNAME, $results->nickname);
        $this->assertEquals("master", $results->role);
    }

    public function testGetDownloadFileUrl()
    {
        echo (" - " . __METHOD__ . "\n");

        $this->authenticateUser();

        // call the getDownloadFileUrl operation
        try {
            $response = $this->api->getDownloadFileUrl($this->accessToken, self::DOWNLOAD_FILE);
            $results = $response->results;
        } catch(Exception $e) {
        }

        $this->assertNotNull($response);
        $this->assertNotNull($results);
        $this->assertInstanceOf(UrlResponse, $response);
        $this->assertInstanceOf(Url, $results);
        $this->assertNotEmpty($results->url);
    }

    public function testGetFileActivityLogs()
    {
        echo (" - " . __METHOD__ . "\n");

        $this->authenticateUser();

        try {
            $response = $this->api->getFileActivityLogs($this->accessToken, 0);
            $firstResult = $response->results[0];
        } catch(Exception $e) {
        }

        $this->assertNotNull($response);
        $this->assertNotNull($firstResult);
        $this->assertInstanceOf(LogResponse, $response);
        $this->assertInstanceOf(LogEntry, $firstResult);
    }

    public function testGetFolders()
    {
        echo (" - " . __METHOD__ . "\n");

        $this->authenticateUser();

        try {
            $response = $this->api->getFolders($this->accessToken, "/");
            $firstResult = $response->results[0];
        } catch(Exception $e) {
            // do nothing
        }

        $this->assertNotNull($response);
        $this->assertNotNull($firstResult);
        $this->assertInstanceOf(ResourcePropertiesResponse, $response);
        $this->assertInstanceOf(ResourceProperty, $firstResult);
    }

    public function testGetResourceList()
    {
        echo (" - " . __METHOD__ . "\n");

        $this->authenticateUser();

        try {
            $response = $this->api->getResourceList($this->accessToken, "/", "sort_files_type", "asc", 1, 25);
            $results = $response->results;
        } catch(Exception $e) {
            // do nothing
        }

        $this->assertNotNull($response);
        $this->assertNotNull($results);
        $this->assertInstanceOf(ResourceResponse, $response);
        $this->assertInstanceOf(Resource, $results);
    }

    public function testGetResourceProperties()
    {
        echo (" - " . __METHOD__ . "\n");

        $this->authenticateUser();
        $timeout = false;

        try {
            $response = $this->api->getResourceProperties($this->accessToken, array("/"));
            $firstResult = $response->results[0];
            
        } catch(Exception $e) {
            if (0 == $e->getCode()) {
                $timeout = true;
            }
        }

        if (true != timeout) {
            $this->assertNotNull($response);
            $this->assertNotNull($firstResult);
            $this->assertInstanceOf(ResourcePropertiesResponse, $response);
            $this->assertInstanceOf(ResourceProperty, $firstResult);    
        }
        
    }

    public function testGetUser()
    {
        echo (" - " . __METHOD__ . "\n");

        $this->authenticateUser();

        try {
            $response = $this->api->getUser($this->accessToken, self::USERNAME);
            $results = $response->results;
        } catch (Exception $e) {
            // do nothing
        }

        $this->assertNotNull($response);
        $this->assertNotNull($results);
        $this->assertInstanceOf(UserResponse, $response);
        $this->assertInstanceOf(User, $results);
    }

    public function testGetUsers()
    {
        echo (" - " . __METHOD__ . "\n");

        $this->authenticateUser();

        try {
            $response = $this->api->getUsers($this->accessToken, "sort_users_username", "asc");
            $firstResult = $response->results[0];
        } catch (Exception $e) {
            // do nothing
        }

        $this->assertNotNull($response);
        $this->assertNotNull($firstResult);
        $this->assertInstanceOf(UsersResponse, $response);
        $this->assertInstanceOf(User, $firstResult);
    }

    public function testMoveResources()
    {
        echo (" - " . __METHOD__ . "\n");

        $this->authenticateUser();

        try {
            // create a bunch of test folders to mess around with
            $this->api->createFolder($this->accessToken, self::FOLDER, "/");
            $this->api->createFolder($this->accessToken, self::SUBFOLDER, "/");

            // make actual call to moveResources
            $response = $this->api->moveResources($this->accessToken, array(self::SUBFOLDER), self::FOLDER);
            $firstResult = $response->results[0];

            // setup the expected values
            $folder = "/" . self::FOLDER;
            $subFolder = "/" . self::SUBFOLDER;
            $movedFolder = $folder . $subFolder;

        } catch (Exception $e) {
            // do nothing
        }

        $this->assertNotNull($response);
        $this->assertNotNull($firstResult);
        $this->assertInstanceOf(ModifiedResourcesResponse, $response);
        $this->assertInstanceOf(ModifiedResource, $firstResult);
        $this->assertEquals($subFolder, $firstResult->file);
        $this->assertEquals($movedFolder, $firstResult->destination);

        // cleanup test folder
        $this->api->deleteResources($this->accessToken, $folder);
    }

    public function testPreviewFile()
    {
        echo (" - " . __METHOD__ . "\n");

        $this->authenticateUser();

        try {
            $response = $this->api->previewFile($this->accessToken, self::PREVIEW, "small");
            $results = $response->results;
        } catch (Exception $e) {
            // do nothing
        }

        $this->assertNotNull($response);
        $this->assertNotNull($results);
        $this->assertInstanceOf(PreviewFileResponse, $response);
        $this->assertInstanceOf(PreviewFile, $results);
    }

    public function testRenameResource()
    {
        echo (" - " . __METHOD__ . "\n");

        $this->authenticateUser();

        try {
            $newFolderName = self::RENAME_FOLDER . "-rename";
            $response = $this->api->renameResource($this->accessToken, self::RENAME_FOLDER, $newFolderName);
            $response = $this->api->renameResource($this->accessToken, $newFolderName, self::RENAME_FOLDER);
        } catch (Exception $e) {
            // do nothing
        }

        $this->assertNotNull($response);
        $this->assertInstanceOf(Response, $response);
        $this->assertEquals(1, $response->success);
    }

    public function testUpdateUser()
    {
        echo (" - " . __METHOD__ . "\n");

        $this->authenticateUser();

        try {
            // create the user, then get their userId
            $response = $this->createUser();
            $response = $this->api->getUser($this->accessToken, self::TEST_USER);
            $userId = $response->results->id;

            // make the call to updateUser
            $response = $this->api->updateUser($this->accessToken, $userId, self::TEST_USER . "-changed");
            $results = $response->results;
            
        } catch (Exception $e) {
            // do nothing
        }

        $this->assertNotNull($response);
        $this->assertInstanceOf(Response, $response);
        $this->assertEquals(1, $response->success);

        $this->api->deleteUser($this->accessToken, self::TEST_USER . "-changed");
    }

    public function testUserAvailable()
    {
        echo (" - " . __METHOD__ . "\n");

        $this->authenticateUser();

        try {
            $response = $this->api->userAvailable($this->accessToken, self::USERNAME);
            $results = $response->results;
        } catch (Exception $e) {
            // do nothing
        }

        $this->assertNotNull($response);
        $this->assertNotNull($results);
        $this->assertInstanceOf(AvailableUserResponse, $response);
        $this->assertInstanceOf(AvailableUser, $results);
        $this->assertEquals(false, $results->available);
    }

    /**
     * tearDown(): logs out the authenticatedUser after each test is
     * performed
     */
    public function tearDown()
    {
        $this->api->logoutUser($this->accessToken);
    }

    /**
     * authenticateUser(): authenticates user with test data and
     * returns the response object
     */
    private function authenticateUser()
    {
        $response = $this->api->authenticateUser(self::USERNAME, self::PASSWORD);
        $this->accessToken = $response->results->accessToken;
        return $response;
    }

    /**
     * createUser(): creates a test user and returns response object
     */
    private function createUser()
    {
        return $this->api->createUser(
            $this->accessToken,
            self::TEST_USER,
            "/",
            self::TEST_EMAIL,
            self::PASSWORD,
            "user",
            '"upload":true,"download":true',  // this needs to be a comma separated value, (CSV)
            null,
            null,
            null,
            self::TIMEZONE
            );
    }

    /**
     * deleteUser(): creates a test user and returns response object
     */
    private function deleteUser()
    {
        return $this->api->deleteUser($this->accessToken, self::TEST_USER);
    }
}
