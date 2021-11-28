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
use MailTemplator\Templates\ExampleTemplate;

class ExampleTemplateTest extends TestCase
{
    /**
     * test render method
     *
     * @return void
     */
    public function testRenderMethod()
    {
        $template = new ExampleTemplate;
        $res      = $template->render(null);
        $this->assertStringContainsString('@TITLE@', $res);
    }

    /**
     * test render default properties method
     *
     * @return void
     */
    public function testRenderDefaultProperties()
    {
        $template        = new ExampleTemplate;
        $template->title = 'exampleTitle'; // use reflection if dynamic methods gets deprecated
        $res             = $template->render(null);
        $this->assertStringContainsString('exampleTitle', $res);
    }

    /**
     * test render additional properties
     *
     * @return void
     */
    public function testRenderAdditionalProperties()
    {
        $template          = new ExampleTemplate;
        $template->content = '@ADDITIONAL_PROPERTY@'; // use reflection if dynamic methods gets deprecated
        $res               = $template->render([
            'additional_property' => 'user_given_property'
        ]);
        $this->assertStringContainsString('user_given_property', $res);
    }
}