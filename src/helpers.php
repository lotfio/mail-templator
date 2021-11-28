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

/**
 * class base name helper function
 *
 * @param  mixed $class
 * @return string
 */
function classBasename(mixed $class): string
{
    $class = is_object($class) ? get_class($class) : $class;
    return basename(str_replace('\\', '/', $class));
}

/**
 * get subject from template function
 *
 * @param  mixed $template
 * @return string
 */
function subjectFromTemplateName(mixed $template): string
{
    $subject = substr(
        classBasename(
        $template
    ),
        0,
        -8
    );

    $subject = preg_replace('/[A-Z]/', ' $0', $subject);

    return ucfirst(strtolower(trim($subject)));
}
