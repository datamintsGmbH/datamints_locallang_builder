<?php

/**
 * Copyright (c) 2021. Mark Weisgerber (mark.weisgerber@outlook.de / m.weisgerber@datamints.com)
 */

namespace Datamints\DatamintsLocallangBuilder\Utility;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;

class LanguageUtility
{
	/**
	 * Gets the default language path for a locallang file ".../de.locallang.xlf" becomes ".../locallang.xlf"
	 *
	 * @param string $path
	 *
	 * @return string
	 */
	public static function getDefaultLanguagePath(string $path): string
	{
		$pathinfo = pathinfo($path);
		if(self::isDefaultLanguageFile($pathinfo['filename'])) { // If its already a default-file, we'll return it again. Nothing to do so far
			return $path;
		}
		$replaceFilename = substr($pathinfo['filename'], strlen(self::getLanguageByFilename($pathinfo['filename'])) + 1); // Removing the language code from the filename de.locallang.xlf becomes locallang.xlf. Adding +1 for the dot.
		return str_replace($pathinfo['filename'], $replaceFilename, $path); // Replacing the old filename with the $replaceFilename
	}

	/**
	 * Checks, if the filename matches a dot.
	 * Everything before the dot has to be the language code, so we return false in this case
	 *
	 * @param string $filename
	 *
	 * @return bool
	 */
	public static function isDefaultLanguageFile(string $filename): bool
	{
		return count(explode('.', $filename)) === 1;
	}

	/**
	 * Returns language code for a filename like de.locallang.xlf => 'de'
	 * We can return the first part splittet by an dot, because its always the first part of a filename
	 *
	 * @param string $filename
	 *
	 * @return string
	 */
	public static function getLanguageByFilename(string $filename): string
	{
		return explode('.', $filename)[0];
	}

	/**
	 * Adds the country code to a default locallang-path ".../locallang.xlf" becomes ".../de.locallang.xlf"
	 *
	 * @param string $country
	 * @param string $path
	 *
	 * @return string
	 */
	public static function getCountryLanguagePath(string $country, string $path): string
	{
		$pathinfo = pathinfo($path);
		if(!self::isDefaultLanguageFile($pathinfo['filename'])) { // If its not a default-file, we'll return it again. Nothing to do so far
			return $path;
		}
		// todo
		$replaceFilename = $country . '.' . $pathinfo['basename']; // Adding the given language code as prefix separated by a dot, e.g. the filename locallang.xlf becomes de.locallang.xlf.
		return $pathinfo['dirname'] . '/' . $replaceFilename; // were building the path again, because with a str_replace on full path theres the possibility to replace other matching folder names like "fileadmin/locallang/blabla/locallang.xlf" with locallang matching 2 times
    }
}
