<?php

declare(strict_types=1);

/**
 *
 * @author    <contact@lotfio.net>
 * @package   mail templator
 * @version   0.1.0
 * @license   MIT
 * @category  CLI
 * @copyright 2021 Lotfio Lakehal
 */

namespace MailTemplator;

use Illuminate\Support\Facades\Facade;

class MailTemplatorFacade extends Facade
{
    /**
     * get facade accessor
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'MailTemplator';
    }
}