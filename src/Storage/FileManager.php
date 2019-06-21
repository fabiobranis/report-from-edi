<?php


namespace Storage;

/**
 * This file manager only opens a stream in read mode
 * Class FileManager
 * @package Storage
 */
class FileManager
{

    const MODE = 'r';

    /**
     * @var string
     */
    private $filePath;

    /**
     * @var string
     */
    private $outputFolder;

    /**
     * @var string
     */
    private $fileName;

    /**
     * @var resource
     */
    private $stream;

    /**
     * FileManager constructor.
     * @param string $filePath
     * @param string $outputFolder
     */
    public function __construct(string $filePath, string $outputFolder)
    {

        // make the directories if they doesn't exists
        if (!is_dir(dirname($filePath))) {
            mkdir(dirname($filePath));
        }
        self::makeDirectory(dirname($filePath));
        self::makeDirectory($outputFolder);
        $this->filePath = $filePath;
        $this->outputFolder = $outputFolder;
        $this->fileName = basename($this->filePath, '.dat');
        $this->stream = fopen($this->filePath, self::MODE);

    }

    /**
     * Whenever the lifecycle of class is ended, the file will be closed
     */
    public function __destruct()
    {
        $this->closeFile();
    }

    /**
     * Static function to create folders if the does not exists
     * @param $path
     */
    public static function makeDirectory($path): void
    {
        if (!is_dir($path)) {
            mkdir($path);
        }
    }

    /**
     * Close the file
     */
    public function closeFile(): void
    {
        fclose($this->stream);
    }

    /**
     * Move the file to the output folder
     * @return bool
     */
    public function moveFile(): bool
    {
        return rename($this->filePath, $this->outputFolder . $this->fileName . '.done.dat');
    }

    /**
     * Get the file stream
     * PHP can't specify the resource that's returned. For me it's a bit annoying
     * @return resource
     */
    public function getStream()
    {
        return $this->stream;
    }

}