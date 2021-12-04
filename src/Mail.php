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
use MailTemplator\Contracts\TemplateInterface;

final class Mail
{
    /**
     * mail template
     *
     * @var TemplateInterface
     *
     * @psalm-suppress PropertyNotSetInConstructor
     */
    private TemplateInterface $template;

    /**
     * additional template variables
     *
     * @var array|null
     *
     * @psalm-suppress PropertyNotSetInConstructor
     */
    private ?array $variables;

    /**
     * mailer object
     *
     * @var MailAdapterInterface
     */
    private MailAdapterInterface $mailer;

    /**
     * set up
     *
     * @param array $settings
     */
    public function __construct(MailAdapterInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * set email template
     *
     * @param  TemplateInterface $template
     * @param  array|null $variables
     * @return self
     */
    public function setTemplate(TemplateInterface $template, ?array $variables = null): self
    {
        $this->template  = $template;
        $this->variables = $variables;
        return $this;
    }

    /**
     * preview email before sending
     *
     * @return string
     */
    public function preview(): string
    {
        return $this->template->render(
            $this->variables
        );
    }

    /**
     * send mail
     *
     * @param  string $to
     * @param  string|null $customSubject
     * @return boolean
     */
    public function send(string $to, string $customSubject = null): bool
    {
        // remove template word
        // all Templates ends with Template so its handy to remove it
        $subject = subjectFromTemplateName($this->template);

        // pass variables additional to template
        $message = $this->template->render(
            $this->variables
        );

        // send email using mail adapter
        return $this->mailer->send($to, $customSubject ?? $subject, $message);
    }
}
