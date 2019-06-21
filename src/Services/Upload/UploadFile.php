<?php


namespace App\Services\Upload;


use Psr\Http\Message\ServerRequestInterface;
use Storage\FileManager;

/**
 * A simple class to wrap upload file functionality
 * Class UploadFile
 * @package App\Services\Upload
 */
class UploadFile
{

    /**
     * @var string
     */
    private static $uploadDir = __DIR__ . '/../../../storage/in/';

    /**
     * @var ServerRequestInterface
     */
    private $request;

    /**
     * @var array
     */
    private $files;

    /**
     * UploadFile constructor.
     * @param ServerRequestInterface $request
     */
    public function __construct(ServerRequestInterface $request)
    {
        $this->request = $request;
        $this->files = $request->getUploadedFiles();
    }

    /**
     * Move the file to the right folder
     * @return string
     */
    public function handle(): string
    {

        foreach ($this->files as $uploadedFile) {
            /** @var $uploadedFile \GuzzleHttp\Psr7\UploadedFile */
            $movedFile = self::$uploadDir . $uploadedFile->getClientFilename();
            FileManager::makeDirectory(dirname($movedFile));
            $uploadedFile->moveTo($movedFile);
        }

        return basename($uploadedFile->getClientFilename(),'.dat');
    }

}