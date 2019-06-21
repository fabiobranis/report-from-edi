<?php


namespace App\Controllers;


use App\Services\Upload\UploadFile;
use GuzzleHttp\Psr7\Response;
use function GuzzleHttp\Psr7\str;
use function GuzzleHttp\Psr7\stream_for;
use Twig\Environment;

class ReportController
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

    public function show($report, Environment $twig): string
    {
        return $twig->render('report.twig');
    }

    /**
     * Call the upload service and return the response
     * @return string
     */
    public function upload(): string
    {
        $file = $this->uploadFile->handle();
        //$this->response->withStatus(200, 'OK');
        header('Content-Type: application/json');
        $response = $this->response->withBody(stream_for(
                json_encode([
                        'report' => $file,
                    ]
                )
            )
        );
        return str($response);
    }
}