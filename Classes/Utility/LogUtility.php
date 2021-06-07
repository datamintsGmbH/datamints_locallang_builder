<?php

namespace Datamints\DatamintsLocallangBuilder\Utility;


/***
 */
class LogUtility
{
    private const FOLDER_PATH = "/typo3temp/logs/datamints_locallang_builder/";

    /**
     * Logs api-calls in typo3temp/logs/*
     *
     * @param string $message
     */
    public static function log($message): void
    {
        if(!is_dir(\TYPO3\CMS\Core\Core\Environment::getPublicPath() . self::FOLDER_PATH)) {
            \mkdir(\TYPO3\CMS\Core\Core\Environment::getPublicPath() . self::FOLDER_PATH, 0777, true);
        }


        $relativePath = self::FOLDER_PATH . "api.txt";
        $date = '<b>' . date("Y.m.d H:i.s") . '</b>';
        file_put_contents(\TYPO3\CMS\Core\Core\Environment::getPublicPath() . $relativePath, $date . " - " . $message . '<br>' . \PHP_EOL, \FILE_APPEND);
    }
}
