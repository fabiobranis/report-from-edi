<?php

namespace App\Reader;

use App\Reader\Exceptions\EndOfFileException;
use Storage\FileManager;

/**
 * A class to manage the file stream
 * Class FileStream
 * @package App\Reader
 */
class FileStream
{

    /**
     * @var FileManager
     */
    private $fileManager;

    /**
     * @var resource
     */
    private $stream;

    /**
     * FileStream constructor.
     * @param FileManager $fileManager
     */
    public function __construct(FileManager $fileManager)
    {
        $this->fileManager = $fileManager;
        $this->stream = $this->fileManager->getStream();
    }

    /**
     * Check if is the end of the file
     * @return bool
     */
    public function hasLine(): bool
    {
        return !feof($this->stream);
    }

    /**
     * Read the line
     * @return string
     * @throws EndOfFileException
     */
    public function readLine(): string
    {
        if (!$this->hasLine()) {
            throw new EndOfFileException('The file has no more lines to be read');
        }

        return fgets($this->stream);
    }

    /**
     * Send a message to file manager to close the file
     */
    public function close(): void
    {
        $this->fileManager->closeFile();
    }

}