<?php


namespace Test\Reader;


use App\Reader\FileStream;
use App\Reader\Exceptions\EndOfFileException;
use Storage\FileManager;
use Test\FileTestContext;

/**
 * Class FileStreamTest
 * @package Test\Reader
 */
class FileStreamTest extends FileTestContext
{

    private $file;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->file = new FileStream(new FileManager($this->filePath, $this->outputFolder));
    }

    /**
     * @throws EndOfFileException
     */
    public function testReadStream(): void
    {
        $this->assertIsObject($this->file);

        while ($this->file->hasLine()) {
            $this->assertIsString($this->file->readLine());
        }

    }

}