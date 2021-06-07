<?php
declare(strict_types = 1);

namespace LMS\Facade\Extbase;

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

use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\Request;
use TYPO3\CMS\Core\Http\{HtmlResponse, JsonResponse};

/**
 * @author Sergey Borulko <borulkosergey@icloud.com>
 */
class Response
{
    /**
     * Create the fresh instance of Response
     *
     * @psalm-suppress InternalClass
     *
     * @param string $content
     * @param int $status
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public static function createWith(string $content, int $status = 200): ResponseInterface
    {
        if (Response::isJson()) {
            return new JsonResponse(json_decode($content, true), $status);
        }

        return new HtmlResponse($content, $status);
    }

    /**
     * Response should be in json ?
     *
     * @return bool
     */
    public static function isJson(): bool
    {
        $accepts = collect(Request::createFromGlobals()->getAcceptableContentTypes());

        return $accepts->contains('application/json');
    }
}
