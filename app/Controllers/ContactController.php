<?php
 
namespace App\Controllers;

use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;
use Zend\Diactoros\ServerRequest;
use Zend\Diactoros\Response\RedirectResponse;

class ContactController extends BaseController
{
    public function index()
    {
        return $this->renderHTML('contacts/index.twig');
    }

    public function send(ServerRequest $request)
    {
        $requestData = $request->getParsedBody();

        $transport = (new Swift_SmtpTransport(getenv('SMTP_HOST'), getenv('SMTP_PORT')))
            ->setUsername(getenv('SMTP_USER'))
            ->setPassword(getenv('SMTP_PASSWORD'))
        ;

        // Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);

        // Create a message
        $message = (new Swift_Message('Wonderful Subject'))
            ->setFrom(['contact@mail.com' => 'Contact Form'])
            ->setTo(['jcocaharo@hotmail.com' => 'A name'])
            ->setBody('Hi, you have a new message. Name: ' . $requestData['name'] 
                . ' Email: ' . $requestData['email'] . ' Message: ' . $requestData['message'])
        ;

        // Send the message
        $result = $mailer->send($message);
        return new RedirectResponse('/primer-proyecto-php/contact');
    }
}