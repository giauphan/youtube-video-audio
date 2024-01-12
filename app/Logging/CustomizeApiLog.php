<?php

declare(strict_types=1);

namespace App\Logging;

use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
use ZipArchive;

class CustomizeApiLog
{
 
    public function __invoke()
    {
        $logger = new Logger('api');
        $logFilePath = storage_path('logs/api.log');

        $this->checkSizeLog($logFilePath);
        $logger->pushHandler(new StreamHandler($logFilePath, Level::Info, false, null, false));

        return $logger;
    }

    public function checkSizeLog(string $logFilePath)
    {
        $maxSizeLog = config('logging.max_size_log');
        if (file_exists($logFilePath)) {
            $fileSize = filesize($logFilePath);
            if ($fileSize > $maxSizeLog) {
                $zipLogName = 'api'.time().'.zip';
                $zipFilePath = dirname($logFilePath).'/'.$zipLogName;

                $zip = new ZipArchive();
                if ($zip->open($zipFilePath, ZipArchive::CREATE) === true) {
                    // Add the file to the zip archive
                    $zip->addFile($logFilePath, basename($logFilePath));

                    // Close the zip archive
                    $zip->close();

                    echo 'File zipped successfully.';
                } else {
                    echo 'Failed to create zip file.';
                }
            }
        }
    }
}
