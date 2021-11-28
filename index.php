<?php

use MailTemplator\Contracts\MailAdapterInterface;
use MailTemplator\Mail;
use MailTemplator\Templates\ExampleEmailTemplate;

require 'vendor/autoload.php';


$phpMailer = new class implements MailAdapterInterface {

    public function send(string $to, string $subject, string $message): bool
    {
        // $to      => receiver
        // $subject => your subject taken from template name
        // $message => html formatted email


        // then you can send it with your mailer (phpmailer or symfony)
        echo $message;
        return true;
    }
};

$swiftMailer = new class implements MailAdapterInterface {
    public function send(string $to, string $subject, string $message): bool { return true; }
};







$mail = new Mail($phpMailer);

print $mail->setTemplate(
    new ExampleEmailTemplate, ['username' => 'lotfio@gmail.com']
)->send('a');