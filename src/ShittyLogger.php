<?php
namespace Dasauser;
/**
 * Class Logger
 * @package core\Utilities
 */
class ShittyLogger
{
    /**
     * Logging function
     * @param string $data
     * @param string $filename
     */
    public static function log(string $data, $filename = 'var/log/log') : void
    {
        $dir = substr($filename, 0, strlen($filename) - strlen(substr($filename, strripos($filename, '/'))));
        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
        }
        $file = $filename . '.log';
        //1 byte -> 1 kb -> 1 mb -> 10mb
        if (file_exists($file) && filesize($file) >= 1 * 1000 * 1000 * 10) {
            rename($file, $filename . '_' . time() . uniqid() . '.log');
        }
        file_put_contents($file, "[" . date('d.m.Y') . "][" . date('H:i:s') . "]:$data" . PHP_EOL , FILE_APPEND);
    }
}