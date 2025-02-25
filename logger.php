<?php
function logError($message) {
    $logFile = 'error_log.txt';
    $timestamp = date("Y-m-d H:i:s");
    $logMessage = "[$timestamp] ERROR: $message" . PHP_EOL;
    file_put_contents($logFile, $logMessage, FILE_APPEND);
}
?>
