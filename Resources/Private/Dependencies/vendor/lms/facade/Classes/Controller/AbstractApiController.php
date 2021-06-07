<?php
declare(strict_types = 1);

namespace LMS\Facade\Controller;

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

/**
 * @author Sergey Borulko <borulkosergey@icloud.com>
 */
abstract class AbstractApiController extends Base\ApiController
{
    /**
     *
     */
    public function showAction(int $uid): void
    {
        $this->view->setVariablesToRender([$this->getRootName()]);

        $this->view->assign($this->getRootName(), [$this->getEntity($uid)]);
    }

    /**
     * Just render all the existing items related to specific resource
     */
    public function indexAction(): void
    {
        $this->view->setVariablesToRender([$this->getRootName()]);

        $this->view->assign($this->getRootName(), $this->getResourceRepository()->all());
    }

    /**
     *
     */
    public function setPropertiesAction(int $uid, array $data): void
    {
        $table = (string)$data['table'];

        unset($data['table']);

        $this->getResourceRepository()->setEntityProperties($uid, $table, $data);

        $this->view->assign('value', ['success' => true]);
    }

    /**
     *
     */
    public function updateAction(int $uid, array $data): void
    {
        if ($entity = $this->getEntity($uid)) {
            foreach ($data as $propertyName => $propertyValue) {
                $entity->_setProperty($propertyName, $propertyValue);
            }

            $entity->save();
        }

        $this->view->assign('value', ['success' => (bool)$entity]);
    }

    /**
     *
     */
    public function storeAction(array $data): void
    {
        $repository = $this->getResourceRepository();

        $this->view->assign('value', [
            'success' => $repository->persist($repository->produce($data))
        ]);
    }

    /**
     *
     */
    public function destroyAction(int $uid): void
    {
        $entity = $this->getEntity($uid);

        $this->view->assign('value', [
            'success' => $entity && $entity->delete()
        ]);
    }
}
