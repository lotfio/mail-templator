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

namespace MailTemplator\Contracts;

interface TemplateInterface
{
    /**
     * render template method
     *
     * @param  array|null $variables
     * @return string
     */
    public function render(?array $variables = null): string;
}
