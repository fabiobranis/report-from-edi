<?php

namespace Test;

use PHPUnit\Framework\TestCase;

class FileTestContext extends TestCase
{

    /**
     * @var string
     */
    protected $filePath;

    /**
     * @var string
     */
    protected $storageFilePath;

    /**
     * @var string
     */
    protected $outputFolder;

    /**
     * FileTestContext constructor.
     * @param null $name
     * @param array $data
     * @param string $dataName
     */
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->filePath = __DIR__ . '/fixtures/test.dat';
        $this->storageFilePath = __DIR__ . '/../storage/in/test.dat';

        if (!is_dir(dirname($this->storageFilePath))) {
            mkdir(dirname($this->storageFilePath));
        }

        copy($this->filePath, $this->storageFilePath );
        $this->outputFolder = __DIR__ . '/../storage/out/';

        if (!is_dir($this->outputFolder)) {
            mkdir($this->outputFolder);
        }
    }

    /**
     * Delete the test file as the test suite ends
     */
    protected function tearDown(): void
    {
        $file = $this->outputFolder . 'test.done.dat';

        if (file_exists($file)) {
            unlink($file);
        }

        parent::tearDown();
    }


}