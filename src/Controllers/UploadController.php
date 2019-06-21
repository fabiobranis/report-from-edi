<?php


namespace App\Controllers;


use App\Services\Upload\UploadFile;
use GuzzleHttp\Psr7\Response;
use function GuzzleHttp\Psr7\stream_for;

/**
 * Class UploadController
 * @package App\Controllers
 */
class UploadController
{
    /**
     * @var UploadFile
     */
    private $uploadFile;

    /**
     * @var Response
     */
    private $response;

    /**
     * ReportController constructor.
     * @param UploadFile $uploadFile
     * @param Response $response
     */
    public function __construct(UploadFile $uploadFile, Response $response)
    {
        $this->uploadFile = $uploadFile;
        $this->response = $response;
    }

    /**
     * Call the upload service and return the response
     * @return string
     */
    public function upload(): string
    {
        $file = $this->uploadFile->handle();
        header('Content-Type: application/json');
        $response = $this->response->withBody(stream_for(
                json_encode([
                        'report' => $file,
                    ]
                )
            )
        );
        return $response->getBody();
    }
}