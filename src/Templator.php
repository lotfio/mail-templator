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

use MailTemplator\Exceptions\TemplatorException;

abstract class Templator
{
    /**
     * email template
     *
     * @var string
     */
    private string $template = '';

    /**
     * load template
     *
     * @param  string $name
     * @return self
     *
     * @psalm-suppress PossiblyNullArgument
     */
    public function loadTemplate(?string $name = null): self
    {
        $file = $name;
        if (is_null($name)) {
            $file = (__DIR__ . '/static/main.html');
        }

        if (realpath($file) === false) {
            throw new TemplatorException("Could not load template file ($file)");
        }

        $this->template = file_get_contents($file);

        return $this;
    }

    /**
     * parse template
     *
     * @param array|null $variables
     * @return string
     */
    public function parse(?array $variables): string
    {
        // load main template
        $template = $this->template;

        // override properties from sub class
        foreach (get_class_methods(static::class) as $method) { // set properties
            if (strpos($method, 'set') === 0) {
                call_user_func_array([$this, $method], []);
            }
        }

        // get sub class properties
        $properties = get_object_vars($this);

        if (is_array($variables)) { // if additional template data
            $properties = array_merge(get_object_vars($this), $variables);
        }

        // replace placeholders with properties values
        array_walk($properties, function (string &$value, string $key) use (&$template): void {

            // if not null
            if ($key && $value) {
                $pattern = '/@' . strtoupper($key) . '@/i';
                $template = preg_replace($pattern, $value, $template);
            }
        });

        return $this->template = $template;
    }
}
