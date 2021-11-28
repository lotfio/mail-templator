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

interface MailAdapterInterface
{
    /**
     * send mail method
     *
     * @param  string $to
     * @param  string $subject
     * @param  string $message
     * @return boolean
     */
    public function send(string $to, string $subject, string $message): bool;
}
