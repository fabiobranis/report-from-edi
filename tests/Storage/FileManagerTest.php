<?php


namespace Test\Storage;


use Storage\FileManager;
use Test\FileTestContext;

/**
 * Class FileManagerTest
 * @package Test\Storage
 */
class FileManagerTest extends FileTestContext
{

    /**
     * Assert if the FileManager is returning the right type (Stream)
     */
    public function testStreamIsValid(): void
    {
        $manager = new FileManager($this->storageFilePath, $this->outputFolder);
        $this->assertIsResource($manager->getStream());

    }

    /**
     * Check if the file is properly moved
     */
    public function testMoveFile(): void
    {
        $manager = new FileManager($this->storageFilePath, $this->outputFolder);
        $this->assertTrue($manager->moveFile());
        $this->assertFileExists($this->outputFolder . '/test.done.dat');
    }





}