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

use MailTemplator\Contracts\MailAdapterInterface;
use MailTemplator\Templates\ExampleTemplate;
use PHPUnit\Framework\TestCase;
use MailTemplator\Mail;

class MailTest extends TestCase
{
    /**
     * mock mail adapter
     *
     * @return void
     */
    private function mailAdapterMock(): MailAdapterInterface
    {
        $mock = $this->getMockBuilder(MailAdapterInterface::class)->getMock();
        $mock->method('send')->willReturn(true);

        return $mock;
    }

    /**
     * test set email template
     *
     * @return void
     */
    public function testSetTemplateMethod()
    {
        $mail = new Mail($this->mailAdapterMock());
        $res  = $mail->setTemplate(new ExampleTemplate);
        $this->assertInstanceOf(Mail::class, $res);
    }

    /**
     * test preview template method
     *
     * @return void
     */
    public function testPreviewTemplateMethod()
    {
        $mail = new Mail($this->mailAdapterMock());
        $res  = $mail->setTemplate(new ExampleTemplate, [
            'openLine' => 'Hello there'
        ]);
        $res  = $res->preview();

        $this->assertStringContainsString('@TITLE@', $res);
        $this->assertStringContainsString('Hello there', $res);
    }

    /**
     * test send method
     *
     * @return void
     */
    public function testSendMethod()
    {
        $mail = new Mail($this->mailAdapterMock());
        $mail->setTemplate(new ExampleTemplate);

        $this->assertTrue(
            $mail->send('user@site.com')
        );
    }

}