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

use MailTemplator\Contracts\MailAdapterInterface;
use Illuminate\Support\ServiceProvider;

/**
 * @psalm-suppress UndefinedClass
 *
 * mail templator service provider
 */
class MailTemplatorServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(Mail::class, function ($app) {
            return new Mail($app->make(MailAdapterInterface::class));
        });

        $this->app->alias(Mail::class, 'MailTemplator');
    }
}