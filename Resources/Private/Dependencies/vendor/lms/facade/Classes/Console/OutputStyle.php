<?php
declare(strict_types = 1);

namespace LMS\Facade\Console;

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

use Symfony\Component\Console\{Input\InputInterface, Output\OutputInterface};

/**
 * @author Sergey Borulko <borulkosergey@icloud.com>
 */
class OutputStyle extends \Symfony\Component\Console\Style\SymfonyStyle
{
    /**
     * The output instance.
     *
     * @var \Symfony\Component\Console\Output\OutputInterface
     */
    private $output;

    /**
     * Create a new Console OutputStyle instance.
     *
     * @param \Symfony\Component\Console\Input\InputInterface   $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    public function __construct(InputInterface $input, OutputInterface $output)
    {
        $this->output = $output;

        parent::__construct($input, $output);
    }

    /**
     * Returns whether verbosity is quiet (-q).
     *
     * @return bool
     */
    public function isQuiet()
    {
        return $this->output->isQuiet();
    }

    /**
     * Returns whether verbosity is verbose (-v).
     *
     * @return bool
     */
    public function isVerbose()
    {
        return $this->output->isVerbose();
    }

    /**
     * Returns whether verbosity is very verbose (-vv).
     *
     * @return bool
     */
    public function isVeryVerbose()
    {
        return $this->output->isVeryVerbose();
    }

    /**
     * Returns whether verbosity is debug (-vvv).
     *
     * @return bool
     */
    public function isDebug()
    {
        return $this->output->isDebug();
    }
}
