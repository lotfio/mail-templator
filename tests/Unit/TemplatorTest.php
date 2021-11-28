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

use MailTemplator\Exceptions\TemplatorException;
use PHPUnit\Framework\TestCase;
use MailTemplator\Templator;

class TemplatorTest extends TestCase
{
    /**
     * templator object
     *
     * @var Templator
     */
    protected Templator $templator;

    /**
     * setup
     *
     * @return void
     */
    public function setUp(): void
    {
        $this->templator = new class extends Templator {};
    }

    /**
     * test load wrong template
     *
     * @return void
     */
    public function testLoadInvalidTemplateMethod()
    {
        $this->expectException(TemplatorException::class);
        $this->templator->loadTemplate("wrong_file");
    }

    /**
     * test load default template
     *
     * @return void
     */
    public function testLoadDefaultTemplate()
    {
        $obj = $this->templator->loadTemplate();
        $this->assertInstanceOf(Templator::class, $obj);
    }

    /**
     * test parse template
     *
     * @return void
     */
    public function testParseTemplate()
    {
        $this->templator->loadTemplate();
        $res = $this->templator->parse([
            'title' => 'testing'
        ]);
        $this->assertStringContainsString('testing', $res);
        $this->assertStringContainsString('@CONTENT@', $res);
    }
}