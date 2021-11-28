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

namespace MailTemplator\Templates;

use MailTemplator\Templator;
use MailTemplator\Contracts\TemplateInterface;

final class ExampleTemplate extends Templator implements TemplateInterface
{
    /**
     * render this template method
     *
     * @param  array|null $variables
     * @return string
     */
    public function render(?array $variables = null): string
    {
        return $this->loadTemplate()->parse($variables);
    }
}
