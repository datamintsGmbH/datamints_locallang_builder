<?php
declare(strict_types = 1);

namespace LMS\Facade\Extbase\Action;

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

use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;

/**
 * @author Sergey Borulko <borulkosergey@icloud.com>
 */
trait CouldReturnPsrResponse
{
    /**
     * The repository has been fully copy/pasted from the original Extbase Controller
     *
     * @psalm-suppress InternalMethod
     * {@inheritdoc}
     */
    protected function callActionMethod(): void
    {
        $preparedArguments = [];
        /** @var \TYPO3\CMS\Extbase\Mvc\Controller\Argument $argument */
        foreach ($this->arguments as $argument) {
            $preparedArguments[] = $argument->getValue();
        }
        $validationResult = $this->arguments->validate();
        if (!$validationResult->hasErrors()) {
            $this->emitBeforeCallActionMethodSignal($preparedArguments);
            $actionResult = $this->{$this->actionMethodName}(...$preparedArguments);
        } else {
            $actionResult = $this->{$this->errorMethodName}();
        }

        if ($actionResult === null && $this->view instanceof ViewInterface) {
            $this->response->appendContent($this->view->render());
        } elseif (is_string($actionResult) && $actionResult !== '') {
            $this->response->appendContent($actionResult);
        } elseif (is_object($actionResult) && method_exists($actionResult, '__toString')) {
            $this->response->appendContent((string)$actionResult);
        } elseif ($actionResult instanceof \Psr\Http\Message\ResponseInterface) {
            // If the return type is Response we check if no redirect is there
            if ($actionResult->hasHeader('Location')) {
                header('Location: ' . $actionResult->getHeaderLine('Location'));
                exit();
            }

            // Otherwise just take the response body and assign it to the original Extbase Response
            $this->response->setContent((string)$actionResult->getBody());
        }
    }
}
