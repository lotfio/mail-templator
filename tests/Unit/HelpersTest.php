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

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class HelpersTest extends TestCase
{
    /**
     * test class base name helper
     *
     * @return void
     */
    public function testClassBaseNameHelper()
    {
        $class          = 'MyNameSpace\MyClass';
        $classNameOnly  = classBasename($class);

        $this->assertEquals('MyClass', $classNameOnly);
    }

    /**
     * test subject from template name helper
     *
     * @return void
     */
    public function testSubjectFromTemplateNameHelper()
    {
        $class          = 'MyNameSpace\MyExampleClassTemplate';
        $subject        = subjectFromTemplateName($class);

        $this->assertEquals('My example class', $subject);
    }
}