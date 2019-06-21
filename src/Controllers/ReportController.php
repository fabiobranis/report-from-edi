<?php


namespace App\Controllers;


use App\Reader\Exceptions\EndOfFileException;
use App\Reader\FileStream;
use App\Reports\Exceptions\NullOrZeroSalesmanException;
use App\Reports\SalesReport;
use App\Services\Sales\BuildSalesModel;
use Storage\FileManager;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class ReportController
 * @package App\Controllers
 */
class ReportController
{

    /**
     * The method that will process the report
     * It's a little bloated because I need to review the way that I can reach the report variable in fast route
     * creation to inject into the DI container
     * @param $report
     * @param Environment $twig
     * @return string
     * @throws EndOfFileException
     * @throws NullOrZeroSalesmanException
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function show($report, Environment $twig): string
    {

        $file = __DIR__ . '/../../storage/in/' . $report . '.dat';
        $output = __DIR__ . '/../../storage/out/';
        $fileManager = new FileManager($file, $output);
        $fileStream = new FileStream($fileManager);

        // build the Report DTO
        $buildSalesModel = new BuildSalesModel($fileStream);

        //Move the file
        $fileManager->moveFile();
        $report = new SalesReport($buildSalesModel->make());

        // build the report
        $report->handle();

        // renders the view
        return $twig->render('report.twig',[
            'report' => $report,
        ]);
    }

}