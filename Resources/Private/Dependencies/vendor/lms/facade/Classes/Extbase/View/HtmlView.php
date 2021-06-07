<?php
declare(strict_types = 1);

namespace LMS\Facade\Extbase\View;

/* * *************************************************************
 *
 *  Copyright notice
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 * ************************************************************* */

use TYPO3\CMS\Fluid\View\StandaloneView;
use TYPO3\CMS\Core\TypoScript\TypoScriptService;
use LMS\Facade\{Extbase\ExtensionHelper, ObjectManageable, Extbase\TypoScriptConfiguration as TS};

/**
 * @author Sergey Borulko <borulkosergey@icloud.com>
 */
trait HtmlView
{
    use ExtensionHelper;

    /**
     * @param string $template
     * @param array  $variables
     *
     * @return \TYPO3\CMS\Fluid\View\StandaloneView
     */
    public function getExtensionView(string $template, array $variables = []): StandaloneView
    {
        $view = $this->createView();

        $viewTS = TS::getView(self::extensionTypoScriptKey());

        $settings = $this->typoScriptService()->convertTypoScriptArrayToPlainArray(
            TS::getSettings(self::extensionTypoScriptKey())
        );

        $view->setFormat('html');
        $view->setLayoutRootPaths($viewTS['layoutRootPaths.'] ?: []);
        $view->setPartialRootPaths($viewTS['partialRootPaths.'] ?: []);
        $view->setTemplateRootPaths($viewTS['templateRootPaths.'] ?: []);
        $view->setTemplate($template);

        return $view->assignMultiple(array_merge($settings, $variables));
    }

    /**
     * @return \TYPO3\CMS\Core\TypoScript\TypoScriptService
     */
    public function typoScriptService(): TypoScriptService
    {
        return ObjectManageable::createObject(TypoScriptService::class);
    }

    /**
     * @return \TYPO3\CMS\Fluid\View\StandaloneView
     */
    public function createView(): StandaloneView
    {
        return ObjectManageable::createObject(StandaloneView::class);
    }
}
