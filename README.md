<p align="center">
  <img src="https://github.com/lotfio/mail-templator/blob/master/docs/logo.jpg"  alt="mail Preview" width="200">
  <p align="center">
    <img src="https://img.shields.io/badge/License-MIT-f1c40f"        alt="License">
    <img src="https://img.shields.io/badge/PHP-8-3498db.svg"          alt="PHP version">
    <img src="https://img.shields.io/badge/coverage-95%25-27ae60.svg" alt="Coverage">
    <img src="https://img.shields.io/badge/downloads-1k-e74c3c.svg"   alt="Downloads">
    </p>
  <p align="center">
    <strong>MailTemplator (Easy templates for your emails).</strong>
  </p>
</p>

## 🔥 Introduction :
MailTemplator is lightweight PHP package that helps you create, edit and customize email templates.


# :pushpin: Requirements :
- PHP  >= 8
- PHPUnit >= 9 (for testing purpose)

# :rocket: Installation & Use :
```php
    composer require lotfio/mail-templator
```

# 💥 testing :
```php
    composer test-unit
    composer test-integration
```
# 💥 static analysis :
```php
    composer psalm
```

# :pencil2: Usage :
- Create your custom Mail Template in your preferred folder withing your project.
- Mail template class name should ends with Template (MyCustomTemplate, MySecondTemplate).

```php
<?php

namespace MyCustomMilTemplates;

use MailTemplator\Templator;
use MailTemplator\Contracts\TemplateInterface;

final class MyTemplate extends Templator implements TemplateInterface
{
    /**
     * render this template method
     *
     * @param  array|null $variables
     * @return string
     */
    public function render(?array $variables = null): string
    {
        return $this->loadTemplate()->parse($variables);
    }
}

```
## Available Directives
- @LOGO@, @OPENLINE@, @HEADER@, @CONTENT@, @FOOTER@, @SUBFOOTER@, @POWEREDBY@
- You can customize and update the content of these directives with setters and also with protected properties
- Example :

```php
<?php

namespace MyCustomMilTemplates;

use MailTemplator\Templator;
use MailTemplator\Contracts\TemplateInterface;

final class MyTemplate extends Templator implements TemplateInterface
{
    // you can use a protected property
    protected string $logo = '<img src="https://mysite.com/logo.png">';

    // or a protected setter
    protected function setLogo(): void
    {
      $this->logo = '<img src="https://mysite.com/logo.png">';
    }

    // all other directives can be updated the same way
}

```
## Custom directives

```php
<?php

namespace MyCustomMilTemplates;

use MailTemplator\Templator;
use MailTemplator\Contracts\TemplateInterface;

final class MyTemplate extends Templator implements TemplateInterface
{
    // declare your custom directives
    protected string $content = 'Hello @USERNAME@ how are u ?';
}

```
- Then you can pass the value with the template `setTemplate(new MyTemplate, ['username' => $username])`
## Custom Static Template
- By default templator uses [Free Responsive HTML Email Template](https://github.com/leemunroe/responsive-html-email-template)
- You can use your custom static template

```php
final class MyTemplate extends Templator implements TemplateInterface
{
    /**
     * render this template method
     *
     * @param  array|null $variables
     * @return string
     */
    public function render(?array $variables = null): string
    {
        return $this->loadTemplate(
          'link/to/your/static/tepmlate.html'
        )->parse($variables);
    }
}
```

## Send mail with Templator
- Send mail with your template
- Email subject will follow Template class name
```php

// your mailer (PHPMailer or swift)
// should implement MailAdapterInterface
$customMailer = new class implements MailTemplator\Contracts\MailAdapterInterface{
  public function send(string $to, string $subject, string $message): bool
  {
     // your mailer send should be wrapped here
     // $subject will be taken from template class name  if no custom subject provided
  }
}

// create an instance of mail class
$mail = new MailTemplator\Mail(
  $customMailer
);

// set your template
$mail->setTemplate(
  new MyCustomMilTemplates\MyTemplate
);

// send mail with the given template
$mail->send('to');

```

# :helicopter: TODO
- Adding laravel support

# :computer: Contributing

- Thank you for considering to contribute to ***mail-templator***. All the contribution guidelines are mentioned [here](CONTRIBUTE.md).

# :page_with_curl: ChangeLog

- Here you can find the [ChangeLog](CHANGELOG.md).

# :beer: Support the development

- Share ***Caprice*** and lets get more stars and more contributors.
- If this project helped you reduce time to develop, you can give me a cup of coffee :) : **[Paypal](https://www.paypal.me/lotfio)**. 💖

# :clipboard: License

- ***Mail-Templator*** is an open-source software licensed under the [MIT license](LICENSE).
